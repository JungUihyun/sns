<?php
namespace src\Controller;

use src\App\DB;

class PostController {
    # 글쓰기 처리
	public function write() {
        $user = $_SESSION['user'];
        // $title = $_POST['title'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];

        $content = nl2br($_POST['content']);

        if(isEmpty(trim($content) == "")) {
            back("필수값이 누락되었습니다.");
        }

        $file = $_FILES['upImage'];

        $sql = "INSERT INTO sns_boards (`content`, `writer`, `date`, `liked`, `commented`) VALUES(?, ?, NOW(), 0, 0)";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$content, $user->name]);
        
        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }
        
        for($i = 0; $i < count($file['name']); $i++) {
            $post_idx = DB::fetch("SELECT * FROM sns_boards ORDER BY id DESC LIMIT 0, 1")->idx;
            $upload_idx = DB::fetch("SELECT * FROM sns_uploads ORDER BY idx DESC LIMIT 0, 1")->idx;
            $name = $file['name'][$i];
            $directory = "./newFile/" . $upload_idx . $file['name'][$i];

            // upload
            move_uploaded_file($file['tmp_name'][$i], $directory);    

            if(explode("/", $file['type'][$i])[0] == "image") {
                // if Image
                if($_FILES['upImage']['size'][$i] >= 1024 * 1024 * 10) back("10MB 미만의 파일만 받을 수 있습니다.");

                $sql = DB::execute("INSERT INTO sns_uploads(`pidx`, `name`, `directory`, `type`) VALUES (?, ?, ?, ?)", $post_idx, $name, $directory, 1);
                echo "이미지 입력";

                if(!$sql) {
                    back("이미지 전송 중 오류 발생");
                }

            } else {
                // if File
                if($_FILES['upImage']['size'][$i] >= 1024 * 1024 * 50) back("50MB 미만의 파일만 받을 수 있습니다.");

                $sql = DB::execute("INSERT INTO sns_uploads(`pidx`, `name`, `directory`, `type`) VALUES (?, ?, ?, ?)", $post_idx, $name, $directory, 0);
                
                echo "파일 입력";

                if(!$sql) {
                    back("파일 전송 중 오류 발생");
                }
            }
        }
        
        back("성공적으로 입력되었습니다.");
    }
    
    # 글 수정
    public function modify() {
        $user = $_SESSION['user'];
        $content = $_POST['modify_input'];
        $pidx = $_POST['pidx'];

        if($content == "" && $pidx == "") {
            back("필수값이 비어있습니다.");
        }

        $sql = "SELECT * FROM sns_boards WHERE writer = ? AND id = ?";
        $data = DB::fetch($sql, [$user->name, $pidx]);

        if($data == null) {
            back("권한이 없습니다.");
        }

        $sql = "UPDATE sns_boards SET `content` = ?, `date` = NOW() WHERE `id` = ?";
        $result = DB::execute($sql, [$content, $pidx]);

        if(!$result) {
            back("데이터베이스 수정중 오류 발생");
        }

        back("성공적으로 수정되었습니다.");
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
        $sql2 = "DELETE FROM sns_comments WHERE pidx = ?";
        $result2 = DB::execute($sql2, [$id]);

        if(!$result || !$result2) {
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
        $user = $_SESSION['user'];

        $pidx = $_POST['pidx'];

        if(isEmpty($_POST)) {
            back("필수 값이 비어있습니다.");
        }

        $update = DB::execute("UPDATE sns_boards SET commented = commented + 1 WHERE id = ?", [$pidx]);

        // $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");

        $sql = "INSERT INTO sns_comments (`uidx`, `pidx`, `content`, `writer`, `wdate`) VALUES(?, ?, ?, ?, NOW())";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$user->idx, $pidx, $comment, $user->name]);

        if(!$result || !$update) {
            back("데이터베이스 입력중 오류 발생");
        }

        back("성공적으로 입력되었습니다.");
    }

    # 댓글 수정
    public function comment_modify() {
    }

    # 댓글 삭제
    public function comment_delete() {
        $user = $_SESSION['user'];
        $pidx = $_GET['id'];

        $update = DB::execute("UPDATE sns_boards SET commented = commented - 1 WHERE id = ?", [$pidx]);
        $sql = DB::fetch("DELETE FROM sns_comments WHERE pidx = ? AND uidx = ?", [$pidx, $user->idx]);

        if(!$update || !$sql) {
            back("데이터베이스 삭제 중 오류 발생");
        }

        back("댓글 삭제 완료");
    }

    # 글 좋아요
    public function like() {
        $user = $_SESSION['user'];

        $id = $_GET['id'];

        if(DB::fetch("SELECT * FROM sns_like WHERE pidx = ? AND uidx = ?", [$id, $user->idx])) {
            $sql = DB::execute("DELETE FROM sns_like WHERE pidx = ? AND uidx = ?", [$id, $user->idx]);
            $update = DB::execute("UPDATE sns_boards SET liked = liked - 1 WHERE id = ?", [$id]);

            if(!$sql || !$update) {
                back("데이터베이스 삭제 중 오류 발생");
            }

            back("좋아요를 취소하였습니다.");
        } else {
            $sql = "INSERT INTO sns_like (`pidx`, `uidx`) VALUES (?, ?)";
            $result = DB::execute($sql, [$id, $user->idx]);

            $update = "UPDATE sns_boards SET liked = liked + 1 WHERE id = ?";
            $uResult = DB::execute($update, [$id]);
            
            if(!$result || !$uResult) {
                back("데이터베이스 입력중 오류 발생");
            }
        }

        back("좋아요 투척");
    }
    

}
