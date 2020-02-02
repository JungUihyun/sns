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
            return;
        }

        if($password != $passwordc){
            back("비밀번호와 비밀번호 확인이 다릅니다.");
            return;
		}
		
		if(!preg_match("/^[0-9a-zA-Zㄱ-ㅎ가-힣!@#$%^&*() ]+$/", $id)) {
			back("아이디가 올바른 형식이 아닙니다. 아이디를 다시 입력해 주세요");
			return;
        }
        
        // if(!preg_match("/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;", $id)) {
        //     back("아이디가 올바른 형식이 아닙니다. 아이디를 다시 입력해 주세요");
		// 	return;
        // }

        $sql = "INSERT INTO sns_users (`id`, `name`, `password`) VALUES (?, ?, ?)";
        $result = DB::execute($sql, [$id, $name, $password]);

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
        // $rsql = "SELECT * FROM sns_users WHERE "; // 친구신청 보내는 사람의 정보
        $sql = "INSERT INTO sns_addfriend (`qidx`, `ridx`, date) VALUES (?, ?, NOW())";
        $result = DB::execute($sql, [$user->idx, 받은사람인덱스]);

        if(!$result){
            back("DB에 값이 올바르게 들어가지 않았습니다.");
        }

        move("/", "친구신청 완료");
    }

    # 친구신청 받기
    public function receive() {

    }


}
