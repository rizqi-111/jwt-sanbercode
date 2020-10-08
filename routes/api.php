<?php

Route::middleware(['role'])->group(function(){
    Route::Post('registerstudent','StudentController@register');
    Route::Post('addbook','BookController@store');
    Route::POST('login','StudentController@login');
    Route::POST('logout','StudentController@logout');
    Route::GET('index','StudentController@index');
    Route::POST('pinjam','StudentController@loan');
    Route::POST('registeradmin','AdminController@register');
    Route::POST('loginadmin','AdminController@login');
    Route::POST('logoutadmin','AdminController@logout');
    Route::GET('indexadmin','AdminController@index');
    Route::POST('kembali','AdminController@return');
});

Route::GET('read','BookController@getAll');
Route::GET('show/{id}','BookController@show');
Route::POST('addbook','BookController@store');
Route::PUT('update/{id}','BookController@update');
Route::DELETE('destroy/{id}','BookController@destroy');