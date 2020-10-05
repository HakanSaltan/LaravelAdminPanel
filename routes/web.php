<?php

Auth::routes();

Route::get('/', array('as'=>'index','uses'=>'HomeController@index'));
Route::get('/home', array('as'=>'index','uses'=>'HomeController@index'));
Route::get('/lastSession','NoAuthController@lastSession');
Route::get('/kontrolLogout','NoAuthController@kontrolLogout');
Route::POST('/kontrolLogin','NoAuthController@kontrolLogin');


Route::group(['prefix' => 'admin', 'middleware' => 'role:super-admin'], function(){
    Route::get('/home', 'AdminGetController@index')->name('adminHome');
    Route::get('/kullanicilar', 'AdminGetController@kullanicilar');
    Route::post('/kullanicilar', 'AdminPostController@kullanicilar');
    Route::get('/profile','AdminGetController@profile');
    Route::post('/profile','AdminPostController@kullanicilar');
});

Route::group(['prefix' => 'kullanici', 'middleware' => ['role:super-admin|uye']], function () {
    Route::get('/home', 'UyeGetController@index')->name('uyeHome');
});

Route::group(['prefix' => 'reload'], function(){
    Route::get('/admin/kullanicilar', 'AdminReloadController@kullanicilar');
});

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
