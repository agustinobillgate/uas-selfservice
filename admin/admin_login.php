<?php include('../components/header.php') ?>
<div class="bg-gray-50 min-h-screen flex items-center justify-center">
  <div class="bg-white p-10 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <form action="admin_process_login.php" method="post">
      <div class="grid gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600" for="admin_username">Username:</label>
          <input class="mt-1 p-4 border rounded w-full focus:outline-none focus:border-blue-500" type="text" name="admin_username" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600" for="admin_password">Password:</label>
          <input class="mt-1 p-4 border rounded w-full focus:outline-none focus:border-blue-500" type="password" name="admin_password" required>
        </div>
        <div class="flex justify-between items-center">
          <a href="../index.php" class="block text-sm font-medium text-green-500">Login as User</a>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include('../components/footer.php') ?>