<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::middleware('guest')->group(function(){
        Route::controller('LoginController')->group(function(){
            Route::get('/login', 'showLoginForm')->name('login');
            Route::post('/login', 'login');
            Route::get('logout', 'logout')->middleware('auth')->withoutMiddleware('guest')->name('logout');
        });

        Route::controller('RegisterController')->middleware(['guest'])->group(function(){
            Route::get('register', 'showRegistrationForm')->name('register');
            Route::post('register', 'register')->middleware('registration.status');
            Route::post('check-mail', 'checkUser')->name('checkUser');
        });

        Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function(){
            Route::get('reset', 'showLinkRequestForm')->name('request');
            Route::post('email', 'sendResetCodeEmail')->name('email');
            Route::get('code-verify', 'codeVerify')->name('code.verify');
            Route::post('verify-code', 'verifyCode')->name('verify.code');
        });

        Route::controller('ResetPasswordController')->group(function(){
            Route::post('password/reset', 'reset')->name('password.update');
            Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
        });

        Route::controller('SocialiteController')->group(function () {
            Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
            Route::get('social-login/callback/{provider}', 'callback')->name('social.login.callback');
        });
    });

});

Route::middleware('auth')->name('user.')->group(function () {
    // authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function(){
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->group(function () {

        Route::get('user-data', 'User\UserController@userData')->name('data');
        Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->namespace('User')->group(function () {
            // Campaign
            Route::middleware('kyc')->controller('CampaignController')->prefix('campaign')->name('campaign.')->group(function(){
                Route::get('create', 'create')->name('create');
                Route::post('store/{id?}', 'store')->name('store');
                Route::get('edit/{id}', 'edit')->name('edit');

                Route::get('approved', 'approved')->name('approved');
                Route::get('pending', 'pending')->name('pending');
                Route::get('success', 'success')->name('success');
                Route::get('rejected', 'rejected')->name('rejected');
                Route::get('expired', 'expired')->name('expired');
                Route::get('all', 'allCampaign')->name('all');
                
                Route::get('details/{slug}/{id}', 'details')->name('view');
                Route::post('complete/{id}', 'complete')->name('make.complete');
                Route::post('stop/{id}', 'runAndStop')->name('stop');
                Route::post('delete/{id}', 'delete')->name('delete');

                Route::post('extended/{id}', 'extended')->name('extended');
            });

            Route::controller('DonationController')->prefix('campaign/donation')->name('campaign.donation.')->group(function () {
                Route::get('my/{campaignId?}', 'myDonation')->name('my');
                Route::get('received/{campaignId?}', 'receivedDonation')->name('received');
                Route::get('details/{id}', 'details')->name('details');
            });


            Route::controller('UserController')->group(function(){
                Route::get('dashboard', 'home')->name('home');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //KYC
                Route::get('kyc-form','kycForm')->name('kyc.form');
                Route::get('kyc-data','kycData')->name('kyc.data');
                Route::post('kyc-submit','kycSubmit')->name('kyc.submit');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions','transactions')->name('transactions');

                Route::post('add-device-token','addDeviceToken')->name('add.device.token');
                Route::get('attachment-download/{fil_hash}','attachmentDownload')->name('attachment.download');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function(){
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
                Route::post('profile', 'profileUpdate')->name('profile.update');
            });

            // Withdraw
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function(){
                Route::middleware('kyc')->group(function(){
                    Route::get('/', 'withdrawMoney');
                    Route::post('/', 'withdrawStore')->name('.money');
                    Route::get('preview', 'withdrawPreview')->name('.preview');
                    Route::post('preview', 'withdrawSubmit')->name('.submit');
                });
                Route::get('history', 'withdrawLog')->name('.history');
            });
        });
    });
});