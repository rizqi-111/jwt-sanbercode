<?php

Route::Post('registerstudent','StudentController@register');
Route::Post('addbook','BookController@store');
Route::POST('login','StudentController@login');
Route::POST('logout','StudentController@logout');
Route::GET('index','StudentController@index');