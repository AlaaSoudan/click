<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ const COLLECTION_PER_PAGE = 9;
    protected $table ="products";
    protected $fillable = [
        'name',
        'description',
        'parentId',
        'category_id',
        'price',
        'image',
        'company_id',
        'productstatus'



    ];

    public function orders()
    {

        return $this->belongsToMany(Order::class,  'orders_product', 'order_id', 'product_id','created_at')->withPivot(['price', 'quantity','user_id', 'created_at']);
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'parentId');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function childrenProducts()
    {
        return $this->hasMany(Product::class, 'parentId')->with('products');
    }

    public function parentProduct()
    {
        return $this->belongsTo(Product::class, 'parentId');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



    public function scopeParent($query){
        return $query->where('parentId',null);
    }

/*     public function apply($builder)
    {
        $builder->whereNull('deleted_at');
    } */

 /*    public function companies()
    {
        return $this->belongsToMany(company::class);
    } */
}
