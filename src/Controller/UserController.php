<?php
namespace src\Controller;

use src\App\DB;

class UserController {
	# 회원가입 처리
	public function register() {
		$id = trim($_POST['id']);
        $password = trim($_POST['password']);
        $passwordc = trim($_POST['passwordc']);
        $name = trim($_POST['name']);

        if($id ==  "" || $password == "" || $name == ""){
            back("필수값은 공백이 될 수 없습니다.");
        }

        if($password != $passwordc){
            back("비밀번호와 비밀번호 확인이 다릅니다.");
		}
		
		if(!preg_match("/^[0-9a-zA-Zㄱ-ㅎ가-힣!@#$%^&*() ]+$/", $id)) {
			back("아이디가 올바른 형식이 아닙니다. 아이디를 다시 입력해 주세요");
        }

        if(DB::fetch("SELECT * FROM sns_users WHERE id = ?", [$id])) {
            back("이미 사용중인 아이디 입니다.");
        }
        
        // if(!preg_match("/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;", $id)) {
        //     back("아이디가 올바른 형식이 아닙니다. 아이디를 다시 입력해 주세요");
		// 	return;
        // }
        

        $b_img_name = "bg" . rand(0, 10) . ".jpg";
        $directory = "./newFile/" . $b_img_name;

        move_uploaded_file($b_img_name, $directory);

        $sql = "INSERT INTO sns_users (`id`, `name`, `password`, `b_img`) VALUES (?, ?, ?, ?)";
        $result = DB::execute($sql, [$id, $name, $password, $directory]);

        if(!$result){
            back("DB에 값이 올바르게 들어가지 않았습니다.");
        }

        move("/login", "회원가입 완료. 로그인해주세요");
	}

	# 로그인 처리
	public function login() {
        extract($_POST);

        $user = DB::fetch("SELECT * FROM sns_users WHERE id = ? AND password = ?", [$id, $password]);
        if(!$user) {
            back("일치하는 회원이 없습니다.");
        } else {
            $_SESSION['user'] = $user;
            move("/", "로그인 완료");
        }
    }
    
    # 로그아웃 처리
    public function logout() {
        unset($_SESSION['user']);
        move("/login", "로그아웃 완료");
    }

    # 친구신청 보내기
    public function question() {
        $user = $_SESSION['user'];
        $ridx = $_POST['ridx'];
        $sql = "INSERT INTO sns_addfriend (`qidx`, `ridx`, date) VALUES (?, ?, NOW())";
        $result = DB::execute($sql, [$user->idx, $ridx]);

        if(!$result){
            back("DB에 값이 올바르게 들어가지 않았습니다.");
        }
        
        move("/", "친구신청 완료");
    }

    # 친구신청 수락
    public function receive() {
        $user = $_SESSION['user'];

        // 친구신청을 보낸 사람의 인덱스
        $qidx = $_POST['question_qidx'];

        $sql = "DELETE FROM sns_addfriend WHERE ridx = ?";
        $result = DB::execute($sql, [$user->idx]);
        
        $sql2 = "INSERT INTO sns_friends (`qidx`, `ridx`, `date`) VALUES (?, ?, NOW())";
        $result2 = DB::execute($sql2, [$user->idx, $qidx]);

        $sql3 = "INSERT INTO sns_friends (`qidx`, `ridx`, `date`) VALUES (?, ?, NOW())";
        $result3 = DB::execute($sql3, [$qidx, $user->idx]);

        if(!$result || !$result2 || !$result3) {
            back("DB에 값이 올바르게 가지 않았습니다.");
        }

        move("/", "친구요청 수락");
    }

    # 친구신청 거절
    public function refuse() {
        $user = $_SESSION['user'];

        $sql1 = DB::execute("DELETE FROM sns_addfriend WHERE qidx = ?", [$user->idx]);
        $sql2 = DB::execute("DELETE FROM sns_addfriend WHERE ridx = ?", [$user->idx]);

        if(!$sql1 || !$sql2) {
            back("DB에 값이 올바르게 삭제되지 않았습니다.");
        }
        
        move("/", "친구신청 거절");
    }

    # 친구신청 취소
    public function send_cancel() {
        $user = $_SESSION['user'];
        $ridx = $_GET['ridx'];

        $sql = DB::execute("DELETE FROM sns_addfriend WHERE qidx = ? AND ridx = ?", [$user->idx, $ridx]);

        if(!$sql) {
            back("DB에 값이 올바르게 삭제되지 않았습니다.");
        }

        move("/", "친구신청 취소");
    }

    # 친구삭제
    public function delete_friend() {
        $user = $_SESSION['user'];
        $friend = $_GET['idx'];

        $result1 = DB::execute("DELETE FROM sns_friends WHERE qidx = ? AND ridx = ?", [$user->idx, $friend]);
        $result2 = DB::execute("DELETE FROM sns_friends WHERE ridx = ? AND qidx = ?", [$user->idx, $friend]);

        if(!$result1 || !$result2) {
            back("DB 작업이 완료되지 않았습니다.");
        }

        move("/", "친구삭제 완료");
    }

    # 쪽지 보내기
    public function send_message() {
        $user = $_SESSION['user'];
        extract($_POST);
        
        $sql = DB::execute("INSERT INTO sns_msg(`qidx`, `ridx`, `content`, `writer`, `receiver`, `date`) VALUES (?, ?, ?, ?, ?, NOW())", [$user->idx, $message_ridx, $message_input, $user->name, $receiver]);

        if(!$sql) {
            back("DB 작업이 완료되지 않았습니다.");
        }

        move("/", "쪽지를 보냈습니다.");
    }

    # 쪽지 삭제
    public function delete_message() {
        $user = $_SESSION['user'];
        extract($_GET);

        

        move("/", "쪽지를 삭제했습니다.");
    }

    # 프로필 사진 설정
    public function setProfile() {
        $user = $_SESSION['user'];

        // if(isset($_POST['formData'])) {
        //     $file = $_FILES['file'];
        
        //     $name = $_POST['name'];
        //     $fileName = $file['name'];
        //     $directory = "./newFile/" . $fileName;

        //     move_uploaded_file($file['tmp_name'], $directory);

        //     DB::execute("UPDATE sns_users SET p_img = ? WHERE idx = ?", [$directory, $user->idx]); 
        //     json(['success'=>true, 'name'=>$file['name'], 'fileName'=>$fileName]);
        // }


        $file = $_FILES['userProfile'];
        json_encode(['success'=>true, 'name'=>$file['name']]);
        $name = $_POST['name'];
        $fileName = $_FILES['file'];
        
        $directory = "./newFile/" . $fileName;

        move_uploaded_file($fileName['tmp_name'], $directory);
        
        DB::execute("UPDATE sns_users SET p_img = ? WHERE idx = ?", [$directory, $user->idx]); 
        
    }
}
