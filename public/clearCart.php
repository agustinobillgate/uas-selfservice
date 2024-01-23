<?php
session_start();
include("../db.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$clearCartSql = "DELETE FROM tb_cart WHERE user_id = '$user_id'";
if ($conn->query($clearCartSql) === TRUE) {
    echo "Terimakasih sudah bertransaksi!";
} else {
    echo "Error clearing the cart: " . $conn->error;
}
$conn->close();
?>