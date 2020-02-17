<?php
use src\App\DB;

function view($url, $data = []) {
	extract($data);

	require "../src/Views/_template/header.php";
	require "../src/Views/$url.php";
	require "../src/Views/_template/footer.php";
}

function move($url, $msg = "") {
	if($msg != "") echo "<script>alert('" . $msg . "')</script>";
	echo "<script>location.href='$url';</script>";
	exit;			
}

function back($msg = "") {
	if($msg != "") echo "<script>alert('" . $msg . "')</script>";
	echo "<script>history.back();</script>";
	exit;
}

user();
// 유저 정보 갖고오기 & 저장
function user($idx = 0) {
	if ( !isset($_SESSION['user']) && isset($_COOKIE['user']) ) {
		$_SESSION['user'] = DB::fetch("SELECT * FROM sns_users WHERE idx = ?", [$_COOKIE['user']]);
	}

	if($idx == 0) {
		if(isset($_SESSION['user'])) {
			$user = DB::fetch("SELECT * FROM sns_users WHERE idx = ?", [$_SESSION['user']->idx]);
			if($user) {
				return $user;
			} else {
				unset($_SESSION['user']);
				move("/", "로그아웃 되었습니다.");
			}
		}
		return false;
	} else {
		$user = DB::fetch("SELECT * FROM sns_users WHERE idx = ?", [$idx]);
		if($user) {
			return $user;
		} else {
			return false;
		}
	}
}

function text($text, $type = false) {
	$text = htmlspecialchars($text);
	$text = str_replace(" ", "&nbsp;", $text);
	if($type) $text = str_replace("\n", "<br>", $text);

	return $text;
}

function isEmpty($arr) {
	$arr = array_map("trim", $arr);
	if(in_array("", $arr)) return true;
	else return false;
}

function toScript($vName, $dName) {
	echo '<script> let ' . $vName . ' = ' . json_encode($dName) . ';</script>';
}

function json($value) {
    header('Content-Type: application/json');
    echo json_encode($value);
    exit;
}

function arr_sort($array, $key, $sort='asc') {
	$keys = array();
	$vals = array();

	foreach ($array as $k => $v) {
	 	$i = $v->$key.'.'.$k;
		$vals[$i] = $v;
		array_push($keys, $k);
	}
	unset($array);
	if ($sort=='asc') {
		ksort($vals);
	} else {
		krsort($vals);
	}
	$ret = array_combine($keys, $vals);
	unset($keys);
	unset($vals);
	return $ret;
}

function arr_unique($array) {
	return array_map("unserialize", array_unique(array_map("serialize", $array)));
}

function p_img_resize($file, $filename) {
	list($w, $h) = getimagesize($file);
	$ratio = $w / $h;

	if ( $w > $h ) {
		$newW = 128 * $ratio;
		$newH = 128;
	} else if ( $w < $h ) {
		$newW = 128 / $ratio;
		$newH = 128;
	} else {
		$newW = 128;
		$newH = 128;
	}

	$extension = explode(".", $file)[1];
	switch($extension) {
		case "jpeg":
		case "jpg":
			$img = imagecreatefromjpeg($file);
			break;
		case "png":
			$img = imagecreatefrompng($file);
			break;
		case "gif":
			$img = imagecreatefromgif($file);
			break;
		case "bmp":
			$img = imagecreatefromgd($file);
			break;
		case "wbmp":
			$img = imagecreatefromwbmp($file);
			break;
	}

	$result = imagecreatetruecolor($newW, $newH);
	imagecopyresampled($result, $img, 0, 0, 0, 0, $newW, $newH, $w, $h);

	switch($extension) {
		case "jpeg":
		case "jpg":
			imagejpeg($result, "newFile/" . $filename, 9);
			break;
		case "png":
			imagepng($result, "newFile/" . $filename, 9);
			break;
		case "gif":
			imagegif($result, "newFile/" . $filename, 9);
			break;
		case "bmp":
			imagegd($result, "newFile/" . $filename, 9);
			break;
		case "wbmp":
			imagewbmp($result, "newFile/" . $filename, 9);
			break;
	}

	return $result;
}

?>
