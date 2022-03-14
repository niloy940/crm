<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::post('crm-statuses/parse-csv-import', 'CrmStatusController@parseCsvImport')->name('crm-statuses.parseCsvImport');
    Route::post('crm-statuses/process-csv-import', 'CrmStatusController@processCsvImport')->name('crm-statuses.processCsvImport');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::post('crm-customers/parse-csv-import', 'CrmCustomerController@parseCsvImport')->name('crm-customers.parseCsvImport');
    Route::post('crm-customers/process-csv-import', 'CrmCustomerController@processCsvImport')->name('crm-customers.processCsvImport');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::post('crm-notes/parse-csv-import', 'CrmNoteController@parseCsvImport')->name('crm-notes.parseCsvImport');
    Route::post('crm-notes/process-csv-import', 'CrmNoteController@processCsvImport')->name('crm-notes.processCsvImport');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::post('crm-documents/parse-csv-import', 'CrmDocumentController@parseCsvImport')->name('crm-documents.parseCsvImport');
    Route::post('crm-documents/process-csv-import', 'CrmDocumentController@processCsvImport')->name('crm-documents.processCsvImport');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/parse-csv-import', 'TeamController@parseCsvImport')->name('teams.parseCsvImport');
    Route::post('teams/process-csv-import', 'TeamController@processCsvImport')->name('teams.processCsvImport');
    Route::resource('teams', 'TeamController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::post('asset-categories/parse-csv-import', 'AssetCategoryController@parseCsvImport')->name('asset-categories.parseCsvImport');
    Route::post('asset-categories/process-csv-import', 'AssetCategoryController@processCsvImport')->name('asset-categories.processCsvImport');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::post('asset-statuses/parse-csv-import', 'AssetStatusController@parseCsvImport')->name('asset-statuses.parseCsvImport');
    Route::post('asset-statuses/process-csv-import', 'AssetStatusController@processCsvImport')->name('asset-statuses.processCsvImport');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::post('assets-histories/parse-csv-import', 'AssetsHistoryController@parseCsvImport')->name('assets-histories.parseCsvImport');
    Route::post('assets-histories/process-csv-import', 'AssetsHistoryController@processCsvImport')->name('assets-histories.processCsvImport');
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Time Work Type
    Route::delete('time-work-types/destroy', 'TimeWorkTypeController@massDestroy')->name('time-work-types.massDestroy');
    Route::post('time-work-types/parse-csv-import', 'TimeWorkTypeController@parseCsvImport')->name('time-work-types.parseCsvImport');
    Route::post('time-work-types/process-csv-import', 'TimeWorkTypeController@processCsvImport')->name('time-work-types.processCsvImport');
    Route::resource('time-work-types', 'TimeWorkTypeController');

    // Time Project
    Route::delete('time-projects/destroy', 'TimeProjectController@massDestroy')->name('time-projects.massDestroy');
    Route::post('time-projects/parse-csv-import', 'TimeProjectController@parseCsvImport')->name('time-projects.parseCsvImport');
    Route::post('time-projects/process-csv-import', 'TimeProjectController@processCsvImport')->name('time-projects.processCsvImport');
    Route::resource('time-projects', 'TimeProjectController');

    // Time Entry
    Route::delete('time-entries/destroy', 'TimeEntryController@massDestroy')->name('time-entries.massDestroy');
    Route::post('time-entries/parse-csv-import', 'TimeEntryController@parseCsvImport')->name('time-entries.parseCsvImport');
    Route::post('time-entries/process-csv-import', 'TimeEntryController@processCsvImport')->name('time-entries.processCsvImport');
    Route::resource('time-entries', 'TimeEntryController');

    // Time Report
    Route::delete('time-reports/destroy', 'TimeReportController@massDestroy')->name('time-reports.massDestroy');
    Route::resource('time-reports', 'TimeReportController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Products List
    Route::delete('products-lists/destroy', 'ProductsListController@massDestroy')->name('products-lists.massDestroy');
    Route::post('products-lists/parse-csv-import', 'ProductsListController@parseCsvImport')->name('products-lists.parseCsvImport');
    Route::post('products-lists/process-csv-import', 'ProductsListController@processCsvImport')->name('products-lists.processCsvImport');
    Route::resource('products-lists', 'ProductsListController');

    // Warehouses List
    Route::delete('warehouses-lists/destroy', 'WarehousesListController@massDestroy')->name('warehouses-lists.massDestroy');
    Route::post('warehouses-lists/parse-csv-import', 'WarehousesListController@parseCsvImport')->name('warehouses-lists.parseCsvImport');
    Route::post('warehouses-lists/process-csv-import', 'WarehousesListController@processCsvImport')->name('warehouses-lists.processCsvImport');
    Route::resource('warehouses-lists', 'WarehousesListController');

    // Receipt Note
    Route::delete('receipt-notes/destroy', 'ReceiptNoteController@massDestroy')->name('receipt-notes.massDestroy');
    Route::resource('receipt-notes', 'ReceiptNoteController');

    // Delivery Note
    Route::delete('delivery-notes/destroy', 'DeliveryNoteController@massDestroy')->name('delivery-notes.massDestroy');
    Route::post('delivery-notes/media', 'DeliveryNoteController@storeMedia')->name('delivery-notes.storeMedia');
    Route::post('delivery-notes/ckmedia', 'DeliveryNoteController@storeCKEditorImages')->name('delivery-notes.storeCKEditorImages');
    Route::post('delivery-notes/parse-csv-import', 'DeliveryNoteController@parseCsvImport')->name('delivery-notes.parseCsvImport');
    Route::post('delivery-notes/process-csv-import', 'DeliveryNoteController@processCsvImport')->name('delivery-notes.processCsvImport');
    Route::resource('delivery-notes', 'DeliveryNoteController');

    // Warehouse Transfer
    Route::delete('warehouse-transfers/destroy', 'WarehouseTransferController@massDestroy')->name('warehouse-transfers.massDestroy');
    Route::resource('warehouse-transfers', 'WarehouseTransferController');

    // Packing List
    Route::delete('packing-lists/destroy', 'PackingListController@massDestroy')->name('packing-lists.massDestroy');
    Route::resource('packing-lists', 'PackingListController');

    // Pdf Invoice
    Route::delete('pdf-invoices/destroy', 'PdfInvoiceController@massDestroy')->name('pdf-invoices.massDestroy');
    Route::resource('pdf-invoices', 'PdfInvoiceController');

    // Note Of Recepit Inter Process
    Route::delete('note-of-recepit-inter-processes/destroy', 'NoteOfRecepitInterProcessController@massDestroy')->name('note-of-recepit-inter-processes.massDestroy');
    Route::resource('note-of-recepit-inter-processes', 'NoteOfRecepitInterProcessController');

    // Half Product
    Route::delete('half-products/destroy', 'HalfProductController@massDestroy')->name('half-products.massDestroy');
    Route::resource('half-products', 'HalfProductController');

    // Oldest Items
    Route::delete('oldest-items/destroy', 'OldestItemsController@massDestroy')->name('oldest-items.massDestroy');
    Route::resource('oldest-items', 'OldestItemsController');

    // Product Balance
    Route::delete('product-balances/destroy', 'ProductBalanceController@massDestroy')->name('product-balances.massDestroy');
    Route::resource('product-balances', 'ProductBalanceController');

    // Bill Materials
    Route::delete('bill-materials/destroy', 'BillMaterialsController@massDestroy')->name('bill-materials.massDestroy');
    Route::resource('bill-materials', 'BillMaterialsController');

    // Half Product Make
    Route::delete('half-product-makes/destroy', 'HalfProductMakeController@massDestroy')->name('half-product-makes.massDestroy');
    Route::resource('half-product-makes', 'HalfProductMakeController');

    // Lot Create
    Route::delete('lot-creates/destroy', 'LotCreateController@massDestroy')->name('lot-creates.massDestroy');
    Route::post('lot-creates/parse-csv-import', 'LotCreateController@parseCsvImport')->name('lot-creates.parseCsvImport');
    Route::post('lot-creates/process-csv-import', 'LotCreateController@processCsvImport')->name('lot-creates.processCsvImport');
    Route::resource('lot-creates', 'LotCreateController');

    // Lot Track
    Route::delete('lot-tracks/destroy', 'LotTrackController@massDestroy')->name('lot-tracks.massDestroy');
    Route::resource('lot-tracks', 'LotTrackController');

    // Production Order
    Route::delete('production-orders/destroy', 'ProductionOrderController@massDestroy')->name('production-orders.massDestroy');
    Route::resource('production-orders', 'ProductionOrderController');

    // Create Finished Product
    Route::delete('create-finished-products/destroy', 'CreateFinishedProductController@massDestroy')->name('create-finished-products.massDestroy');
    Route::resource('create-finished-products', 'CreateFinishedProductController');

    // Production Spent
    Route::delete('production-spents/destroy', 'ProductionSpentController@massDestroy')->name('production-spents.massDestroy');
    Route::resource('production-spents', 'ProductionSpentController');

    // Product Balance Processing
    Route::delete('product-balance-processings/destroy', 'ProductBalanceProcessingController@massDestroy')->name('product-balance-processings.massDestroy');
    Route::resource('product-balance-processings', 'ProductBalanceProcessingController');

    // Product Price
    Route::delete('product-prices/destroy', 'ProductPriceController@massDestroy')->name('product-prices.massDestroy');
    Route::resource('product-prices', 'ProductPriceController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
