@component('mail::message')
# Order Received

Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->billing_email }}

**Order Name:** {{ $order->billing_name }}

**Order Address:** {{ $order->billing_address }},{{ $order->billing_city }},{{ $order->billing_province }} - {{ $order->billing_postalcode }}

**Order Person Contact No:** {{ $order->billing_phone }}

**Order Tax:** ${{ presentprice($order->billing_tax) }}

**Order Total:** ${{ presentprice($order->billing_total) }}

{{-- {{ var_dump() }} --}}

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->product_name }} <br>
Price: ${{ presentprice($product->product_pirce) }} <br>
Quantity: {{ $product-> pivot->quantity }} <br>
@endforeach



You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Home Page
@endcomponent

Thank you again for choosing us. 

Regards,<br>
AJD Shopping Comapny.
@endcomponent
