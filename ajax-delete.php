<?php

$admin_id = $_POST["id"];

$conn = mysqli_connect("localhost","root","","adminrol") or die("Connection Failed");

$sql = "DELETE FROM admin_user WHERE id = {$admin_id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
