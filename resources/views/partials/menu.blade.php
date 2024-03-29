<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('to_do_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.to-dos.index") }}" class="nav-link {{ request()->is("admin/to-dos") || request()->is("admin/to-dos/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-check-circle">

                            </i>
                            <p>
                                {{ trans('cruds.toDo.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('client_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.client.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('boat_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.boats.index") }}" class="nav-link {{ request()->is("admin/boats") || request()->is("admin/boats/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-ship">

                            </i>
                            <p>
                                {{ trans('cruds.boat.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('marina_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.marinas.index") }}" class="nav-link {{ request()->is("admin/marinas") || request()->is("admin/marinas/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-anchor">

                            </i>
                            <p>
                                {{ trans('cruds.marina.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('work_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/wlists*") ? "menu-open" : "" }} {{ request()->is("admin/wlogs*") ? "menu-open" : "" }} {{ request()->is("admin/mlogs*") ? "menu-open" : "" }} {{ request()->is("admin/comments*") ? "menu-open" : "" }} {{ request()->is("admin/appointments*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/wlists*") ? "active" : "" }} {{ request()->is("admin/wlogs*") ? "active" : "" }} {{ request()->is("admin/mlogs*") ? "active" : "" }} {{ request()->is("admin/comments*") ? "active" : "" }} {{ request()->is("admin/appointments*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.work.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('wlist_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.wlists.index") }}" class="nav-link {{ request()->is("admin/wlists") || request()->is("admin/wlists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.wlist.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('wlog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.wlogs.index") }}" class="nav-link {{ request()->is("admin/wlogs") || request()->is("admin/wlogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.wlog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('mlog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mlogs.index") }}" class="nav-link {{ request()->is("admin/mlogs") || request()->is("admin/mlogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mlog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('comment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.comments.index") }}" class="nav-link {{ request()->is("admin/comments") || request()->is("admin/comments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-comments">

                                        </i>
                                        <p>
                                            {{ trans('cruds.comment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('appointment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('booking_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/booking-lists*") ? "menu-open" : "" }} {{ request()->is("admin/booking-slots*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/booking-lists*") ? "active" : "" }} {{ request()->is("admin/booking-slots*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book-open">

                            </i>
                            <p>
                                {{ trans('cruds.booking.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('booking_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.booking-lists.index") }}" class="nav-link {{ request()->is("admin/booking-lists") || request()->is("admin/booking-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bookmark">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bookingList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('booking_slot_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.booking-slots.index") }}" class="nav-link {{ request()->is("admin/booking-slots") || request()->is("admin/booking-slots/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-bookmark">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bookingSlot.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('vip_plan_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/suscriptions*") ? "menu-open" : "" }} {{ request()->is("admin/plans*") ? "menu-open" : "" }} {{ request()->is("admin/waiting-lists*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/suscriptions*") ? "active" : "" }} {{ request()->is("admin/plans*") ? "active" : "" }} {{ request()->is("admin/waiting-lists*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-star">

                            </i>
                            <p>
                                {{ trans('cruds.vipPlan.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('suscription_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.suscriptions.index") }}" class="nav-link {{ request()->is("admin/suscriptions") || request()->is("admin/suscriptions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.suscription.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('plan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.plans.index") }}" class="nav-link {{ request()->is("admin/plans") || request()->is("admin/plans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-ol">

                                        </i>
                                        <p>
                                            {{ trans('cruds.plan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('waiting_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.waiting-lists.index") }}" class="nav-link {{ request()->is("admin/waiting-lists") || request()->is("admin/waiting-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-pause">

                                        </i>
                                        <p>
                                            {{ trans('cruds.waitingList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('maintenance_plan_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/maintenance-suscriptions*") ? "menu-open" : "" }} {{ request()->is("admin/care-plans*") ? "menu-open" : "" }} {{ request()->is("admin/checkpoints*") ? "menu-open" : "" }} {{ request()->is("admin/checkpoints-groups*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/maintenance-suscriptions*") ? "active" : "" }} {{ request()->is("admin/care-plans*") ? "active" : "" }} {{ request()->is("admin/checkpoints*") ? "active" : "" }} {{ request()->is("admin/checkpoints-groups*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.maintenancePlan.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('maintenance_suscription_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.maintenance-suscriptions.index") }}" class="nav-link {{ request()->is("admin/maintenance-suscriptions") || request()->is("admin/maintenance-suscriptions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.maintenanceSuscription.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('care_plan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.care-plans.index") }}" class="nav-link {{ request()->is("admin/care-plans") || request()->is("admin/care-plans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.carePlan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('checkpoint_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.checkpoints.index") }}" class="nav-link {{ request()->is("admin/checkpoints") || request()->is("admin/checkpoints/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-check-square">

                                        </i>
                                        <p>
                                            {{ trans('cruds.checkpoint.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('checkpoints_group_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.checkpoints-groups.index") }}" class="nav-link {{ request()->is("admin/checkpoints-groups") || request()->is("admin/checkpoints-groups/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.checkpointsGroup.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('remote_device_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/iot-suscriptions*") ? "menu-open" : "" }} {{ request()->is("admin/iot-received-datas*") ? "menu-open" : "" }} {{ request()->is("admin/iot-plans*") ? "menu-open" : "" }} {{ request()->is("admin/iot-devices*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/iot-suscriptions*") ? "active" : "" }} {{ request()->is("admin/iot-received-datas*") ? "active" : "" }} {{ request()->is("admin/iot-plans*") ? "active" : "" }} {{ request()->is("admin/iot-devices*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-broadcast-tower">

                            </i>
                            <p>
                                {{ trans('cruds.remoteDevice.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('iot_suscription_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.iot-suscriptions.index") }}" class="nav-link {{ request()->is("admin/iot-suscriptions") || request()->is("admin/iot-suscriptions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                                        </i>
                                        <p>
                                            {{ trans('cruds.iotSuscription.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('iot_received_data_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.iot-received-datas.index") }}" class="nav-link {{ request()->is("admin/iot-received-datas") || request()->is("admin/iot-received-datas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sign-in-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.iotReceivedData.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('iot_plan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.iot-plans.index") }}" class="nav-link {{ request()->is("admin/iot-plans") || request()->is("admin/iot-plans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-ol">

                                        </i>
                                        <p>
                                            {{ trans('cruds.iotPlan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('iot_device_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.iot-devices.index") }}" class="nav-link {{ request()->is("admin/iot-devices") || request()->is("admin/iot-devices/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-microchip">

                                        </i>
                                        <p>
                                            {{ trans('cruds.iotDevice.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('billing_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/finalcial-documents*") ? "menu-open" : "" }} {{ request()->is("admin/financial-document-items*") ? "menu-open" : "" }} {{ request()->is("admin/finantial-document-taxes*") ? "menu-open" : "" }} {{ request()->is("admin/finantial-document-discounts*") ? "menu-open" : "" }} {{ request()->is("admin/payments*") ? "menu-open" : "" }} {{ request()->is("admin/claims*") ? "menu-open" : "" }} {{ request()->is("admin/currencies*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/finalcial-documents*") ? "active" : "" }} {{ request()->is("admin/financial-document-items*") ? "active" : "" }} {{ request()->is("admin/finantial-document-taxes*") ? "active" : "" }} {{ request()->is("admin/finantial-document-discounts*") ? "active" : "" }} {{ request()->is("admin/payments*") ? "active" : "" }} {{ request()->is("admin/claims*") ? "active" : "" }} {{ request()->is("admin/currencies*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon far fa-money-bill-alt">

                            </i>
                            <p>
                                {{ trans('cruds.billing.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('finalcial_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.finalcial-documents.index") }}" class="nav-link {{ request()->is("admin/finalcial-documents") || request()->is("admin/finalcial-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice">

                                        </i>
                                        <p>
                                            {{ trans('cruds.finalcialDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('financial_document_item_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.financial-document-items.index") }}" class="nav-link {{ request()->is("admin/financial-document-items") || request()->is("admin/financial-document-items/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice">

                                        </i>
                                        <p>
                                            {{ trans('cruds.financialDocumentItem.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('finantial_document_tax_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.finantial-document-taxes.index") }}" class="nav-link {{ request()->is("admin/finantial-document-taxes") || request()->is("admin/finantial-document-taxes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-university">

                                        </i>
                                        <p>
                                            {{ trans('cruds.finantialDocumentTax.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('finantial_document_discount_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.finantial-document-discounts.index") }}" class="nav-link {{ request()->is("admin/finantial-document-discounts") || request()->is("admin/finantial-document-discounts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-percent">

                                        </i>
                                        <p>
                                            {{ trans('cruds.finantialDocumentDiscount.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payments.index") }}" class="nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-cc-visa">

                                        </i>
                                        <p>
                                            {{ trans('cruds.payment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('claim_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.claims.index") }}" class="nav-link {{ request()->is("admin/claims") || request()->is("admin/claims/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-angry">

                                        </i>
                                        <p>
                                            {{ trans('cruds.claim.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('currency_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.currencies.index") }}" class="nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-euro-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.currency.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expense_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/expenses*") ? "menu-open" : "" }} {{ request()->is("admin/incomes*") ? "menu-open" : "" }} {{ request()->is("admin/expense-reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/expenses*") ? "active" : "" }} {{ request()->is("admin/incomes*") ? "active" : "" }} {{ request()->is("admin/expense-reports*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill">

                            </i>
                            <p>
                                {{ trans('cruds.expenseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.income.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-reports.index") }}" class="nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseReport.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('product_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/products*") ? "menu-open" : "" }} {{ request()->is("admin/product-categories*") ? "menu-open" : "" }} {{ request()->is("admin/brands*") ? "menu-open" : "" }} {{ request()->is("admin/providers*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/products*") ? "active" : "" }} {{ request()->is("admin/product-categories*") ? "active" : "" }} {{ request()->is("admin/brands*") ? "active" : "" }} {{ request()->is("admin/providers*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-boxes">

                            </i>
                            <p>
                                {{ trans('cruds.productManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-boxes">

                                        </i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-categories.index") }}" class="nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('brand_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.brands.index") }}" class="nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-store-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.brand.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('provider_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.providers.index") }}" class="nav-link {{ request()->is("admin/providers") || request()->is("admin/providers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-store-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.provider.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/assets-rentals*") ? "menu-open" : "" }} {{ request()->is("admin/assets*") ? "menu-open" : "" }} {{ request()->is("admin/asset-categories*") ? "menu-open" : "" }} {{ request()->is("admin/asset-locations*") ? "menu-open" : "" }} {{ request()->is("admin/assets-histories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/assets-rentals*") ? "active" : "" }} {{ request()->is("admin/assets*") ? "active" : "" }} {{ request()->is("admin/asset-categories*") ? "active" : "" }} {{ request()->is("admin/asset-locations*") ? "active" : "" }} {{ request()->is("admin/assets-histories*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.assetManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('assets_rental_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets-rentals.index") }}" class="nav-link {{ request()->is("admin/assets-rentals") || request()->is("admin/assets-rentals/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetsRental.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.asset.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-categories.index") }}" class="nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-locations.index") }}" class="nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetLocation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('assets_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets-histories.index") }}" class="nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-th-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('company_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/documentations*") ? "menu-open" : "" }} {{ request()->is("admin/banks*") ? "menu-open" : "" }} {{ request()->is("admin/insurances*") ? "menu-open" : "" }} {{ request()->is("admin/employees*") ? "menu-open" : "" }} {{ request()->is("admin/employee-attendances*") ? "menu-open" : "" }} {{ request()->is("admin/employee-holidays*") ? "menu-open" : "" }} {{ request()->is("admin/employee-skills*") ? "menu-open" : "" }} {{ request()->is("admin/skills-categories*") ? "menu-open" : "" }} {{ request()->is("admin/employee-ratings*") ? "menu-open" : "" }} {{ request()->is("admin/clients-reviews*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/documentations*") ? "active" : "" }} {{ request()->is("admin/banks*") ? "active" : "" }} {{ request()->is("admin/insurances*") ? "active" : "" }} {{ request()->is("admin/employees*") ? "active" : "" }} {{ request()->is("admin/employee-attendances*") ? "active" : "" }} {{ request()->is("admin/employee-holidays*") ? "active" : "" }} {{ request()->is("admin/employee-skills*") ? "active" : "" }} {{ request()->is("admin/skills-categories*") ? "active" : "" }} {{ request()->is("admin/employee-ratings*") ? "active" : "" }} {{ request()->is("admin/clients-reviews*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-building">

                            </i>
                            <p>
                                {{ trans('cruds.company.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('documentation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.documentations.index") }}" class="nav-link {{ request()->is("admin/documentations") || request()->is("admin/documentations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-paperclip">

                                        </i>
                                        <p>
                                            {{ trans('cruds.documentation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('bank_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.banks.index") }}" class="nav-link {{ request()->is("admin/banks") || request()->is("admin/banks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-university">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bank.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('insurance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.insurances.index") }}" class="nav-link {{ request()->is("admin/insurances") || request()->is("admin/insurances/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-heartbeat">

                                        </i>
                                        <p>
                                            {{ trans('cruds.insurance.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employees.index") }}" class="nav-link {{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employee.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_attendance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employee-attendances.index") }}" class="nav-link {{ request()->is("admin/employee-attendances") || request()->is("admin/employee-attendances/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-clock">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employeeAttendance.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_holiday_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employee-holidays.index") }}" class="nav-link {{ request()->is("admin/employee-holidays") || request()->is("admin/employee-holidays/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-umbrella-beach">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employeeHoliday.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_skill_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employee-skills.index") }}" class="nav-link {{ request()->is("admin/employee-skills") || request()->is("admin/employee-skills/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employeeSkill.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('skills_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.skills-categories.index") }}" class="nav-link {{ request()->is("admin/skills-categories") || request()->is("admin/skills-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.skillsCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_rating_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employee-ratings.index") }}" class="nav-link {{ request()->is("admin/employee-ratings") || request()->is("admin/employee-ratings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-edit">

                                        </i>
                                        <p>
                                            {{ trans('cruds.employeeRating.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('clients_review_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.clients-reviews.index") }}" class="nav-link {{ request()->is("admin/clients-reviews") || request()->is("admin/clients-reviews/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.clientsReview.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/social-accounts*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/permissions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/social-accounts*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/permissions*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('social_account_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.social-accounts.index") }}" class="nav-link {{ request()->is("admin/social-accounts") || request()->is("admin/social-accounts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-google-plus-g">

                                        </i>
                                        <p>
                                            {{ trans('cruds.socialAccount.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contact_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/contact-contacts*") ? "menu-open" : "" }} {{ request()->is("admin/contact-companies*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/contact-contacts*") ? "active" : "" }} {{ request()->is("admin/contact-companies*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-phone-square">

                            </i>
                            <p>
                                {{ trans('cruds.contactManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('contact_contact_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-contacts.index") }}" class="nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactContact.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_company_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-companies.index") }}" class="nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactCompany.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/content-pages*") ? "menu-open" : "" }} {{ request()->is("admin/content-categories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/content-pages*") ? "active" : "" }} {{ request()->is("admin/content-categories*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('learning_center_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/technical-documentations*") ? "menu-open" : "" }} {{ request()->is("admin/tech-docs-types*") ? "menu-open" : "" }} {{ request()->is("admin/video-tutorials*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/technical-documentations*") ? "active" : "" }} {{ request()->is("admin/tech-docs-types*") ? "active" : "" }} {{ request()->is("admin/video-tutorials*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-graduation-cap">

                            </i>
                            <p>
                                {{ trans('cruds.learningCenter.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('technical_documentation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.technical-documentations.index") }}" class="nav-link {{ request()->is("admin/technical-documentations") || request()->is("admin/technical-documentations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                                        </i>
                                        <p>
                                            {{ trans('cruds.technicalDocumentation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tech_docs_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tech-docs-types.index") }}" class="nav-link {{ request()->is("admin/tech-docs-types") || request()->is("admin/tech-docs-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.techDocsType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('video_tutorial_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.video-tutorials.index") }}" class="nav-link {{ request()->is("admin/video-tutorials") || request()->is("admin/video-tutorials/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-youtube">

                                        </i>
                                        <p>
                                            {{ trans('cruds.videoTutorial.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }} {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/faq-questions*") ? "active" : "" }} {{ request()->is("admin/faq-categories*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('setup_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/documentation-categories*") ? "menu-open" : "" }} {{ request()->is("admin/wlist-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/booking-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/asset-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/product-tags*") ? "menu-open" : "" }} {{ request()->is("admin/contact-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/expense-categories*") ? "menu-open" : "" }} {{ request()->is("admin/income-categories*") ? "menu-open" : "" }} {{ request()->is("admin/video-categories*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/user-settings*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/documentation-categories*") ? "active" : "" }} {{ request()->is("admin/wlist-statuses*") ? "active" : "" }} {{ request()->is("admin/booking-statuses*") ? "active" : "" }} {{ request()->is("admin/asset-statuses*") ? "active" : "" }} {{ request()->is("admin/product-tags*") ? "active" : "" }} {{ request()->is("admin/contact-tags*") ? "active" : "" }} {{ request()->is("admin/content-tags*") ? "active" : "" }} {{ request()->is("admin/expense-categories*") ? "active" : "" }} {{ request()->is("admin/income-categories*") ? "active" : "" }} {{ request()->is("admin/video-categories*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }} {{ request()->is("admin/user-settings*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.setup.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('documentation_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.documentation-categories.index") }}" class="nav-link {{ request()->is("admin/documentation-categories") || request()->is("admin/documentation-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.documentationCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('wlist_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.wlist-statuses.index") }}" class="nav-link {{ request()->is("admin/wlist-statuses") || request()->is("admin/wlist-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.wlistStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('booking_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.booking-statuses.index") }}" class="nav-link {{ request()->is("admin/booking-statuses") || request()->is("admin/booking-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bookingStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-statuses.index") }}" class="nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-tags.index") }}" class="nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-tags.index") }}" class="nav-link {{ request()->is("admin/contact-tags") || request()->is("admin/contact-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('video_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.video-categories.index") }}" class="nav-link {{ request()->is("admin/video-categories") || request()->is("admin/video-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-video">

                                        </i>
                                        <p>
                                            {{ trans('cruds.videoCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_setting_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-settings.index") }}" class="nav-link {{ request()->is("admin/user-settings") || request()->is("admin/user-settings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userSetting.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>