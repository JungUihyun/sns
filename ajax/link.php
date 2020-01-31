<?php
use src\App\Route;

// index page
Route::GET("/", "MainController@index");

Route::GET("/ajax", "AjaxController@index");
Route::GET("/ajax/load", "AjaxController@load");

Route::init();
?>