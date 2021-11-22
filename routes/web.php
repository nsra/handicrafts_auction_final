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

Route::namespace('App\Http\Controllers')->group(function () {

    Auth::routes();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::get('/category/{id}/products', 'HomeController@category_products')->name('category_products');
    Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'Controller@userLogout']);

    Route::get('/buyer', 'Buyer\HomeController@buyerDashboard')->name('buyer_dashboard');
    Route::get('/craftsman', 'Craftsman\HomeController@craftsmanDashboard')->name('craftsman_dashboard');
    
    //these routes should be first, then we but permission routes
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
        Route::get('permissions/role/{id}', ['as'=>'role.view_permissions','uses'=>'Admin\RolesController@view_permissions']);
        
        Route::get('products/category/{id}', ['as' => 'category.view_products', 'uses' => 'Admin\CategoriesController@view_products']);

        Route::get('buyers', ['as' => 'buyers.index', 'uses' => 'Admin\BuyersController@index']);
        Route::get('buyer/{id}', ['as'=>'admin.buyers.show','uses'=>'Admin\BuyersController@show']);
        Route::get('buyer/{id}/bids', ['as'=>'admin.buyer.bids','uses'=>'Admin\BuyersController@bids']);
        Route::get('buyer/bid/product/craftsman/{id}', ['as'=>'admin.buyer.bid.product.craftsman','uses'=>'Admin\BuyersController@view_bid_product_craftsman']);
        Route::get('buyer/bid/product/{id}', ['as'=>'admin.buyer.bid.product','uses'=>'Admin\BuyersController@view_bid_product']);
        Route::get('buyer/destroy/{id}', ['as' => 'buyer.destroy', 'uses' => 'Admin\BuyersController@destroy']);

        Route::get('craftsmen', ['as' => 'craftsmen.index', 'uses' => 'Admin\CraftsmenController@index']);
        Route::get('craftsman/{id}', ['as'=>'admin.craftsmen.show','uses'=>'Admin\CraftsmenController@show']);
        Route::get('craftsman/{id}/products', ['as'=>'admin.craftsman.products','uses'=>'Admin\CraftsmenController@products']);
        Route::get('craftsman/product/{id}', ['as'=>'admin.craftsman.product','uses'=>'Admin\CraftsmenController@view_craftsman_product']);
        Route::get('craftsman/product/{id}/bids', ['as'=>'admin.craftsman.product.bids','uses'=>'Admin\CraftsmenController@view_product_bids']);
        Route::get('craftsman/destroy/{id}', ['as' => 'craftsman.destroy', 'uses' => 'Admin\BuyersController@destroy']);
    });

    Route::get('/profile', ['as' => 'profile', 'uses' => 'Controller@profile']);

    Route::group(['prefix' => 'craftsman', 'middleware' => 'craftsman'], function(){
        Route::get('profile', ['as' => 'craftsman.profile', 'uses' => 'Craftsman\CraftsmanController@edit_craftsman_profile']);
        Route::put('changepassword', ['as'=>'craftsman_password.update','uses'=>'Craftsman\CraftsmanController@update_craftsman_password']);
        Route::put('editprofile', ['as'=>'craftsman_profile.update','uses'=>'Craftsman\CraftsmanController@update_craftsman_profile']);
        Route::get('editprofile', ['as' => 'craftsman_profile.edit', 'uses' => 'Craftsman\CraftsmanController@edit_craftsman_profile']);
        Route::get('changepassword', ['as' => 'craftsman_password.change', 'uses' => 'Craftsman\CraftsmanController@change_craftsman_password']);
        Route::get('/{id}/poducts', ['as' => 'craftsman.products', 'uses' => 'Craftsman\ProductController@index']);
        Route::get('/{id}/auctioned/poducts', ['as' => 'craftsman.auctioned_products', 'uses' => 'Craftsman\ProductController@auctioned_products']);
        Route::get('/{id}/ordered/products', ['as' => 'craftsman.ordered_products', 'uses' => 'Craftsman\OrderController@index']);
        
        Route::get('product/{id}/bids', ['as'=>'craftsman.product.bids','uses'=>'Craftsman\ProductController@view_product_bids']);
        
        Route::get('product/bids/{id}/user', ['as'=>'craftsman.product.bid.user','uses'=>'Craftsman\ProductController@view_buyer']);
            
        Route::get('product/create', ['as' => 'craftsman.product.create', 'uses' => 'Craftsman\ProductController@create']);
        Route::put('product/create', ['as'=>'craftsman.product.store','uses'=>'Craftsman\ProductController@store']);
        
        Route::get('product/{id}', ['as' => 'craftsman.product.edit', 'uses' => 'Craftsman\ProductController@edit']);
        Route::put('product/{id}', ['as'=>'craftsman.product.update','uses'=>'Craftsman\ProductController@update']);
    
    });

    Route::group(['prefix' => 'buyer', 'middleware' => 'buyer'], function(){
        Route::get('profile', ['as' => 'buyer.profile', 'uses' => 'Buyer\BuyereController@edit_buyer_profile'])->middleware('buyer');
        Route::put('changepassword', ['as'=>'buyer_password.update','uses'=>'Buyer\BuyerController@update_buyer_password']);
        Route::put('editprofile', ['as'=>'buyer_profile.update','uses'=>'Buyer\BuyerController@update_buyer_profile']);
        Route::get('editprofile', ['as' => 'buyer_profile.edit', 'uses' => 'Buyer\BuyerController@edit_buyer_profile']);
        Route::get('changepassword', ['as' => 'buyer_password.change', 'uses' => 'Buyer\BuyerController@change_buyer_password']);
    });

});

