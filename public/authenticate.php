<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM tb_user WHERE user_name='$username' AND user_pass='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['user_id'];
    header("Location: categories.php");
  } else {
    echo "Invalid username or password";
  }
}
$conn->close();
?>