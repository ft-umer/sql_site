<?php
session_start();
include('db_conn.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$user = $_SESSION['user_id'];

$query = "SELECT * FROM bookings WHERE user_id = '$user'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Rooms - Hotel Management System</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-900"><a href="index.php">Luxury Haven</a></h1>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-blue-900">Home</a>
                    <a href="rooms.php" class="text-gray-700 hover:text-blue-900">Rooms</a>
                    <a href="index.php#amenities" class="text-gray-700 hover:text-blue-900">Amenities</a>
                    <a href="index.php#gallery" class="text-gray-700 hover:text-blue-900">Gallery</a>
                    <a href="index.php#contact" class="text-gray-700 hover:text-blue-900">Contact</a>
                    <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
                </div>

                <button class="md:hidden flex items-center" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="index.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Home</a>
                <a href="rooms.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Rooms</a>
                <a href="index.php#amenities" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Amenities</a>
                <a href="index.php#gallery" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Gallery</a>
                <a href="index.php#contact" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Contact</a>
                <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
            </div>
        </div>
    </nav>

    <section class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Booked Rooms</h1>
        <?php if (mysqli_num_rows($result) == 0): ?>
        <p class="text-xl text-gray-700">You have not booked any rooms yet.</p>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-blue-900 text-white hover:bg-blue-800 transition">
                    <tr>
                        <th class="px-6 py-4 text-left">Room Image</th>
                        <th class="px-6 py-4 text-left">Room Type</th>
                        <th class="px-6 py-4 text-left">Check-In Date</th>
                        <th class="px-6 py-4 text-left">Check-Out Date</th>
                        <th class="px-6 py-4 text-left">Adults</th>
                        <th class="px-6 py-4 text-left">Children</th>
                        <th class="px-6 py-4 text-left">Special Requests</th>
                        <th class="px-6 py-4 text-left">Total Price</th>
                        <th class="px-6 py-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="<?= htmlspecialchars($row['room_image']) ?>" alt="Room Image"
                                class="w-24 h-16 rounded object-cover">
                        </td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['room_type']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['checkin_date']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['checkout_date']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['adults']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['children']) ?></td>
                        <td class="px-6 py-4">
                            <?php echo empty($row['special_requests']) ? 'No request' : htmlspecialchars($row['special_requests']); ?>
                        </td>
                        <td class="px-6 py-4">$<?= htmlspecialchars($row['total_price']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>
</body>

</html>