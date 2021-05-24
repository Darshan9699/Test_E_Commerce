@extends('base')

@section('content')
     <!-- Breadcrumb Begin -->
     <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Women</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    @foreach ($categories as $category)
                                                    <li class="{{ request()->category == $category->slug ? 'active':'' }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}"><b style="color: black;text-transform:capitalize;">{{ $category->name }}</b></a></li>
                                                    @endforeach                       
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <strong>Price:</strong>
                        </div>
                        <div>
                            <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a>
                        </div>
                        <div>
                            <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                        </div>
                        {{-- <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="33" data-max="99"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#">Filter</a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach ($products  as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('/images/'.$product->image) }}">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="{{ asset('/images/'.$product->image) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li>
                                            <form action="{{ route('cart.store') }}" method="POST" >
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->product_name }}">
                                                <input type="hidden" name="price" value="{{ $product->presentPrice() }}">
                                                <button type="submit" style="border-radius: 50px ;height: 50px ;width: 50px ;font-size: 18px;color: #111111;display: inline-block;background: #ffffff;line-height: 48px;text-align: center;transition: all, 0.5s;"><span class="icon_bag_alt"></span></button>
                                            </form>
                                        </li>                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('shop.show', $product->slug) }}">{{ $product->product_name }}</a></h6>
                                    <div class="product__price">$ {{ $product->presentPrice() }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        
                            <div class="col-lg-12 text-center"> 
                                {{--{{ $products->links() }}--}}    
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    
@endsection