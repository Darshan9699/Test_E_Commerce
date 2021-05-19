@extends('layouts.admin1')

<style>
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05)
    }
    
    .panel-body {
        padding: 15px
    }
    
    .panel-body:after,
    .panel-body:before {
        display: table;
        content: " "
    }
    
    .panel-body:after {
        clear: both
    }
    
    .panel-heading {
        padding: 10px 15px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px
    }
    
    .panel-heading>.dropdown .dropdown-toggle,
    .panel-title {
        color: inherit
    }
    
    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px
    }
    
    .panel-title>.small,
    .panel-title>.small>a,
    .panel-title>a,
    .panel-title>small,
    .panel-title>small>a {
        color: inherit
    }
    
    .panel-footer {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px
    }
</style>

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">{{ __('Admin View Products') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                {{-- <button class="btn btn-block btn-success">Add To Products</button> --}}
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __(' View Products') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Show All Products</h3>
                </div>
                <!-- /.card-header -->

                @foreach ($product as $product)            
                <div class="card-body">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">ID</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->id }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product Name</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->product_name }}
                            <h6>
                    </div>

                    <hr style="margin:0;">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product Keywords</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->slug }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product Details</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->details }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">price</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->product_pirce }}
                            <h6>
                    </div>

                    <hr style="margin:0;">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product Descriptions</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->product_description }}
                            <h6>
                    </div>

                    <hr style="margin:0;">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product image</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        {{-- <h6>{{ $product->product_description }}
                            <h6> --}}

                                <img src="{{ asset('/images/'.$product->image) }}" alt="">
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Product Fetured</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->featured }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Create At</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->created_at }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Update At</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        <h6>{{ $product->updated_at }}
                            <h6>
                    </div>

                    <hr style="margin:0;">

                </div>
                <!-- /.card-body -->
                @endforeach
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
</div>


@endsection