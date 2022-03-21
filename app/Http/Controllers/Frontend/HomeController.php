<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Brand;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $products = Product::paginate(6);
        return view('frontend.home.home', compact('products', 'brands'));
    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        return view('frontend.product.product-detail', compact('product'));
    }

    public function searchName(Request $request)
    {
        $brands = Brand::all();
        $search = $request->get("search");
        $products = Product::where ( 'name', 'LIKE', '%' . $search . '%' )->get();
        return view('frontend.search.search', compact('products','brands'));
    }

    public function search(Request $request)
    {
      $product = Product::query();

    if (isset($request->name)) {
      $product->where('name', 'LIKE', '%' . $request->name . '%')->get();
    }

    if ($request->price != "") {
      $price = json_decode($request->price);
      $product->where([
        ['price', '>=', $price[0]],
        ['price', '<=', $price[1]]
      ])->get();
    }


    if ($request->brand != "") {
      $product->where('id_brand', $request->brand)->get();
    }

    $products = $product->paginate(6);
    // $products = $product->get();
    $brands = Brand::all();
    return view('frontend.search.search-advanced', compact('products', 'brands'));
    }

    public function searchPrice(Request $request)
    {
      $price = $_POST['price'];

      $products = Product::whereBetween('price',[$price[0], $price[1]])->get()->toArray();
      if(!empty($products))
      {
        return response()->json(["products" => $products]);
      }
    }
}
