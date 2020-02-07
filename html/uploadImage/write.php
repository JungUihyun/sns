<?php

$id = $_POST['id'];
$content = $_POST['content'];

include "../include/db_connect.php";

$query = "insert into test_bbs (id,content) values('$id','$content')";

$db_inet->query($query);

$bbsid = $db_inet->insert_id;

//$path = $_SERVER['DOCUMENT_ROOT'].'/testBBS/';
$path = "/testBBS/";
$filename =  date("YmdHis").".jpg";
move_uploaded_file($_FILES['imageform']['tmp_name'], $filename);

$query = "insert into test_image (bbsNo,path,filename) values ($bbsid, '$path','$filename')";

$db_inet->query($query);

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>게시물 작성 예제 폼</title>
</head>
<body>
<table>
<tr>
	<td>전송아이디:</td>
	<td><?=$id;?></td>
</tr>
<tr>
	<td>전송내용:</td>
	<td><?=$content;?></td>
</tr>
<tr>
	<td>전송이미지</td>
	<td><img src="<?=$path.$filename;?>" /></td>
</tr>
</table>
<p><b>전송완료</b></p>
<p><a href='list.php'>목록가기</a></p>
</body>
</html>