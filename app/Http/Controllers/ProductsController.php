<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {     $companies=Company::all();
        $categories=category::all();
        $products = Product::with(['companies', 'category'])->where('parentId',null)->when($request->keyword, function ($q) use ($request) {

            return $q->where('description','like','%' .$request->keyword . '%')
            ->orWhere('name','like','%' .$request->keyword . '%');
        })->paginate(24);
        $products->appends($request->all());

       return view('product.show',compact('products','companies','categories'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = category::get();
        $companies = Company::get();
        $parentProducts = Product::with('childrenProducts')->where('parentId', null)->get();
        return view('product.add',compact('parentProducts', 'categories','companies'));
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
            $product->company_id=$request->company_id;
            $product->parentId = $request->parentId;
            $product->Productstatus='1';

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
            $product->company_id=$request->company_id;
            $product->category_id=$request->category_id;
            $product->Productstatus='1';
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
                $product->image = null;

             }

             $product->save();
        }
         return redirect()->route('product');
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
        $companies = Company::get();

        return view('product.edit', compact('product', 'parentProducts',  'categories','companies'));

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
        if ($request->has('company_id') && $product->company_id != $request->company_id) {
            $product->company_id = $request->company_id;
        }
        if ($request->has('company_id') && $product->company_id != $request->company_id) {
            $product->company_id = $request->company_id;
        }
        $data = $request->all();
        if ($request->has('image')&& $product->image != $request->image) {
            Storage::delete($request->image);
            $imageDestination = 'public/images/product';
            $image = $request->file('image');
            $imageName = $request['name']  . time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($imageDestination, $imageName);
            $image =  'images/product' . '/' . $imageName;
            $product->image =  $image;

            $data['image'] =  $image;

        }






        $product->update();


        return redirect()->route('product');
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
        return redirect()->route('product');
    }
    public function search(Request $request){

        $companies=Company::all();
        $categories=category::all();

        $product = Product::orderBy('created_at','DESC')
                        ->with('products')
                        ->when($request->keyword,function($product) use($request){
                            $product->where('description','like','%' .$request->keyword . '%')
                                ->orWhere('name','like','%' .$request->keyword . '%');
                        })->paginate(24);
                        $product->appends($request->all());

        return  redirect()->route('product');
    }
    public function filters(Request $request){

        $companies=Company::all();
        $categories=category::all();

       $category = $request->input('category');
       $company = $request->input('company');




        $products = Product::parent()->when($category ,function($products_up_category)use($category ){
           $products_up_category->where('category_id',$category );
       })->when($company ,function($products_up_company)use($company ){
           $products_up_company->where('company_id',$company );
                   })->when($request->keyword,function($products_up_keyword)use($request){
           $products_up_keyword
                   ->where('name','like','%' . $request->keyword . '%');
       })->paginate(24);

$products->appends($request->all());
       return view('product.show',compact(['products','categories','companies']));
   }
   public function changeStatus(Request $request,$id )
   {

      $product = Product::findOrFail($request->product_id);


        if($product->productstatus == 1)
        {
    		  $product->Productstatus =! true ;
    		$product->update();
        }
    	else
    	{
    		 $product->Productstatus =!  false;
    		$product->update();
    	}


    /* $product->Productstatus =! $product->status ; */



       return redirect()->back();
   }





}
