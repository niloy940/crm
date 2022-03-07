<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/products-lists*") ? "c-show" : "" }} {{ request()->is("admin/oldest-items*") ? "c-show" : "" }} {{ request()->is("admin/product-balances*") ? "c-show" : "" }} {{ request()->is("admin/bill-materials*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.product.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('products_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products-lists") || request()->is("admin/products-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productsList.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('oldest_item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.oldest-items.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/oldest-items") || request()->is("admin/oldest-items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exclamation-triangle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.oldestItem.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_balance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-balances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-balances") || request()->is("admin/product-balances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-balance-scale c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productBalance.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bill_material_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bill-materials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bill-materials") || request()->is("admin/bill-materials/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.billMaterial.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('warehouse_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/receipt-notes*") ? "c-show" : "" }} {{ request()->is("admin/delivery-notes*") ? "c-show" : "" }} {{ request()->is("admin/warehouse-transfers*") ? "c-show" : "" }} {{ request()->is("admin/packing-lists*") ? "c-show" : "" }} {{ request()->is("admin/warehouses-lists*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-warehouse c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.warehouse.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('receipt_note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.receipt-notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/receipt-notes") || request()->is("admin/receipt-notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.receiptNote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('delivery_note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.delivery-notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/delivery-notes") || request()->is("admin/delivery-notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.deliveryNote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('warehouse_transfer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.warehouse-transfers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/warehouse-transfers") || request()->is("admin/warehouse-transfers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrows-alt-h c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.warehouseTransfer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('packing_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.packing-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/packing-lists") || request()->is("admin/packing-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cube c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.packingList.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('warehouses_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.warehouses-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/warehouses-lists") || request()->is("admin/warehouses-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-warehouse c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.warehousesList.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('processing_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-balance-processings*") ? "c-show" : "" }} {{ request()->is("admin/note-of-recepit-inter-processes*") ? "c-show" : "" }} {{ request()->is("admin/half-products*") ? "c-show" : "" }} {{ request()->is("admin/half-product-makes*") ? "c-show" : "" }} {{ request()->is("admin/production-spents*") ? "c-show" : "" }} {{ request()->is("admin/create-finished-products*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-spinner c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.processing.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_balance_processing_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-balance-processings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-balance-processings") || request()->is("admin/product-balance-processings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-balance-scale c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productBalanceProcessing.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('note_of_recepit_inter_process_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.note-of-recepit-inter-processes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/note-of-recepit-inter-processes") || request()->is("admin/note-of-recepit-inter-processes/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-clipboard c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.noteOfRecepitInterProcess.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('half_product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.half-products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/half-products") || request()->is("admin/half-products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.halfProduct.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('half_product_make_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.half-product-makes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/half-product-makes") || request()->is("admin/half-product-makes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-drum c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.halfProductMake.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('production_spent_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.production-spents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/production-spents") || request()->is("admin/production-spents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-ul c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productionSpent.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('create_finished_product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.create-finished-products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/create-finished-products") || request()->is("admin/create-finished-products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.createFinishedProduct.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('lot_tracking_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/lot-creates*") ? "c-show" : "" }} {{ request()->is("admin/lot-tracks*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-barcode c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.lotTracking.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('lot_create_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lot-creates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lot-creates") || request()->is("admin/lot-creates/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-barcode c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lotCreate.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lot_track_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lot-tracks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lot-tracks") || request()->is("admin/lot-tracks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-barcode c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lotTrack.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('basic_c_r_m_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/crm-customers*") ? "c-show" : "" }} {{ request()->is("admin/crm-statuses*") ? "c-show" : "" }} {{ request()->is("admin/crm-notes*") ? "c-show" : "" }} {{ request()->is("admin/crm-documents*") ? "c-show" : "" }} {{ request()->is("admin/pdf-invoices*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.basicCRM.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('crm_customer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmCustomer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmNote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_document_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmDocument.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pdf_invoice_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pdf-invoices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pdf-invoices") || request()->is("admin/pdf-invoices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pdfInvoice.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/product-prices*") ? "c-show" : "" }} {{ request()->is("admin/production-orders*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/task-statuses*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_price_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-prices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-prices") || request()->is("admin/product-prices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productPrice.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('production_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.production-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/production-orders") || request()->is("admin/production-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productionOrder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('time_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/time-projects*") ? "c-show" : "" }} {{ request()->is("admin/time-work-types*") ? "c-show" : "" }} {{ request()->is("admin/time-entries*") ? "c-show" : "" }} {{ request()->is("admin/time-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-clock c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.timeManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('time_project_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-projects.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-projects") || request()->is("admin/time-projects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeProject.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_work_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-work-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-work-types") || request()->is("admin/time-work-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeWorkType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_entry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-entries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-entries") || request()->is("admin/time-entries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeEntry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-reports") || request()->is("admin/time-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                <li class="c-sidebar-nav-item">
                    <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                        <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                        </i>
                        <span>{{ trans("global.team-members") }}</span>
                    </a>
                </li>
            @endif
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>