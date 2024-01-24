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
  <h2 class="text-3xl font-bold mb-4">Admin Dashboard - Categories</h2>
  <a href="admin_dashboard_item.php" class="bg-green-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Menu Item</a>
  <a href="admin_create_category.php" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4 inline-block">Create Category</a>
  <?php
  $categoriesResult = $conn->query("SELECT * FROM tb_category");
  while ($category = $categoriesResult->fetch_assoc()) :
  ?>
    <div class="flex items-center bg-white p-6 rounded-md shadow-md mb-4">
      <?php if (!empty($category['category_image'])) : ?>
        <img src="<?php echo $category['category_image']; ?>" alt="Category Image" class="object-cover w-16 h-16 mr-4 rounded-md">
      <?php else : ?>
        <div class="w-16 h-16 bg-black rounded-md mr-4"></div>
      <?php endif; ?>
      <div>
        <p class="text-xl font-semibold mb-2">
          <?php echo $category['category_name']; ?>
        </p>
      </div>
      <div class="ml-auto flex space-x-2">
        <a href="admin_update_category.php?category_id=<?php echo $category['category_id']; ?>" class="bg-green-500 text-white py-2 px-4 rounded-md">Update</a>
        <a href="admin_delete_category.php?category_id=<?php echo $category['category_id']; ?>" class="bg-red-500 text-white py-2 px-4 rounded-md">Delete</a>
      </div>
    </div>
  <?php endwhile; ?>
  <a href="admin_logout.php" class="bg-gray-500 text-white py-2 px-4 rounded-md inline-block mt-4">Logout</a>
</div>
<?php include('../components/footer.php') ?>