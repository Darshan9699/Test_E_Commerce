<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check only admin is access 
        if(Auth::guard('admin'))
        {
            $orderProducts = OrderProduct::all();
            return view('admin.Orders_Products.index')->with('orderProducts',$orderProducts);
        } else {
            // dd('this is not admin');
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::guard('admin'))
        {
            $orderProducts = OrderProduct::where('id',$id)->first();
            return view('admin.Orders_Products.view')->with('orderProduct', $orderProducts);
        } else {
             // dd('this is not admin');
             return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

}
