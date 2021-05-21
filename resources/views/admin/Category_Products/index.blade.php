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
            <h1 class="m-0 text-dark">{{ __('Admin View Categories Products') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                <a href="{{ route('admin.categoriesProducts.create') }}" class="btn btn-block btn-success">Add To Categories Products</a>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Categories PRoducts') }}</li>
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
                  <h3 class="card-title">Show All Categories Products</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Category ID</th>
                      <th>Category Product Name</th>
                      <th>Category Category_id</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryProducts as $categoryProduct)
                        <tr>
                            <td>{{ $categoryProduct->id }}</td>
                            <td>{{ productname($categoryProduct->product_id)  }}</td>
                            <td>{{ categoryName($categoryProduct->category_id)  }}</td>
                            <td>
                                <a href="{{ route('admin.categoriesProducts.view',[$categoryProduct->id]) }}" class="btn btn-block btn-success">View</a>
                                <a href="{{ route('admin.categoriesProducts.edit',[$categoryProduct->id]) }}" class="btn btn-block btn-danger">Edit</a>
                                <form action="{{ route('admin.categoriesProducts.destroy', $categoryProduct->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-block btn-warning" style="margin-top: .5rem" onclick="return confirm('are you sure you want to delete this Category')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                          <th>Category ID</th>
                          <th>Category Product Name</th>
                          <th>Category Category_id</th>
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
