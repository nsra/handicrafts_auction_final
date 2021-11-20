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

Route::get('/', function () {
    return view('home');
});

Route::namespace('App\Http\Controllers')->group(function () {

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/buyer', 'Buyer\HomeController@buyerDashboard')->name('buyer_dashboard');
    Route::get('/craftsman', 'Craftsman\HomeController@craftsmanDashboard')->name('craftsman_dashboard');
    Route::get('/admin', 'Admin\AdminController@adminDashboard')->name('admin_dashboard');
    
    //these routes should be first, then we but permission routes
    Route::get('/multiguard_login', 'Auth\LoginController@showLoginForm')->name('show_multiguard_login');

    Route::get('/register/buyer', 'Auth\RegisterController@showBuyerRegisterForm')->name('show_buyer_register');
    Route::get('/register/craftsman', 'Auth\RegisterController@showCraftsmanRegisterForm')->name('show_craftsman_register');
    Route::get('/register_role', 'Auth\RegisterController@showRegisterRolesForm')->name('show_roleto_register');

    Route::post('/multiguard_login', 'Auth\LoginController@multiguardLogin')->name('multiguard_login');

    Route::post('/register/buyer', 'Auth\RegisterController@create')->name('buyer_register');
    Route::post('/register/craftsman', 'Auth\RegisterController@create')->name('craftsman_register');

    Route::put('/admin_changepassword', ['as'=>'admin_password.update','uses'=>'Admin\AdminController@update_admin_password']);
    Route::put('/admin_editprofile', ['as'=>'admin_profile.update','uses'=>'Admin\AdminController@update_admin_profile']);
    Route::get('/admin_editprofile', ['as' => 'admin_profile.edit', 'uses' => 'Admin\AdminController@edit_admin_profile']);
    Route::get('/admin_changepassword', ['as' => 'admin_password.change', 'uses' => 'Admin\AdminController@change_admin_password']);

     //Route::resource('order_steps', 'Order_stepsController');
     Route::get('/admin/categories', ['as' => 'categories.index', 'uses' => 'Admin\CategoriesController@index']);
     Route::get('/admin/roles', ['as' => 'roles.index', 'uses' => 'Admin\RolesController@index']);
     Route::get('admin/permissions/role/{id}', ['as'=>'role.view_permissions','uses'=>'Admin\RolesController@view_permissions']);
     
     Route::get('/logout/custom', ['as' => 'logout.custom', 'uses' => 'Controller@userLogout']);
     Route::get('/admin/products/category/{id}', ['as' => 'category.view_products', 'uses' => 'Admin\CategoriesController@view_products']);


     Route::get('/admin/buyers', ['as' => 'buyers.index', 'uses' => 'Admin\BuyersController@index']);
     Route::get('admin/buyer/{id}', ['as'=>'admin.buyers.show','uses'=>'Admin\BuyersController@show']);
     Route::get('admin/buyer/{id}/bids', ['as'=>'admin.buyer.bids','uses'=>'Admin\BuyersController@bids']);
     Route::get('admin/buyer/bid/product/craftsman/{id}', ['as'=>'admin.buyer.bid.product.craftsman','uses'=>'Admin\BuyersController@view_bid_product_craftsman']);
     Route::get('admin/buyer/bid/product/{id}', ['as'=>'admin.buyer.bid.product','uses'=>'Admin\BuyersController@view_bid_product']);
     Route::get('buyer/{id}', ['as' => 'buyer.destroy', 'uses' => 'Admin\BuyersController@destroy']);


     Route::get('/admin/craftsmen', ['as' => 'craftsmen.index', 'uses' => 'Admin\CraftsmenController@index']);
     Route::get('admin/craftsman/{id}', ['as'=>'admin.craftsmen.show','uses'=>'Admin\CraftsmenController@show']);
     Route::get('admin/craftsman/{id}/products', ['as'=>'admin.craftsman.products','uses'=>'Admin\CraftsmenController@products']);
     Route::get('admin/craftsman/product/{id}', ['as'=>'admin.craftsman.product','uses'=>'Admin\CraftsmenController@view_craftsman_product']);
     Route::get('admin/craftsman/product/{id}/bids', ['as'=>'admin.craftsman.product.bids','uses'=>'Admin\CraftsmenController@view_product_bids']);
     Route::get('craftsman/{id}', ['as' => 'craftsman.destroy', 'uses' => 'Admin\BuyersController@destroy']);

});
