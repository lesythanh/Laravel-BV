@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Blog</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
              <form action="{{route('blog.update', ['blog' => $blog->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" value="{{$blog->title}}" class="form-control" >
                    <p class="text-danger">{{ $errors->first('title') }}</p>
                  </div>
                  <div class="form-group">
                    <label for="customFile">Image</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="customFile" >
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                    </div>
                    <img src="{{asset('upload/image/'.$blog->image)}}" style=" width:150px">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" value="{{$blog->description}}" class="form-control" >
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                  </div>
                  <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" id="demo"  class="form-control">{{$blog->content}}</textarea>
                    <p class="text-danger">{{ $errors->first('content') }}</p>
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