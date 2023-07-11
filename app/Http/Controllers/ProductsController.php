<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();

       return view('product.show',compact('products',$products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = category::get();
        $parentProducts = Product::with('childrenProducts')->where('parentId', null)->get();
        return view('product.add',compact('parentProducts', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->parentId != null)
        {
            $rules =[
                'price' => ['required'],
            ];
            $request->validate($rules);
        }
        else{
            $request->validate([
                'name' =>'required',
                'description' => 'required',
                'price' => 'required',
                'category_id' => 'required',
            ]);

        }

        if($request->has('parentId') && $request->parentId != null)
        {
            $image=0;
            $parent = Product::findOrFail($request->parentId);
            $product = new product;
            $product->description =  $parent->description;
            $product->name = $parent->name;
            $product->price = $request->price == null ?$parent->price : $request->price;
            $product->category_id = $parent->category_id;
            $product->parentId = $request->parentId;

            if ($request->has('image') ) {
                $imageDestination = 'public/images/product';
                 $image = $request->file('image');
                 $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
                 $path = $request->file('image')->storeAs($imageDestination, $imageName);
                 $image ='images/product' . '/' . $imageName;
                 $product->image =  $image;
               }
               else{
                   $product->image = Product::findOrFail($request->parentId)->image;
               }
           $product->save();

        }
        else
        {
            $product = new product;
            $product->description = $request->description;
            $product->name=$request->name;
            $product->price=$request->price;
            $product->category_id=$request->category_id;
             if($request->has('image'))
             {

                $imageDestination = 'public/images/product';
                $image = $request->file('image');
                $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
                $path = $request->file('image')->storeAs($imageDestination, $imageName);
                $image ='images/product' . '/' . $imageName;

                 $product->image = $image;

             }
             else {
                $product->image = Product::findOrFail($request->parentId)->image;

             }
             $product->save();
        }
         return redirect('/product');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $parentProducts = Product::with('childrenProducts')->where('parentId', null)->where('id', '!=', $id)->get();
        $categories = Category::get();

        return view('product.edit', compact('product', 'parentProducts',  'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::with('parentProduct')->findOrFail($request->product_id);
        if ($request->has('name') && $product->name != $request->name) {
            $product->name = $request->name;
        }
        if ($request->has('description') && $product->description != $request->description) {
            $product->description = $request->description;
        }
        if (($request->has('price') && $product->price != $request->price) || $request->price == null ) {
            if($request->price == null &&  $product->parentId != null){
                $product->price = $product->parentProduct->price;
            }

            elseif($product->parentId == null && $request->price == null){
                $request->validate([
                    'price' => 'required',
                ]);
            }
            else{
                $product->price = $request->price;

            }


        }


        if ($request->has('parentId') && $product->parentId != $request->parentId) {

            if ($request->parentId == 'null') {
                $product->parentId = null;
            } else {
                $product->parentId = $request->parentId;
            }
        }
        if ($request->has('category_id') && $product->category_id != $request->category_id) {
            $product->category_id = $request->category_id;
        }

        if ($request->has('image')) {
         /*    Storage::delete([$request->image]); */
            $imageDestination = 'public/images/product';
            $image = $request->file('image');
            $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($imageDestination, $imageName);
            $product->image =  'images/product' . '/' . $imageName;
        }
        $data = $request->all();



        $product->update($data);

        return redirect('/product');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        if($product->childrenProducts()->exists()){
            $product->childrenProducts()->delete();
        }
        $product->delete();
        return redirect('/product');
    }

}
