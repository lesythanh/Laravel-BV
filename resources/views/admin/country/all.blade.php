@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Country</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Country</h3>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                      {{Session::get('success')}}
                    </div>
                @endif
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($countrys as $country)
                    <tr>
                      <td>{{$country->id}}</td>
                      <td>{{$country->name}}</td>
                      <td>
                        <a href="{{route('country.edit', ['country' => $country->id])}}" class="btn btn-warning">EDIT</a>
                      </td>
                      <td>
                        <form action="{{route('country.destroy', ['country' => $country->id])}}" method="POST">
                           @csrf
                           @method('delete')
                           <input type="submit" class="btn btn-danger" value="DELETE">
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div>
                  <a class="btn btn-success" href="{{route('country.create')}}">Add Country</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection