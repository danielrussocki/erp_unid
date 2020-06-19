<?php
print_r($_POST);
print_r($_FILES);
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']["tmp_name"];
$name = $_FILES['file']["name"];
$nuevo_path = "./assets/".$name;
move_uploaded_file($tmp_name, $nuevo_path);
$array = explode('.', $nuevo_path);
$ext = end($array);
?>