@extends('layouts.admin1')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">{{ __('Admin Create Products') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                {{-- <button class="btn btn-block btn-success">Add To Products</button> --}}
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __(' Create Products') }}</li>
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
                  <h3 class="card-title">Create Products</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" id="quickForm" >
                        @csrf
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Product Keywords</label>
                            <input type="text" class="form-control" id="slug" name="slug" required>
                        </div>

                        <div class="form-group">
                            <label for="details">Product details</label>
                            <input type="text" class="form-control" id="details" name="details" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Product price</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Product Descrtiptions</label>
                        </div>

                        <div class="form-group">
                            <textarea name="product_description" id="product_description" cols="5" rows="3" class="form-control" required>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Product price</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>


                        <div class="form-group">
                            <label for="price">Featured</label>
                            <input type="checkbox" class="form-control" id="featured" name="featured">
                        </div>  

                        <div class="form-group">
                            <label>Categories</label>
                            <ul style="list-style-type: none; padding-left:0">
                                @foreach ($allCategories as $category)
                                       <li><label><input value="{{ $category->id }}" type="checkbox" name="category[]" style="margin-right: 5px;" >{{ $category->name }}</label></li>
                                @endforeach
                            </ul>
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
                    product_name : {
                        required: true,
                    },
                    slug : {
                        required: true,
                    },
                    details : {
                        required: true,
                    },
                    product_price : {
                        required: true,
                    }
                },
                messages: {
                    product_name : {
                        required: "Please Enter Product Name",
                    },
                    slug : {
                        required: "Please Enter Product KeyWords",
                    },
                    details : {
                        required: "Please Enter Product Details",
                    },
                    product_price : {
                        required: "Please Enter Product Price",
                    }
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
