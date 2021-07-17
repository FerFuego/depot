<?php

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

Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('forgot', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('forgot/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', 'UsersController')->middleware('role:superadmin,admin');
    Route::resource('roles', 'RolesController')->middleware('can:isSuper');
    Route::resource('sucursals', 'SucursalController')->middleware('role:superadmin,admin');
    Route::resource('sales', 'SalesController');
    Route::resource('tasks', 'TaskController');
    Route::get('todos/check', 'TodoController@check');
    Route::resource('todos', 'TodoController')->middleware('role:superadmin,admin');
    Route::resource('todolists', 'TodoListController');
    Route::resource('notifications', 'NotificationController');
    Route::resource('offers', 'OfferController');
    Route::resource('rrhhs', 'RRhhController');
    Route::post('bookings/report', 'BookingController@show')->name('bookings.report');
    Route::post('bookings/report/month', 'BookingController@report')->name('bookings.report.month');
    Route::resource('bookings', 'BookingController');
    Route::get('download/{file}', function ($file) {
        return Response::download( public_path('uploads/') . $file);
    });
    Route::get('offers/print/{id}', 'OfferController@download');
    Route::post('sales/filter', 'SalesController@filter');
    Route::post('bookings/filter', 'BookingController@filter');
    Route::post('bookings/state', 'BookingController@state');
    Route::post('bookings/day', 'BookingController@getBookingsDay');
    Route::post('bookings', 'BookingController@store')->name('storeBooking');
});


if (Auth::id()) {
    return $next($request);
}

return Response::make('Forbidden', 403);