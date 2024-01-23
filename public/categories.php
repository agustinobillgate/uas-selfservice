<?php
session_start();
include("../db.php");
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}
$sql = "SELECT * FROM tb_category";
$result = $conn->query($sql);
?>

<?php include('../components/header.php') ?>
<div class="bg-gray-50 min-h-screen p-4">
  <div class="bg-white p-10 rounded-lg shadow-md md:w-[60%] mx-auto mb-6">
    <div class="flex justify-between">
      <h2 class="text-2xl font-bold">Selamat Datang, <br> Mau Pesan apa hari ini?</h2>
      <a href="logout.php" class="block text-sm font-medium text-red-500">Logout</a>
    </div>
  </div>
  <div class="grid grid-cols-3 gap-4 md:w-[60%] mx-auto">
    <?php while ($row = $result->fetch_assoc()) : ?>
      <a href="items.php?category_id=<?php echo $row['category_id']; ?>" class="relative group">
        <img src="<?php echo $row['category_image']; ?>" class="w-full h-auto transform scale-100 group-hover:scale-105 transition-transform duration-300">
        <div class="absolute inset-0 rounded bg-black bg-opacity-50 opacity-100 group-hover:opacity-200 transition-opacity transform scale-100 group-hover:scale-105 transition-transform duration-300 flex items-center justify-center">
          <span class="text-white text-lg font-bold"><?php echo $row['category_name']; ?></span>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</div>
<?php include('../components/footer.php') ?>