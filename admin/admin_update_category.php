<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
include("../db.php");
$category_id = $_GET['category_id'];
$categoryResult = $conn->query("SELECT * FROM tb_category WHERE category_id = $category_id");
$category = $categoryResult->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $category_name = $_POST['category_name'];
  if ($_FILES['category_image']['size'] > 0 && getimagesize($_FILES['category_image']['tmp_name'])) {
    $uploadDirectory = "../assets/img/";
    if (!file_exists($uploadDirectory)) {
      mkdir($uploadDirectory, 0777, true);
    }
    $fileName = uniqid() . "_" . $_FILES['category_image']['name'];
    $filePath = $uploadDirectory . $fileName;
    move_uploaded_file($_FILES['category_image']['tmp_name'], $filePath);
    $category_image = $filePath;
  } else {
    $category_image = $category['category_image'];
  }
  $sql = "UPDATE tb_category SET category_name = ?, category_image = ? WHERE category_id = $category_id";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $category_name, $category_image);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_dashboard_category.php");
}
?>

<?php include('../components/header.php') ?>
<div class="container mx-auto my-8">
  <h2 class="text-3xl font-bold mb-4">Update Category</h2>
  <form action="" method="post" enctype="multipart/form-data" class="max-w-md bg-white p-6 rounded-md shadow-md">
    <div class="mb-4">
      <label for="category_name" class="block text-gray-600 text-sm font-semibold mb-2">Category Name:</label>
      <input type="text" name="category_name" value="<?php echo $category['category_name']; ?>" required class="w-full px-3 py-2 border rounded-md">
    </div>
    <div class="mb-4">
      <label for="category_image" class="block text-gray-600 text-sm font-semibold mb-2">Category Image:</label>
      <input type="file" name="category_image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Update Category</button>
  </form>
</div>
<?php include('../components/footer.php') ?>