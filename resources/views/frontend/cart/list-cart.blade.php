@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
		<a href="{{ url('/cart/order') }}">Order</a>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cart as $key => $product)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('upload/product/'.Auth::id().'/'.$product['image'][0]) }}" style="width:150px; height:100px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$product['name']}}</a></h4>
                            <p class="id" style="display:none;" >{{ $key }}</p>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p class="price">{{$product['price']}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" > + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$product['qty']}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$product['price'] * $product['qty']}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>                    
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span class="totalall">{{$total}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('a.cart_quantity_up').click(function(){
            var getId = $(this).closest('tr').find('p.id').text();
            var getPrice = Number($(this).closest('tr').find('p.price').text());
            var getQty = parseInt($(this).next().val()) + 1
			var sum = Number($('span.totalall').text())
            $(this).next().val(getQty)
            sum = sum + getPrice;
			var getTotalAll = $('span.totalall').text(sum)
            var into_money = getPrice * getQty;
            $(this).closest("tr").find("p.cart_total_price").text(into_money)
			var _token = $('input[name="_token"]').val()
            $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
          url:"{{ url('/cart/up') }}", 
          method:"POST", 
          data:{
            product_id:getId, 
            _token:_token,
          },
          success:function(data){ 
          console.log(data);
                 }
            })
        })

        $('a.cart_quantity_down').click(function(){
            var getId = $(this).closest('tr').find('p.id').text();
            var getPrice = Number($(this).closest('tr').find('p.price').text());
            var getQty = Number($(this).prev().val()) - 1
			var sum = Number($('span.totalall').text())
            $(this).closest('tr').find('.cart_quantity_input').val(getQty)
            sum = sum - getPrice;
			var getTotalAll = $('span.totalall').text(sum)
            var into_money = getPrice * getQty;
            $(this).closest("tr").find("p.cart_total_price").text(into_money)
            if(getQty == 0){
                $(this).closest("tr").remove();
            }
			var _token = $('input[name="_token"]').val()
            $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
          url:"{{ url('/cart/down') }}", 
          method:"POST", 
          data:{
            product_id:getId, 
            _token:_token,
          },
          success:function(data){ 
          console.log(data);
                 }
            })

        })

        $('a.cart_quantity_delete').click(function(){
			var getId = $(this).closest("tr").find("p.id").text();
			$(this).closest("tr").remove()
            var sum = Number($('span.totalall').text())
			var total = $(this).closest('tr').find("p.cart_total_price").text();
            sum = sum - total
			var getTotalAll = $('span.totalall').text(sum)
			var _token = $('input[name="_token"]').val()
            $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url:"{{ url('/cart/delete') }}", 
            method:"POST", 
            data:{
            product_id:getId, 
            _token:_token,
          },
          success:function(data){ 
          console.log(data);
                 }
            })


        })
    })
</script>
@endsection