<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_dashboard.php"); // Redirect to admin login if not logged in
    exit;
}

include('db_conn.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = intval($_POST['user_id']);

    // Delete reservations associated with the user
    $deleteReservationsQuery = "DELETE FROM bookings WHERE user_id = ?";
    $stmt = $conn->prepare($deleteReservationsQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Delete the user
    $deleteUserQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteUserQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Redirect back to the admin panel
    header("Location: admin_panel.php");
    exit;
}

// Fetch users
$usersQuery = "SELECT * FROM users";
$usersResult = $conn->query($usersQuery);

// Fetch reservations
$reservationsQuery = "SELECT * FROM bookings";
$reservationsResult = $conn->query($reservationsQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservationId = intval($_POST['reservation_id']);

    if (isset($_POST['approve_reservation'])) {
        // Approve the reservation
        $updateReservationQuery = "UPDATE bookings SET status = 'approved' WHERE id = ?";
    } elseif (isset($_POST['reject_reservation'])) {
        // Reject the reservation
        $updateReservationQuery = "UPDATE bookings SET status = 'rejected' WHERE id = ?";
    }

    $stmt = $conn->prepare($updateReservationQuery);
    $stmt->bind_param("i", $reservationId);
    $stmt->execute();

    // Redirect back to the admin panel
    header("Location: admin_panel.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Cresta Restaurant</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-800">Admin Panel</h1>
            <a href="logout.php" class="text-red-600 hover:underline">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-24 px-4">


        <!-- Users Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Users</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 bg-white rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">ID</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">First Name</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Last Name</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Email</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Phone</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $usersResult->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b"><?= $user['id'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $user['first_name'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $user['last_name'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $user['email'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $user['phone'] ?></td>
                            <td class="px-4 py-2 border-b">
                                <form method="post" action="">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="delete_user"
                                        class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Reservations Section -->
        <section>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Reservations</h2>
            <div class="overflow-x-auto mb-[15px]">
                <table class="min-w-full border border-gray-300 bg-white rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">User_ID</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">CheckIn Date</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">CheckOut Date</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Room Type</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Adults</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Children</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Total Price:</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Status</th>
                            <th class="px-4 py-2 text-left text-gray-600 font-medium border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reservation = $reservationsResult->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b"><?= $reservation['user_id'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['checkin_date'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['checkout_date'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['room_type'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['adults'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['children'] ?></td>
                            <td class="px-4 py-2 border-b"><?= $reservation['total_price'] ?></td>
                            <td class="px-4 py-2 border-b">
                                <span
                                    class="<?= $reservation['status'] === 'approved' ? 'text-green-600' : ($reservation['status'] === 'rejected' ? 'text-red-600' : 'text-gray-600') ?>">
                                    <?= ucfirst($reservation['status']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b">
                                <?php if ($reservation['status'] == 'pending'): ?>
                                <form method="post" action="">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>">
                                    <button type="submit" name="approve_reservation"
                                        class="text-green-600 hover:underline">Approve</button>
                                    <button type="submit" name="reject_reservation"
                                        class="text-red-600 hover:underline">Reject</button>
                                </form>
                                <?php else: ?>
                                <span class="text-gray-600">Processed</span>
                                <?php endif; ?>

                            </td>

                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>

</html>