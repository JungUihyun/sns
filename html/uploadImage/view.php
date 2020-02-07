<?
$bbsno = $_GET['bbsno'];
include "../include/db_connect.php";
$result = $db_inet->query("select * from test_bbs where bbsNo=".$bbsno);
$row = $result->fetch_assoc();

$result = $db_inet->query("select * from test_image where bbsNo=".$bbsno);
$row2 = $result->fetch_assoc();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>게시물 보기</title>
</head>
<body>
<table>
<tr>
	<td>번호</td>
	<td><?=$row['bbsNo'];?></td>
</tr>
<tr>
	<td>아이디</td>
	<td><?=$row['id'];?></td>
</tr>
<tr>
	<td>내용</td>
	<td><?=$row['content'];?></td>
</tr>
<tr>
	<td>작성시간</td>
	<td><?=$row['regdate'];?></td>
</tr>
<tr>
	<td>이미지</td>
	<td>
<?
if(!empty($row2)) 
	echo "<img src='".$row2['path'].$row2['filename']."' />";
else 
	echo "이미지 없음";
?>
	</td>
</tr>
</table>
<p><b>전송완료</b></p>
<p><a href='list.php'>목록가기</a></p>
</body>
</html>
