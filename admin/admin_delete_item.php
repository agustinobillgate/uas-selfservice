<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
$item_id = $_GET['item_id'];
$sql = "DELETE FROM tb_item WHERE item_id = $item_id";
$conn->query($sql);
header("Location: admin_dashboard_item.php");
?>