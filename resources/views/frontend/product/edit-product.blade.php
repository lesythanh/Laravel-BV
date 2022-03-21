@extends('frontend.layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>
    .hidden{
        display: none;
    }
     .show{
        display: block;
    }
    </style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if (Session::has('success'))
              <div class="alert alert-success">
                {{Session::get('success')}}
              </div>
              @endif
              <form action="{{route('productUpdate', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data"  >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control" >
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" name="price" value="{{$product->price}}" class="form-control" >
                    <p class="text-danger">{{ $errors->first('price') }}</p>
                  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="id_category">
                            <option value="" select>Please choose category</option>
                            <option value="1" >KIDS</option>
                            <option value="2" >FASHION</option>
                            <option value="1" >SHOSE</option>
                            <option value="3" >BAGS</option>
                        </select>
                    </div>

                <div class="form-group">
                    <label>Brand</label>
                        <select class="form-control form-control-line" name="id_brand">
                            <option value="" select>Please choose brand</option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                        <select class="form-control form-control-line" id="sale" name="sale">
                            <option value="" select>Sale or New</option>
                            <option value="1">Sale</option>
                            <option value="0">New</option>
                        </select>

                        <div class="hidden" id="abc">
                            <input type="text" class="form-control form-control-line" name="sale">
                        </div>
                        <script>
                            $('#sale').change(function(){
                                    let id = $(this).val();
                              if(id == '1'){
                                $('#abc').removeClass('hidden')
                                 $('#abc').addClass('show')
                              }else{
                              
                              $('#abc').addClass('hidden')
                                 $('#abc').removeClass('show')
                              }
                            });
                          </script>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Image</label>
                      <input type="file"  multiple name="image[]">
                        <p class="text-danger">{{ $errors->first('image') }}</p>  
                        
                        <div style="display: flex, width: 200px, border: 1px solid black" >
                            @foreach (json_decode($product['image'], true) as $image)
                                <img  src="{{ asset('upload/product/'.Auth::id().'/'.$image) }}" style="height: 80px;">
                                <input type="checkbox" name="checkbox[]" value="{{$image}}">
                            @endforeach
                        </div>
                </div>
                  <div class="form-group">
                    <label>Detail</label>
                    <textarea name="detail" id="demo"  class="form-control">{{$product->detail}}</textarea>
                    <p class="text-danger">{{ $errors->first('detail') }}</p>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection