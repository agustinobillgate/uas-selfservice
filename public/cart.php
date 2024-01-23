<?php
session_start();
include("../db.php");
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}
$user_id = $_SESSION['user_id'];
$cartSql = "SELECT tb_cart.quantity, tb_item.item_name, tb_item.item_price, tb_item.item_desc FROM tb_cart INNER JOIN tb_item ON tb_cart.item_id = tb_item.item_id WHERE tb_cart.user_id = '$user_id'";
$cartResult = $conn->query($cartSql);
$overallTotal = 0;
$itemTotals = array();
while ($cartItem = $cartResult->fetch_assoc()) {
  $itemTotal = $cartItem['quantity'] * $cartItem['item_price'];
  $overallTotal += $itemTotal;
  $itemTotals[$cartItem['item_name']] = array(
    'quantity' => $cartItem['quantity'],
    'price' => $cartItem['item_price'],
    'total' => $itemTotal
  );
}
?>

<?php include('../components/header.php') ?>
<div class="bg-gray-50 min-h-screen p-4">
  <div class="md:w-[40%] mx-auto">
    <div class="bg-white p-4 rounded">
      <h2 class="text-2xl font-bold text-center mb-6">Rincian Keranjang</h2>
      <table class="w-full">
        <tr>
          <th class="text-left">Menu</th>
          <th class="text-right">Jumlah</th>
          <th class="text-right">Harga</th>
          <th class="text-right">Subtotal</th>
        </tr>
        <?php foreach ($itemTotals as $itemName => $itemDetails) : ?>
          <tr>
            <td class="text-left"><?php echo $itemName; ?></td>
            <td class="text-right"><?php echo $itemDetails['quantity']; ?></td>
            <td class="text-right"><?php echo $itemDetails['price']; ?></td>
            <td class="text-right"><?php echo $itemDetails['total']; ?></td>
          </tr>
        <?php endforeach; ?>
        <tr class="border-t">
          <td colspan="2"></td>
          <td>
            <h3 class="text-right text-lg font-bold">Total: </h3>
          </td>
          <td>
            <h3 class="text-right text-lg font-bold"><?php echo $overallTotal; ?>
          </td>
        </tr>
      </table>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="checkout()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Bayar</button>
      <a href="items.php" class="block text-sm font-medium text-green-500">Kembali ke halaman awal</a>
    </div>
  </div>
  <script>
    function checkout() {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "clearCart.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          window.location.href = "clearCart.php";
        }
      };
      xhr.send();
    }
  </script>
</div>
</div>
<?php include('../components/footer.php') ?>