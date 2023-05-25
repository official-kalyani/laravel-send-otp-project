<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\ProductsController;
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
    return view('home.index');
});

Auth::routes();
Route::get('phone-auth', [App\Http\Controllers\PhoneAuthController::class, 'index']);

// // otp validation from https://ferdousul-haque.medium.com/how-to-create-a-laravel-otp-security-code-verification-for-e-commerce-website-55de8161cfb8
//  not working only one time send
// Route::get('/test/purchase', [App\Http\Controllers\OtpController::class,'confirmationPage']);
// Route::post('/test/otp-request', [App\Http\Controllers\OtpController::class,'requestForOtp'])->name('requestForOtp');
// Route::post('/test/otp-validate', [App\Http\Controllers\OtpController::class,'validateOtp'])->name('validateOtp');
// Route::post('/test/otp-resend', [App\Http\Controllers\OtpController::class,'resendOtp'])->name('resendOtp');
// // otp validation from medium

Route::controller(AuthOtpController::class)->group(function(){
    Route::get('/otp/login', 'login')->name('otp.login');
    Route::post('/otp/generate', 'generate')->name('otp.generate');
    Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('/otp/login', 'loginWithOtp')->name('otp.getlogin');
});

Route::get('/login-register', ['as'=>'login','uses'=> 'App\Http\Controllers\UserController@loginRegister']);
Route::post('/login', [App\Http\Controllers\UserController::class, 'loginUser']);
Route::post('/register', [App\Http\Controllers\UserController::class, 'registerUser']);
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logoutUser']);

// Confirm Account
Route::get('/confirm/{code}',[App\Http\Controllers\UserController::class, 'confirmAccount']);
Route::post('/confirm/{code}',[App\Http\Controllers\UserController::class, 'confirmAccount']);

// Forgot Password
Route::get('/forgot/password',[App\Http\Controllers\UserController::class, 'forgotPassword']);
Route::post('/forgot/password',[App\Http\Controllers\UserController::class, 'forgotPassword']);

Route::get('/product/{id}', [App\Http\Controllers\ProductsController::class, 'detail']);

Route::group(['middleware'=>['auth']],function(){

    //Update User Details & Password
    Route::get('/user/account',[App\Http\Controllers\UserController::class, 'account']);
    Route::post('/user/account',[App\Http\Controllers\UserController::class, 'account']);

    // Change New PassWord
    Route::post('/check-user-pwd',[App\Http\Controllers\UserController::class, 'chkUserPassword']);
    Route::post('/update-user-pwd',[App\Http\Controllers\UserController::class, 'updateUserPassword']);

});



Route::prefix('/admin')->namespace('Admin')->group(function(){

    //admin login 
    Route::get('/login',[App\Http\Controllers\Admin\AdminController::class, 'login']);
    Route::post('/login',[App\Http\Controllers\Admin\AdminController::class, 'login']);

Route::group(['middleware'=>['admin']], function(){

    //dashboard
    Route::get('/dashboard',[App\Http\Controllers\Admin\AdminController::class, 'dashboard']);

    //logout
    Route::get('/logout',[App\Http\Controllers\Admin\AdminController::class, 'logout']);




    //Product



    Route::get('/product',[App\Http\Controllers\Admin\ProductController::class, 'product']);
    Route::get('/delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class, 'deleteProduct']);
    Route::get('/add-edit-product/{id?}',[App\Http\Controllers\Admin\ProductController::class, 'addEditProduct']);
    Route::post('/add-edit-product/{id?}',[App\Http\Controllers\Admin\ProductController::class, 'addEditProduct']);


});

});
