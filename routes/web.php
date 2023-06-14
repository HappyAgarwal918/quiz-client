<?php

Route::get('/', 'HomeController@index')->name('home');

// User
Route::group(['as' => 'client.', 'middleware' => ['auth']], function () {
    Route::get('change-password', 'ChangePasswordController@create')->name('password.create');
    Route::post('change-password', 'ChangePasswordController@update')->name('password.update');
    Route::get('test', 'TestsController@index')->name('test');
    Route::post('test', 'TestsController@store')->name('test.store');
    Route::get('results/{result_id}', 'ResultsController@show')->name('results.show');
});

Route::get('getdata/{id}', 'TestsController@getdata');


Auth::routes();
// Admin

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth.admin']], function () {
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionsController');

    // Options
    Route::delete('options/destroy', 'OptionsController@massDestroy')->name('options.massDestroy');
    Route::resource('options', 'OptionsController');

    // Results
    Route::delete('results/destroy', 'ResultsController@massDestroy')->name('results.massDestroy');
    Route::resource('results', 'ResultsController');
});
