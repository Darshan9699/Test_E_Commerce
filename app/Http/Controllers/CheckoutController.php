<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Double;

class CheckoutController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // dd(Cart::subtotal());
            if (Cart::instance('default')->count() == 0) {
                return redirect()->route('shop.index');
            }

            return view('checkout')->with([
                'discount' => $this->getNumbers()->get('discount'),
                'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
                'newTax' => $this->getNumbers()->get('newTax'),
                'newTotal' => $this->getNumbers()->get('newTotal'),
            ]); 
    

    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();


        try {
            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('newTotal'),
                'currency' => 'INR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

                    //Insert into orders table
                $order = Order::create([
                    'user_id' => auth()->user() ? auth()->user()->id : null,
                    'billing_email' => $request->email,
                    'billing_name' => $request->name,
                    'billing_address' => $request->address,
                    'billing_city' => $request->city,
                    'billing_province' => $request->province,
                    'billing_postalcode' => $request->postalcode,
                    'billing_phone' => $request->phone,
                    'billing_name_on_card' => $request->name_on_card,
                    'billing_discount' => $this->getNumbers()->get('discount'),
                    'billing_discount_code' => $this->getNumbers()->get('code'),
                    'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
                    'billing_tax' => $this->getNumbers()->get('newTax'),
                    'billing_total' => $this->getNumbers()->get('newTotal'),
                    'error' => null,
                ]);

                //insert into product_order tabel 

                foreach (Cart::content() as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item->model->id,
                        'quantity' => $item->qty,
                    ]);

                    // $order_id = $order->id;
                    // $product_id = $item->model->id;
                    // $quantity = $item->qty;
                    // DB::insert('insert into order_products(order_id, product_id, quantity) values ('.$order_id.','.$product_id.','.$quantity.')');
                }


            Mail::send(new OrderPlaced($order));

            //success 
            Cart::instance('default')->destroy();

            // return back()->with('success_message', 'Thank You For Your Payments Has Been success');
            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

        } catch (Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
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
        return $request->all();
    }
   
    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $oldtotals = str_replace( ',', '', Cart::subtotal() ) - $discount;
        $newSubtotal = (double)$oldtotals;
        $newTax = (double)$newSubtotal * $tax;
        $newTotal = (double)$newSubtotal * (1 + $tax);


        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal
        ]);
    }
}
