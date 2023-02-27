<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
<body>
<?php

include_once('conn.php');

$sql =$database->prepare("SELECT * FROM articles "); 
$sql->execute();

foreach($sql AS $result){
  echo '<div class="card text-white bg-danger mb-3 float-left m-3" style="max-width: 18rem;">
  <div class="card-header">' .$result["id"] . ' </div>
  <div class="card-body">
    <h5 class="card-title"> ' .$result["Title"] . '</h5>
    <p class="card-text">' . $result["Content"] .' </p>
  </div>
</div>
';
// echo "<h1>" . $result['Title'] . "</h1>";
// echo "<p>" . $result['Text'] . "</p>";
}

  
?>