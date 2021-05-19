@extends('layouts.admin1')


@section('exctra-css')
<style>
    .holder .enabled-visible {
        display: none;
    }
    .holder .enabled-invisible {
        display: inline-block;
    }

    .holder.status-enabled .enabled-visible {
        display: inline-block;
    }
    .holder.status-enabled .enabled-invisible {
        display: none;
    }
</style>
    
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">{{ __('Admin Manage Products') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                <a href="{{ route('admin.create') }}" class="btn btn-block btn-success">Add To Products</a>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Products') }}</li>
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
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Products_Id</th>
                      <th>Product_Name </th>
                      <th>Products Url(slug) (s)</th>
                      <th>Product Details</th>
                      <th>Product_pirce</th>
                      <th>Product_Description</th>
                      <th>featured</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($Products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name  }}</td>
                            <td>{{ $product->slug  }}</td>
                            <td>{{ $product->details }}</td>
                            <td>{{ $product->product_pirce }}</td>
                            <td>{{ $product->product_description }}</td>
                            <td>
                              <input type="checkbox" data-id={{ $product->id }} class ="toggle-class" data-off-color="danger" data-on-color="success" data-bootstrap-switch data-toggle="toggle" data-on="Avilable" data-off="Not Avilable" {{ $product->featured ? 'checked' : '' }}>

                              {{-- <div class="holder @if($product->featured == 1) status-enabled @endif">
                                <button class="btn btn-link p-0 change" type="submit" data-id="{{ $product->id }}">
                                    <i class="fa fa-toggle-on text-success enabled-visible"></i>
                                    <i class="fa fa-toggle-off text-muted enabled-invisible"></i>
                                </button>
                            
                                <span class="badge badge-soft-success enabled-visible">
                                    Avilable
                                </span>
                            
                                <span class="badge badge-soft-pink enabled-invisible">
                                    Not Avilable
                                </span>
                            </div> --}}
                              {{-- @if ($product->featured)
                                  <a href="" class="btn btn-block btn-success">True</a>
                              @else 
                                  <a href="" class="btn btn-block btn-warning">False</a>
                              @endif --}}
                              </td>
                            <td>
                                <a href="{{ route('admin.view',[$product->id]) }}" class="btn btn-block btn-success">View</a>
                                <a href="{{ route('admin.edit',[$product->id]) }}" class="btn btn-block btn-danger">Edit</a>
                                <br>
                                <form action="{{ route('admin.destroy', $product->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-block btn-warning" onclick="return confirm('are you sure you want to delete this Products')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Products_Id</th>
                        <th>Product_Name </th>
                        <th>Products Url(slug) (s)</th>
                        <th>Product Details</th>
                        <th>Product_pirce</th>
                        <th>Product_Description</th>
                        <th>featured</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
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

@section('extra-js')
  <script>
  $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var product_id = $(this).data('id'); 
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus'.product_id,
              data: {'status': status},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endsection