<?php

Route::post('register', 'Api/AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Cliente
    Route::apiResource('clientes', 'ClienteApiController');

    // Pantalla
    Route::post('pantallas/media', 'PantallaApiController@storeMedia')->name('pantallas.storeMedia');
    Route::apiResource('pantallas', 'PantallaApiController');

    // Galeriainterior
    Route::post('galeriainteriors/media', 'GaleriainteriorApiController@storeMedia')->name('galeriainteriors.storeMedia');
    Route::apiResource('galeriainteriors', 'GaleriainteriorApiController');

    // Espacioscomunes
    Route::post('espacioscomunes/media', 'EspacioscomunesApiController@storeMedia')->name('espacioscomunes.storeMedia');
    Route::apiResource('espacioscomunes', 'EspacioscomunesApiController');
});
