@extends('base')

@section('content')
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                data-setbg="img/categories/category-1.jpg">
                <div class="categories__text">
                    <h1>Women’s fashion</h1>
                    <a href="http://127.0.0.1:8000/shop?category=women">Shop now</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                        <div class="categories__text">
                            <h4>Men’s fashion</h4>
                            <a href="http://127.0.0.1:8000/shop?category=men">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                        <div class="categories__text">
                            <h4>Kid’s fashion</h4>
                            <a href="http://127.0.0.1:8000/shop?category=Kids">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                        <div class="categories__text">
                            <h4>Cosmetics</h4>
                            <a href="http://127.0.0.1:8000/shop?category=cosmetics">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="categories__item set-bg" data-setbg="img/categories/category-5.jpg">
                        <div class="categories__text">
                            <h4>Accessories</h4>
                            <a href="http://127.0.0.1:8000/shop?category=accessories">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="section-title">
                <h4>New product</h4>
            </div>
        </div>
    </div>

    <div class="row property__gallery">
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mix women">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset('/images/'.$product->image) }}">
{{--                    <div class="label new">New</div>--}}
                    <ul class="product__hover">
                        <li><a href="{{ asset('/images/'.$product->image) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                        {{-- <li><a href="#"><span class="icon_heart_alt"></span></a></li> --}}
                        <li>
                            <form action="{{ route('cart.store') }}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->product_name }}">
                                <input type="hidden" name="price" value="{{ $product->presentPrice() }}">
                                <button type="submit" style="border-radius: 50px ;height: 50px ;width: 50px ;font-size: 18px;color: #111111;display: inline-block;background: #ffffff;line-height: 48px;text-align: center;transition: all, 0.5s;"><span class="icon_bag_alt"></span></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="{{ route('shop.show', $product->slug) }}">{{ $product->product_name }}</a></h6>
                    <div class="product__price">${{ $product->presentPrice() }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
        <div>
            <a href="{{ route('shop.index')  }}" class="site-btn" style="margin-left: 40%">Show More Products</a>
        </div>
</div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
<div class="container">
    <div class="row">
        <div class="col-xl-7 col-lg-8 m-auto">
            <div class="banner__slider owl-carousel">
                <div class="banner__item">
                    <div class="banner__text">
                        <span>The Chloe Collection</span>
                        <h1>The Project Jacket</h1>
                        <a href="http://127.0.0.1:8000/shop">Shop now</a>
                    </div>
                </div>
                <div class="banner__item">
                    <div class="banner__text">
                        <span>The Chloe Collection</span>
                        <h1>The Project Jacket</h1>
                        <a href="http://127.0.0.1:8000/shop">Shop now</a>
                    </div>
                </div>
                <div class="banner__item">
                    <div class="banner__text">
                        <span>The Chloe Collection</span>
                        <h1>The Project Jacket</h1>
                        <a href="http://127.0.0.1:8000/shop">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Banner Section End -->
@endsection
