<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
?>

<?php include('../components/header.php') ?>
<div class="container mx-auto my-8">
  <h2 class="text-3xl font-bold mb-4">Admin Dashboard - Items</h2>
  <a href="admin_create_item.php" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Create Item</a>
  <?php
  $itemsResult = $conn->query("SELECT * FROM tb_item");
  while ($item = $itemsResult->fetch_assoc()) :
  ?>
    <div class="flex items-center bg-white p-6 rounded-md shadow-md mb-4">
      <?php if (!empty($item['item_image'])) : ?>
        <img src="<?php echo $item['item_image']; ?>" alt="Item Image" class="object-cover w-16 h-16 mr-4 rounded-md">
      <?php else : ?>
        <div class="w-16 h-16 bg-black rounded-md mr-4"></div>
      <?php endif; ?>
      <div>
        <p class="text-xl font-semibold mb-2">
          <?php echo $item['item_name']; ?><br> Rp<?php echo $item['item_price']; ?>
        </p>
        <p class="text-gray-600 mb-4"><?php echo $item['item_desc']; ?></p>
      </div>
      <div class="ml-auto flex space-x-2">
        <a href="admin_update_item.php?item_id=<?php echo $item['item_id']; ?>" class="bg-green-500 text-white py-2 px-4 rounded-md">Update</a>
        <a href="admin_delete_item.php?item_id=<?php echo $item['item_id']; ?>" class="bg-red-500 text-white py-2 px-4 rounded-md">Delete</a>
      </div>
    </div>
  <?php endwhile; ?>
  <a href="admin_logout.php" class="bg-gray-500 text-white py-2 px-4 rounded-md inline-block mt-4">Logout</a>
</div>
<?php include('../components/footer.php') ?>