<?php

use App\Models\Category;
use App\Models\Product;
use Egulias\EmailValidator\Warning\Comment;

function presentPrice($price)
{
    return number_format($price, 2);
}

function productname($id)
{
    $product = Product::find($id);
    $name = $product->product_name;
    return $name;
}

function categoryName($id)
{
    $category = Category::find($id);
    $name = $category->name;
    return $name;
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

//function productImage($path)
//{
//    return file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('img/not-found.jpg');
//}
