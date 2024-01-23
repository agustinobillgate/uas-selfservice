<?php include('components/header.php') ?>
<div class="bg-gray-50 min-h-screen flex items-center justify-center">
  <div class="bg-white p-10 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">User Login</h2>
    <form action="public/authenticate.php" method="post">
      <div class="grid gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600" for="username">Username:</label>
          <input class="mt-1 p-4 border rounded w-full focus:outline-none focus:border-blue-500" type="text" name="username" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600" for="password">Password:</label>
          <input class="mt-1 p-4 border rounded w-full focus:outline-none focus:border-blue-500" type="password" name="password" required>
        </div>
        <div class="flex justify-between items-center">
          <a href="admin/admin_login.php" class="block text-sm font-medium text-green-500">Login as Admin</a>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include('components/footer.php') ?>