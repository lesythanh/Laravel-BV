<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
//FrontEnd

//home
Route::get('/', 'Frontend\HomeController@index')->name('homeIndex');



//blog
Route::resource('home', 'Frontend\IndexController');
Route::get('blog/list', 'Frontend\BlogController@index')->name('blogIndex');
Route::get('blog/detail/{id}', 'Frontend\BlogController@detail')->name('blogDetail');
Route::post('blog/rating', 'Frontend\BlogController@rating')->name('blogRating');

//cart
Route::get('/product/{id}', 'Frontend\HomeController@showProduct')->name('productShow');
Route::post('/addtocart', 'Frontend\CartController@addCart');
Route::get('/cart', 'Frontend\CartController@index');
Route::post('/cart/up', 'Frontend\CartController@upQuantity');
Route::post('/cart/down', 'Frontend\CartController@downQuantity');
Route::post('/cart/delete', 'Frontend\CartController@delete');
Route::get('/cart/order', 'Frontend\CartController@order');
Route::post('/cart/checkout', 'Frontend\CartController@checkout')->name('cartCheckout');

Route::get('search', 'Frontend\HomeController@searchName')->name('searchName');
Route::get('search/advanced', 'Frontend\HomeController@search')->name('searchAdvanced');
Route::post('search/price', 'Frontend\HomeController@searchPrice')->name('searchPrice');

//check not login for form login
Route::group(['middleware' => 'memberNotLogin'], function () {
    //login and register
    Route::resource('member/login', 'Frontend\LoginController');
    Route::resource('member/register', 'Frontend\RegisterController');
});


//check login
Route::group(['middleware' => 'member'], function () {
    //product
    Route::get('member/listproduct', 'Frontend\ProductController@index')->name('productIndex');
    Route::get('member/addproduct', 'Frontend\ProductController@create')->name('productCreate');
    Route::post('member/addproduct', 'Frontend\ProductController@store')->name('productStore');
    Route::get('member/editproduct/{id}', 'Frontend\ProductController@edit')->name('productEdit');
    Route::post('member/editproduct/{id}', 'Frontend\ProductController@update')->name('productUpdate');
    //account
    Route::get('member/account', 'Frontend\AccountController@index')->name('accountIndex');
    Route::post('member/account', 'Frontend\AccountController@update')->name('accountUpdate');
    //logout
    Route::get('/logout', 'Frontend\AuthController@logout')->name('logout');
    //comment and replay
    Route::post('blog/comment', 'Frontend\CommentController@store')->name('blogStore');
    Route::post('blog/reply', 'Frontend\CommentController@reply')->name('blogReply');
});




//BackEnd
Auth::routes();
Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('admin/dashboard', 'HomeController@index')->name('home');
        Route::post('admin/profile', 'Admin\UserController@update')->name('updateProfile');
        Route::get('admin/profile', 'Admin\UserController@profile')->name('profile');
        //country
        Route::resource('admin/country', 'Admin\CountryController');
        //blog
        Route::resource('admin/blog', 'Admin\BlogController');
    }
);

// Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
