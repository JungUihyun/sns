<?php
use src\App\Route;
use src\Controller\MainController;

// index page
Route::GET("/", "MainController@index");
// 404 page
Route::GET("/error", "MainController@error");

# 회원가입 페이지 이동
Route::GET("/register", "MainController@register");
# 회원가입 처리
Route::POST("/register", "UserController@register");
# 로그인 페이지 이동
Route::GET("/login", "MainController@login");
# 로그인 처리
Route::POST("/login", "UserController@login");
# 로그아웃 처리
Route::GET("/logout", "UserController@logout");
# 프로필 페이지 이동
Route::GET("/profile", "MainController@profile");

# 글쓰기 처리
Route::POST("/write", "PostController@write");
# 글삭제 처리
Route::GET("/delete", "PostController@delete");

Route::init();
?>