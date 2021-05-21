@extends('layouts.admin1')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">{{ __('Admin Create Categories Products') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                {{-- <button class="btn btn-block btn-success">Add To Products</button> --}}
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __(' Create Categories Products') }}</li>
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
                  <h3 class="card-title">Create Categories Products</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <form action="{{ route('admin.categoriesProducts.update', $categoryProduct->id) }}" method="POST" enctype="multipart/form-data" id="quickForm" >
                        @csrf
                        <div class="form-group">
                            <label for="name">Select Products Name</label>
                            <select name="product_id" class="form-control" id="product_id"  required>
                                <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ ( $categoryProduct->product_id == $product->id) ? "selected" : "" }} >{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="slug">Select Category Name</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                              <option value="">Select Category</option>
                              @foreach ($categories as $categories)
                                        <option value="{{ $categories->id }}" {{ ( $categoryProduct->category_id == $categories->id) ? "selected" : "" }}>{{ $categories->name }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
<script type="text/javascript">
        $(document).ready(function () {
            $('#quickForm').validate({
                rules: {
                    product_id : {
                        required: true,
                        
                    },
                    category_id : {
                        required: true,
                    },
                },
                messages: {
                    product_id : {
                        required: "Select the Products Name",
                    },
                    category_id : {
                        required: "Selecr the Category Name",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
</script>
@endsection
