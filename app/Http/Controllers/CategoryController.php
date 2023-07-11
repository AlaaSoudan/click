<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;
use Illuminate\Support\Facades\Event;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
 /*        $pageTitle = 'Countries'; */
        return view('category.show', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

/*         $rules = [
            'name' => 'required|unique:categories,name',
        ];
        $validate = Validator::make($request->all(), $rules);

        $messages = $validate->messages();
        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($messages);
        }  */
        $category = new category;
        $category->name = $request->name;



        if ($request->has('image')) {
            $imageDestination = 'public/images/category';
            $image = $request->file('image');
            $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($imageDestination, $imageName);

            $category->image =  'images/category' . '/' . $imageName;
        }


        $category->save();

     /*    Event::dispatch(new DataCreated()); */

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = category::findOrFail($request->id);

        if ($request->has('name') && $category->name != $request->name) {
            $category->name = $request->name;
        }

        if ($request->has('image')) {
          /*   Storage::delete($request->image); */
            $imageDestination = 'public/images/category';
            $image = $request->file('image');
            $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($imageDestination, $imageName);
            $category->image=  'images/category' . '/' . $imageName;
        }

        $category->update();

       return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = category::findOrFail($id);
        $category->delete();
        return redirect('/category');
    }


}
