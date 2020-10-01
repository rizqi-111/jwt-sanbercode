<?php

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