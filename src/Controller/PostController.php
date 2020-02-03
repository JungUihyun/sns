<?php
namespace src\Controller;

use src\App\DB;

class PostController {
    # 글쓰기 처리
	public function write() {
        // $title = $_POST['title'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];

        $content = $_POST['content'];

        if(isEmpty($_POST)) {
            back("필수 값이 비어있습니다.");
        }

        // $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");
        $user = $_SESSION['user'];

        $sql = "INSERT INTO sns_boards (`content`, `writer`, `date`) VALUES(?, ?, NOW())";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$content, $user->name]);
        
        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }

        move("/", "성공적으로 입력되었습니다.");
    }
    
    // # 글 수정
    public function modify() {
        // $title = $_POST['title'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];

        if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            back("수정 대상 값이 올바르지 않습니다.");
        }

        $content = $_POST['content'];
        
        $id = $_POST['id'];

        if(isEmpty($content)) {
            back("필수값이 비어있습니다.");
        }

        $user = $_SESSION['user'];
        $sql = "SELECT * FROM sns_boards WHERE writer = ? AND id = ?";
        $data = DB::fetch($sql, [$user->id, $id]);

        if($data == null) {
            back("권한이 없습니다.");
        }

        // $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");
        $sql = "UPDATE sns_boards SET `title` = ?, `content` = ?, `date` = ? WHERE `id` = ?";
        $result = DB::execute($sql, [$title, $content, $datetime, $id]);

        if(!$result) {
            back("데이터베이스 수정중 오류 발생.");
        }

        move("성공적으로 수정되었습니다.", "/");
    }
	
    # 글 삭제
    public function delete() {
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            back("삭제 대상 값이 올바르지 않습니다.");
        }

        $id = $_GET['id'];
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM sns_boards WHERE writer = ? AND id = ?";
        $data = DB::fetch($sql, [$user->name, $id]);

        if($data == null) {
            back("권한이 없습니다.");
        }

        $sql = "DELETE FROM sns_boards WHERE id = ?";
        $result = DB::execute($sql, [$id]);

        if(!$result) {
            back("데이터베이스 삭제중 오류 발생");
        }

        back("성공적으로 삭제되었습니다.");
    }

    # 글 리스트 출력
    // public function list($idx = 0) {
    //     if(!isset($_SESSION['user'])){
    //         back("로그인 후 시도하세요.");
    //     }else {
    //         $sql = "SELECT * FROM sns_boards ORDER BY date LIMIT {$idx}, 5";
    //         $list = DB::fetchAll($sql, [$_SESSION['user']->id]);
    //         var_dump($list);
    //         json(['success'=>true, 'list'=>$list]);
    //     }
    // }

    # 댓글 쓰기 처리
    public function comment_write() {
        $comment = $_POST['comment_'];

        if(isEmpty($_POST)) {
            back("필수 값이 비어있습니다.");
        }

        // $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");
        $user = $_SESSION['user'];

        $uidx = $_SESSION['user']->idx;
        $pidx = $_POST['pidx'];

        $sql = "INSERT INTO sns_comments (`uidx`, `pidx`, `content`, `writer`, `wdate`) VALUES(?, ?, ?, ?, NOW())";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$uidx, $pidx, $comment, $user->name]);

        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }

        move("/", "성공적으로 입력되었습니다.");
    }

    # 댓글 수정
    public function comment_modify() {

    }

    # 댓글 삭제
    public function comment_delete() {

    }
    

}
