<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Site Point
    Route::apiResource('site-points', 'SitePointApiController');

    // Asset Condition
    Route::apiResource('asset-conditions', 'AssetConditionApiController');

    // Segment Connected
    Route::apiResource('segment-connecteds', 'SegmentConnectedApiController');

    // Core Config
    Route::apiResource('core-configs', 'CoreConfigApiController');

    // Core Connection
    Route::apiResource('core-connections', 'CoreConnectionApiController');
});
