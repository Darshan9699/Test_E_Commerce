<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')){
            $orders = Order::all();//show all orders
            return view('admin.Orders.index')->with('orders',$orders);
        } else {
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
        if(Auth::guard('admin')){
            $orders = Order::where('id',$id)->first();
            return view('admin.Orders.view')->with('order', $orders); 
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success_message','Order Delete Successfully');
    }

    public function changeShipped(Request $request)
    {
        $orders = Order::find($request->id);
        $orders->shipped = $request->status;
        $orders->save();
        return response()->json(['success' => 'Product shipped status change Show']);
    }
}
