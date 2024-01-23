<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
$category_id = $_GET['category_id'];
$checkItemsQuery = "SELECT COUNT(*) AS total_items FROM tb_item WHERE category_id = $category_id";
$result = $conn->query($checkItemsQuery);
$row = $result->fetch_assoc();
$totalItems = $row['total_items'];
if ($totalItems > 0) {
  header("Location: admin_dashboard_category.php?error=category_has_items");
  exit();
}
$deleteCategoryQuery = "DELETE FROM tb_category WHERE category_id = $category_id";
$conn->query($deleteCategoryQuery);
header("Location: admin_dashboard_category.php");
?>