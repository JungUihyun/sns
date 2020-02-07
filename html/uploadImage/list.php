
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
include "../include/db_connect.php";
$result = $db_inet->query("select * from test_bbs");

echo "<table border=1>";
while($row = $result->fetch_assoc()) {
	echo "<tr>";
	echo "<td>".$row['bbsNo']."</td>";
	echo "<td>".$row['id']."</td>";
	echo "<td><a href='view.php?bbsno=".$row['bbsNo']."'>".$row['content']."</a></td>";
	echo "<td>".$row['regdate']."</td>";
	echo "</tr>";
}

?>