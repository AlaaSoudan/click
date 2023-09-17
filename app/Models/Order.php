<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table='orders';
   protected $fillable=[
    'total_price',
    'user_id',
    'status',
    'note'

   ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


     const Order_Pending = 0;
     const Order_Confirmed = 1;
     const Order_Delivered = 2;
     const Order_Canceled = 3;
     const STATUS = ['0' => 'Pending', '1' => 'Confirmed', '2' => 'Delivered', '3' => 'Canceled'];
     const STATUS_ARABIC = [
         '0' => 'بانتظار قبول الطلب',
         '1' => 'جاري التحضير',
         '2' => 'تم تسليم الطلب',
         '3' => 'تم الغاء الطلب'
     ];


     public function getTotalBeforeAcceptAttribute()
     {
         if($this->status == 1){
             return $this->products()->where('status',1)->get()->sum(function($q){
                 return $q->pivot->price * $q->pivot->quantity;
             });
         }
         return $this->products()->get()->sum(function($q){
             return $q->pivot->price * $q->pivot->quantity;
         });

     }
     //relation

        public function products()
    {

        return $this->belongsToMany(Product::class, 'orders_product', 'order_id', 'product_id')->withPivot(['price', 'quantity','user_id','created_at']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeSearch($query, $username)
    {
        return $query->whereHas('user', function ($query) use ($username) {
            $query->where('name', 'like', '%' . $username . '%');
        });
    }
}
