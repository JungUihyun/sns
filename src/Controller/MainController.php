<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	# 인덱스 페이지 이동
	public function index() {
		return view("index");
	}

	# 회원가입 페이지 이동
	public function register() {
		return view("register");
	}

	# 로그인 페이지 이동
	public function login() {
		return view("login");
	}

	# 글쓰기 페이지 이동
	public function write() {
		return view("write");
	}

}
?>