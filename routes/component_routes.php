<?php

Route::prefix('component')->group(function () {
    Route::get('/','ComponentController@main');
    Route::get('{comp}','ComponentController@components');
    Route::get('{comp}/{modelId}','ComponentController@components');
});
Route::prefix('component_request')->group(function () {
    Route::get('{comp}','ComponentController@componentRequest');
    Route::post('{comp}','ComponentController@componentRequest');
});