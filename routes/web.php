<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::group(['middleware' => ['auth', 'rules']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/permission/auth-permission/', 'AuthPermissionController@index');
    Route::post('/permission/auth-permission/store', 'AuthPermissionController@store');
    Route::get('/permissions/hapus_permissions/{id}', 'AuthPermissionController@destroy');
    Route::get('/permission/auth-group/', 'AuthGroupController@index');
    Route::post('/permission/auth-group/store', 'AuthGroupController@store');
    Route::post('/permission/auth-group/get-permissions', 'AuthGroupController@get_permissions');
    Route::post('/permission/auth-group/change-permissions', 'AuthGroupController@change_permissions'); 

      //super admin  //
    Route::prefix('super_admin/')->group(function() {
        Route::get('master_user', 'SuperAdminController@master_user');
        Route::get('master_dept', 'SuperAdminController@master_dept');
        Route::post('add_user', 'SuperAdminController@store');
        Route::post('add_dept', 'SuperAdminController@add_dept');
        Route::get('edit_user/{id}', 'SuperAdminController@edit');
        Route::patch('update_user/{id}', 'SuperAdminController@update_user');
        Route::get('hapus_user/{id}', 'SuperAdminController@destroy');
        Route::get('master_gangguan', 'SuperAdminController@master_gangguan');
        Route::get('hapus_gangguan/{kode_gangguan}', 'SuperAdminController@hapus_gangguan');
        Route::post('add_gangguan', 'SuperAdminController@add_gangguan');
    });

      //HELPDESK  //
    Route::prefix('helpdesk/')->group(function() {
        Route::get('create_tiket  ', 'HelpdeskController@index');
        Route::post('create_tiket  ', 'HelpdeskController@store');
        Route::get('master_helpdesk  ', 'HelpdeskController@master_helpdesk');
        Route::get('detail_tiket/{no_gangguan}  ', 'HelpdeskController@detail_tiket');
        Route::PATCH('update_tiket', 'HelpdeskController@update_tiket');
        Route::get('hapus_tiket/{no_gangguan}', 'HelpdeskController@hapus_tiket');
    });

      //TEKNISI  //
    Route::prefix('teknisi/')->group(function() {
        Route::get('/', 'TeknisiController@index');
        Route::get('cari_gangguan/{no_gangguan}', 'TeknisiController@cari_gangguan');
        Route::get('ubah_status/{no_gangguan}', 'TeknisiController@ubah_status');
        Route::patch('post_gangguan', 'TeknisiController@post_gangguan');
        Route::patch('close_gangguan', 'TeknisiController@close_gangguan');
        Route::get('cari_penanganan/{kode_gangguan}', 'TeknisiController@cari_penanganan');
        Route::get('list_wo', 'TeknisiController@list_wo');
        Route::get('detail_tiket/{no_gangguan}  ', 'TeknisiController@detail_tiket');
    });

});

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@authenticate');
  });
  Route::get('dashboard', 'DashboardController@index');
  Route::get('cari_report/{tgl_mulai}/{tgl_selesai}', 'DashboardController@cari_report');
  Route::get('dashboard/detail/{no_gangguan}', 'DashboardController@detail');
  Route::get('download_excel/{tgl_mulai}/{tgl_selesai}', 'DashboardController@download_excel');
  