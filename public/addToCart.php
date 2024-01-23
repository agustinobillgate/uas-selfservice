<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST['item_id'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $checkSql = "SELECT * FROM tb_cart WHERE user_id='$user_id' AND item_id='$item_id'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
      $existingQuantity = $checkResult->fetch_assoc()['quantity'];
      $newQuantity = $existingQuantity + $quantity;
      $updateSql = "UPDATE tb_cart SET quantity='$newQuantity' WHERE user_id='$user_id' AND item_id='$item_id'";
      if ($conn->query($updateSql) === TRUE) {
        echo $newQuantity;
      } else {
        echo "Error updating item quantity in the cart: " . $conn->error;
      }
    } else {
      $insertSql = "INSERT INTO tb_cart (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
      if ($conn->query($insertSql) === TRUE) {
        echo $quantity;
      } else {
        echo "Error adding item to the cart: " . $conn->error;
      }
    }
  } else {
    echo "User not logged in.";
  }
}
$conn->close();
?>