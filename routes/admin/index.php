<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'guest:admin',
    'excluded_middleware' => 'auth:admin',
], function () {
    Route::get('/admin/login', 'AuthController@create')->name('auth.login');
    Route::post('/admin/login', 'AuthController@store');
});
Route::post('/admin/logout', 'AuthController@destroy')->name('auth.logout');

Route::get('/admin/dashboard', 'StaticPageController@dashboard')->name('admin.dashboard');

Route::group(['prefix' => 'admin/invoice', 'as' => 'admin.invoice.', 'namespace' => '\App\Invoices'], function () {
    Route::get('/', 'InvoiceController@index')->name('index');

    //Incomings
    Route::group(['prefix' => '/incoming', 'as' => 'incoming.', 'namespace' => '\App\Invoices\Incoming'], function () {
        Route::get('/create', 'IncomingInvoiceController@create')->name('create');
        Route::post('/create', 'IncomingInvoiceController@create');
        Route::get('/{invoice}', 'IncomingInvoiceController@show')->name('show');
        Route::get('/{invoice}/edit', 'IncomingInvoiceController@edit')->name('edit');
        Route::post('/{invoice}/update', 'IncomingInvoiceController@update')->name('update');
        Route::delete('/{invoice}/delete', 'IncomingInvoiceController@delete')->name('delete');
    });
});

Route::group(['as' => 'admin.customer.', 'namespace' => '\App\Customers'], function () {
    Route::get('/admin/customer', 'CustomerController@index')->name('index');
    Route::get('/admin/customer/create', 'CustomerController@create')->name('create');
    Route::post('/admin/customer/create', 'CustomerController@store');
    Route::get('/admin/customer/{customer}/avatar', 'CustomerController@avatar')->name('avatar');
    Route::get('/admin/customer/{customer}', 'CustomerController@show')->name('show');
    Route::get('/admin/customer/{customer}/edit', 'CustomerController@edit')->name('edit');
    Route::post('/admin/customer/{customer}/update', 'CustomerController@update')->name('update');
    Route::post('/admin/customer/{customer}/delete', 'CustomerController@delete')->name('delete');
});

Route::group(['as' => 'admin.user.', 'namespace' => '\App\Users'], function () {
    Route::get('/admin/user', 'UserController@index')->name('index');
    Route::get('/admin/user/create', 'UserController@create')->name('create');
    Route::post('/admin/user/create', 'UserController@store');
    Route::get('/admin/user/{user}', 'UserController@show')->name('show');
    Route::get('/admin/user/{user}/edit', 'UserController@edit')->name('edit');
    Route::post('/admin/user/{user}/update', 'UserController@update')->name('update');
    Route::delete('/admin/user/{user}', 'UserController@delete')->name('delete');
    Route::get('/admin/user/{user}/avatar', 'UserController@avatar')->name('avatar');
});

Route::group(['as' => 'admin.project.', 'namespace' => '\App\Projects'], function () {

    Route::group(['as' => 'comment.', 'prefix' => '/admin/project'], function () {
       Route::post('/comment/{comment}', 'ProjectController@createComment')->name('create');
       Route::post('/comment/{comment}/delete', 'ProjectController@deleteComment')->name('delete');
    });

    Route::get('/admin/project', 'ProjectController@index')->name('index');
    Route::get('/admin/project/create', 'ProjectController@create')->name('create');
    Route::post('/admin/project/create', 'ProjectController@store')->name('store');
    Route::get('/admin/project/{project}', 'ProjectController@show')->name('show');
    Route::get('/admin/project/{project}/image', 'ProjectController@image')->name('image');
    Route::get('/admin/project/{project}/og-image', 'ProjectController@ogImage')->name('og_image');
    Route::get('/admin/project/{project}/edit', 'ProjectController@edit')->name('edit');
    Route::post('/admin/project/{project}/update', 'ProjectController@update')->name('update');
    Route::post('/admin/project/{project}', 'ProjectController@delete')->name('delete');
});

Route::group(['as' => 'admin.task.', 'namespace' => '\App\Tasks'], function () {
    Route::post('/admin/tasks/{task}/update-order', 'TaskController@updateOrder')->name('update-order');
    Route::post('/admin/task/{task}/update', 'TaskController@update')->name('update');
    Route::post('/admin/task/{task}/delete', 'TaskController@delete')->name('delete');
    Route::post('/admin/task/create', 'TaskController@create')->name('create');
    Route::get('/admin/task/{task}', 'TaskController@show')->name('show');
    Route::get('/admin/task', 'TaskController@index')->name('index');
});

Route::group(['as' => 'admin.company.', 'namespace' => '\App\Companies'], function () {
    Route::get('/admin/company', 'CompanyController@index')->name('index');
    Route::get('/admin/company/create', 'CompanyController@create')->name('create');
    Route::post('/admin/company/create', 'CompanyController@store');
    Route::get('/admin/company/{company}', 'CompanyController@show')->name('show');
    Route::get('/admin/company/{company}/edit', 'CompanyController@edit')->name('edit');
    Route::post('/admin/company/{company}/update', 'CompanyController@update')->name('update');
    Route::delete('/admin/company/{company}', 'CompanyController@delete')->name('delete');
    Route::get('/admin/company/{company}/avatar', 'CompanyController@avatar')->name('avatar');
});

Route::post('/admin/ckeditor/upload', 'CKEditorController@upload')->name('admin.ckeditor.upload');
Route::get('/admin/ckeditor/{filename}/download', 'CKEditorController@download')->name('admin.ckeditor.download');
