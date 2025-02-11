<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/browse/{category:slug}', [FrontController::class, 'categoryy'])->name('front.category');

Route::get('/detail/{shoe:slug}', [FrontController::class, 'details'])->name('front.details');

Route::post('/order/begin/{shoe:slug}', [FrontController::class, 'saveOrder'])->name('front.save_order');

Route::get('/order/booking', [OrderController::class, 'booking'])->name('front.booking');

Route::get('/order/booking/customer-data', [OrderController::class, 'customerData'])->name('front.customer_data');
Route::post('/order/booking/customer-data/save', [OrderController::class, 'saveCustomerData'])->name('front.save_customer_data');

Route::get('/order/payment', [OrderController::class, 'payment'])->name('front.payment');
Route::post('/order/payment/confirm', [OrderController::class, 'payment_confirm'])->name('front.payment_confirm');

Route::get('/order/finished/{productTracsaction:id}', [OrderController::class, 'order_finished'])->name('front.orderFinished');

