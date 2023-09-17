<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Cart;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::where('productstatus', 1)->paginate(24);

         $companies=Company::all();
         $categories=category::all();


        return view('home', compact(['product','categories', 'companies']));
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

        return view('home', compact(['product','categories', 'companies']));
    }
 public function adminPage()
 {
    return view('admin.dashbord');
 }

}
