كل صورة وحدها هو أن المتغير  $getFile  يتم تعيينه في كل تكرار من حلقة foreach ويتم استخدام القيمة الأخيرة للتكرار في عرض الصورة في العلامة  <img> ، لذلك سيتم عرض صورة واحدة فقط.

لحل هذه المشكلة، يجب تخزين جميع الصور المسترجعة من قاعدة البيانات في مصفوفة واحدة، ثم استخدام حلقة foreach لعرض كل صورة بشكل منفصل في العلامة  <img> .

هذا هو الكود المعدل:


<?php 
include_once('conn.php');

$myFiles = $database->prepare("SELECT * FROM files WHERE fileType = 'image/png' ");
$myFiles->execute();

$files = array(); // مصفوفة لتخزين جميع الصور المسترجعة
foreach($myFiles AS $data){
  $getFile = "data:" . $data['fileType'] . ";base64,".base64_encode($data['file']);
  $files[] = $getFile; // إضافة كل صورة إلى المصفوفة
}

if(isset($_POST['upload'])){
  $fileName = $_FILES['file']["name"];
  $fileType = $_FILES['file']["type"];
  $fileData = file_get_contents($_FILES['file']["tmp_name"]);

  $addFile = $database->prepare("INSERT INTO files(file,fileName,fileType) 
  VALUES(:file ,:fileName,:fileType)");

  $addFile->bindParam("file",$fileData);
  $addFile->bindParam("fileName",$fileName);
  $addFile->bindParam("fileType",$fileType);

  if($addFile->execute()){
    echo 'تم حفظ ملف';
  } else {
    echo 'فشل تخزين ملف';
  }
}

$sql = $database->prepare("SELECT * FROM files" );
$sql->execute();
echo $sql->rowCount(); 

?>

<!-- عرض الصور -->
<?php foreach($files as $file): ?>
  <li><img src="<?php echo $file; ?>" width="300px" /></li>
