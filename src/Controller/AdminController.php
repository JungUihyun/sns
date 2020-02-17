<?php
namespace src\Controller;

use src\App\DB;

class AdminController {
	# 관리자 페이지 이동
	public function admin() {
        // 유저 수
        $datas["user_cnt"] = DB::fetch("SELECT count(*) AS user_cnt FROM sns_users")->user_cnt;

        // 유저 정보
        $datas["userList"] = DB::fetchAll("SELECT * FROM sns_users");

        // 게시글 수
        $datas["board_cnt"] = DB::fetch("SELECT count(*) AS board_cnt FROM sns_boards")->board_cnt;

        // 게시글 정보
        $datas["boardList"] = DB::fetchAll("SELECT * FROM sns_boards");

        // 많은 글 유저
        $datas["boardTOP"] = DB::fetchAll("SELECT count(*) AS cnt, uidx FROM sns_boards GROUP BY uidx ORDER BY cnt DESC LIMIT 0, 5");

        // 많은 댓글 유저
        $datas["commentTOP"] = DB::fetchAll("SELECT count(*) AS cnt, uidx FROM sns_comments GROUP BY uidx ORDER BY cnt DESC LIMIT 0, 5");
        
        return view("admin", $datas);
    }

    public function admin_delete($pidx) {
        DB::execute("DELETE FROM sns_boards WHERE id = ?", [$pidx]);
        DB::execute("DELETE FROM sns_comments WHERE pidx = ?", [$pidx]);

        back("글 삭제");
    }

    public function user_delete($uidx) {
        DB::execute("DELETE FROM sns_users WHERE idx = ?", [$uidx]);
        DB::execute("DELETE FROM sns_comments WHERE uidx = ?", [$uidx]);
        DB::execute("DELETE FROM sns_boards WHERE uidx = ?", [$uidx]);

        back("유저 삭제");
    }
}

?>
