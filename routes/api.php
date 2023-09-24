<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Boats
    Route::apiResource('boats', 'BoatsApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Wlogs
    Route::apiResource('wlogs', 'WlogsApiController');

    // Wlist
    Route::post('wlists/media', 'WlistApiController@storeMedia')->name('wlists.storeMedia');
    Route::apiResource('wlists', 'WlistApiController');

    // To Do
    Route::post('to-dos/media', 'ToDoApiController@storeMedia')->name('to-dos.storeMedia');
    Route::apiResource('to-dos', 'ToDoApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Marinas
    Route::apiResource('marinas', 'MarinasApiController');

    // Contact Company
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Provider
    Route::post('providers/media', 'ProviderApiController@storeMedia')->name('providers.storeMedia');
    Route::apiResource('providers', 'ProviderApiController');

    // Brands
    Route::post('brands/media', 'BrandsApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandsApiController');

    // Proforma
    Route::apiResource('proformas', 'ProformaApiController');

    // Claim
    Route::apiResource('claims', 'ClaimApiController');

    // Payment
    Route::apiResource('payments', 'PaymentApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::post('asset-locations/media', 'AssetLocationApiController@storeMedia')->name('asset-locations.storeMedia');
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Mat Logs
    Route::apiResource('mat-logs', 'MatLogsApiController');

    // Comments
    Route::apiResource('comments', 'CommentsApiController');

    // Booking List
    Route::apiResource('booking-lists', 'BookingListApiController');

    // Availability
    Route::apiResource('availabilities', 'AvailabilityApiController');
});
