<?php

namespace App\Http\Controllers\Frontend;

use Image;
use App\User;
use App\Model\Brand;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $userId = Auth::id();

            $user = User::find($userId);
            $products = Product::paginate(4);
            
            return view('frontend.product.list-product', compact('products'));

        }
    }
    
    public function create()
    {
        $brands = Brand::all();
        return view('frontend.product.add-product', compact('brands'));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $id_category = $request->id_category;
        $id_brand = $request->id_brand;
        $sale = $request->sale;
        $detail = $request->detail;

        if($request->hasfile('image'))
        {

            $data = [];

            foreach($request->file('image') as $image)
            {

                $name_1 = $image->getClientOriginalName();
                $name_2 = "_85".$image->getClientOriginalName();
                $name_3 = "_329".$image->getClientOriginalName();

                $dir = 'upload/product/'.Auth::id();
 
                if(!file_exists($dir)){
                     mkdir($dir,0777,true);
                 }
                
                $path = public_path('upload/product/' .Auth::id(). '/' . $name_1);
                $path2 = public_path('upload/product/' .Auth::id(). '/' . $name_2);
                $path3 = public_path('upload/product/' .Auth::id(). '/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                
                $data[] = $name_1;
            }
        }


        Product::create([
            'name' => $name,
            'price' => $price,
            'id_category' => $id_category,
            'id_brand' => $id_brand,
            'sale' => $sale,
            'image' => json_encode($data),
            'detail' => $detail
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        
        $product = Product::find($id);
        $brands = Brand::all();

        return view('frontend.product.edit-product', compact('product', 'brands'));
    }

    public function update(Request $request, $id)
    {
        // $useId = Auth::id();
        $product = Product::find($id);
        $images = json_decode($product->image, true);
        $check = $request->checkbox;
        $merge = [];

        $name = $request->name;
        $price = $request->price;
        $id_category = $request->id_category;
        $id_brand = $request->id_brand;
        $sale = $request->sale;
        $detail = $request->detail;

        // $file = $request->file('image');
        if($check != null)
        {
            foreach($images as $key => $image){
                if(in_array($image, $check)){
                    unset($images[$key]);
                }
            }
        }

        reset($images);

        if($request->hasfile('image'))
        {
            $data = [];

            foreach($request->file('image') as $image)
            {
                $name_1 = $image->getClientOriginalName();
                $name_2 = "_85".$image->getClientOriginalName();
                $name_3 = "_329".$image->getClientOriginalName();

                $dir = 'upload/product/'.Auth::id();
 
                if(!file_exists($dir)){
                     mkdir($dir,0777,true);
                 }
                
                $path = public_path('upload/product/' .Auth::id(). '/' . $name_1);
                $path2 = public_path('upload/product/' .Auth::id(). '/' . $name_2);
                $path3 = public_path('upload/product/' .Auth::id(). '/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                
                $data[] = $name_1;
            }
        }
        $merge = array_merge($images, $data);

        $product->update([
            'name' => $name,
            'price' => $price,
            'id_category' => $id_category,
            'id_brand' => $id_brand,
            'sale' => $sale,
            'image' => json_encode($merge),
            'detail' => $detail
        ]);
        return redirect()->back();

        
    }
}
