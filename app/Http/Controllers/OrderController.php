<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\Product;
use App\Models\Company;
use App\Models\Order;

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Arr;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $orders = Order::orderBy('created_at','DESC')->where('status', '!=', Order::Order_Delivered)->paginate(24);
       return view('order.all_order',compact($orders,'orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function MyOrders()
    {
       $user= User::first();
        Auth::SetUser($user);
        $user =Auth::user();
        $userId =$user->id;


        $orders= Order::where('user_id',$userId)->get();
        return view('order.order',compact($orders,'orders'));
}
    public function addToOrederlist(Request $request,$id)
    {
        $products = Product::FindOrFail($id);



        $companies=Company::all();
        $categories=category::all();
        $product=Product::all();
           $user= User::first();
         Auth::SetUser($user);
         $user =Auth::user();
         $userId =$user->id;


     $add_to_cart=[];
/*             $add_to_cart[]=[
                'id' => $products->$id,
                'name' => $products->name,
                'price' => $products->price,
                'quantity' => $request->input('quantity'),
                'note'=> $request->input('note'),
                'associatedModel' => $products,

            ]; */
            $note= $request->input('note');
         $dsds=Cart::session($user->id)->add(array(
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'quantity' => $request->input('quantity'),
                'note' => $request->input('note'),
                /* 'associatedModel' => $products, */
            ));



         if(Cart::session($userId)->IsEmpty()){
            echo  'chgjk' ;
        }
          if(!Cart::session($userId)->IsEmpty()){

            echo 'gfdgfh';
         }



         $total = Cart::session($userId)->getTotal();


        $cartTotalQuantity = Cart::session($userId)->getTotalQuantity();

        $items =Cart::session($userId)->getcontent()->toArray();




 //لا انسى clear
 return redirect('/');
    }


    public function create()
    {
       return view('order.createOrder');
    }
    public function  ShoppingCart()
    {
        $user= User::first();
        Auth::SetUser($user);
        $user =Auth::user();
        $userId =$user->id;

        $total = Cart::session($userId)->getTotal();
        $items =Cart::session($userId)->getcontent();

       return view('order.ShoppingCart',compact('items','total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function AddingOrder(Request $request)
    {
        $user= User::first();
        Auth::SetUser($user);
        $user =Auth::user();
        $userId =$user->id;

        $order = new Order;

        $order->total_price =Cart::session($userId)->getTotal();
        $order->user_id=$userId;
        $order->status="0" ;

      $items =Cart::session($userId)->getcontent()->toArray();
      $note= $request->input('note');
      $order->note=$note;

         $order->save();

        foreach($items as$id => $product)

        {


            $price= Arr::get($product, 'price');
            $quantity=Arr::get($product, 'quantity');

            $order->products()->attach($id,  [ 'price'=>$price,'user_id'=>$userId,'quantity' => $quantity,]);
        }

 Cart::session($userId)->clear();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
      public function Order_search(Request $request){



        $orders = Order::search($request->keyword)->orderBy('created_at','DESC')->paginate(24);


    /*  $orders= Order::orderBy('created_at','DESC')->with('user')

                        ->when($request->keyword,function($order) use($request){
                            $order->where($order,'like','%' .$request->keyword . '%');
                        })->paginate(24);
                        $order->appends($request->all());
 */


                        return view('order.all_order', compact(['orders']));
    }
    public function changeStatus(Request $request)
    {

        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        if ($request->status == Order::Order_Delivered) {
            $order->updated_at = now();
        }
        if ($request->status == Order::Order_Confirmed) {
            foreach ($order->products  as $product) {
        /*         $product->pivot->status = Order::Order_Confirmed;
                $product->pivot->save(); */
                $order->status = $request->status;
            }
        }
       /*  $order->totalPrice = $order->products()->having('pivot_status', Order::Order_Confirmed)->get()->sum('pivot.price'); */
        $order->save();
        return redirect()->route('orders');
    }
     public function deliveredOrders()
    {
        $orders = Order::orderBy('updated_at','DESC')->where('status', Order::Order_Delivered)->get();
        return view('order.delivered', compact('orders'));
    }
  /*  public function changeProductStatus(Request $request)
    {

        $order = Order::findOrFail($request->orderId);


        $product = $order->products->where('id', $request->productId)->first();

        $product->pivot->update(['status' =>  $request->status]);
        if ($request->status == Order::Order_Confirmed) {
            $order->status = Order::Order_Confirmed;
            $order->save();
        } else {
            $generalProducts = $order->products;
            $products = $order->products()->having('pivot_status', Order::Order_Canceled)->get();

            if (count($generalProducts) - count($products)  == 0) {
                $order->status = Order::Order_Canceled;
                $order->save();
            }
        }
        $order->totalPrice = $order->products()->having('pivot_status', Order::Order_Confirmed)->get()->sum('pivot.price');

        $order->save();
        return redirect()->route('OrderProducts', ['id' => $request->orderId]);
    }


     public function productsToPrepare()
    {
        $productsArray = [];
        $productsIdes = [];
        $orders = Order::orderBy('created_at','DESC')->with('products')->where('status', Order::Order_Confirmed)->get();
        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                if ($product->pivot->status == Order::Order_Confirmed) {
                    if (array_key_exists($product->id, $productsArray)) {
                        $productsArray[$product->id] = $productsArray[$product->id] + $product->pivot->quantity;
                    } else {
                        $productsArray[$product->id] = $product->pivot->quantity;
                        array_push($productsIdes, $product->id);
                    }
                }
            }
        }
        $products = Product::whereIn('id', $productsIdes)->get()->map(function ($q) use ($productsArray) {
            $q['quantity'] = $productsArray[$q->id];
            return $q;
        });
        return view('pages.order.productsToPrepare', compact('products'));
    }
 */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function OrderDetails($id)
    {
        $order = Order::with('products')->findOrFail($id)->products;
        $user= User::first();
        Auth::SetUser($user);
        $user =Auth::user();


         if ($user->role =='admin'){
            return view('order.show_details_admin',compact('order'));
         }
         else

    {
        return view('order.show_details',compact('order'));
    }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


       $userId = auth()->user()->id;
Cart::session($userId)->remove($id);
 return  redirect('/shopping_Cart');
    }
}
