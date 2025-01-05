<?php
include('db_conn.php');

$info = '';

if (isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate passwords
    if ($password !== $confirmPassword) {
        $info = "<span class='error text-[red]'>passwords aik dsry sy mushabeh nai hn</span>";
    } elseif (strlen($password) < 8) {
        $info = "<span class='error text-[red]'>password k 8 lfz puray kren Shukria!</span> ";
    } else {
        // Check if email already exists
        $checkEmailQuery = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            $info = "<span class='error text-[red]'>yh email pehlay e register hy boss</span>";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Attempt to insert user into the database
            $insertQuery = "INSERT INTO users (first_name, last_name, email, phone, password) 
                            VALUES ('$firstName', '$lastName', '$email', '$phone', '$hashedPassword')";

            try {
                if ($conn->query($insertQuery) === TRUE) {
                    // Redirect to the sign-in page
                    header("Location: signin.php");
                    exit;
                } else {
                    $info = "<span class='error text-[red]'>Error during registration:"  . $conn->error. "</span>";
                }
            } catch (mysqli_sql_exception $e) {
                $info = "<span class='error text-[red]'>Error: " . $e->getMessage()."</span>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Luxury Haven Hotel</title>
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
                    
                    <a href="signin.php" class="text-gray-700 hover:text-blue-900">Sign In</a>
                    <a href="admin.php" class="text-gray-700 hover:text-blue-900">Admin Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg mt-[6rem]">
            <div>
                <h2 class="text-3xl font-bold text-center text-gray-900">Create Account</h2>
                <p class="mt-2 text-center text-gray-600">Join Luxury Haven for exclusive benefits</p>
            </div>
            <span><?php echo $info; ?></span>
            <form class="mt-8 space-y-6" id="signupForm" action="" method="post">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="firstName" name="firstName" required
                            class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required
                            class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                    <p class="mt-1 text-sm text-gray-500">Must be at least 8 characters long</p>
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required
                        class="mt-1 w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                </div>
                <button type="submit" name="submit"
                    class="w-full bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition duration-300">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="signin.php" class="text-blue-900 hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</body>

</html>