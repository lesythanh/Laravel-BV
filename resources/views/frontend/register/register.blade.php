@extends('frontend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Regiter</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('register.store')}}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input name="name" placeholder="Enter name" value="{{ old('name') }}" type="text" class="form-control form-control-line">
                                <p class="text-danger">{{ $errors->first('name') }}</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" placeholder="example@admin.com" value="{{ old('email') }}" class="form-control form-control-line" name="email" id="example-email">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input value="" name="password" value="{{ old('password') }}" type="password" value="password" class="form-control form-control-line">
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                        </div>
                        {{-- <div class="form-group">                    
                            <label class="col-md-12">Password confirmation</label>
                            <div class="col-md-12">
                                <input value="" name="passwordConfirm" value="{{ old('passwordConfirm') }}" type="password" value="password" class="form-control form-control-line">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input name="phone" value="{{ old('phone') }}" type="text" class="form-control form-control-line">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input name="address" value="{{ old('address') }}" type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Avatar</label>
                            <div class="col-md-12">
                                <input name="avatar" value="{{ old('avatar') }}" type="file" placeholder="123 456 7890" class="form-control form-control-line">
                                <p class="text-danger">{{ $errors->first('avatar') }}</p>   
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="id_country" value="{{ old('id_country') }}" class="form-control form-control-line">
                                    @if (!empty($countrys))
                                        @foreach ($countrys as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection