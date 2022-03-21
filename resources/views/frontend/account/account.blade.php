@extends('frontend.layouts.app')
@section('content')
<div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="card">
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            {{-- @foreach ($members as $member) --}}
            <form method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">FullName</label>
                    <div class="col-md-12">
                        <input type="text" value="{{$members->name}}" class="form-control form-control-line" name="name">
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Email</label>
                    <div class="col-md-12">
                        <input type="email" value="{{$members->email}}" class="form-control form-control-line" name="email" id="example-email">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Address</label>
                    <div class="col-md-12">
                        <input type="address" value="{{$members->address}}" class="form-control form-control-line" name="address" id="address">
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Password</label>
                    <div class="col-md-12">
                        <input type="password" value="" class="form-control form-control-line" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Phone No</label>
                    <div class="col-md-12">
                        <input type="text" value="{{$members->phone}}" class="form-control form-control-line" name="phone">
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Image</label>
                    <div class="col-md-12">
                        <input name="avatar" value="" type="file" placeholder="123 456 7890" class="form-control form-control-line">
                        <img src="{{asset('upload/image/'.$members->avatar)}}" style="width:150px">
                        <p class="text-danger">{{ $errors->first('avatar') }}</p>   
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-12">
                        <button>Update Account</button>
                    </div>
                </div>
            </form>             
            {{-- @endforeach                       --}}
        </div>
    </div>
</div>
@endsection