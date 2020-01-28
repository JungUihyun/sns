<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	# 인덱스 페이지 이동
	public function index() {
		return view("index");
	}

	# 404 페이지 이동
	public function error() {
		return view("error");
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

	# 프로필 페이지 이동
	public function profile() {
		return view("profile");
	}

	# 피드 이동
	public function list() {
		return view("list");
	}

	# 친구창
	# 설정
	# 검색


}
?>

<!-- user()를 썼을때 -->
<!-- 로그인 되어있으면 로그인된 정보 가져옴 (true) -->
<!-- 로그인 안되어있으면 false -->

<!-- user(3)를 썼을때 -->
<!-- 로그인여부와 상관없이 users 테이블에서 idx가 3인 유저 정보를 가져옴 -->
<!-- 없으면 false -->