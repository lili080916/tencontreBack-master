<?php
# @Author: Codeals
# @Date:   07-03-2020
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-03-2020
# @Copyright: Codeals

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

use App\Events\ChatConversation;
use Illuminate\Support\Facades\Auth;

// urls sessions
Auth::routes();
Auth::routes(['register' => false]);

// urls security
Route::get('reset/password/{token}', function ($token) {
	return Redirect::to("tencontre://changePassword/".$token);
})->name('reset.password');

// urls update app
Route::get('update/app', function () {
	return Redirect::to("https://play.google.com/store/apps/details?id=com.tencontre");
})->name('update.app');

// usuarios registrados
Route::group(['middleware' => 'auth'], function () {

});

/**
 * info clinets
 */
Route::get('privacidad', function () {
  return view('privacidad');
})->name('privacidad');

/**
 * privacity
 */
Route::get('', function () {
  return view('clients');
})->name('/');

// usuarios admin
Route::group(['middleware' => 'admin'], function () {

  // urls links bases
  Route::get('admin/home', 'HomeController@index')->name('admin.home');
  Route::get('admin.home/dashboardChart/{year}', 'HomeController@dashboardChart')->name('admin.home.dashboardChart');
  Route::get('admin', function () {
      return view('main');
  })->name('admin');

  // urls products
  Route::resource('admin/products', 'ProductController')->names([
      'index' => 'admin.products.index',
      'show' => 'admin.products.show',
      'create' => 'admin.products.create',
      'store' => 'admin.products.store',
      'edit' => 'admin.products.edit',
      'update' => 'admin.products.update',
      'destroy' => 'admin.products.destroy'
  ]);

  // urls users
  Route::get('admin/users/change', 'UserController@changePassword')->name('admin.users.change');
  Route::post('admin/users/store-password', 'UserController@storePassword')->name('admin.users.store-password');
  Route::resource('admin/users', 'UserController')->names([
      'index' => 'admin.users.index',
      'show' => 'admin.users.show',
      'create' => 'admin.users.create',
      'store' => 'admin.users.store',
      'edit' => 'admin.users.edit',
      'update' => 'admin.users.update',
      'destroy' => 'admin.users.destroy'
  ]);

  // urls locations
  Route::resource('admin/locations', 'LocationController')->names([
      'index' => 'admin.locations.index',
      'show' => 'admin.locations.show',
      'create' => 'admin.locations.create',
      'store' => 'admin.locations.store',
      'edit' => 'admin.locations.edit',
      'update' => 'admin.locations.update',
      'destroy' => 'admin.locations.destroy'
  ]);

  // urls settings
  Route::get('admin/settings/edit', 'SettingController@edit')->name('admin.settings.edit');
  Route::put('admin/settings/update/{id}', 'SettingController@update')->name('admin.settings.update');

  // urls reports
  Route::get('admin/reports/map', 'ReportController@showMap')->name('admin.reports.map');
  Route::post('admin/reports/multidestroy', 'ReportController@multiDestroy')->name('admin.reports.multidestroy');
	Route::resource('admin/reports', 'ReportController')->names([
  		'index' => 'admin.reports.index',
  		'destroy' => 'admin.reports.destroy'
  ]);
  
  // urls sessions
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});
