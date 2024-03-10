<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Boats
    Route::post('boats/media', 'BoatsApiController@storeMedia')->name('boats.storeMedia');
    Route::apiResource('boats', 'BoatsApiController');

    // Content Category
    Route::post('content-categories/media', 'ContentCategoryApiController@storeMedia')->name('content-categories.storeMedia');
    Route::apiResource('content-categories', 'ContentCategoryApiController');

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
    Route::apiResource('assets-histories', 'AssetsHistoryApiController');

    // Faq Category
    Route::post('faq-categories/media', 'FaqCategoryApiController@storeMedia')->name('faq-categories.storeMedia');
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::post('faq-questions/media', 'FaqQuestionApiController@storeMedia')->name('faq-questions.storeMedia');
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

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

    // Tech Docs Types
    Route::apiResource('tech-docs-types', 'TechDocsTypesApiController');

    // Skills Categories
    Route::apiResource('skills-categories', 'SkillsCategoriesApiController');

    // Clients Reviews
    Route::apiResource('clients-reviews', 'ClientsReviewsApiController');

    // Video Tutorials
    Route::post('video-tutorials/media', 'VideoTutorialsApiController@storeMedia')->name('video-tutorials.storeMedia');
    Route::apiResource('video-tutorials', 'VideoTutorialsApiController');

    // Video Categories
    Route::post('video-categories/media', 'VideoCategoriesApiController@storeMedia')->name('video-categories.storeMedia');
    Route::apiResource('video-categories', 'VideoCategoriesApiController');

    // Suscriptions
    Route::post('suscriptions/media', 'SuscriptionsApiController@storeMedia')->name('suscriptions.storeMedia');
    Route::apiResource('suscriptions', 'SuscriptionsApiController');

    // Plans
    Route::post('plans/media', 'PlansApiController@storeMedia')->name('plans.storeMedia');
    Route::apiResource('plans', 'PlansApiController');

    // Documentation
    Route::post('documentations/media', 'DocumentationApiController@storeMedia')->name('documentations.storeMedia');
    Route::apiResource('documentations', 'DocumentationApiController');

    // Insurances
    Route::post('insurances/media', 'InsurancesApiController@storeMedia')->name('insurances.storeMedia');
    Route::apiResource('insurances', 'InsurancesApiController');

    // Banks
    Route::post('banks/media', 'BanksApiController@storeMedia')->name('banks.storeMedia');
    Route::apiResource('banks', 'BanksApiController');

    // Documentation Categories
    Route::post('documentation-categories/media', 'DocumentationCategoriesApiController@storeMedia')->name('documentation-categories.storeMedia');
    Route::apiResource('documentation-categories', 'DocumentationCategoriesApiController');

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

    // Iot Plans
    Route::post('iot-plans/media', 'IotPlansApiController@storeMedia')->name('iot-plans.storeMedia');
    Route::apiResource('iot-plans', 'IotPlansApiController');

    // Iot Suscriptions
    Route::post('iot-suscriptions/media', 'IotSuscriptionsApiController@storeMedia')->name('iot-suscriptions.storeMedia');
    Route::apiResource('iot-suscriptions', 'IotSuscriptionsApiController');

    // Iot Devices
    Route::apiResource('iot-devices', 'IotDevicesApiController');

    // Iot Received Data
    Route::apiResource('iot-received-datas', 'IotReceivedDataApiController');

    // Checkpoints Groups
    Route::apiResource('checkpoints-groups', 'CheckpointsGroupsApiController');

    // Currencies
    Route::apiResource('currencies', 'CurrenciesApiController');

    // Finalcial Documents
    Route::apiResource('finalcial-documents', 'FinalcialDocumentsApiController');

    // Social Accounts
    Route::apiResource('social-accounts', 'SocialAccountsApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Financial Document Items
    Route::apiResource('financial-document-items', 'FinancialDocumentItemsApiController');

    // Finantial Document Taxes
    Route::apiResource('finantial-document-taxes', 'FinantialDocumentTaxesApiController');

    // Finantial Document Discounts
    Route::apiResource('finantial-document-discounts', 'FinantialDocumentDiscountsApiController');

    // User Settings
    Route::apiResource('user-settings', 'UserSettingsApiController');
});
