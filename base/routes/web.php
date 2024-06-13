<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{id}', 'replyTicket')->name('reply');
    Route::post('close/{id}', 'closeTicket')->name('close');
    Route::get('download/{attachment_id}', 'ticketDownload')->name('download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');

Route::controller('SiteController')->group(function () {
    Route::get('contact', 'contact')->name('contact');
    Route::post('contact', 'contactSubmit');
    Route::post('help-desk', 'helpDesk')->name('help.desk');
    Route::post('newsletter', 'subscribe')->name('newsletter');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');
    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('cookie/reject', 'cookieDecline')->name('cookie.decline');
    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');
    Route::get('date-format', 'dateFormat')->name('date.format');

    // blog
    Route::get('/blog', 'blog')->name('blog');;
    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');

    // Campaign
    Route::get('/campaigns', 'campaign')->name('campaigns');
    Route::get('campaign/{slug}/{id}', 'campaignDetails')->name('campaign.details');

    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');
    Route::get('maintenance-mode', 'App\Http\Controllers\SiteController@maintenance')->withoutMiddleware('maintenance')->name('maintenance');
    Route::post('subscribe', 'subscribe')->name('subscribe');

    // Category Campaign
    Route::get('category/campaign/{id}', 'categoryCampaign')->name('category.campaigns');

    // Campaign Filter
    Route::get('campaign/filter', 'campaignFilter')->name('campaign.filtered');

    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
});

// Campaign Controller...
Route::controller('CampaignController')->prefix('campaigns')->name('campaign.')->group(function () {
    Route::get('campaign', 'filterCampaign')->name('filter');
    Route::get('details/{slug}/{id}', 'details')->name('details');
    Route::post('comment', 'comment')->name('comment');
});

Route::prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function(){
    Route::get('campaign/payment/{id}', 'campaignPayment')->name('campaign.payment');
    Route::any('/', 'deposit')->name('index');
    Route::post('insert', 'depositInsert')->name('insert');
    Route::get('confirm', 'depositConfirm')->name('confirm');
    Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
    Route::post('manual', 'manualDepositUpdate')->name('manual.update');
});