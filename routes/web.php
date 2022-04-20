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

    // Cliente
    Route::delete('clientes/destroy', 'ClienteController@massDestroy')->name('clientes.massDestroy');
    Route::resource('clientes', 'ClienteController');

    // Pantalla
    Route::delete('pantallas/destroy', 'PantallaController@massDestroy')->name('pantallas.massDestroy');
    Route::post('pantallas/media', 'PantallaController@storeMedia')->name('pantallas.storeMedia');
    Route::post('pantallas/ckmedia', 'PantallaController@storeCKEditorImages')->name('pantallas.storeCKEditorImages');
    Route::resource('pantallas', 'PantallaController');

    // Galeriainterior
    Route::delete('galeriainteriors/destroy', 'GaleriainteriorController@massDestroy')->name('galeriainteriors.massDestroy');
    Route::post('galeriainteriors/media', 'GaleriainteriorController@storeMedia')->name('galeriainteriors.storeMedia');
    Route::post('galeriainteriors/ckmedia', 'GaleriainteriorController@storeCKEditorImages')->name('galeriainteriors.storeCKEditorImages');
    Route::resource('galeriainteriors', 'GaleriainteriorController');

    // Espacioscomunes
    Route::delete('espacioscomunes/destroy', 'EspacioscomunesController@massDestroy')->name('espacioscomunes.massDestroy');
    Route::post('espacioscomunes/media', 'EspacioscomunesController@storeMedia')->name('espacioscomunes.storeMedia');
    Route::post('espacioscomunes/ckmedia', 'EspacioscomunesController@storeCKEditorImages')->name('espacioscomunes.storeCKEditorImages');
    Route::resource('espacioscomunes', 'EspacioscomunesController');
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
