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
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
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

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Site Point
    Route::delete('site-points/destroy', 'SitePointController@massDestroy')->name('site-points.massDestroy');
    Route::post('site-points/parse-csv-import', 'SitePointController@parseCsvImport')->name('site-points.parseCsvImport');
    Route::post('site-points/process-csv-import', 'SitePointController@processCsvImport')->name('site-points.processCsvImport');
    Route::resource('site-points', 'SitePointController');

    // Asset Condition
    Route::delete('asset-conditions/destroy', 'AssetConditionController@massDestroy')->name('asset-conditions.massDestroy');
    Route::post('asset-conditions/parse-csv-import', 'AssetConditionController@parseCsvImport')->name('asset-conditions.parseCsvImport');
    Route::post('asset-conditions/process-csv-import', 'AssetConditionController@processCsvImport')->name('asset-conditions.processCsvImport');
    Route::resource('asset-conditions', 'AssetConditionController');

    // Segment Connected
    Route::delete('segment-connecteds/destroy', 'SegmentConnectedController@massDestroy')->name('segment-connecteds.massDestroy');
    Route::post('segment-connecteds/parse-csv-import', 'SegmentConnectedController@parseCsvImport')->name('segment-connecteds.parseCsvImport');
    Route::post('segment-connecteds/process-csv-import', 'SegmentConnectedController@processCsvImport')->name('segment-connecteds.processCsvImport');
    Route::resource('segment-connecteds', 'SegmentConnectedController');

    // Core Config
    Route::delete('core-configs/destroy', 'CoreConfigController@massDestroy')->name('core-configs.massDestroy');
    Route::post('core-configs/parse-csv-import', 'CoreConfigController@parseCsvImport')->name('core-configs.parseCsvImport');
    Route::post('core-configs/process-csv-import', 'CoreConfigController@processCsvImport')->name('core-configs.processCsvImport');
    Route::resource('core-configs', 'CoreConfigController');

    // Core Connection
    Route::delete('core-connections/destroy', 'CoreConnectionController@massDestroy')->name('core-connections.massDestroy');
    Route::post('core-connections/parse-csv-import', 'CoreConnectionController@parseCsvImport')->name('core-connections.parseCsvImport');
    Route::post('core-connections/process-csv-import', 'CoreConnectionController@processCsvImport')->name('core-connections.processCsvImport');
    Route::resource('core-connections', 'CoreConnectionController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
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
