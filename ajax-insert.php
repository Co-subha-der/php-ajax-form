<?php

$user_name = $_POST["user_name"];
$pass_word = $_POST["pass_word"];
$role_n= $_POST["role_n"] ;

$conn = mysqli_connect("localhost","root","","adminrol") or die("Connection Failed");

$sql = "INSERT INTO admin_user(username, password, role) VALUES('{$user_name}','{$pass_word}','{$role_n}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}


?>
