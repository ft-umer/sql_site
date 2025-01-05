<?php
session_start();
include('db_conn.php'); // Include your database connection file

$error = '';
if (isset($_POST['submit'])) {
    // Escape user inputs to prevent SQL injection
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Query to check if the user exists
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // Redirect to the homepage
                header("Location: index.php");
                exit;
            } else {
                $error = "<span class='error text-[red]'>ghlt password hy boss.</span>";
            }
        } else {
            $error = "<span class='error text-[red]'>is email py koi account nai mila boss</span>";
        }
    } else {
        $error = "<span class='error text-[red]'>All fields are required.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Luxury Haven Hotel</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-sans bg-gray-50">
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-blue-900">Luxury Haven</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    
                    <a href="signup.php" class="text-gray-700 hover:text-blue-900">Sign Up</a>
                    <a href="admin.php" class="text-gray-700 hover:text-blue-900">Admin Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg mt-[5rem]">
            <div>
                <h2 class="text-3xl font-bold text-center text-gray-900">Welcome Back</h2>
                <p class="mt-2 text-center text-gray-600">Please sign in to your account</p>
                <span><?php echo $error; ?></span>
            </div>
            <form class="mt-8 space-y-6" id="signinForm" action="" method="post">
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 text-blue-900 focus:ring-blue-900 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-blue-900 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" name="submit"
                    class="w-full bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition duration-300">
                    Sign In
                </button>
            </form>
            <p class="text-center text-sm text-gray-600">
                Don't have an account? 
                <a href="signup.php" class="text-blue-900 hover:underline">Sign up</a>
            </p>
        </div>
    </div>
</body>
</html>