<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;

class AdminOrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderProducts = OrderProduct::all();
        return view('admin.Orders_Products.index')->with('orderProducts',$orderProducts);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderProducts = OrderProduct::where('id',$id)->first();
        return view('admin.Orders_Products.view')->with('orderProduct', $orderProducts);
    }

}
