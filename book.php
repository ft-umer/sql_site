<?php
session_start();
include('db_conn.php');
if (!isset($_SESSION['user_id'], $_SESSION['user_email'])) {
    header("Location: signin.php");
    exit;
}

$info = '';
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Collect form data
    $checkin_date = $_POST['checkin'];
    $checkout_date = $_POST['checkout'];
    $room_type = $_POST['room_type'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $special_requests = $_POST['special_requests'];

    // Calculate price
    $room_prices = [
        'deluxe' => 299,
        'luxury' => 499,
        'presidential' => 899
    ];
    $nights = (strtotime($checkout_date) - strtotime($checkin_date)) / (60 * 60 * 24);
    $room_total = $room_prices[$room_type] * $nights;
    $taxes = $room_total * 0.15;
    $total_price = $room_total + $taxes;

    // Insert data into database
    $sql = "INSERT INTO bookings (user_id, checkin_date, checkout_date, room_type, adults, children, special_requests, total_price,status) 
        VALUES ('$user_id', '$checkin_date', '$checkout_date', '$room_type', $adults, $children, '$special_requests', $total_price, 'pending')";

    if (mysqli_query($conn, $sql)) {
        $info = "<span class='text-[green]'>Your reservation is under review by the management <br/>
        You will be notified by an email shortly</span> ";
    } else {
        $info =  "<span class='text-[red]'There was an error processing your reservation. Please try again</span>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now - Luxury Haven Hotel</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Date picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-900">Luxury Haven</h1>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-blue-900">Home</a>
                    <a href="#rooms" class="text-gray-700 hover:text-blue-900">Rooms</a>
                    <a href="#amenities" class="text-gray-700 hover:text-blue-900">Amenities</a>
                    <a href="#gallery" class="text-gray-700 hover:text-blue-900">Gallery</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-900">Contact</a>
                    <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
                </div>

                <button class="md:hidden flex items-center" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="index.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Home</a>
                <a href="#rooms" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Rooms</a>
                <a href="#amenities" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Amenities</a>
                <a href="#gallery" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Gallery</a>
                <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Contact</a>
                <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Booking Section -->
    <section class="pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Book Your Stay</h1>
                <span><?php echo $info; ?></span>
                <form id="bookingForm" class="space-y-6" action=""  method="post">
                    <!-- Dates Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-in Date</label>
                            <input type="date" id="checkin" name="checkin" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-out Date</label>
                            <input type="date" id="checkout" name="checkout" required
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                        </div>
                    </div>

                    <!-- Room Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Room Type</label>
                        <select required name="room_type"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                            <option value="">Select a room type</option>
                            <option value="deluxe">Deluxe Room - $299/night</option>
                            <option value="luxury">Luxury Suite - $499/night</option>
                            <option value="presidential">Presidential Suite - $899/night</option>
                        </select>
                    </div>

                    <!-- Guest Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Number of Adults</label>
                            <select required name="adults"
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                                <option value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Number of Children</label>
                            <select required name="children"
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                                <option value="0">No Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                                <option value="3">3 Children</option>
                            </select>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="first_name" required
                                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" required
                                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" required
                                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" name="phone" required
                                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900">
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                        <textarea rows="3" name="special_requests"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-900 focus:border-blue-900"
                            placeholder="Any special requests or preferences?"></textarea>
                    </div>

                    <!-- Price Summary -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Price Summary</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Room Rate</span>
                                <span class="font-medium" id="roomRate">$0</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Taxes & Fees (15%)</span>
                                <span class="font-medium" id="taxes">$0</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between">
                                    <span class="font-semibold">Total</span>
                                    <span class="font-semibold text-blue-900" id="total">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" name="submit"
                        class="w-full bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        Confirm Booking
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 Luxury Haven. All rights reserved.</p>
        </div>
    </footer>

    <!-- Date picker JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
         // Mobile menu toggle
         function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        // Initialize date pickers
        flatpickr("#checkin", {
            minDate: "today",
            onChange: function(selectedDates) {
                // Set minimum date for checkout to be after checkin
                const checkoutPicker = document.getElementById("checkout")._flatpickr;
                checkoutPicker.set("minDate", selectedDates[0].fp_incr(1));
            }
        });

        flatpickr("#checkout", {
            minDate: "today",
        });

        // Simple price calculator
        const form = document.getElementById('bookingForm');
        form.addEventListener('change', calculatePrice);

        function calculatePrice() {
            const roomSelect = form.querySelector('select');
            const roomType = roomSelect.value;
            let basePrice = 0;

            switch(roomType) {
                case 'deluxe':
                    basePrice = 299;
                    break;
                case 'luxury':
                    basePrice = 499;
                    break;
                case 'presidential':
                    basePrice = 899;
                    break;
            }

            const checkin = new Date(document.getElementById('checkin').value);
            const checkout = new Date(document.getElementById('checkout').value);
            
            if (checkin && checkout && checkout > checkin) {
                const nights = (checkout - checkin) / (1000 * 60 * 60 * 24);
                const roomTotal = basePrice * nights;
                const taxes = roomTotal * 0.15;
                const total = roomTotal + taxes;

                document.getElementById('roomRate').textContent = `$${roomTotal}`;
                document.getElementById('taxes').textContent = `$${taxes.toFixed(2)}`;
                document.getElementById('total').textContent = `$${total.toFixed(2)}`;
            }
        }
    </script>
</body>
</html>