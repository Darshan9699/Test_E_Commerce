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
            <h1 class="m-0 text-dark">{{ __('Admin View Order Products') }}</h1>
          </div><!-- /.col -->
          
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Users') }}</li>
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
                  <h3 class="card-title">Show All Orders Products</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>OrderProduct_Id</th>
                      <th>Order_Id</th>
                      <th>Product Id</th>
                      <th>Quantity</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderProducts as $orderProduct)
                        <tr>
                            <td>{{ $orderProduct->id }}</td>
                            <td>{{ $orderProduct->order_id  }}</td>
                            <td>{{ productname($orderProduct->product_id ) }}</td>
                            <td>{{ $orderProduct->quantity }}</td>
                            <td>
                                <a href="{{ route('admin.orderproduct.view',[$orderProduct->id]) }}" class="btn btn-block btn-success">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>OrderProduct_Id</th>
                        <th>Order_Id</th>
                        <th>Product_name</th>
                        <th>Quantity</th>
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
