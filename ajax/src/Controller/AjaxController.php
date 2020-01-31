<?php
namespace src\Controller;

use src\App\DB;

class AjaxController {
	public function index() {
		return view("ajax");
	}

	public function load() {
		$start = $_GET['start'];
		$sql = "SELECT * FROM boards LIMIT $start, 5";
		$list = DB::fetchAll($sql);

		echo json_encode($list, JSON_UNESCAPED_UNICODE);
	}
}
?>