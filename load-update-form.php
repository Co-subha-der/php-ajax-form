<?php

$userId = $_POST["id"];

$conn = mysqli_connect("localhost","root","", "adminrol") or die("Connection Failed");

$sql = "SELECT * FROM admin_user WHERE id = {$userId}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>UserName</td>
      <td><input type='text' id='edit-username' value='{$row["username"]}'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}'>
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type='text' id='edit-password' value='{$row["password"]}'></td>
    </tr>
    <tr>
      <td>Role</td>
      <td><input type='text' id='edit-role' value='{$row["role"]}'></td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
