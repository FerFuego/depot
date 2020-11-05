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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', 'UsersController')->middleware('role:superadmin,admin');
    Route::resource('roles', 'RolesController')->middleware('can:isSuper');
    Route::resource('sucursals', 'SucursalController')->middleware('role:superadmin,admin');
});

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

if (Auth::id()) {
    return $next($request);
}

return Response::make('Forbidden', 403);