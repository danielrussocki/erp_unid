<?php
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']["tmp_name"];
$name = $_FILES['file']["name"];
$nuevo_path = "../assets/cvs/".$name;
move_uploaded_file($tmp_name, $nuevo_path);
$array = explode('.', $nuevo_path);
$ext = end($array);
// if ($_FILES['file']['size'] == 0 && $_FILES['file']['error'] == 0)
// {
//     // cover_image is empty (and not an error)
//     // print_r($_FILES);
// }
?>