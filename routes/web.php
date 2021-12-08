<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('product/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
Route::delete('product/destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('project.destroy');

Route::namespace('App\Http\Controllers')->group(function () {

    Auth::routes();

    Route::get('/category/{id}/products', 'HomeController@category_products')->name('category_products');
    Route::get('/about_us', 'HomeController@about_us')->name('about_us');
    Route::get('/test_timer', 'HomeController@test_timer')->name('test_timer');

    Route::get('product/{id}', ['as' => 'product.details', 'uses' => 'HomeController@product_details']);
    Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'Controller@userLogout']);
    
    Route::get('/multiguard_login', 'Auth\LoginController@showLoginForm')->name('show_multiguard_login');

    Route::get('/register/buyer', 'Auth\RegisterController@showBuyerRegisterForm')->name('show_buyer_register');
    Route::get('/register/craftsman', 'Auth\RegisterController@showCraftsmanRegisterForm')->name('show_craftsman_register');
    Route::get('/register_role', 'Auth\RegisterController@showRegisterRolesForm')->name('show_roleto_register');

    Route::post('/multiguard_login', 'Auth\LoginController@multiguardLogin')->name('multiguard_login');

    Route::post('/register/buyer', 'Auth\RegisterController@create')->name('buyer_register');
    Route::post('/register/craftsman', 'Auth\RegisterController@create')->name('craftsman_register');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
        Route::get('/', 'Admin\AdminController@adminDashboard')->name('admin_dashboard');
        Route::put('changepassword', ['as'=>'admin_password.update','uses'=>'Admin\AdminController@update_admin_password']);
        Route::put('editprofile', ['as'=>'admin_profile.update','uses'=>'Admin\AdminController@update_admin_profile']);
        Route::get('editprofile', ['as' => 'admin_profile.edit', 'uses' => 'Admin\AdminController@edit_admin_profile']);
        Route::get('changepassword', ['as' => 'admin_password.change', 'uses' => 'Admin\AdminController@change_admin_password']);

        Route::get('categories', ['as' => 'categories.index', 'uses' => 'Admin\CategoriesController@index']);
        Route::get('roles', ['as' => 'roles.index', 'uses' => 'Admin\RolesController@index']);
        Route::get('users/role/{id}', ['as'=>'role.view_users','uses'=>'Admin\RolesController@view_users']);
        
        Route::get('products/category/{id}', ['as' => 'category.view_products', 'uses' => 'Admin\CategoriesController@view_products']);

        Route::get('buyers', ['as' => 'buyers.index', 'uses' => 'Admin\BuyersController@index']);
        Route::get('buyer/{id}', ['as'=>'admin.buyers.show','uses'=>'Admin\BuyersController@show']);
        Route::get('buyer/{id}/bids', ['as'=>'admin.buyer.bids','uses'=>'Admin\BuyersController@bids']);
        Route::get('buyer/bid/product/craftsman/{id}', ['as'=>'admin.buyer.bid.product.craftsman','uses'=>'Admin\BuyersController@view_bid_product_craftsman']);
        Route::get('buyer/bid/product/{id}', ['as'=>'admin.buyer.bid.product','uses'=>'Admin\BuyersController@view_bid_product']);
        
        Route::get('buyer/delete/{id}', ['as' => 'buyer.delete', 'uses' => 'Admin\BuyersController@delete']);
        Route::delete('buyer/destroy/{id}', ['as' => 'buyer.destroy', 'uses' => 'Admin\BuyersController@destroy']);

        Route::get('products', ['as' => 'products.index', 'uses' => 'Admin\ProductsController@index']);
        Route::get('product/{id}', ['as'=>'admin.products.show','uses'=>'Admin\ProductsController@show']);
        Route::get('product/{id}/bids', ['as'=>'admin.product.bids','uses'=>'Admin\ProductsController@bids']);
        Route::get('product/bid/{id}/buyer', ['as'=>'admin.product.bid.buyer','uses'=>'Admin\ProductsController@view_product_bid_buyer']);
        Route::get('product/{id}/craftsman', ['as'=>'admin.product.craftsman','uses'=>'Admin\ProductsController@view_product_craftsman']);
        
        Route::get('product/delete/{id}', ['as' => 'product.delete', 'uses' => 'Admin\ProductsController@delete']);
        Route::delete('product/destroy/{id}', ['as' => 'product.destroy', 'uses' => 'Admin\ProductsController@destroy']);

        Route::get('craftsmen', ['as' => 'craftsmen.index', 'uses' => 'Admin\CraftsmenController@index']);
        Route::get('craftsman/{id}', ['as'=>'admin.craftsmen.show','uses'=>'Admin\CraftsmenController@show']);
        Route::get('craftsman/{id}/products', ['as'=>'admin.craftsman.products','uses'=>'Admin\CraftsmenController@products']);
        Route::get('craftsman/product/{id}', ['as'=>'admin.craftsman.product','uses'=>'Admin\CraftsmenController@view_craftsman_product']);
        Route::get('craftsman/product/{id}/bids', ['as'=>'admin.craftsman.product.bids','uses'=>'Admin\CraftsmenController@view_product_bids']);
        
        Route::get('craftsman/delete/{id}', ['as' => 'craftsman.delete', 'uses' => 'Admin\CraftsmenController@delete']);
        Route::delete('craftsman/destroy/{id}', ['as' => 'craftsman.destroy', 'uses' => 'Admin\CraftsmenController@destroy']);
    
        Route::get('orders', ['as' => 'orders.index', 'uses' => 'Admin\OrdersController@index']);
        Route::get('order/{id}', ['as'=>'admin.order.show','uses'=>'Admin\OrdersController@view_order']);
        
        Route::get('order/delete/{id}', ['as' => 'order.delete', 'uses' => 'Admin\OrdersController@delete']);
        Route::delete('order/destroy/{id}', ['as' => 'order.destroy', 'uses' => 'Admin\OrdersController@destroy']);

    });

    Route::get('/profile', ['as' => 'profile', 'uses' => 'Controller@profile']);

    Route::group(['prefix' => 'craftsman', 'middleware' => 'craftsman'], function(){
        Route::get('/', 'Craftsman\HomeController@craftsmanDashboard')->name('craftsman_dashboard');
        Route::get('profile', ['as' => 'craftsman.profile', 'uses' => 'Craftsman\CraftsmanController@edit_craftsman_profile']);
        Route::put('changepassword', ['as'=>'craftsman_password.update','uses'=>'Craftsman\CraftsmanController@update_craftsman_password']);
        Route::put('editprofile', ['as'=>'craftsman_profile.update','uses'=>'Craftsman\CraftsmanController@update_craftsman_profile']);
        Route::get('edit/profile', ['as' => 'craftsman_profile.edit', 'uses' => 'Craftsman\CraftsmanController@edit_craftsman_profile']);
        Route::get('changepassword', ['as' => 'craftsman_password.change', 'uses' => 'Craftsman\CraftsmanController@change_craftsman_password']);
        Route::get('poducts', ['as' => 'craftsman.products', 'uses' => 'Craftsman\ProductController@index']);
        Route::get('auctioned/poducts', ['as' => 'craftsman.auctioned_products', 'uses' => 'Craftsman\ProductController@auctioned_products']);
        Route::get('ordered/products', ['as' => 'craftsman.ordered_products', 'uses' => 'Craftsman\OrderController@index']);
        Route::get('product/{id}/bids', ['as'=>'craftsman.product.bids','uses'=>'Craftsman\ProductController@view_product_bids']);
        Route::get('product/{id}/extend_auction', ['as'=>'craftsman.product.extend_auction','uses'=>'Craftsman\ProductController@extend_auction']);
        Route::get('product/bids/{id}/user', ['as'=>'craftsman.product.bid.user','uses'=>'Craftsman\ProductController@view_buyer']);
        Route::get('product/order/{id}/user', ['as'=>'craftsman.product.order.user','uses'=>'Craftsman\OrderController@view_buyer']);
        Route::get('product/create', ['as' => 'craftsman.product.create', 'uses' => 'Craftsman\ProductController@create']);
        Route::post('product/create', ['as'=>'craftsman.product.store','uses'=>'Craftsman\ProductController@store']);
        Route::get('product/{id}', ['as' => 'craftsman.product.edit', 'uses' => 'Craftsman\ProductController@edit']);
        Route::put('product/{id}', ['as'=>'craftsman.product.update','uses'=>'Craftsman\ProductController@update']);
        Route::get('buyer/{id}/bids', ['as'=>'craftsman.buyer.bids','uses'=>'Craftsman\ProductController@view_buyer_bids']);
        
        Route::get('product/delete/{id}', ['as' => 'craftsman.product.delete', 'uses' => 'Craftsman\ProductController@delete']);
        Route::delete('product/destroy/{id}', ['as' => 'craftsman.product.destroy', 'uses' => 'Craftsman\ProductController@destroy']);

        Route::get('product/delete_out/{id}', ['as' => 'craftsman.product.delete_out', 'uses' => 'Craftsman\ProductController@delete_out']);
        Route::delete('product/destroy_out/{id}', ['as' => 'craftsman.product.destroy_out', 'uses' => 'Craftsman\ProductController@destroy_out']);

    });

    Route::group(['prefix' => 'buyer', 'middleware' => 'buyer'], function(){
        Route::get('/', 'Buyer\HomeController@buyerDashboard')->name('buyer_dashboard');
        Route::get('profile', ['as' => 'buyer.profile', 'uses' => 'Buyer\BuyerController@edit_buyer_profile'])->middleware('buyer');
        Route::put('changepassword', ['as'=>'buyer_password.update','uses'=>'Buyer\BuyerController@update_buyer_password']);
        Route::put('editprofile', ['as'=>'buyer_profile.update','uses'=>'Buyer\BuyerController@update_buyer_profile']);
        Route::get('editprofile', ['as' => 'buyer_profile.edit', 'uses' => 'Buyer\BuyerController@edit_buyer_profile']);
        Route::get('changepassword', ['as' => 'buyer_password.change', 'uses' => 'Buyer\BuyerController@change_buyer_password']);
        Route::get('bids', ['as' => 'buyer.bids', 'uses' => 'Buyer\BidController@index']);
        Route::get('ordered/products', ['as' => 'buyer.ordered_products', 'uses' => 'Buyer\OrderController@index']);
        Route::get('product/{id}/user', ['as'=>'buyer.product.user','uses'=>'Buyer\OrderController@view_craftsman']);
        Route::get('product/{id}', ['as' => 'buyer.product.show', 'uses' => 'Buyer\ProductController@show']);
        
        Route::get('bid/delete/{id}', ['as' => 'buyer.bid.delete', 'uses' => 'Buyer\BidController@delete']);
        Route::delete('bid/destroy/{id}', ['as' => 'buyer.bid.destroy', 'uses' => 'Buyer\BidController@destroy']);

        Route::get('order/delete/{id}', ['as' => 'buyer.order.delete', 'uses' => 'Buyer\OrderController@delete']);
        Route::delete('order/destroy/{id}', ['as' => 'buyer.order.destroy', 'uses' => 'Buyer\OrderController@destroy']);

        Route::get('place_bid/{id}', ['as' => 'buyer.place_bid', 'uses' => 'Buyer\BidController@place_bid']);
        Route::post('place_bid/{id}', ['as' => 'buyer.store_placed_bid', 'uses' => 'Buyer\BidController@stor_place_bid']);
        Route::get('order_now/{id}', ['as' => 'buyer.order_now', 'uses' => 'Buyer\OrderController@order_now']);    
        Route::post('order_now/{id}', ['as' => 'buyer.store_order_now', 'uses' => 'Buyer\OrderController@store_order_now']);    
        Route::get('product/{id}/bids', ['as'=>'buyer.product.bids','uses'=>'Buyer\ProductController@view_product_bids']);
        Route::get('product/bids/{id}/user', ['as'=>'buyer.product.bid.user','uses'=>'Buyer\ProductController@view_buyer']);
        Route::get('product/{id}/craftsman', ['as'=>'buyer.product.craftsman','uses'=>'Buyer\ProductController@view_craftsman']);
        Route::get('craftsman/{id}/products', ['as'=>'buyer.craftsman.products','uses'=>'Buyer\ProductController@view_craftsman_products']);
    });

    Route::get('product/bids/{id}/user', ['as'=>'product.bid.user','uses'=>'HomeController@view_buyer']);
    Route::get('product/{id}/user', ['as'=>'product.craftsman','uses'=>'HomeController@view_craftsman']);
    Route::get('craftsman/{id}/products', ['as'=>'user.products','uses'=>'HomeController@view_craftsman_products']);
});

