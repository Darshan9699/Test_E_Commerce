<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SaveForLaterController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message','Products has been removed!');
    }

    /**
     * Switch products form Saved for Later to Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);//get produts

        Cart::instance('saveForLater')->remove($id);  //remove procuts

        //check the duplicate not repeat
        $duplicates = Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message','Product is already in your Cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                 ->associate('App\Models\Product');
    
         return redirect()->route('cart.index')->with('success_message','Products Has been Move to Cart');

    }
}
