<?php
// Authentication routes....
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@index']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Password reset link request routes...
Route::get('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@postEmail']);

// Registration routes...
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);

// Password reset routes...
Route::get('password/reset/{token}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@postReset']);

Route::get('auth', function () {
    return redirect('auth/login');
});

Route::get('login', function () {
    return redirect('auth/login');
});