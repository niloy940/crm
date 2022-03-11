<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
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
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
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
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

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
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.team.title') }}
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
                        </ul>
                    </li>
                @endcan
                @can('product_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/products-lists*") ? "menu-open" : "" }} {{ request()->is("admin/oldest-items*") ? "menu-open" : "" }} {{ request()->is("admin/product-balances*") ? "menu-open" : "" }} {{ request()->is("admin/bill-materials*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.product.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('products_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products-lists.index") }}" class="nav-link {{ request()->is("admin/products-lists") || request()->is("admin/products-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productsList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('oldest_item_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.oldest-items.index") }}" class="nav-link {{ request()->is("admin/oldest-items") || request()->is("admin/oldest-items/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-exclamation-triangle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.oldestItem.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_balance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-balances.index") }}" class="nav-link {{ request()->is("admin/product-balances") || request()->is("admin/product-balances/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-balance-scale">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productBalance.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('bill_material_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bill-materials.index") }}" class="nav-link {{ request()->is("admin/bill-materials") || request()->is("admin/bill-materials/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.billMaterial.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('warehouse_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/receipt-notes*") ? "menu-open" : "" }} {{ request()->is("admin/delivery-notes*") ? "menu-open" : "" }} {{ request()->is("admin/warehouse-transfers*") ? "menu-open" : "" }} {{ request()->is("admin/packing-lists*") ? "menu-open" : "" }} {{ request()->is("admin/warehouses-lists*") ? "menu-open" : "" }} {{ request()->is("admin/warehouse-sectors*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-warehouse">

                            </i>
                            <p>
                                {{ trans('cruds.warehouse.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('receipt_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.receipt-notes.index") }}" class="nav-link {{ request()->is("admin/receipt-notes") || request()->is("admin/receipt-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-left">

                                        </i>
                                        <p>
                                            {{ trans('cruds.receiptNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('delivery_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.delivery-notes.index") }}" class="nav-link {{ request()->is("admin/delivery-notes") || request()->is("admin/delivery-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.deliveryNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('warehouse_transfer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.warehouse-transfers.index") }}" class="nav-link {{ request()->is("admin/warehouse-transfers") || request()->is("admin/warehouse-transfers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrows-alt-h">

                                        </i>
                                        <p>
                                            {{ trans('cruds.warehouseTransfer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('packing_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.packing-lists.index") }}" class="nav-link {{ request()->is("admin/packing-lists") || request()->is("admin/packing-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cube">

                                        </i>
                                        <p>
                                            {{ trans('cruds.packingList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('warehouses_list_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.warehouses-lists.index") }}" class="nav-link {{ request()->is("admin/warehouses-lists") || request()->is("admin/warehouses-lists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-warehouse">

                                        </i>
                                        <p>
                                            {{ trans('cruds.warehousesList.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('warehouse_sector_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.warehouse-sectors.index") }}" class="nav-link {{ request()->is("admin/warehouse-sectors") || request()->is("admin/warehouse-sectors/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-puzzle-piece">

                                        </i>
                                        <p>
                                            {{ trans('cruds.warehouseSector.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('processing_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/product-balance-processings*") ? "menu-open" : "" }} {{ request()->is("admin/note-of-recepit-inter-processes*") ? "menu-open" : "" }} {{ request()->is("admin/half-products*") ? "menu-open" : "" }} {{ request()->is("admin/half-product-makes*") ? "menu-open" : "" }} {{ request()->is("admin/production-spents*") ? "menu-open" : "" }} {{ request()->is("admin/create-finished-products*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-spinner">

                            </i>
                            <p>
                                {{ trans('cruds.processing.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('product_balance_processing_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-balance-processings.index") }}" class="nav-link {{ request()->is("admin/product-balance-processings") || request()->is("admin/product-balance-processings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-balance-scale">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productBalanceProcessing.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('note_of_recepit_inter_process_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.note-of-recepit-inter-processes.index") }}" class="nav-link {{ request()->is("admin/note-of-recepit-inter-processes") || request()->is("admin/note-of-recepit-inter-processes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-clipboard">

                                        </i>
                                        <p>
                                            {{ trans('cruds.noteOfRecepitInterProcess.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('half_product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.half-products.index") }}" class="nav-link {{ request()->is("admin/half-products") || request()->is("admin/half-products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-box-open">

                                        </i>
                                        <p>
                                            {{ trans('cruds.halfProduct.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('half_product_make_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.half-product-makes.index") }}" class="nav-link {{ request()->is("admin/half-product-makes") || request()->is("admin/half-product-makes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-drum">

                                        </i>
                                        <p>
                                            {{ trans('cruds.halfProductMake.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('production_spent_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.production-spents.index") }}" class="nav-link {{ request()->is("admin/production-spents") || request()->is("admin/production-spents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-ul">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productionSpent.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('create_finished_product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.create-finished-products.index") }}" class="nav-link {{ request()->is("admin/create-finished-products") || request()->is("admin/create-finished-products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.createFinishedProduct.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('lot_tracking_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/lot-creates*") ? "menu-open" : "" }} {{ request()->is("admin/lot-tracks*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-barcode">

                            </i>
                            <p>
                                {{ trans('cruds.lotTracking.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('lot_create_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lot-creates.index") }}" class="nav-link {{ request()->is("admin/lot-creates") || request()->is("admin/lot-creates/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-barcode">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lotCreate.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('lot_track_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lot-tracks.index") }}" class="nav-link {{ request()->is("admin/lot-tracks") || request()->is("admin/lot-tracks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-barcode">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lotTrack.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('basic_c_r_m_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/crm-customers*") ? "menu-open" : "" }} {{ request()->is("admin/crm-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/crm-notes*") ? "menu-open" : "" }} {{ request()->is("admin/crm-documents*") ? "menu-open" : "" }} {{ request()->is("admin/pdf-invoices*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.basicCRM.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('crm_customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-customers.index") }}" class="nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmCustomer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-statuses.index") }}" class="nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-notes.index") }}" class="nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sticky-note">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-documents.index") }}" class="nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('pdf_invoice_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pdf-invoices.index") }}" class="nav-link {{ request()->is("admin/pdf-invoices") || request()->is("admin/pdf-invoices/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pdfInvoice.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/product-prices*") ? "menu-open" : "" }} {{ request()->is("admin/production-orders*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }} {{ request()->is("admin/user-alerts*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }} {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-tasks">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_price_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.product-prices.index") }}" class="nav-link {{ request()->is("admin/product-prices") || request()->is("admin/product-prices/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productPrice.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('production_order_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.production-orders.index") }}" class="nav-link {{ request()->is("admin/production-orders") || request()->is("admin/production-orders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productionOrder.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bell">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userAlert.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/asset-locations*") ? "menu-open" : "" }} {{ request()->is("admin/asset-categories*") ? "menu-open" : "" }} {{ request()->is("admin/asset-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/assets*") ? "menu-open" : "" }} {{ request()->is("admin/assets-histories*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.assetManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
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
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-categories.index") }}" class="nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetCategory.title') }}
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
                @can('expense_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/incomes*") ? "menu-open" : "" }} {{ request()->is("admin/expenses*") ? "menu-open" : "" }} {{ request()->is("admin/income-categories*") ? "menu-open" : "" }} {{ request()->is("admin/expense-categories*") ? "menu-open" : "" }} {{ request()->is("admin/expense-reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill">

                            </i>
                            <p>
                                {{ trans('cruds.expenseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.income.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
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
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseCategory.title') }}
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
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
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
                        </ul>
                    </li>
                @endcan
                @can('time_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/time-projects*") ? "menu-open" : "" }} {{ request()->is("admin/time-work-types*") ? "menu-open" : "" }} {{ request()->is("admin/time-entries*") ? "menu-open" : "" }} {{ request()->is("admin/time-reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-clock">

                            </i>
                            <p>
                                {{ trans('cruds.timeManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('time_project_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.time-projects.index") }}" class="nav-link {{ request()->is("admin/time-projects") || request()->is("admin/time-projects/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.timeProject.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('time_work_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.time-work-types.index") }}" class="nav-link {{ request()->is("admin/time-work-types") || request()->is("admin/time-work-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-th">

                                        </i>
                                        <p>
                                            {{ trans('cruds.timeWorkType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('time_entry_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.time-entries.index") }}" class="nav-link {{ request()->is("admin/time-entries") || request()->is("admin/time-entries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.timeEntry.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('time_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.time-reports.index") }}" class="nav-link {{ request()->is("admin/time-reports") || request()->is("admin/time-reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.timeReport.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                        <li class="nav-item">
                            <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                                <i class="fa-fw fa fa-users nav-icon">
                                </i>
                                <p>
                                    {{ trans("global.team-members") }}
                                </p>
                            </a>
                        </li>
                    @endif
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
