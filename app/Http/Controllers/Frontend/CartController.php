<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Model\Country;
use App\Model\History;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
  protected function getCart()
  {
    if(session()->has('cart'))
    {
      return session()->get('cart');
    }
  }

  protected function register($user)
  {
    return User::create($user);
  }

  protected function saveHistory($email, $name, $phone, $total, $id)
  {
    $hisrory = [
      'email' => $email,
      'name' => $name,
      'phone' => $phone,
      'user_id' => $id,
      'price' => $total
    ];
    return History::create($hisrory);
  }

  protected function sendmail($email, $cart, $total)
  {
    return \Mail::to($email)->send(new \App\Mail\SendEmail(['cart' => $cart,
                                                      'total' => $total ]));
  }

  protected function total_money()
  {
    $total = 0;
    if(session()->has('cart'))
    {
      $cart = session()->get('cart');
      foreach($cart as $product)
      {
        $total += ($product['qty'] * $product['price']);
      }
    }
    return $total;
  }



  //add
    public function addCart(Request $request)
    {
    $data = $request->all();
    $product_id = $data['product_id'];
    $product = Product::find($product_id)->toArray();

    $cart = session()->get('cart');
    if(isset($cart[$product_id]))
    {
      $cart[$product_id]['qty'] += 1;
    } else {
      $cart[$product_id] = [
        'name' => $product['name'],
        'qty' => 1,
        'price' => $product['price'],
        'image' => json_decode($product['image'], true),
      ];
    }
    session()->put('cart', $cart);
    // dd(session()->get('cart'));
     count(session()->get('cart'));

    }

    public function index(Request $request)
    {
      if(session()->has('cart')){
      $cart = session()->get('cart');
      $total = 0;
      foreach($cart as $product)
      {
        $total += ($product['qty'] * $product['price']);
      }
      $cart = session()->get('cart');
      return view('frontend.cart.list-cart', compact('cart', 'total'));
      }
    }

    public function upQuantity()
    {
      $product_id = $_POST['product_id'];
      if(session()->has('cart'))
      {
        $cart = session()->get('cart');
        if(isset($cart[$product_id])){
          $cart[$product_id]['qty'] += 1;
          session()->put('cart', $cart);
        }
      }
    }

    public function downQuantity()
    {
      $product_id = $_POST['product_id'];
      if(session()->has('cart'))
      {
        $cart = session()->get('cart');
        if(isset($cart[$product_id])){
          $cart[$product_id]['qty'] -= 1;
          $qty = $cart[$product_id]['qty'];
          if($qty == 0){
            unset($cart[$product_id]);
          }
        session()->put('cart', $cart);
        }
      }

    }

    public function delete()
    {
      $product_id = $_POST['product_id'];
      if(session()->has('cart'))
      {
        $cart = session()->get('cart');
        if(isset($cart[$product_id])){
          unset($cart[$product_id]);
        }
        if (count($cart) == 0) {
          session()->forget('cart');
        } else {
          session()->put('cart', $cart);
        }
      }

    }

    public function order(Request $request)
    {
      if(session()->has('cart'))
    {
      $countries = Country::all();
      $total = 0;
      $cart = session()->get('cart');
      foreach($cart as $product)
      {
        $total += $product['qty'] * $product['price'];
      }

    }
    return View('frontend.cart.order', compact('total', 'cart', 'countries'));
    }

    public function checkout(Request $request)
    {
      $success = false;
      $total = $this->total_money();
      $cart = $this->getCart();
  
      $data = $request->all();
      $email = $data['email'];
      $name = $data['name'];
      $phone = $data['phone'];
  
      if(Auth::check())
      {
        $this->sendmail($email, $cart, $total);
        $id = Auth::id();
        if($this->saveHistory($email, $name, $phone, $total, $id))
        {
          $success = true;
        };
      } else {
        $password = $data['password'] ;
        $address = $data['address'];
        $id_country = $data['id_country'];
        $user = [
          'email' => $email,
          'password' => Hash::make($password),
          'name' => $name,
          'phone' => $phone,
          'address' =>$address,
          'countryID' => $id_country
        ];
        if(User::create($user))
        {
          $this->sendmail($email, $cart, $total);
          $id = User::where('email', $email)->first()->id;
          echo $id;
          exit;
          if($this->saveHistory($email, $name, $phone, $total, $id))
          {
            $success = true;
          };
        }
      }
      if($success)
      {
        session()->forget('cart');
        return redirect()->route('homeIndex')->with('status', 'đặt hàng thành công, vui lòng kiểm tra mail của bạn');
      } else {
        return back()->with('status', 'Fail');
      }
    }
}
