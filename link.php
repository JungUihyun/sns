<?php
use src\App\Route;
use src\Controller\MainController;

// index page
Route::GET("/", "MainController@index");
# 회원가입 페이지 이동
Route::GET("/register", "MainController@register");
# 회원가입 처리
Route::POST("/register", "UserController@registerProcess");
# 로그인 페이지 이동
Route::GET("/login", "MainController@login");
# 로그인 처리
Route::POST("/login", "UserController@loginProcess");

Route::init();
?>