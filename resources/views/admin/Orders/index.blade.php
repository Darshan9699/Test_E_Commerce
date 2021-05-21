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
            <h1 class="m-0 text-dark">{{ __('Admin View Orders') }}</h1>
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
                  <h3 class="card-title">Show All Orders</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Order_id</th>
                      <th>user_id </th>
                      <th>billing_email</th>
                      <th>billing_name</th>
                      <th>billing_address</th>
                      <th>billing_city</th>
                      <th>billing_province</th>
                      <th>billing_postalcode</th>
                      <th>billing_phone</th>
                      <th>billing_name_on_card</th>
                      <th>billing_subtotal</th>
                      <th>billing_tax</th>
                      <th>billing_total</th>
                      <th>payment_gateway</th>
                      <th>error</th>
                      <th>shipped</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->billing_email  }}</td>
                            <td>{{ $order->billing_name  }}</td>
                            <td>{{ $order->billing_address  }}</td>
                            <td>{{ $order->billing_city  }}</td>
                            <td>{{ $order->billing_province  }}</td>
                            <td>{{ $order->billing_postalcode  }}</td>
                            <td>{{ $order->billing_phone  }}</td>
                            <td>{{ $order->billing_name_on_card  }}</td>
                            <td>{{ $order->billing_subtotal  }}</td>
                            <td>{{ $order->billing_tax  }}</td>
                            <td>{{ $order->billing_total  }}</td>
                            <td>{{ $order->payment_gateway  }}</td>
                            <td>{{ $order->error  }}</td>
                            <td>
                                <input type="checkbox" class="toggle-class" data-on="Avilable" data-off="Not Avilable" data-onstyle="danger" data-offstyle="success" data-id={{ $order->id }} {{ $order->shipped ? 'checked' : '' }}>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.view',[$order->id]) }}" class="btn btn-block btn-success">View</a>
                                {{-- <a href="{{ route('admin.edit',[$user->id]) }}" class="btn btn-block btn-danger">Edit</a>
                                <br> --}}
                                <form action="{{ route('admin.orders.destroy', $order->id)}}" method="POST">
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
                        <th>Order_id</th>
                        <th>user_id </th>
                        <th>billing_email</th>
                        <th>billing_name</th>
                        <th>billing_address</th>
                        <th>billing_city</th>
                        <th>billing_province</th>
                        <th>billing_postalcode</th>
                        <th>billing_phone</th>
                        <th>billing_name_on_card</th>
                        <th>billing_subtotal</th>
                        <th>billing_tax</th>
                        <th>billing_total</th>
                        <th>payment_gateway</th>
                        <th>shipped</th>
                        <th>error</th>
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
    (function($) {
      // $("input[data-bootstrap-switch]").each(function(){
      //   $(this).bootstrapSwitch('state', $(this).prop('checked'));
      // });
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var User_id = $(this).data('id'); 
          $.ajax({
              type: "GET",
              dataType: "json",
              data: {'status': status,'id': User_id},
              url: '/admin/orders/changeStatus',
              success: function(data){
                console.log(data.success)
              }
          })
          // console.log(url)
      })
    })
</script>