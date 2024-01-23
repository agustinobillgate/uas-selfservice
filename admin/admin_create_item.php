<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item_name = $_POST['item_name'];
  $item_price = $_POST['item_price'];
  $category_id = $_POST['category_id'];
  $item_desc = $_POST['item_desc'];
  if ($_FILES['item_image']['size'] > 0 && getimagesize($_FILES['item_image']['tmp_name'])) {
    $uploadDirectory = "../assets/img/";
    if (!file_exists($uploadDirectory)) {
      mkdir($uploadDirectory, 0777, true);
    }
    $fileName = uniqid() . "_" . $_FILES['item_image']['name'];
    $filePath = $uploadDirectory . $fileName;
    move_uploaded_file($_FILES['item_image']['tmp_name'], $filePath);
    $item_image = $filePath;
  } else {
    $item_image = null;
  }
  $sql = "INSERT INTO tb_item (item_name, item_price, category_id, item_image, item_desc) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssiss", $item_name, $item_price, $category_id, $item_image, $item_desc);
  $stmt->execute();
  $stmt->close();

  header("Location: admin_dashboard_item.php");
}
?>

<?php include('../components/header.php') ?>
<div class="container mx-auto my-8">
  <h2 class="text-3xl font-bold mb-4">Create Item</h2>
  <form action="" method="post" enctype="multipart/form-data" class="max-w-md bg-white p-6 rounded-md shadow-md">
    <div class="mb-4">
      <label for="item_name" class="block text-gray-600 text-sm font-semibold mb-2">Item Name:</label>
      <input type="text" name="item_name" required class="w-full px-3 py-2 border rounded-md">
    </div>
    <div class="mb-4">
      <label for="item_price" class="block text-gray-600 text-sm font-semibold mb-2">Item Price:</label>
      <input type="text" name="item_price" required class="w-full px-3 py-2 border rounded-md">
    </div>
    <div class="mb-4">
      <label for="category_id" class="block text-gray-600 text-sm font-semibold mb-2">Category:</label>
      <select name="category_id" required class="w-full px-3 py-2 border rounded-md">
        <?php
        $categories = $conn->query("SELECT * FROM tb_category");
        while ($category = $categories->fetch_assoc()) :
        ?>
          <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-4">
      <label for="item_desc" class="block text-gray-600 text-sm font-semibold mb-2">Item Description:</label>
      <textarea name="item_desc" rows="4" required class="w-full px-3 py-2 border rounded-md"></textarea>
    </div>
    <div class="mb-4">
      <label for="item_image" class="block text-gray-600 text-sm font-semibold mb-2">Item Image:</label>
      <input type="file" name="item_image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Create Item</button>
  </form>
</div>
<?php include('../components/footer.php') ?>
