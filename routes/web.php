<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\LoginController;

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', 'HomeController@index')->name('home.index');


    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        //Route::get('/login', 'LoginController@show')->name('login.show');
        //Route::post('/login', 'LoginController@login')->name('login.perform');
        Route::get('/login', [LoginController::class, 'show'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');

        /**
         * Password Recovery Routes
         */
        Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
        Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    });

    Route::group(['middleware' => ['auth']], function() {
         /**
         * Pizza Routes
         */
        //Route::get('/', [PizzaController::class, 'index']);
        Route::get('/pizza', [PizzaController::class, 'pizza'])->name('order.pizza');
        Route::get('/payment', function () {return view('order.payment');});
        Route::post('/confirmOrder/{id}', [PizzaController::class, 'confirmOrder']);
        Route::get('/payment/{id}', [PizzaController::class, 'show']);
        Route::post('/payment/{id}', [PizzaController::class, 'payment']);
        Route::get('/payment/result/{id}', [PizzaController::class, 'paymentResult'])->name('payment.result');
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});