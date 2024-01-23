<?php
session_start();
include("../db.php");
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}
if (!isset($_GET['category_id'])) {
  header("Location: categories.php");
  exit();
}
$category_id = $_GET['category_id'];
$sql = "SELECT * FROM tb_item WHERE category_id='$category_id'";
$result = $conn->query($sql);
if (!$result) {
  echo "Error: " . $conn->error;
  exit();
}
?>

<?php include('../components/header.php') ?>
<div class="bg-gray-50 min-h-screen p-4">
  <?php
  include("../db.php");
  if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
  }
  if (!isset($_GET['category_id'])) {
    header("Location: categories.php");
    exit();
  }
  $category_id = $_GET['category_id'];
  $sql = "SELECT * FROM tb_item WHERE category_id='$category_id'";
  $result = $conn->query($sql);
  if (!$result) {
    echo "Error: " . $conn->error;
    exit();
  }
  while ($row = $result->fetch_assoc()) :
  ?>
    <div class="grid md:flex justify-between items-center bg-white my-2 rounded md:w-[60%] mx-auto p-4 gap-4">
      <div class="flex items-center gap-4">
        <div class="w-[100px] h-20 bg-black"></div>
        <div class="grid">
          <p class="text-2xl font-bold"><?php echo $row['item_name']; ?></p>
          <p class="text-lg font-semibold">Rp<?php echo $row['item_price']; ?></p>
          <p><?php echo $row['item_desc']; ?></p>
        </div>
      </div>
      <div class="flex items-center gap-1">
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" onclick="decreaseQuantity(<?php echo $row['item_id']; ?>)">-</button>
        <span class="mx-2 text-center" id="quantity_<?php echo $row['item_id']; ?>">1</span>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" onclick="increaseQuantity(<?php echo $row['item_id']; ?>)">+</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" onclick="addToCart(<?php echo $row['item_id']; ?>, '<?php echo $row['item_name']; ?>')">Tambah ke Keranjang</button>
      </div>
    </div>
  <?php endwhile; ?>
  <div class="mx-auto flex justify-end md:w-[60%]">
    <a href="cart.php">
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Lihat Keranjang</button>
    </a>
  </div>
  <script>
    var itemQuantities = {};

    function increaseQuantity(itemId) {
      var quantityElement = document.getElementById('quantity_' + itemId);
      if (quantityElement) {
        var currentQuantity = parseInt(quantityElement.innerText);
        quantityElement.innerText = currentQuantity + 1;
        itemQuantities[itemId] = currentQuantity + 1;
      }
    }

    function decreaseQuantity(itemId) {
      var quantityElement = document.getElementById('quantity_' + itemId);
      if (quantityElement) {
        var currentQuantity = parseInt(quantityElement.innerText);
        if (currentQuantity > 1) {
          quantityElement.innerText = currentQuantity - 1;
          itemQuantities[itemId] = currentQuantity - 1;
        }
      }
    }

    function addToCart(itemId, itemName) {
      var quantity = itemQuantities[itemId] || 1;
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "addToCart.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          alert(itemName + " (" + quantity + ") successfully added to cart!");
        }
      };
      xhr.send("item_id=" + itemId + "&quantity=" + quantity);
    }
  </script>
</div>
<?php include('../components/footer.php') ?>