<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Prfixed With Local Language Prefix
|--------------------------------------------------------------------------
|
| Application url is wrapped with a language prefix for multiple languages]
| languages support and fallback with a local laguage prefix. These
| prefixes are defined in the app.config, and the proccess of
| applying the prefix is done in RouteSerivceProvider.
|
*/

// Note: another prefix should be added for supporting countries and full html lang attribute
// e.g. <html lang="en-LB">
// Groupting Requests by their Authority

Route::group(['middleware' => ['ajax_check_session', 'auth'] ], function () {

    // Grouping Requests by their destination 
    Route::prefix('cpanel')->group(function () {

        Route::get('/','ControlPanelController@main');
        
        // Cpanel Main View
        Route::prefix('platform')->group(function () {
            Route::prefix('board')->group(function () {
                Route::post('store', 'platformController@boardStore');
                Route::post('delete/{platform_id}', 'platformController@boardDelete');
                Route::post('update/{platform_id}', 'platformController@boardUpdate');
            });
            Route::prefix('screen')->group(function () {
                Route::post('store', 'platformController@screenStore');
                Route::post('delete/{platform_id}', 'platformController@screenDelete');
                Route::post('update/{platform_id}', 'platformController@screenUpdate');
            });
            
            Route::get('typehiting', 'VendorsController@nameTypeHinting');
            Route::get('list_partial_view', 'VendorsController@listPartialView');
            Route::get('view_edit_form/{vendor_id}', 'VendorsController@getVendorViewEditForm');
            Route::post('update/{vendor_id}', 'VendorsController@update');
            Route::post('delete/{vendor_id}', 'VendorsController@delete');
        });


    });
    
    // Route::post('type', 'UserController@AccountStatus');
});

Route::prefix('component')->group(function () {
    Route::get('/','ComponentController@main');
    // Getting Cpanel Components
    Route::get('{comp}','ComponentController@components');
    Route::get('{comp}/{modelId}','ComponentController@components');
});

Route::get('/', 'PublicPlatformController@main');

Auth::routes();

