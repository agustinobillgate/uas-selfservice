<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
$item_id = $_GET['item_id'];
$checkItemsQuery = "SELECT COUNT(*) AS total_items FROM tb_item WHERE item_id = $item_id";
$result = $conn->query($checkItemsQuery);
$row = $result->fetch_assoc();
$totalItems = $row['total_items'];
if ($totalItems > 0) {
  header("Location: admin_dashboard_item.php?error=item_has_items");
  exit();
}
$deleteitemQuery = "DELETE FROM tb_item WHERE item_id = $item_id";
$conn->query($deleteitemQuery);
header("Location: admin_dashboard_item.php");
?>