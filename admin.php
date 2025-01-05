<?php
session_start();
include('db_conn.php'); // Include database connection file

$error = '';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the admins table
    $query = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Store admin information in the session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            // Redirect to the admin panel
            header("Location: admin_panel.php");
            exit;
        } else {
            $error = "<span class='error text-[red]'>Incorrect password.</span>";
        }
    } else {
        $error = "<span class='error text-[red]>'No account found with this email.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Cresta Restaurant</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-blue-900">Luxury Haven</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                   
                    <a href="signin.php" class="text-gray-700 hover:text-blue-900">Sign In</a>
                    <a href="admin.php" class="text-gray-700 hover:text-blue-900">Admin Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg mt-[5rem]">
            <div>
                <h2 class="text-3xl font-bold text-center text-gray-900">Admin Login</h2>
                <span><?php echo $error; ?></span>
            </div>
            <form class="mt-8 space-y-6" action="" method="post">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                </div>
                <button type="submit" name="submit"
                    class="w-full bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
