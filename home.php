<?php 
include_once('conn.php');

$sql = $database->prepare("SELECT * FROM files WHERE id = 4 ");
$sql->execute();
$data = $sql->fetch(); // استرداد صف واحد فقط

if ($data) {
  $getFile = "data:" . $data['fileType'] . ";base64,".base64_encode($data['file']);
  echo '<img src="'.$getFile.'" width="300px" />';
  echo '<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos at commodi ut fugit ipsa culpa nisi fuga alias quam deleniti delectus, optio, laborum in beatae architecto, eius laboriosam sed quidem?</p>';
} else {
  echo 'لم يتم العثور على أي صور.';
}

?>

