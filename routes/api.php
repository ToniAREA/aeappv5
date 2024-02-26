<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Boats
    Route::post('boats/media', 'BoatsApiController@storeMedia')->name('boats.storeMedia');
    Route::apiResource('boats', 'BoatsApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Wlogs
    Route::post('wlogs/media', 'WlogsApiController@storeMedia')->name('wlogs.storeMedia');
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
    Route::post('marinas/media', 'MarinasApiController@storeMedia')->name('marinas.storeMedia');
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
    Route::post('expenses/media', 'ExpenseApiController@storeMedia')->name('expenses.storeMedia');
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Comments
    Route::post('comments/media', 'CommentsApiController@storeMedia')->name('comments.storeMedia');
    Route::apiResource('comments', 'CommentsApiController');

    // Booking List
    Route::apiResource('booking-lists', 'BookingListApiController');

    // Mlogs
    Route::post('mlogs/media', 'MlogsApiController@storeMedia')->name('mlogs.storeMedia');
    Route::apiResource('mlogs', 'MlogsApiController');

    // Assets Rentals
    Route::apiResource('assets-rentals', 'AssetsRentalsApiController');

    // Booking Slots
    Route::apiResource('booking-slots', 'BookingSlotsApiController');

    // Employee Attendances
    Route::apiResource('employee-attendances', 'EmployeeAttendancesApiController');

    // Technical Documentation
    Route::post('technical-documentations/media', 'TechnicalDocumentationApiController@storeMedia')->name('technical-documentations.storeMedia');
    Route::apiResource('technical-documentations', 'TechnicalDocumentationApiController');

    // Skills Categories
    Route::apiResource('skills-categories', 'SkillsCategoriesApiController');

    // Clients Reviews
    Route::apiResource('clients-reviews', 'ClientsReviewsApiController');

    // Suscriptions
    Route::post('suscriptions/media', 'SuscriptionsApiController@storeMedia')->name('suscriptions.storeMedia');
    Route::apiResource('suscriptions', 'SuscriptionsApiController');

    // Plans
    Route::post('plans/media', 'PlansApiController@storeMedia')->name('plans.storeMedia');
    Route::apiResource('plans', 'PlansApiController');

    // Insurances
    Route::post('insurances/media', 'InsurancesApiController@storeMedia')->name('insurances.storeMedia');
    Route::apiResource('insurances', 'InsurancesApiController');

    // Banks
    Route::apiResource('banks', 'BanksApiController');

    // Checkpoints
    Route::post('checkpoints/media', 'CheckpointsApiController@storeMedia')->name('checkpoints.storeMedia');
    Route::apiResource('checkpoints', 'CheckpointsApiController');

    // Care Plans
    Route::apiResource('care-plans', 'CarePlansApiController');

    // Maintenance Suscriptions
    Route::post('maintenance-suscriptions/media', 'MaintenanceSuscriptionsApiController@storeMedia')->name('maintenance-suscriptions.storeMedia');
    Route::apiResource('maintenance-suscriptions', 'MaintenanceSuscriptionsApiController');

    // Employee Holidays
    Route::apiResource('employee-holidays', 'EmployeeHolidaysApiController');

    // Employee Skills
    Route::apiResource('employee-skills', 'EmployeeSkillsApiController');

    // Employee Rating
    Route::apiResource('employee-ratings', 'EmployeeRatingApiController');
});
