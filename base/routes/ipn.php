<?php

use Illuminate\Support\Facades\Route;

Route::post('paypal', 'Paypal\ProcessController@ipn')->name('Paypal');

Route::post('perfect-money', 'PerfectMoney\ProcessController@ipn')->name('PerfectMoney');
Route::post('stripe', 'Stripe\ProcessController@ipn')->name('Stripe');
Route::post('stripe-js', 'StripeJs\ProcessController@ipn')->name('StripeJs');
Route::post('stripe-v3', 'StripeV3\ProcessController@ipn')->name('StripeV3');
Route::post('skrill', 'Skrill\ProcessController@ipn')->name('Skrill');
Route::post('paytm', 'Paytm\ProcessController@ipn')->name('Paytm');
Route::post('payeer', 'Payeer\ProcessController@ipn')->name('Payeer');
Route::post('paystack', 'Paystack\ProcessController@ipn')->name('Paystack');
Route::post('voguepay', 'Voguepay\ProcessController@ipn')->name('Voguepay');
Route::get('flutterwave/{trx}/{type}', 'Flutterwave\ProcessController@ipn')->name('Flutterwave');
Route::post('razorpay', 'Razorpay\ProcessController@ipn')->name('Razorpay');
Route::get('blockchain', 'Blockchain\ProcessController@ipn')->name('Blockchain');
Route::post('coinpayments-fiat', 'CoinpaymentsFiat\ProcessController@ipn')->name('CoinpaymentsFiat');
Route::post('authorize', 'Authorize\ProcessController@ipn')->name('Authorize');
Route::any('btc-pay', 'BTCPay\ProcessController@ipn')->name('BTCPay');
Route::post('now-payments-hosted', 'NowPaymentsHosted\ProcessController@ipn')->name('NowPaymentsHosted');
Route::post('now-payments-checkout', 'NowPaymentsCheckout\ProcessController@ipn')->name('NowPaymentsCheckout');
Route::post('2checkout', 'TwoCheckout\ProcessController@ipn')->name('TwoCheckout');
Route::any('checkout', 'Checkout\ProcessController@ipn')->name('Checkout');