<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
    use HasFactory;

    // /**
    //  * Searchable rules.
    //  *
    //  * @var array
    //  */
    // protected $searchable = [
    //     /**
    //      * Columns and their priority in search results.
    //      * Columns with higher values are more important.
    //      * Columns with equal values have equal importance.
    //      *
    //      * @var array
    //      */
    //     'columns' => [
    //         'products.product_name' => 10,
    //         'products.details' => 10,
    //         'products.product_description' => 2,
    //     ]
    // ];


    protected $fillable = [
        'product_name',
        'slug',
        'details',
        'product_pirce',
        'product_description',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function presentPrice()
    {
        return number_format($this->product_pirce, 2);
    }

   
}
