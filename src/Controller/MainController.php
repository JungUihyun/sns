<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	# 인덱스 페이지 이동, 데이터 전송
	public function index() {
		$comment_list = [];
		$list = [];
		$cnt = 0;
		$comment_cnt = 0;
        $prev = false;
        $next = false;
		$page = 0;
		/* 추천친구 */
		$recommend_list = [];
		$recommend_cnt = 0;
		/* 친구신청리스트 cnt */
		$question_list = [];
		$question_cnt = 0;
		/* 친구 리스트 */
		$friend_list = [];
		$friend_cnt = 0;
		/* 보낸 친구신청 리스트 */
		$send_list = [];
		$send_cnt = 0;
		/* 보낸 쪽지함 */
		$send_msg_list = [];
		$send_msg_cnt = 0;
		/* 받은 쪽지함 */
		$receive_msg_list = [];
		$receive_msg_cnt = 0;
		/* 이미지 리스트 */
		$images = [];
		/* 현재 유저 프로필 사진 */
		$current_profile = [];

        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
			$page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
			$start = ($page - 1) * 5;
			// $sql = "SELECT * FROM sns_boards ORDER BY date DESC LIMIT ${start}, 5";
			$sql = "SELECT * FROM sns_boards ORDER BY date DESC";
            $list = DB::fetchAll($sql);

				// echo "<pre>";
				// // var_dump($list);
				// var_dump(json_encode($list));
				// echo "</pre>";
				// exit;
			/* 댓글 리스트 출력 */
			foreach($list as $board){
				$comment_sql = "SELECT * FROM sns_comments WHERE pidx = ? ORDER BY wdate";
				$comment_list = DB::fetchAll($comment_sql, [$board->id]);
				$board->comments = $comment_list;

				$images = DB::fetchAll("SELECT * FROM sns_uploads WHERE pidx = ?", [$board->id]);
				$board->images = $images;

				$p_img = DB::fetch("SELECT p_img FROM sns_users WHERE name = ?", [$board->writer]);
				$board->p_img = $p_img;
			}			
			
			/* 추천친구 */
			// $recommend_sql = "SELECT * FROM sns_users WHERE id NOT IN(" . $user->id . ") ORDER BY rand()";
			$recommend_sql = "SELECT * FROM sns_users WHERE idx NOT IN (SELECT qidx FROM sns_friends WHERE ridx = ? ) ORDER BY rand()";
			$recommend_list = DB::fetchAll($recommend_sql, [$user->idx]);
			$recommend_sql = "SELECT count(*) AS r_cnt FROM sns_users WHERE idx NOT IN(?)";
			$recommend_cnt = DB::fetch($recommend_sql, [$user->idx])->r_cnt;

			/* 친구신청 리스트 출력 */
			$question_sql = "SELECT * FROM sns_users WHERE idx IN ( SELECT qidx FROM sns_addfriend WHERE ridx = ?)";
			$question_list = DB::fetchAll($question_sql, [$user->idx]);
			$question_sql = "SELECT count(*) AS q_cnt FROM sns_addfriend WHERE ridx = ?";
			$question_cnt = DB::fetch($question_sql, [$user->idx])->q_cnt;

			/* 친구 리스트 출력 */
			$friend_sql = "SELECT * FROM sns_users WHERE idx IN (SELECT ridx FROM sns_friends WHERE qidx = ?)";
			$friend_list = DB::fetchAll($friend_sql, [$user->idx]);
			$friend_sql = "SELECT count(*) AS f_cnt FROM sns_friends WHERE ridx = ?";
			$friend_cnt = DB::fetch($friend_sql, [$user->idx])->f_cnt;

			/* 보낸 친구신청 리스트 출력 */
			$send_sql = "SELECT * FROM sns_users WHERE idx IN (SELECT ridx FROM sns_addfriend WHERE qidx = ?)";
			$send_list = DB::fetchAll($send_sql, [$user->idx]);
			$send_sql = "SELECT count(*) AS s_cnt FROM sns_addfriend WHERE qidx = ?";
			$send_cnt = DB::fetch($send_sql, [$user->idx])->s_cnt;

			/* 보낸 쪽지 리스트 */
			$send_msg_list = DB::fetchAll("SELECT * FROM sns_msg WHERE qidx = ? ORDER BY date DESC", [$user->idx]);
			$send_msg_cnt = DB::fetch("SELECT count(*) AS s_m_cnt FROM sns_msg WHERE qidx = ?", [$user->idx])->s_m_cnt;

			/* 받은 쪽지 리스트 */
			$receive_msg_list = DB::fetchAll("SELECT * FROM sns_msg WHERE ridx = ? ORDER BY date DESC", [$user->idx]);
			$receive_msg_cnt = DB::fetch("SELECT count(*) AS s_m_cnt FROM sns_msg WHERE ridx = ?", [$user->idx])->s_m_cnt;

			/* 현재 사용자 프로필 이미지 */
			$current_profile = DB::fetch("SELECT p_img FROM sns_users WHERE idx = ?", [$user->idx]);
		}	

		return view("index", ['p_img' => $p_img, 'current_profile' => $current_profile, 'images' => $images, 'receive_msg_list' => $receive_msg_list, 'receive_msg_cnt' => $receive_msg_cnt, 'send_msg_list' => $send_msg_list, 'send_msg_cnt' => $send_msg_cnt, 'send_list' => $send_list, 'send_cnt' => $send_cnt, 'friend_list' => $friend_list, 'friend_cnt' => $friend_cnt, 'question_list' => $question_list, 'question_cnt' => $question_cnt, 'recommend_list' => $recommend_list, 'recommend_cnt' => $recommend_cnt, 'comment_list' => $comment_list, 'comment_cnt' => $comment_cnt, 'list' => $list, 'prev' => $prev, 'next' => $next, 'p' => $page]);
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
	public function profile($uidx) {
		$comment_list = [];
		$list = [];
		$cnt = 0;
		$comment_cnt = 0;
        $prev = false;
        $next = false;
		$page = 0;
		/* 추천친구 */
		$recommend_list = [];
		$recommend_cnt = 0;
		/* 친구신청리스트 cnt */
		$question_list = [];
		$question_cnt = 0;
		/* 친구 리스트 */
		$friend_list = [];
		$friend_cnt = 0;
		/* 보낸 친구신청 리스트 */
		$send_list = [];
		$send_cnt = 0;
		/* 보낸 쪽지함 */
		$send_msg_list = [];
		$send_msg_cnt = 0;
		/* 받은 쪽지함 */
		$receive_msg_list = [];
		$receive_msg_cnt = 0;
		/* 프로필 배경화면 */
		$background_image = [];
		/* 이미지 리스트 */
		$images = [];
		/* 현재 유저 프로필 사진 */
		$current_profile = [];

        if(isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			// $name = $_GET['name'];
			$name = DB::fetch("SELECT name FROM sns_users WHERE idx = ?", [$uidx]);
            $page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
			$sql = "SELECT * FROM sns_boards WHERE writer = (SELECT name FROM sns_users WHERE idx = ?) ORDER BY date DESC";
			$list = DB::fetchAll($sql, [$uidx]);

			/* 댓글 리스트 출력 */
			foreach($list as $board){
				$comment_sql = "SELECT * FROM sns_comments WHERE pidx = ? ORDER BY wdate";
				$comment_list = DB::fetchAll($comment_sql, [$board->id]);
				$board->comments = $comment_list;

				$p_img = DB::fetch("SELECT p_img FROM sns_users WHERE name = ?", [$board->writer]);
				$board->p_img = $p_img;
			}

			/* 글 개수 */
			$sql = DB::fetch("SELECT count(*) AS cnt FROM sns_boards WHERE writer = (SELECT name FROM sns_users WHERE idx = ?)", [$uidx])->cnt;
			
			/* 추천친구 */
			// $recommend_sql = "SELECT * FROM sns_users WHERE id NOT IN($user->id) ORDER BY rand()";
			$recommend_sql = "SELECT * FROM sns_users WHERE idx NOT IN (SELECT qidx FROM sns_friends WHERE ridx = ? ) ORDER BY rand()";
			$recommend_list = DB::fetchAll($recommend_sql, [$user->idx]);
			$recommend_sql = "SELECT count(*) AS r_cnt FROM sns_users WHERE idx NOT IN(?)";
			$recommend_cnt = DB::fetch($recommend_sql, [$user->idx])->r_cnt;

			/* 친구신청 리스트 출력 */
			$question_sql = "SELECT * FROM sns_users WHERE idx IN ( SELECT qidx FROM sns_addfriend WHERE ridx = ?)";
			$question_list = DB::fetchAll($question_sql, [$user->idx]);
			$question_sql = "SELECT count(*) AS q_cnt FROM sns_addfriend WHERE ridx = ?";
			$question_cnt = DB::fetch($question_sql, [$user->idx])->q_cnt;

			/* 친구 리스트 출력 */
			$friend_sql = "SELECT * FROM sns_users WHERE idx IN (SELECT ridx FROM sns_friends WHERE qidx = ?)";
			$friend_list = DB::fetchAll($friend_sql, [$user->idx]);
			$friend_sql = "SELECT count(*) AS f_cnt FROM sns_friends WHERE ridx = ?";
			$friend_cnt = DB::fetch($friend_sql, [$user->idx])->f_cnt;

			/* 보낸 친구신청 리스트 출력 */
			$send_sql = "SELECT * FROM sns_users WHERE idx IN (SELECT ridx FROM sns_addfriend WHERE qidx = ?)";
			$send_list = DB::fetchAll($send_sql, [$user->idx]);
			$send_sql = "SELECT count(*) AS s_cnt FROM sns_addfriend WHERE qidx = ?";
			$send_cnt = DB::fetch($send_sql, [$user->idx])->s_cnt;

			/* 보낸 쪽지 리스트 */
			$send_msg_list = DB::fetchAll("SELECT * FROM sns_msg WHERE qidx = ? ORDER BY date DESC", [$user->idx]);
			$send_msg_cnt = DB::fetch("SELECT count(*) AS s_m_cnt FROM sns_msg WHERE qidx = ?", [$user->idx])->s_m_cnt;

			/* 받은 쪽지 리스트 */
			$receive_msg_list = DB::fetchAll("SELECT * FROM sns_msg WHERE ridx = ? ORDER BY date DESC", [$user->idx]);
			$receive_msg_cnt = DB::fetch("SELECT count(*) AS s_m_cnt FROM sns_msg WHERE ridx = ?", [$user->idx])->s_m_cnt;

			/* 프로필 배경화면 */
			$background_image = DB::fetch("SELECT b_img FROM sns_users WHERE idx = ?", [$uidx]);

			/* 현재 사용자 프로필 이미지 */
			$current_profile = DB::fetch("SELECT p_img FROM sns_users WHERE idx = ?", [$user->idx]);

			/* 메인 프로필 사진 */
			$main_profile = DB::fetch("SELECT p_img FROM sns_users WHERE idx = ?", [$uidx]);
		}	

		return view("profile", ['main_profile' => $main_profile , 'images' => $images, 'current_profile' => $current_profile, 'background_image' => $background_image, 'cnt' => $sql, 'name' => $name, 'receive_msg_list' => $receive_msg_list, 'receive_msg_cnt' => $receive_msg_cnt, 'send_msg_list' => $send_msg_list, 'send_msg_cnt' => $send_msg_cnt, 'send_list' => $send_list, 'send_cnt' => $send_cnt, 'friend_list' => $friend_list, 'friend_cnt' => $friend_cnt, 'question_list' => $question_list, 'question_cnt' => $question_cnt, 'recommend_list' => $recommend_list, 'recommend_cnt' => $recommend_cnt, 'comment_list' => $comment_list, 'comment_cnt' => $comment_cnt, 'list' => $list, 'prev' => $prev, 'next' => $next, 'p' => $page]);
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

