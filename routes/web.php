<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/parse-csv-import', 'ClientsController@parseCsvImport')->name('clients.parseCsvImport');
    Route::post('clients/process-csv-import', 'ClientsController@processCsvImport')->name('clients.processCsvImport');
    Route::resource('clients', 'ClientsController');

    // Boats
    Route::delete('boats/destroy', 'BoatsController@massDestroy')->name('boats.massDestroy');
    Route::post('boats/media', 'BoatsController@storeMedia')->name('boats.storeMedia');
    Route::post('boats/ckmedia', 'BoatsController@storeCKEditorImages')->name('boats.storeCKEditorImages');
    Route::post('boats/parse-csv-import', 'BoatsController@parseCsvImport')->name('boats.parseCsvImport');
    Route::post('boats/process-csv-import', 'BoatsController@processCsvImport')->name('boats.processCsvImport');
    Route::resource('boats', 'BoatsController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::post('content-categories/media', 'ContentCategoryController@storeMedia')->name('content-categories.storeMedia');
    Route::post('content-categories/ckmedia', 'ContentCategoryController@storeCKEditorImages')->name('content-categories.storeCKEditorImages');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::post('content-pages/parse-csv-import', 'ContentPageController@parseCsvImport')->name('content-pages.parseCsvImport');
    Route::post('content-pages/process-csv-import', 'ContentPageController@processCsvImport')->name('content-pages.processCsvImport');
    Route::resource('content-pages', 'ContentPageController');

    // Wlogs
    Route::delete('wlogs/destroy', 'WlogsController@massDestroy')->name('wlogs.massDestroy');
    Route::post('wlogs/media', 'WlogsController@storeMedia')->name('wlogs.storeMedia');
    Route::post('wlogs/ckmedia', 'WlogsController@storeCKEditorImages')->name('wlogs.storeCKEditorImages');
    Route::post('wlogs/parse-csv-import', 'WlogsController@parseCsvImport')->name('wlogs.parseCsvImport');
    Route::post('wlogs/process-csv-import', 'WlogsController@processCsvImport')->name('wlogs.processCsvImport');
    Route::resource('wlogs', 'WlogsController');

    // Wlist
    Route::delete('wlists/destroy', 'WlistController@massDestroy')->name('wlists.massDestroy');
    Route::post('wlists/media', 'WlistController@storeMedia')->name('wlists.storeMedia');
    Route::post('wlists/ckmedia', 'WlistController@storeCKEditorImages')->name('wlists.storeCKEditorImages');
    Route::post('wlists/parse-csv-import', 'WlistController@parseCsvImport')->name('wlists.parseCsvImport');
    Route::post('wlists/process-csv-import', 'WlistController@processCsvImport')->name('wlists.processCsvImport');
    Route::resource('wlists', 'WlistController');

    // To Do
    Route::delete('to-dos/destroy', 'ToDoController@massDestroy')->name('to-dos.massDestroy');
    Route::post('to-dos/media', 'ToDoController@storeMedia')->name('to-dos.storeMedia');
    Route::post('to-dos/ckmedia', 'ToDoController@storeCKEditorImages')->name('to-dos.storeCKEditorImages');
    Route::post('to-dos/parse-csv-import', 'ToDoController@parseCsvImport')->name('to-dos.parseCsvImport');
    Route::post('to-dos/process-csv-import', 'ToDoController@processCsvImport')->name('to-dos.processCsvImport');
    Route::resource('to-dos', 'ToDoController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/parse-csv-import', 'AppointmentsController@parseCsvImport')->name('appointments.parseCsvImport');
    Route::post('appointments/process-csv-import', 'AppointmentsController@processCsvImport')->name('appointments.processCsvImport');
    Route::resource('appointments', 'AppointmentsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::post('product-categories/parse-csv-import', 'ProductCategoryController@parseCsvImport')->name('product-categories.parseCsvImport');
    Route::post('product-categories/process-csv-import', 'ProductCategoryController@processCsvImport')->name('product-categories.processCsvImport');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::post('product-tags/parse-csv-import', 'ProductTagController@parseCsvImport')->name('product-tags.parseCsvImport');
    Route::post('product-tags/process-csv-import', 'ProductTagController@processCsvImport')->name('product-tags.processCsvImport');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Marinas
    Route::delete('marinas/destroy', 'MarinasController@massDestroy')->name('marinas.massDestroy');
    Route::post('marinas/media', 'MarinasController@storeMedia')->name('marinas.storeMedia');
    Route::post('marinas/ckmedia', 'MarinasController@storeCKEditorImages')->name('marinas.storeCKEditorImages');
    Route::post('marinas/parse-csv-import', 'MarinasController@parseCsvImport')->name('marinas.parseCsvImport');
    Route::post('marinas/process-csv-import', 'MarinasController@processCsvImport')->name('marinas.processCsvImport');
    Route::resource('marinas', 'MarinasController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::post('employees/parse-csv-import', 'EmployeesController@parseCsvImport')->name('employees.parseCsvImport');
    Route::post('employees/process-csv-import', 'EmployeesController@processCsvImport')->name('employees.processCsvImport');
    Route::resource('employees', 'EmployeesController');

    // Provider
    Route::delete('providers/destroy', 'ProviderController@massDestroy')->name('providers.massDestroy');
    Route::post('providers/media', 'ProviderController@storeMedia')->name('providers.storeMedia');
    Route::post('providers/ckmedia', 'ProviderController@storeCKEditorImages')->name('providers.storeCKEditorImages');
    Route::post('providers/parse-csv-import', 'ProviderController@parseCsvImport')->name('providers.parseCsvImport');
    Route::post('providers/process-csv-import', 'ProviderController@processCsvImport')->name('providers.processCsvImport');
    Route::resource('providers', 'ProviderController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::post('brands/parse-csv-import', 'BrandsController@parseCsvImport')->name('brands.parseCsvImport');
    Route::post('brands/process-csv-import', 'BrandsController@processCsvImport')->name('brands.processCsvImport');
    Route::resource('brands', 'BrandsController');

    // Proforma
    Route::delete('proformas/destroy', 'ProformaController@massDestroy')->name('proformas.massDestroy');
    Route::post('proformas/parse-csv-import', 'ProformaController@parseCsvImport')->name('proformas.parseCsvImport');
    Route::post('proformas/process-csv-import', 'ProformaController@processCsvImport')->name('proformas.processCsvImport');
    Route::resource('proformas', 'ProformaController');

    // Claim
    Route::delete('claims/destroy', 'ClaimController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::post('asset-categories/parse-csv-import', 'AssetCategoryController@parseCsvImport')->name('asset-categories.parseCsvImport');
    Route::post('asset-categories/process-csv-import', 'AssetCategoryController@processCsvImport')->name('asset-categories.processCsvImport');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/media', 'AssetLocationController@storeMedia')->name('asset-locations.storeMedia');
    Route::post('asset-locations/ckmedia', 'AssetLocationController@storeCKEditorImages')->name('asset-locations.storeCKEditorImages');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::post('faq-categories/parse-csv-import', 'FaqCategoryController@parseCsvImport')->name('faq-categories.parseCsvImport');
    Route::post('faq-categories/process-csv-import', 'FaqCategoryController@processCsvImport')->name('faq-categories.processCsvImport');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/media', 'FaqQuestionController@storeMedia')->name('faq-questions.storeMedia');
    Route::post('faq-questions/ckmedia', 'FaqQuestionController@storeCKEditorImages')->name('faq-questions.storeCKEditorImages');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/media', 'ExpenseController@storeMedia')->name('expenses.storeMedia');
    Route::post('expenses/ckmedia', 'ExpenseController@storeCKEditorImages')->name('expenses.storeCKEditorImages');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::post('incomes/parse-csv-import', 'IncomeController@parseCsvImport')->name('incomes.parseCsvImport');
    Route::post('incomes/process-csv-import', 'IncomeController@processCsvImport')->name('incomes.processCsvImport');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Contact Tag
    Route::delete('contact-tags/destroy', 'ContactTagController@massDestroy')->name('contact-tags.massDestroy');
    Route::resource('contact-tags', 'ContactTagController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/media', 'CommentsController@storeMedia')->name('comments.storeMedia');
    Route::post('comments/ckmedia', 'CommentsController@storeCKEditorImages')->name('comments.storeCKEditorImages');
    Route::post('comments/parse-csv-import', 'CommentsController@parseCsvImport')->name('comments.parseCsvImport');
    Route::post('comments/process-csv-import', 'CommentsController@processCsvImport')->name('comments.processCsvImport');
    Route::resource('comments', 'CommentsController');

    // Booking List
    Route::delete('booking-lists/destroy', 'BookingListController@massDestroy')->name('booking-lists.massDestroy');
    Route::post('booking-lists/parse-csv-import', 'BookingListController@parseCsvImport')->name('booking-lists.parseCsvImport');
    Route::post('booking-lists/process-csv-import', 'BookingListController@processCsvImport')->name('booking-lists.processCsvImport');
    Route::resource('booking-lists', 'BookingListController');

    // Wlist Statuses
    Route::delete('wlist-statuses/destroy', 'WlistStatusesController@massDestroy')->name('wlist-statuses.massDestroy');
    Route::resource('wlist-statuses', 'WlistStatusesController');

    // Mlogs
    Route::delete('mlogs/destroy', 'MlogsController@massDestroy')->name('mlogs.massDestroy');
    Route::post('mlogs/media', 'MlogsController@storeMedia')->name('mlogs.storeMedia');
    Route::post('mlogs/ckmedia', 'MlogsController@storeCKEditorImages')->name('mlogs.storeCKEditorImages');
    Route::post('mlogs/parse-csv-import', 'MlogsController@parseCsvImport')->name('mlogs.parseCsvImport');
    Route::post('mlogs/process-csv-import', 'MlogsController@processCsvImport')->name('mlogs.processCsvImport');
    Route::resource('mlogs', 'MlogsController');

    // Assets Rentals
    Route::delete('assets-rentals/destroy', 'AssetsRentalsController@massDestroy')->name('assets-rentals.massDestroy');
    Route::resource('assets-rentals', 'AssetsRentalsController');

    // Booking Statuses
    Route::delete('booking-statuses/destroy', 'BookingStatusesController@massDestroy')->name('booking-statuses.massDestroy');
    Route::resource('booking-statuses', 'BookingStatusesController');

    // Booking Slots
    Route::delete('booking-slots/destroy', 'BookingSlotsController@massDestroy')->name('booking-slots.massDestroy');
    Route::post('booking-slots/parse-csv-import', 'BookingSlotsController@parseCsvImport')->name('booking-slots.parseCsvImport');
    Route::post('booking-slots/process-csv-import', 'BookingSlotsController@processCsvImport')->name('booking-slots.processCsvImport');
    Route::resource('booking-slots', 'BookingSlotsController');

    // Employee Attendances
    Route::delete('employee-attendances/destroy', 'EmployeeAttendancesController@massDestroy')->name('employee-attendances.massDestroy');
    Route::resource('employee-attendances', 'EmployeeAttendancesController');

    // Technical Documentation
    Route::delete('technical-documentations/destroy', 'TechnicalDocumentationController@massDestroy')->name('technical-documentations.massDestroy');
    Route::post('technical-documentations/media', 'TechnicalDocumentationController@storeMedia')->name('technical-documentations.storeMedia');
    Route::post('technical-documentations/ckmedia', 'TechnicalDocumentationController@storeCKEditorImages')->name('technical-documentations.storeCKEditorImages');
    Route::resource('technical-documentations', 'TechnicalDocumentationController');

    // Tech Docs Types
    Route::delete('tech-docs-types/destroy', 'TechDocsTypesController@massDestroy')->name('tech-docs-types.massDestroy');
    Route::resource('tech-docs-types', 'TechDocsTypesController');

    // Skills Categories
    Route::delete('skills-categories/destroy', 'SkillsCategoriesController@massDestroy')->name('skills-categories.massDestroy');
    Route::resource('skills-categories', 'SkillsCategoriesController');

    // Clients Reviews
    Route::delete('clients-reviews/destroy', 'ClientsReviewsController@massDestroy')->name('clients-reviews.massDestroy');
    Route::post('clients-reviews/parse-csv-import', 'ClientsReviewsController@parseCsvImport')->name('clients-reviews.parseCsvImport');
    Route::post('clients-reviews/process-csv-import', 'ClientsReviewsController@processCsvImport')->name('clients-reviews.processCsvImport');
    Route::resource('clients-reviews', 'ClientsReviewsController');

    // Video Tutorials
    Route::delete('video-tutorials/destroy', 'VideoTutorialsController@massDestroy')->name('video-tutorials.massDestroy');
    Route::post('video-tutorials/media', 'VideoTutorialsController@storeMedia')->name('video-tutorials.storeMedia');
    Route::post('video-tutorials/ckmedia', 'VideoTutorialsController@storeCKEditorImages')->name('video-tutorials.storeCKEditorImages');
    Route::resource('video-tutorials', 'VideoTutorialsController');

    // Video Categories
    Route::delete('video-categories/destroy', 'VideoCategoriesController@massDestroy')->name('video-categories.massDestroy');
    Route::resource('video-categories', 'VideoCategoriesController');

    // Suscriptions
    Route::delete('suscriptions/destroy', 'SuscriptionsController@massDestroy')->name('suscriptions.massDestroy');
    Route::post('suscriptions/media', 'SuscriptionsController@storeMedia')->name('suscriptions.storeMedia');
    Route::post('suscriptions/ckmedia', 'SuscriptionsController@storeCKEditorImages')->name('suscriptions.storeCKEditorImages');
    Route::resource('suscriptions', 'SuscriptionsController');

    // Plans
    Route::delete('plans/destroy', 'PlansController@massDestroy')->name('plans.massDestroy');
    Route::post('plans/media', 'PlansController@storeMedia')->name('plans.storeMedia');
    Route::post('plans/ckmedia', 'PlansController@storeCKEditorImages')->name('plans.storeCKEditorImages');
    Route::resource('plans', 'PlansController');

    // Documentation
    Route::delete('documentations/destroy', 'DocumentationController@massDestroy')->name('documentations.massDestroy');
    Route::post('documentations/media', 'DocumentationController@storeMedia')->name('documentations.storeMedia');
    Route::post('documentations/ckmedia', 'DocumentationController@storeCKEditorImages')->name('documentations.storeCKEditorImages');
    Route::resource('documentations', 'DocumentationController');

    // Insurances
    Route::delete('insurances/destroy', 'InsurancesController@massDestroy')->name('insurances.massDestroy');
    Route::post('insurances/media', 'InsurancesController@storeMedia')->name('insurances.storeMedia');
    Route::post('insurances/ckmedia', 'InsurancesController@storeCKEditorImages')->name('insurances.storeCKEditorImages');
    Route::resource('insurances', 'InsurancesController');

    // Banks
    Route::delete('banks/destroy', 'BanksController@massDestroy')->name('banks.massDestroy');
    Route::resource('banks', 'BanksController');

    // Documentation Categories
    Route::delete('documentation-categories/destroy', 'DocumentationCategoriesController@massDestroy')->name('documentation-categories.massDestroy');
    Route::resource('documentation-categories', 'DocumentationCategoriesController');

    // Checkpoints
    Route::delete('checkpoints/destroy', 'CheckpointsController@massDestroy')->name('checkpoints.massDestroy');
    Route::post('checkpoints/media', 'CheckpointsController@storeMedia')->name('checkpoints.storeMedia');
    Route::post('checkpoints/ckmedia', 'CheckpointsController@storeCKEditorImages')->name('checkpoints.storeCKEditorImages');
    Route::post('checkpoints/parse-csv-import', 'CheckpointsController@parseCsvImport')->name('checkpoints.parseCsvImport');
    Route::post('checkpoints/process-csv-import', 'CheckpointsController@processCsvImport')->name('checkpoints.processCsvImport');
    Route::resource('checkpoints', 'CheckpointsController');

    // Care Plans
    Route::delete('care-plans/destroy', 'CarePlansController@massDestroy')->name('care-plans.massDestroy');
    Route::post('care-plans/parse-csv-import', 'CarePlansController@parseCsvImport')->name('care-plans.parseCsvImport');
    Route::post('care-plans/process-csv-import', 'CarePlansController@processCsvImport')->name('care-plans.processCsvImport');
    Route::resource('care-plans', 'CarePlansController');

    // Maintenance Suscriptions
    Route::delete('maintenance-suscriptions/destroy', 'MaintenanceSuscriptionsController@massDestroy')->name('maintenance-suscriptions.massDestroy');
    Route::post('maintenance-suscriptions/media', 'MaintenanceSuscriptionsController@storeMedia')->name('maintenance-suscriptions.storeMedia');
    Route::post('maintenance-suscriptions/ckmedia', 'MaintenanceSuscriptionsController@storeCKEditorImages')->name('maintenance-suscriptions.storeCKEditorImages');
    Route::post('maintenance-suscriptions/parse-csv-import', 'MaintenanceSuscriptionsController@parseCsvImport')->name('maintenance-suscriptions.parseCsvImport');
    Route::post('maintenance-suscriptions/process-csv-import', 'MaintenanceSuscriptionsController@processCsvImport')->name('maintenance-suscriptions.processCsvImport');
    Route::resource('maintenance-suscriptions', 'MaintenanceSuscriptionsController');

    // Employee Holidays
    Route::delete('employee-holidays/destroy', 'EmployeeHolidaysController@massDestroy')->name('employee-holidays.massDestroy');
    Route::post('employee-holidays/parse-csv-import', 'EmployeeHolidaysController@parseCsvImport')->name('employee-holidays.parseCsvImport');
    Route::post('employee-holidays/process-csv-import', 'EmployeeHolidaysController@processCsvImport')->name('employee-holidays.processCsvImport');
    Route::resource('employee-holidays', 'EmployeeHolidaysController');

    // Employee Skills
    Route::delete('employee-skills/destroy', 'EmployeeSkillsController@massDestroy')->name('employee-skills.massDestroy');
    Route::resource('employee-skills', 'EmployeeSkillsController');

    // Employee Rating
    Route::delete('employee-ratings/destroy', 'EmployeeRatingController@massDestroy')->name('employee-ratings.massDestroy');
    Route::post('employee-ratings/parse-csv-import', 'EmployeeRatingController@parseCsvImport')->name('employee-ratings.parseCsvImport');
    Route::post('employee-ratings/process-csv-import', 'EmployeeRatingController@processCsvImport')->name('employee-ratings.processCsvImport');
    Route::resource('employee-ratings', 'EmployeeRatingController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Boats
    Route::delete('boats/destroy', 'BoatsController@massDestroy')->name('boats.massDestroy');
    Route::post('boats/media', 'BoatsController@storeMedia')->name('boats.storeMedia');
    Route::post('boats/ckmedia', 'BoatsController@storeCKEditorImages')->name('boats.storeCKEditorImages');
    Route::resource('boats', 'BoatsController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::post('content-categories/media', 'ContentCategoryController@storeMedia')->name('content-categories.storeMedia');
    Route::post('content-categories/ckmedia', 'ContentCategoryController@storeCKEditorImages')->name('content-categories.storeCKEditorImages');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Wlogs
    Route::delete('wlogs/destroy', 'WlogsController@massDestroy')->name('wlogs.massDestroy');
    Route::post('wlogs/media', 'WlogsController@storeMedia')->name('wlogs.storeMedia');
    Route::post('wlogs/ckmedia', 'WlogsController@storeCKEditorImages')->name('wlogs.storeCKEditorImages');
    Route::resource('wlogs', 'WlogsController');

    // Wlist
    Route::delete('wlists/destroy', 'WlistController@massDestroy')->name('wlists.massDestroy');
    Route::post('wlists/media', 'WlistController@storeMedia')->name('wlists.storeMedia');
    Route::post('wlists/ckmedia', 'WlistController@storeCKEditorImages')->name('wlists.storeCKEditorImages');
    Route::resource('wlists', 'WlistController');

    // To Do
    Route::delete('to-dos/destroy', 'ToDoController@massDestroy')->name('to-dos.massDestroy');
    Route::post('to-dos/media', 'ToDoController@storeMedia')->name('to-dos.storeMedia');
    Route::post('to-dos/ckmedia', 'ToDoController@storeCKEditorImages')->name('to-dos.storeCKEditorImages');
    Route::resource('to-dos', 'ToDoController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Marinas
    Route::delete('marinas/destroy', 'MarinasController@massDestroy')->name('marinas.massDestroy');
    Route::post('marinas/media', 'MarinasController@storeMedia')->name('marinas.storeMedia');
    Route::post('marinas/ckmedia', 'MarinasController@storeCKEditorImages')->name('marinas.storeCKEditorImages');
    Route::resource('marinas', 'MarinasController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Provider
    Route::delete('providers/destroy', 'ProviderController@massDestroy')->name('providers.massDestroy');
    Route::post('providers/media', 'ProviderController@storeMedia')->name('providers.storeMedia');
    Route::post('providers/ckmedia', 'ProviderController@storeCKEditorImages')->name('providers.storeCKEditorImages');
    Route::resource('providers', 'ProviderController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

    // Proforma
    Route::delete('proformas/destroy', 'ProformaController@massDestroy')->name('proformas.massDestroy');
    Route::resource('proformas', 'ProformaController');

    // Claim
    Route::delete('claims/destroy', 'ClaimController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/media', 'AssetLocationController@storeMedia')->name('asset-locations.storeMedia');
    Route::post('asset-locations/ckmedia', 'AssetLocationController@storeCKEditorImages')->name('asset-locations.storeCKEditorImages');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/media', 'FaqQuestionController@storeMedia')->name('faq-questions.storeMedia');
    Route::post('faq-questions/ckmedia', 'FaqQuestionController@storeCKEditorImages')->name('faq-questions.storeCKEditorImages');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/media', 'ExpenseController@storeMedia')->name('expenses.storeMedia');
    Route::post('expenses/ckmedia', 'ExpenseController@storeCKEditorImages')->name('expenses.storeCKEditorImages');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Contact Tag
    Route::delete('contact-tags/destroy', 'ContactTagController@massDestroy')->name('contact-tags.massDestroy');
    Route::resource('contact-tags', 'ContactTagController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::post('comments/media', 'CommentsController@storeMedia')->name('comments.storeMedia');
    Route::post('comments/ckmedia', 'CommentsController@storeCKEditorImages')->name('comments.storeCKEditorImages');
    Route::resource('comments', 'CommentsController');

    // Booking List
    Route::delete('booking-lists/destroy', 'BookingListController@massDestroy')->name('booking-lists.massDestroy');
    Route::resource('booking-lists', 'BookingListController');

    // Wlist Statuses
    Route::delete('wlist-statuses/destroy', 'WlistStatusesController@massDestroy')->name('wlist-statuses.massDestroy');
    Route::resource('wlist-statuses', 'WlistStatusesController');

    // Mlogs
    Route::delete('mlogs/destroy', 'MlogsController@massDestroy')->name('mlogs.massDestroy');
    Route::post('mlogs/media', 'MlogsController@storeMedia')->name('mlogs.storeMedia');
    Route::post('mlogs/ckmedia', 'MlogsController@storeCKEditorImages')->name('mlogs.storeCKEditorImages');
    Route::resource('mlogs', 'MlogsController');

    // Assets Rentals
    Route::delete('assets-rentals/destroy', 'AssetsRentalsController@massDestroy')->name('assets-rentals.massDestroy');
    Route::resource('assets-rentals', 'AssetsRentalsController');

    // Booking Statuses
    Route::delete('booking-statuses/destroy', 'BookingStatusesController@massDestroy')->name('booking-statuses.massDestroy');
    Route::resource('booking-statuses', 'BookingStatusesController');

    // Booking Slots
    Route::delete('booking-slots/destroy', 'BookingSlotsController@massDestroy')->name('booking-slots.massDestroy');
    Route::resource('booking-slots', 'BookingSlotsController');

    // Employee Attendances
    Route::delete('employee-attendances/destroy', 'EmployeeAttendancesController@massDestroy')->name('employee-attendances.massDestroy');
    Route::resource('employee-attendances', 'EmployeeAttendancesController');

    // Technical Documentation
    Route::delete('technical-documentations/destroy', 'TechnicalDocumentationController@massDestroy')->name('technical-documentations.massDestroy');
    Route::post('technical-documentations/media', 'TechnicalDocumentationController@storeMedia')->name('technical-documentations.storeMedia');
    Route::post('technical-documentations/ckmedia', 'TechnicalDocumentationController@storeCKEditorImages')->name('technical-documentations.storeCKEditorImages');
    Route::resource('technical-documentations', 'TechnicalDocumentationController');

    // Tech Docs Types
    Route::delete('tech-docs-types/destroy', 'TechDocsTypesController@massDestroy')->name('tech-docs-types.massDestroy');
    Route::resource('tech-docs-types', 'TechDocsTypesController');

    // Skills Categories
    Route::delete('skills-categories/destroy', 'SkillsCategoriesController@massDestroy')->name('skills-categories.massDestroy');
    Route::resource('skills-categories', 'SkillsCategoriesController');

    // Clients Reviews
    Route::delete('clients-reviews/destroy', 'ClientsReviewsController@massDestroy')->name('clients-reviews.massDestroy');
    Route::resource('clients-reviews', 'ClientsReviewsController');

    // Video Tutorials
    Route::delete('video-tutorials/destroy', 'VideoTutorialsController@massDestroy')->name('video-tutorials.massDestroy');
    Route::post('video-tutorials/media', 'VideoTutorialsController@storeMedia')->name('video-tutorials.storeMedia');
    Route::post('video-tutorials/ckmedia', 'VideoTutorialsController@storeCKEditorImages')->name('video-tutorials.storeCKEditorImages');
    Route::resource('video-tutorials', 'VideoTutorialsController');

    // Video Categories
    Route::delete('video-categories/destroy', 'VideoCategoriesController@massDestroy')->name('video-categories.massDestroy');
    Route::resource('video-categories', 'VideoCategoriesController');

    // Suscriptions
    Route::delete('suscriptions/destroy', 'SuscriptionsController@massDestroy')->name('suscriptions.massDestroy');
    Route::post('suscriptions/media', 'SuscriptionsController@storeMedia')->name('suscriptions.storeMedia');
    Route::post('suscriptions/ckmedia', 'SuscriptionsController@storeCKEditorImages')->name('suscriptions.storeCKEditorImages');
    Route::resource('suscriptions', 'SuscriptionsController');

    // Plans
    Route::delete('plans/destroy', 'PlansController@massDestroy')->name('plans.massDestroy');
    Route::post('plans/media', 'PlansController@storeMedia')->name('plans.storeMedia');
    Route::post('plans/ckmedia', 'PlansController@storeCKEditorImages')->name('plans.storeCKEditorImages');
    Route::resource('plans', 'PlansController');

    // Documentation
    Route::delete('documentations/destroy', 'DocumentationController@massDestroy')->name('documentations.massDestroy');
    Route::post('documentations/media', 'DocumentationController@storeMedia')->name('documentations.storeMedia');
    Route::post('documentations/ckmedia', 'DocumentationController@storeCKEditorImages')->name('documentations.storeCKEditorImages');
    Route::resource('documentations', 'DocumentationController');

    // Insurances
    Route::delete('insurances/destroy', 'InsurancesController@massDestroy')->name('insurances.massDestroy');
    Route::post('insurances/media', 'InsurancesController@storeMedia')->name('insurances.storeMedia');
    Route::post('insurances/ckmedia', 'InsurancesController@storeCKEditorImages')->name('insurances.storeCKEditorImages');
    Route::resource('insurances', 'InsurancesController');

    // Banks
    Route::delete('banks/destroy', 'BanksController@massDestroy')->name('banks.massDestroy');
    Route::resource('banks', 'BanksController');

    // Documentation Categories
    Route::delete('documentation-categories/destroy', 'DocumentationCategoriesController@massDestroy')->name('documentation-categories.massDestroy');
    Route::resource('documentation-categories', 'DocumentationCategoriesController');

    // Checkpoints
    Route::delete('checkpoints/destroy', 'CheckpointsController@massDestroy')->name('checkpoints.massDestroy');
    Route::post('checkpoints/media', 'CheckpointsController@storeMedia')->name('checkpoints.storeMedia');
    Route::post('checkpoints/ckmedia', 'CheckpointsController@storeCKEditorImages')->name('checkpoints.storeCKEditorImages');
    Route::resource('checkpoints', 'CheckpointsController');

    // Care Plans
    Route::delete('care-plans/destroy', 'CarePlansController@massDestroy')->name('care-plans.massDestroy');
    Route::resource('care-plans', 'CarePlansController');

    // Maintenance Suscriptions
    Route::delete('maintenance-suscriptions/destroy', 'MaintenanceSuscriptionsController@massDestroy')->name('maintenance-suscriptions.massDestroy');
    Route::post('maintenance-suscriptions/media', 'MaintenanceSuscriptionsController@storeMedia')->name('maintenance-suscriptions.storeMedia');
    Route::post('maintenance-suscriptions/ckmedia', 'MaintenanceSuscriptionsController@storeCKEditorImages')->name('maintenance-suscriptions.storeCKEditorImages');
    Route::resource('maintenance-suscriptions', 'MaintenanceSuscriptionsController');

    // Employee Holidays
    Route::delete('employee-holidays/destroy', 'EmployeeHolidaysController@massDestroy')->name('employee-holidays.massDestroy');
    Route::resource('employee-holidays', 'EmployeeHolidaysController');

    // Employee Skills
    Route::delete('employee-skills/destroy', 'EmployeeSkillsController@massDestroy')->name('employee-skills.massDestroy');
    Route::resource('employee-skills', 'EmployeeSkillsController');

    // Employee Rating
    Route::delete('employee-ratings/destroy', 'EmployeeRatingController@massDestroy')->name('employee-ratings.massDestroy');
    Route::resource('employee-ratings', 'EmployeeRatingController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
