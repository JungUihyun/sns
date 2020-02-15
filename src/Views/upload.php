<?php

header("Content-Type: application/json");

$file = $_FILES['upImage'];

move_uploaded_file($file['tmp_name'], "/" . "newFile/" . $file['name']);

echo json_encode(['success'=>true, 'name'=>$file['name']]);

?>