<?php
namespace src\Controller;

use src\App\DB;

class PostController {
    # 글쓰기 처리
	public function write() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}

        $user = $_SESSION['user'];
        // $title = $_POST['title'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];
        
        $content = $_POST['content'];
        $link = $_POST['link'];

        $setDistance = $_POST['setDistance'];
        $setCDistance = $_POST['setCDistance'];

        if($content == "" || $setDistance == null || $setCDistance == null) {
            back('필수값이 누락되었습니다.');
        }

        if(!empty($link)) {
            if(preg_match("/^[a-zA-Z]{2,6}(\:[0-9]+)?(\/\S*)?$/", $link)) {
                $link = "http://$link";
                // back("링크 형식이 잘못되었습니다. 다시 입력해 주세요.");
            } else if(preg_match("/^((http(s?))\:\/\/)([0-9a-zA-Z\-]+\.)+[a-zA-Z]{2,6}(\:[0-9]+)?(\/\S*)?$/", $link)) {
                $link = $link;                
            } else {
                back("링크 형식이 잘못되었습니다. 다시 입력해 주세요.");
            }
            // if(preg_match("/^[^((http(s?))\:\/\/)]([0-9a-zA-Z\-]+\.)+[a-zA-Z]{2,6}(\:[0-9]+)?(\/\S*)?$/", $link)) {
            //     $link = "http://$link";
            //     // back("링크 형식이 잘못되었습니다. 다시 입력해 주세요.");
            // } else if(preg_match("/^((http(s?))\:\/\/)([0-9a-zA-Z\-]+\.)+[a-zA-Z]{2,6}(\:[0-9]+)?(\/\S*)?$/", $link)) {
                
            // }
        }

        $uploadLink = "<a href='$link' target='_blank'>$link</a>";

        $file = $_FILES['upImage'];

        $update1 = DB::execute("UPDATE sns_users SET post_cnt = post_cnt + 1 WHERE idx = ?", [user()->idx]);
        $sql = "INSERT INTO sns_boards (`content`, `link`, `writer`, `date`, `liked`, `commented`, `uidx`, `distance`, `c_distance`) VALUES(?, ?, ?, NOW(), 0, 0, ?, ?, ?)";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$content, $uploadLink, $user->name, user()->idx, $setDistance, $setCDistance]);
        
        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }

        if(isset($_FILES['list'])) {
            $files = $_FILES['list'];
            $upload_idx = DB::fetch("SELECT * FROM sns_boards ORDER BY id DESC LIMIT 0, 1")->id;
            // $upload_idx = DB::fetch("SELECT * FROM sns_uploads ORDER BY idx DESC LIMIT 0, 1")->idx;

            for($i = 0; $i < count($files['name']); $i++) {
                $name = $upload_idx . $files['name'][$i];
                $directory = "/" . "newFile/" . $name;
                
                move_uploaded_file($files['tmp_name'][$i], "." . $directory);

                // if(explode("/", $files['type'][$i])[0] == "image") {
                //     // if Image
                //     if($_FILES['list']['size'][$i] >= 1024 * 1024 * 10) back("10MB 미만의 파일만 받을 수 있습니다.");
    
                //     $sql = DB::execute("INSERT INTO sns_uploads(`pidx`, `name`, `directory`, `type`) VALUES (?, ?, ?, ?)", [$post_idx, $name, $directory, 1]);
    
                //     if(!$sql) {
                //         back("이미지 전송 중 오류 발생");
                //     }
                // }
            }
        }

        if(isset($_FILES['upImage'])) {
            for($i = 0; $i < count($file['name']); $i++) {
                $post_idx = DB::fetch("SELECT * FROM sns_boards ORDER BY id DESC LIMIT 0, 1")->id;
                $upload_idx = DB::fetch("SELECT * FROM sns_uploads ORDER BY idx DESC LIMIT 0, 1");
                $name = $file['name'][$i];
                $directory = "/" . "newFile/" . $upload_idx . $file['name'][$i];
                
                // upload
                move_uploaded_file($file['tmp_name'][$i], "." . $directory);
    
                if(explode("/", $file['type'][$i])[0] == "image") {
                    // if Image
                    if($_FILES['upImage']['size'][$i] >= 1024 * 1024 * 10) back("10MB 미만의 파일만 받을 수 있습니다.");
    
                    $sql = DB::execute("INSERT INTO sns_uploads(`pidx`, `name`, `directory`, `type`) VALUES (?, ?, ?, ?)", [$post_idx, $name, $directory, 1]);
    
                    if(!$sql) {
                        back("이미지 전송 중 오류 발생");
                    }
                }
            }
        }
        
        // back("성공적으로 입력되었습니다.");
    }
    
    # 글 수정
    public function modify() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}

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

        $sql = "UPDATE sns_boards SET `content` = ? WHERE `id` = ?";
        $result = DB::execute($sql, [$content, $pidx]);

        if(!$result) {
            back("데이터베이스 수정중 오류 발생");
        }

        back("성공적으로 수정되었습니다.");
    }
	
    # 글 삭제
    public function delete() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}

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

        $update = DB::execute("UPDATE sns_users SET comment_cnt = comment_cnt - 1 WHERE idx = ?", [user()->idx]);

        $sql = "DELETE FROM sns_boards WHERE id = ?";
        $result = DB::execute($sql, [$id]);
        $sql2 = "DELETE FROM sns_comments WHERE pidx = ?";
        $result2 = DB::execute($sql2, [$id]);
        $sql3 = "DELETE FROM sns_uploads WHERE pidx = ?";
        $result3 = DB::execute($sql3, [$id]);

        if(!$result || !$result2 || !$result3) {
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
        // 비회원 접근 시
		if(!user()) {
			return view("login");
        }

        $comment = $_POST['comment_'];
        $user = $_SESSION['user'];

        $pidx = $_POST['pidx'];

        if(isEmpty($_POST)) {
            back("필수 값이 비어있습니다.");
        }

        // 댓글 권한
        $post = DB::fetch("SELECT * FROM sns_boards WHERE id = ?", [$pidx]);

		if (user()->idx == $post->uidx) {} else {
			$friend = DB::fetch("SELECT * FROM sns_friends WHERE ridx = ? AND qidx = ?", [user()->idx, $post->uidx]);
			if ($friend) {
				if ($post->c_distance != 1 && $post->c_distance != 2) {
					back("권한이 없습니다.");
				}
			} else {
				if ( $post->c_distance != 3 ) {
					back("권한이 없습니다.");
				}
			}
        }

        $update = DB::execute("UPDATE sns_boards SET commented = commented + 1 WHERE id = ?", [$pidx]);
        $update1 = DB::execute("UPDATE sns_users SET comment_cnt = comment_cnt + 1 WHERE idx = ?", [user()->idx]);

        // $datetime = $date . " " . ($time == "" ? "00:00:00" : $time . ":00");

        $sql = "INSERT INTO sns_comments (`uidx`, `pidx`, `content`, `writer`, `wdate`) VALUES(?, ?, ?, ?, NOW())";
        // $result = DB::execute($sql, [$content, $user->id, $datetime]);
        $result = DB::execute($sql, [$user->idx, $pidx, $comment, $user->name]);

        if(!$result || !$update || !$update1) {
            back("데이터베이스 입력중 오류 발생");
        }

        back("성공적으로 입력되었습니다.");
    }

    # 댓글 수정
    public function comment_modify() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}
    }

    # 댓글 삭제
    public function comment_delete() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}
        $user = $_SESSION['user'];
        $pidx = $_GET['id'];

        $update = DB::execute("UPDATE sns_boards SET commented = commented - 1 WHERE id = ?", [$pidx]);
        $update1 = DB::execute("UPDATE sns_users SET comment_cnt = comment_cnt - 1 WHERE idx = ?", [user()->idx]);

        $sql = DB::execute("DELETE FROM sns_comments WHERE pidx = ? AND uidx = ?", [$pidx, $user->idx]);
        
        if(!$update1 || !$update || !$sql) {
            back("데이터베이스 삭제 중 오류 발생");
        }

        back("댓글 삭제 완료");
    }

    # 글 좋아요
    public function like() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}
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

    # 글 검색
    // public function search() {
    //     // 비회원 접근 시
	// 	if(!user()) {
	// 		return view("login");
    //     }
        
    //     $user = $_SESSION['user'];

    //     $result = DB::fetchAll("SELECT * FROM sns_boards WHERE content = ?");
        
        
    // }

    # 글 공개범위
    public function distance() {
        // 비회원 접근 시
		if(!user()) {
			return view("login");
		}

        $writer = $_GET['writer'];
        $pidx = $_GET['pidx'];
        $distance = $_GET['distance'];

        if($writer != $_SESSION['user']->name) {
            back("권한이 없습니다.");
        }

        $result = DB::execute("UPDATE sns_boards SET distance = ? WHERE id = ?", [$distance, $pidx]);

        if(!$result) {
            back("데이터베이스 처리중 오류 발생");
        }

        if($distance == 1) {
            back("공개범위를 전체공개로 변경하였습니다.");
        } else if($distance == 2) {
            back("공개범위를 친구공개로 변경하였습니다.");
        } else if($distance == 3) {
            back("공개범위를 나만보기로 변경하였습니다.");
        } else {
            back("[오류] 다시 시도해 주세요.");
        }
    }
    

}
