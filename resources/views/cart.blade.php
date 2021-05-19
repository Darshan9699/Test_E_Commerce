@extends('base')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div>
                @if(session()->has('success_message'))
                    <div>
                        <div class="alert alert-success">
                            {{ session()->get('success_message') }}
                        </div>
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

               
            </div>
            @if( Gloudemans\Shoppingcart\Facades\Cart::count() > 0)
            <h5>{{ Gloudemans\Shoppingcart\Facades\Cart::count() }} item(s) in Shopping Cart</h5>
                <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    {{-- <th>Total</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Gloudemans\Shoppingcart\Facades\Cart::content() as $product)
                                    
                                    <tr>
                                        <td class="cart__product__item">
                                            <div class="cart__product__item__title">
                                                <a href="{{ route('shop.show', $product->model->slug) }}"><h6>{{ $product->model->product_name }}</h6></a>
                                                <p>Details : <span>{{ $product->model->details }}</span></p>
                                            </div>
                                        </td>
                                        <td class="cart__price">${{ $product->model->presentPrice() }}</td>
                                        <td class="cart__quantity">
                                            <div>
                                                <select class="pro-qty"  data-id="{{ $product->rowId }}">
                                                    @for ($i = 1; $i < 5 + 1 ; $i++)
                                                        <option {{ $product->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        {{-- <td class="cart__total">$ 110.0</td> --}}
                                        <td class="cart__close">
                                            <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="site-btn mr-2">Remove</button>
                                            </form>
                                        </td>
                                        <td class="cart__close">
                                            <form action="{{ route('cart.switchToSaveForLater', $product->rowId) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="site-btn">Save</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{ route('shop.index') }}">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <a href="{{ route('cart.index') }}"><span class="icon_loading"></span> Update cart</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    {{-- <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div> --}}
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                            <li>Tax <span>${{ Cart::tax() }}</span></li>
                            <li>Total <span>${{ Cart::total() }}</span></li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>

            @else 
                <h3>No Products In Cart</h3>
                <hr>
                <a href="{{ route('shop.index') }}" class="site-btn"> Continue-Shopping</a>

            @endif

            @if(Cart::instance('saveForLater')->count() > 0)

                <h2>{{ Cart::instance('saveForLater')->count() }}  Product in Saved for Later</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <hr> 
                        <div class="shop__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach (Cart::instance('saveForLater')->content() as $item)
                                <tbody>
                                    <tr>
                                        <td class="cart__product__item">
                                            <div class="cart__product__item__title">
                                            <a href="{{ route('shop.show', $item->model->slug) }}"><h6>{{ $item->model->product_name }}</h6></a>
                                                <p>Details : <span>{{ $item->model->details }}</span></p>
                                            </div>
                                        </td>
                                    <td class="cart__price">${{ $item->model->presentPrice() }}</td>
                                    <td class="cart__quantity">
                                        <div>
                                            <select class="pro-qty"  data-id="{{ $item->rowId }}">
                                                <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                                <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                                <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                                <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                                <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                            </select>
                                        </div>
                                    </td>
                                        <td class="cart__close">
                                            <form action="{{ route('saveForLater.destroy',$item->rowId)}}" method="POST" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="site-btn mr-2">Remove</span></button>
                                            </form>
                                        </td>
                                        <td class="cart__close">
                                            <form action="{{ route('saveForLater.switchToCart',$item->rowId)}}" method="POST" >
                                                {{ csrf_field() }}
                                                <button type="submit" class="site-btn">Move</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @else
                    <h3>You have no items save for Later.</h3>
                @endif

            </div>
    </section>
@endsection

@section('extra-js')
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            (function(){
                const classname=document.querySelectorAll('.pro-qty')

                Array.from(classname).forEach(function(element){
                    element.addEventListener('change', function() {
                        const id = element.getAttribute('data-id')

                        axios.patch(`/cart/${id}`, {
                            quantity: this.value,
                        })
                        .then(function (response) {
                            // console.log(response);
                            window.location.href = '{{ route('cart.index') }}'
                        })
                        .catch(function (error) {
                             //console.log(error);
                            window.location.href = '{{ route('cart.index') }}'
                        });
                    })
                })
            })();
        </script>
    
@endsection