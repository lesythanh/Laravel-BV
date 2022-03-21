@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <section id="cart_items">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Id</td>
                        <td class="description">Name</td>
                        <td class="price">Image</td>
                        <td class="quantity">Price</td>
                        <td class="total" colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                      <td>{{$product->name}}</td>
                      @foreach (json_decode($product['image'], true) as $image)
                      <td><img src="{{ asset('upload/product/'.Auth::id().'/'.$image) }}" style="height: 70px; width:70px"></td>
                      @break
                      @endforeach
                      <td>{{$product->price}}</td>
                      <td>
                        <a href="{{route('productEdit', ['id' => $product->id])}}" class="btn btn-warning">EDIT</a>
                      </td>
                      <td>
                        <form action="" method="POST">
                           @csrf
                           @method('delete')
                           <input type="submit" class="btn btn-danger" value="DELETE">
                        </form>
                    </td>
                    </tr>                                  
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <a href="{{route('productCreate')}}"><button id="button">Thêm Sản Phẩm</button></a>
                        </td>
                        </tr>
                    </tfoot>
            </table>
            {{ $products->links() }}
        </div>
    </section>
    </div>
@endsection



{{-- hien tai 3 hinh:
e xoa 2 thi con lai 1 

upload 3 hinh nua 


hinh con lai:
mang ban dau [a,b,c]
mang xoa: [a,b]
unset => hinh con lai: [c] --}}


