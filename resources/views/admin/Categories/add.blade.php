@extends('layouts.admin1')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark">{{ __('Admin Create Categories') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-2">
                {{-- <button class="btn btn-block btn-success">Add To Products</button> --}}
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __(' Create Categories') }}</li>
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
                  <h3 class="card-title">Create Categories</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="quickForm" >
                        @csrf
                        <div class="form-group">
                            <label for="name">Categories Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Category Keywords</label>
                            <input type="text" class="form-control" id="slug" name="slug" required>
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
                    name : {
                        required: true,
                        
                    },
                    slug : {
                        required: true,
                    },
                },
                messages: {
                    name : {
                        required: "Please Enter category Name",
                    },
                    slug : {
                        required: "Please Enter category KeyWords",
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
