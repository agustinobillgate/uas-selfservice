<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $admin_username = $_POST['admin_username'];
  $admin_password = $_POST['admin_password'];
  $sql = "SELECT * FROM tb_admin WHERE admin_username = '$admin_username' AND admin_password = '$admin_password'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $_SESSION['admin_id'] = $result->fetch_assoc()['admin_id'];
    header("Location: admin_dashboard.php");
  } else {
    echo "Invalid admin credentials.";
  }
}
$conn->close();
?>