<?php
namespace src\Controller;

use src\App\DB;

class PostController {
    # 글쓰기 처리
	// public function write() {
    //     $title = $_POST['title'];
    //     $date = $_POST['date'];
    //     $time = $_POST['time'];
    //     $content = $_POST['content'];

    //     if($title == "" || $date == "" || $content == "") {
    //         Library::msgAndGo("필수 값이 비어있습니다.", "/todo/write");
    //         return;
    //     }

    //     $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");
    //     $user = $_SESSION['user'];

    //     $sql = "INSERT INTO todos (`title`, `content`, `owner`, `date`) VALUES(?, ?, ?, ?)";
    //     $result = DB::execute($sql, [$title, $content, $user->id, $datetime]);
        
    //     if($result != 1) {
    //         Library::msgAndGo("데이터베이스 입력중 오류 발생",  "/todo/write");
    //         return;
    //     }
    //     Library::msgAndGo("성공적으로 입력되었습니다.", "/", "success");
    // }
    
    // # 글 수정
    // public function modify() {
    //     $title = $_POST['title'];
    //     $date = $_POST['date'];
    //     $time = $_POST['time'];
    //     $content = $_POST['content'];
    //     $id = $_POST['id'];

    //     if($title == "" || $date == "" || $content == "") {
    //         Library::msgAndGo("필수값이 비어있습니다.", "/todo/mod?id" . $id);
    //         return;
    //     }

    //     $user = $_SESSION['user'];
    //     $sql = "SELECT * FROM todos WHERE owner = ? AND id = ?";
    //     $data = DB::fetch($sql, [$user->id, $id]);

    //     if($data == null) {
    //         Library::msgAndGo("권한이 없습니다.", "/");
    //         return;
    //     }

    //     $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");
    //     $sql = "UPDATE todos SET `title` = ?, `content` = ?, `date` = ? WHERE `id` = ?";
    //     $result = DB::execute($sql, [$title, $content, $datetime, $id]);

    //     if($result != 1) {
    //         Library::msgAndGo("데이터베이스 수정중 오류 발생.", "/todo/mod?id=" . $id);
    //         return;
    //     }
    //     Library::msgAndGo("성공적으로 수정되었습니다.", "/", "success");
    //     return;
    // }
	
    // # 글 삭제
    // public function delete() {
    //     if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    //         Library::msgAndGo("삭제 대상 값이 올바르지 않습니다.", "/");
    //         return;
    //     }

    //     $id = $_GET['id'];
    //     $user = $_SESSION['user'];
    //     $sql = "SELECT * FROM todos WHERE owner = ? AND id = ?";
    //     $data = DB::fetch($sql, [$user->id, $id]);

    //     if($data == null) {
    //         Library::msgAndGo("권한이 없습니다.", "/");
    //         return;
    //     }

    //     $sql = "DELETE FROM todos WHERE id = ?";
    //     $result = DB::execute($sql, [$id]);
    //     if($result != 1) {
    //         Library::msgAndGo("데이터베이스 삭제중 오류 발생", "/");
    //         return;
    //     }
    //     Library::msgAndGo("성공적으로 삭제되었습니다.", "/" ,"success");
    //     return;
    // }
    

}
