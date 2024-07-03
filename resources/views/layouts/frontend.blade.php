<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="icon" href="{{ asset('favicon.ico') }}">


    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
        rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->roles->first()->title ?? 'no role' }})
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item"
                                        href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>

                                    @can('to_do_access')
                                        <a class="dropdown-item" href="{{ route('frontend.to-dos.index') }}">
                                            {{ trans('cruds.toDo.title') }}
                                        </a>
                                    @endcan
                                    @can('client_access')
                                        <a class="dropdown-item" href="{{ route('frontend.clients.index') }}">
                                            {{ trans('cruds.client.title') }}
                                        </a>
                                    @endcan
                                    @can('boat_access')
                                        <a class="dropdown-item" href="{{ route('frontend.boats.index') }}">
                                            {{ trans('cruds.boat.title') }}
                                        </a>
                                    @endcan
                                    @can('marina_access')
                                        <a class="dropdown-item" href="{{ route('frontend.marinas.index') }}">
                                            {{ trans('cruds.marina.title') }}
                                        </a>
                                    @endcan
                                    @can('work_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.work.title') }}
                                        </a>
                                    @endcan
                                    @can('wlist_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.wlists.index') }}">
                                            {{ trans('cruds.wlist.title') }}
                                        </a>
                                    @endcan
                                    @can('wlog_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.wlogs.index') }}">
                                            {{ trans('cruds.wlog.title') }}
                                        </a>
                                    @endcan
                                    @can('mlog_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.mlogs.index') }}">
                                            {{ trans('cruds.mlog.title') }}
                                        </a>
                                    @endcan
                                    @can('comment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.comments.index') }}">
                                            {{ trans('cruds.comment.title') }}
                                        </a>
                                    @endcan
                                    @can('appointment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.appointments.index') }}">
                                            {{ trans('cruds.appointment.title') }}
                                        </a>
                                    @endcan
                                    @can('booking_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.booking.title') }}
                                        </a>
                                    @endcan
                                    @can('booking_list_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.booking-lists.index') }}">
                                            {{ trans('cruds.bookingList.title') }}
                                        </a>
                                    @endcan
                                    @can('booking_slot_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.booking-slots.index') }}">
                                            {{ trans('cruds.bookingSlot.title') }}
                                        </a>
                                    @endcan
                                    @can('vip_plan_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.vipPlan.title') }}
                                        </a>
                                    @endcan
                                    @can('suscription_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.suscriptions.index') }}">
                                            {{ trans('cruds.suscription.title') }}
                                        </a>
                                    @endcan
                                    @can('plan_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.plans.index') }}">
                                            {{ trans('cruds.plan.title') }}
                                        </a>
                                    @endcan
                                    @can('waiting_list_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.waiting-lists.index') }}">
                                            {{ trans('cruds.waitingList.title') }}
                                        </a>
                                    @endcan
                                    @can('maintenance_plan_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.maintenancePlan.title') }}
                                        </a>
                                    @endcan
                                    @can('maintenance_suscription_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.maintenance-suscriptions.index') }}">
                                            {{ trans('cruds.maintenanceSuscription.title') }}
                                        </a>
                                    @endcan
                                    @can('care_plan_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.care-plans.index') }}">
                                            {{ trans('cruds.carePlan.title') }}
                                        </a>
                                    @endcan
                                    @can('checkpoint_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.checkpoints.index') }}">
                                            {{ trans('cruds.checkpoint.title') }}
                                        </a>
                                    @endcan
                                    @can('checkpoints_group_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.checkpoints-groups.index') }}">
                                            {{ trans('cruds.checkpointsGroup.title') }}
                                        </a>
                                    @endcan
                                    @can('remote_device_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.remoteDevice.title') }}
                                        </a>
                                    @endcan
                                    @can('iot_suscription_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.iot-suscriptions.index') }}">
                                            {{ trans('cruds.iotSuscription.title') }}
                                        </a>
                                    @endcan
                                    @can('iot_received_data_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.iot-received-datas.index') }}">
                                            {{ trans('cruds.iotReceivedData.title') }}
                                        </a>
                                    @endcan
                                    @can('iot_plan_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.iot-plans.index') }}">
                                            {{ trans('cruds.iotPlan.title') }}
                                        </a>
                                    @endcan
                                    @can('iot_device_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.iot-devices.index') }}">
                                            {{ trans('cruds.iotDevice.title') }}
                                        </a>
                                    @endcan
                                    @can('billing_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.billing.title') }}
                                        </a>
                                    @endcan
                                    @can('finalcial_document_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.finalcial-documents.index') }}">
                                            {{ trans('cruds.finalcialDocument.title') }}
                                        </a>
                                    @endcan
                                    @can('financial_document_item_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.financial-document-items.index') }}">
                                            {{ trans('cruds.financialDocumentItem.title') }}
                                        </a>
                                    @endcan
                                    @can('finantial_document_tax_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.finantial-document-taxes.index') }}">
                                            {{ trans('cruds.finantialDocumentTax.title') }}
                                        </a>
                                    @endcan
                                    @can('finantial_document_discount_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.finantial-document-discounts.index') }}">
                                            {{ trans('cruds.finantialDocumentDiscount.title') }}
                                        </a>
                                    @endcan
                                    @can('payment_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.payments.index') }}">
                                            {{ trans('cruds.payment.title') }}
                                        </a>
                                    @endcan
                                    @can('claim_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.claims.index') }}">
                                            {{ trans('cruds.claim.title') }}
                                        </a>
                                    @endcan
                                    @can('currency_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.currencies.index') }}">
                                            {{ trans('cruds.currency.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.expenseManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.expenses.index') }}">
                                            {{ trans('cruds.expense.title') }}
                                        </a>
                                    @endcan
                                    @can('income_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.incomes.index') }}">
                                            {{ trans('cruds.income.title') }}
                                        </a>
                                    @endcan
                                    @can('product_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.productManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('product_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.products.index') }}">
                                            {{ trans('cruds.product.title') }}
                                        </a>
                                    @endcan
                                    @can('product_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.product-categories.index') }}">
                                            {{ trans('cruds.productCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('brand_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.brands.index') }}">
                                            {{ trans('cruds.brand.title') }}
                                        </a>
                                    @endcan
                                    @can('provider_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.providers.index') }}">
                                            {{ trans('cruds.provider.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.assetManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('assets_rental_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.assets-rentals.index') }}">
                                            {{ trans('cruds.assetsRental.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.assets.index') }}">
                                            {{ trans('cruds.asset.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-categories.index') }}">
                                            {{ trans('cruds.assetCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_location_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-locations.index') }}">
                                            {{ trans('cruds.assetLocation.title') }}
                                        </a>
                                    @endcan
                                    @can('assets_history_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.assets-histories.index') }}">
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </a>
                                    @endcan
                                    @can('company_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.company.title') }}
                                        </a>
                                    @endcan
                                    @can('documentation_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.documentations.index') }}">
                                            {{ trans('cruds.documentation.title') }}
                                        </a>
                                    @endcan
                                    @can('bank_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.banks.index') }}">
                                            {{ trans('cruds.bank.title') }}
                                        </a>
                                    @endcan
                                    @can('insurance_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.insurances.index') }}">
                                            {{ trans('cruds.insurance.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.employees.index') }}">
                                            {{ trans('cruds.employee.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_attendance_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.employee-attendances.index') }}">
                                            {{ trans('cruds.employeeAttendance.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_holiday_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.employee-holidays.index') }}">
                                            {{ trans('cruds.employeeHoliday.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_skill_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.employee-skills.index') }}">
                                            {{ trans('cruds.employeeSkill.title') }}
                                        </a>
                                    @endcan
                                    @can('skills_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.skills-categories.index') }}">
                                            {{ trans('cruds.skillsCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('employee_rating_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.employee-ratings.index') }}">
                                            {{ trans('cruds.employeeRating.title') }}
                                        </a>
                                    @endcan
                                    @can('clients_review_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.clients-reviews.index') }}">
                                            {{ trans('cruds.clientsReview.title') }}
                                        </a>
                                    @endcan
                                    @can('user_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.userManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.users.index') }}">
                                            {{ trans('cruds.user.title') }}
                                        </a>
                                    @endcan
                                    @can('social_account_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.social-accounts.index') }}">
                                            {{ trans('cruds.socialAccount.title') }}
                                        </a>
                                    @endcan
                                    @can('role_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.roles.index') }}">
                                            {{ trans('cruds.role.title') }}
                                        </a>
                                    @endcan
                                    @can('permission_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.permissions.index') }}">
                                            {{ trans('cruds.permission.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.contactManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_contact_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.contact-contacts.index') }}">
                                            {{ trans('cruds.contactContact.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_company_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.contact-companies.index') }}">
                                            {{ trans('cruds.contactCompany.title') }}
                                        </a>
                                    @endcan
                                    @can('content_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.contentManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('content_page_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.content-pages.index') }}">
                                            {{ trans('cruds.contentPage.title') }}
                                        </a>
                                    @endcan
                                    @can('content_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.content-categories.index') }}">
                                            {{ trans('cruds.contentCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('learning_center_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.learningCenter.title') }}
                                        </a>
                                    @endcan
                                    @can('technical_documentation_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.technical-documentations.index') }}">
                                            {{ trans('cruds.technicalDocumentation.title') }}
                                        </a>
                                    @endcan
                                    @can('tech_docs_type_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.tech-docs-types.index') }}">
                                            {{ trans('cruds.techDocsType.title') }}
                                        </a>
                                    @endcan
                                    @can('video_tutorial_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.video-tutorials.index') }}">
                                            {{ trans('cruds.videoTutorial.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_management_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.faqManagement.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_question_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-questions.index') }}">
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </a>
                                    @endcan
                                    @can('faq_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.faq-categories.index') }}">
                                            {{ trans('cruds.faqCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('setup_access')
                                        <a class="dropdown-item disabled" href="#">
                                            {{ trans('cruds.setup.title') }}
                                        </a>
                                    @endcan
                                    @can('documentation_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.documentation-categories.index') }}">
                                            {{ trans('cruds.documentationCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('wlist_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.wlist-statuses.index') }}">
                                            {{ trans('cruds.wlistStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('booking_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.booking-statuses.index') }}">
                                            {{ trans('cruds.bookingStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('asset_status_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.asset-statuses.index') }}">
                                            {{ trans('cruds.assetStatus.title') }}
                                        </a>
                                    @endcan
                                    @can('product_tag_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.product-tags.index') }}">
                                            {{ trans('cruds.productTag.title') }}
                                        </a>
                                    @endcan
                                    @can('contact_tag_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.contact-tags.index') }}">
                                            {{ trans('cruds.contactTag.title') }}
                                        </a>
                                    @endcan
                                    @can('content_tag_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.content-tags.index') }}">
                                            {{ trans('cruds.contentTag.title') }}
                                        </a>
                                    @endcan
                                    @can('expense_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.expense-categories.index') }}">
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('income_category_access')
                                        <a class="dropdown-item ml-3"
                                            href="{{ route('frontend.income-categories.index') }}">
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('video_category_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.video-categories.index') }}">
                                            {{ trans('cruds.videoCategory.title') }}
                                        </a>
                                    @endcan
                                    @can('user_setting_access')
                                        <a class="dropdown-item ml-3" href="{{ route('frontend.user-settings.index') }}">
                                            {{ trans('cruds.userSetting.title') }}
                                        </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if (session('message'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>
