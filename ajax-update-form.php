<?php

$userId = $_POST["id"];
$username = $_POST["Username"];
$password = $_POST["Password"];
$role = $_POST["Role"];

$conn = mysqli_connect("localhost","root","", "adminrol") or die("Connection Failed");

$sql = "UPDATE admin_user SET username = '{$username}',password = '{$password}', role = '{$role}' WHERE id = {$userId}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
