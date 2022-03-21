@extends('frontend.layouts.app')
@if (count($errors) >0)
  <ul>
    @foreach($errors->all() as $error)
      <li class="text-danger"> {{ $error }}</li>
    @endforeach
  </ul>
@endif

@if (session('status'))
  <ul>
    <li class="text-danger"> {{ session('status') }}</li>
  </ul>
@endif
@section('content')
<section id="do_action">
  <div class="container">
    <div class="row">
      <div class=" col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="cart-title">REGISTER FORM</div>
            <form action="{{ url('/cart/checkout') }}" class="form-horizontal form-material" method="POST">
              @csrf
              <div class="form-group">
                <label class="col-md-4">Email</label>
                <div class="col-md-4">
                <input type="email" name="email"/>
                </div>
              </div>
              <div class="form-group register">
                <label class="col-md-4">Password</label>
                <div class="col-md-4">
                  <input type="password" name="password" />
                </div>
              </div>
              <div class="form-group register">
                <label class="col-md-4">Password Confirm</label>
                <div class="col-md-4">
                <input type="password" name="password_confirmation" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4">Name</label>
                <div class="col-md-4">
                  <input name="name" type="text" value="" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4">Phone</label>
                <div class="col-md-4">
                  <input type="text" name="phone" >
                </div>
              </div>
              <div class="form-group register">
                <label class="col-md-4">Address</label>
                <div class="col-md-4">
                  <input name="address" type="text" >
                </div>
              </div>
              <div class="form-group register">
                <label class="col-md-4">Country</label>
                <div class="col-md-4">
                  <select name="countryID">
                    @foreach($countries as $country)
                      <option value="{{ $country->id }}">{{ $country->countryName }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-4">
                  <button class="btn btn-success">Checkout</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class=" col-md-8">
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu">
                <td class="title">Product name</td>
                <td class="image">Item</td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              @foreach($cart as $key=>$product)
                <tr>
                  <td class="cart_product-name">
                    <h4><a href="">{{ $product['name'] }}</a></h4>
                    <p class="id" >{{ $key }}</p>
                  </td>
                  <td class="cart_product">
                    <a href=""><img width="85px" height="84px" src={{ asset('upload/product/'.Auth::id().'/'.$product['image'][0]) }}></a>
                  </td>
                  
                  <td class="cart_price">
                    <p class="price">${{ $product["price"] }}</p>
                  </td>
                  <td class="cart_quantity">
                    <div class="cart_quantity_button">
                      <input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2" readonly>
                    </div>
                  </td>
                  <td class="cart_total">
                    <p class="cart_into_money">{{ $product['qty'] * $product['price'] }}$</p>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script>
$(document).ready(function(){
  var id_user = '{{ Auth::check() }}'
  if(id_user)
  {
    $('div.register').hide()
  } else {
    $('div.register').show()
  }
})
</script>
@endsection