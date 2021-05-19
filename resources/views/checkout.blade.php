@extends('base')

@section('extra-css')
<style>
                /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
            background-color: white;
            padding: 16px 16px;
            border: 1px solid #ccc;
        }

        .StripeElement--focus {
            // box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: #fa755a;
        }

</style>
@endsection

@section('content')
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

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        
        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="checkout__form">
                    @csrf
                        <h1 class="checkout-heading">Billing Details</h1>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__form__input">
                                            <p>Email <span>*</span></p>
                                            @if (auth()->user())
                                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                            @else
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                            @endif
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Full Name <span>*</span></p>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Country <span>*</span></p>
                                        <input type="text">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Address <span>*</span></p>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" required>
                                        <input type="text" id="address2" name="address2" placeholder="Apartment. suite, unite ect ( optinal )">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Town/City <span>*</span></p>
                                        <input type="text"class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>State <span>*</span></p>
                                        <input type="text" class="form-control" id="province" name="province" required>
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Postcode/Zip <span>*</span></p>
                                        <input type="text" class="form-control" id="postalcode" name="postalcode" required>
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Phone <span>*</span></p>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone')}}" required>
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                     <h5>Payment Details</h5>
                                        <div class="checkout__form__input">
                                            <p>Name Of Card <span>*</span></p>
                                            <input type="text" id="name_on_card" name="name_on_card" value="">
                                        </div>
                                        <div class="checkout__form__input">
                                            <div class="from-group">
                                                <label for="card-element">
                                                  Credit or debit card-element
                                                </label>
                                                <div id="card-element">
                                                <!-- a Stripe Element will be inserted here. -->
                                                </div>
                        
                                                <!-- Used to display form errors -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <br>
                        <button type="submit" id = "complete-order" class="site-btn">Complete Order</button>
                </form>
            </div>
            {{-- Order informations create --}}
            <div class="col-lg-6">
                <h3> Total Amount  </h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                @foreach (Cart::content() as $item)
                                <li>{{ $item->model->name }}<br>{{ $item->model->details }} <span>${{ $item->model->presentPrice() }}</span></li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    {{-- <li>Subtotal <span>${{ presentPrice(Cart::subtotal())  }}</span></li> --}}
                                    @if (session()->has('coupon'))
                                        <li>Discount ({{ session()->get('coupon')['name'] }}) :
                                            <form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" style="font-size:14px">Remove</button>
                                            </form>
                                            <span>-${{ presentPrice($discount) }}</span></li>
                                            <hr>        
                                        <li>New Subtotal<span>{{ presentPrice($newSubtotal) }}</span></li>
                                    @endif
    
                                    <li>Tax(GST 18%) <span>${{ presentPrice($newTax) }}</span></li>
                                    <li>Total <span>${{ presentPrice($newTotal) }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(!session()->has('coupon') )
                    
                    <div class="col-lg-5">
                        <div class="discount__content">
                            <form action="{{ route('coupon.stroe') }}" method="POST">
                                        @csrf
                                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter your coupon code">
                                    <button type="submit" class = "site-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- Total Order infrmations --}}
    </div>
</section>

@endsection


@section('extra-js')
<script src="https://js.stripe.com/v3/"></script>

<script>
    (function(){
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51HJiYXKMu3FjDyZN6oMZCI6aMSL2EZkdlnWwM5H0NPvOotNARsXM6Xjg1fhgiYfYeT5sP9VzXqBp7AM0TxUUgBRT001a1iSP0p');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };

        // Create an instance of the card Element.
        var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });


        // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

        // Handle form submission.
        var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

                document.getElementById('complete-order').disabled = true;

              var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }
              stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                  // Inform the user if there was an error
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;

                  // Enable the submit button
                  document.getElementById('complete-order').disabled = false;
                } else {
                  // Send the token to your server
                  stripeTokenHandler(result.token);
                }
              });
            });

        // Submit the form with the token ID.
        
        function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);

              // Submit the form
              form.submit();
            }

    })();
</script>
@endsection