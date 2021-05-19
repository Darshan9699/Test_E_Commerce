<?php

use Egulias\EmailValidator\Warning\Comment;

function presentPrice($price)
{
    return number_format($price, 2);
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

//function productImage($path)
//{
//    return file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('img/not-found.jpg');
//}
