<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	# 인덱스 페이지 이동, 데이터 전송
	public function index() {
		$comment_list = [];
		$list = [];
        $cnt = 0;
        $prev = false;
        $next = false;
		$page = 0;
		
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
            // $start = ($page - 1) * 5; 
			// $sql = "SELECT * FROM sns_boards WHERE writer = ? AND date >= NOW() ORDER BY date LIMIT {$start}, 5"; //LIMIT 기본 정렬은 asc 오름차순인데 0개서 부터 5개 가져온다.
			$sql = "SELECT * FROM sns_boards ORDER BY date DESC";
            $list = DB::fetchAll($sql, [$_SESSION['user']->id]);

			// $sql = "SELECT count(*) AS cnt FROM sns_boards WHERE writer = ? AND date >= NOW()";
			$sql = "SELECT count(*) AS cnt FROM sns_boards";

            $cnt = DB::fetch($sql, [$user->id]);
            $cnt = $cnt->cnt;

            if(ceil($cnt / 5) > $page) {
                $next = true;
            }
            if($page != 1) {
                $prev = true;
			}
			
			/* 댓글 쓰기 */
            // $start = ($page - 1) * 5; 
			// $sql = "SELECT * FROM sns_boards WHERE writer = ? AND date >= NOW() ORDER BY date LIMIT {$start}, 5"; //LIMIT 기본 정렬은 asc 오름차순인데 0개서 부터 5개 가져온다.
			$comment_sql = "SELECT * FROM sns_comments ORDER BY wdate DESC";
            $comment_list = DB::fetchAll($comment_sql, [$_SESSION['user']->id]);
		}

		return view("index", ['comment_list' => $comment_list, 'list' => $list, 'cnt' => $cnt, 'prev' => $prev, 'next' => $next, 'p' => $page]);
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
		$list = [];
        $cnt = 0;
        $prev = false;
        $next = false;
		$page = 0;
		
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
            // $start = ($page - 1) * 5; 
			// $sql = "SELECT * FROM sns_boards WHERE writer = ? AND date >= NOW() ORDER BY date LIMIT {$start}, 5";
			$sql = "SELECT * FROM sns_boards WHERE writer = ? ORDER BY date DESC";
            $list = DB::fetchAll($sql, [$_SESSION['user']->name]);

			$sql = "SELECT count(*) AS cnt FROM sns_boards WHERE writer = ?";

            $cnt = DB::fetch($sql, [$user->name]);
            $cnt = $cnt->cnt;

            if(ceil($cnt / 5) > $page) {
                $next = true;
            }
            if($page != 1) {
                $prev = true;
            }
		}

		return view("profile", ['list' => $list, 'cnt' => $cnt, 'prev' => $prev, 'next' => $next, 'p' => $page]);
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