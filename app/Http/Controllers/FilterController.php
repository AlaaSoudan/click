<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\category;


class FilterController extends Controller
{
    public function filter(Request $request){

        $companies=Company::all();
        $categories=category::all();
        $product=Product::all();
        $category = $request->input('category');
        $company = $request->input('company');


     /*    $per_page =  $request->has('per_page') ?  $request->per_page : Product::COLLECTION_PER_PAGE; */

        $product = Product::parent()->when($category ,function($products_up_category)use($category ){
            $products_up_category->where('category_id',$category );
        })->when($company ,function($products_up_company)use($company ){
            $products_up_company->where('company_id',$company );
                    })->when($request->keyword,function($products_up_keyword)use($request){
            $products_up_keyword
                    ->where('name','like','%' . $request->keyword . '%');
        })->get();

        return view('\home',compact(['product','categories', 'companies']));
    }
}
      /*   ->when($company,function($products_up_company)use($company){
             $products_up_company->whereHas('childrenProducts',function(Builder $child)use($company){
                        $child->where('company_id',$company);
                    });

        }) */
