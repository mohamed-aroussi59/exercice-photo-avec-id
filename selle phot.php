
لجلب صورة واحدة بدون تكرار، يمكنك استخدام الدالة fetch() بدلاً من foreach() لاسترداد صف واحد من قاعدة البيانات.

هذا هو مثال بسيط لجلب صورة واحدة باستخدام PDO:

<?php 
include_once('conn.php');

$sql = $database->prepare("SELECT * FROM files WHERE id = '57'");
$sql->execute();
$data = $sql->fetch(); // استرداد صف واحد فقط

if ($data) {
  $getFile = "data:" . $data['fileType'] . ";base64,".base64_encode($data['file']);
  echo '<img src="'.$getFile.'" width="300px" />';
} else {
  echo 'لم يتم العثور على أي صور.';
}
?>

تم استخدام LIMIT 1 في الاستعلام لجلب صف واحد فقط، وإذا لم يتم العثور على أي صور يتم عرض رسالة تفيد بذلك.

لاحظ أنه يمكنك تعديل شرط WHERE في الاستعلام لتحديد الصورة التي تريد جلبها بناءً على المعلومات الموجودة في قاعدة البيانات.