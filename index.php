<?php
session_start();
include('db_conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Haven Hotel</title>
    <script src="./assets/tailwindcss/3.4.16"></script>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>

<body class="font-sans">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-900"><a href="index.php">Luxury Haven</a></h1>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-700 hover:text-blue-900">Home</a>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                    <a href="rooms.php" class="text-gray-700 hover:text-blue-900">Rooms</a>
                    <?php
                    }?>

                    <a href="#amenities" class="text-gray-700 hover:text-blue-900">Amenities</a>
                    <a href="#gallery" class="text-gray-700 hover:text-blue-900">Gallery</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-900">Contact</a>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                    <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
                    <?php
                    }else{ ?>
                    <a href="signup.php" class="text-gray-700 hover:text-blue-900">Signup/Login</a>
                    <?php
                    }
                     ?>
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
                <a href="#amenities" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Amenities</a>
                <a href="#gallery" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Gallery</a>
                <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-blue-900">Contact</a>
                <a href="logout.php" class="text-gray-700 hover:text-blue-900">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen">
        <div class="absolute inset-0">
            <img src="./assets/imgs/bg.jpg" alt="Luxury Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
        <div class="relative h-full flex items-center justify-center text-center text-white px-4">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Experience Luxury Living</h1>
                <p class="text-xl mb-8">Discover the perfect blend of comfort and elegance at Luxury Haven</p>
                <button class="bg-blue-900 text-white px-8 py-3 rounded-md hover:bg-blue-800 transition text-lg">
                    <a href="book.php">Book Your Stay</a>
                </button>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Our Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Deluxe Room -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=500"
                        alt="Deluxe Room" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-2">Deluxe Room</h3>
                        <p class="text-gray-600 mb-4">Spacious comfort with modern amenities</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-900">$299/night</span>
                            <button class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                                <a href="book.php">Book Now</a>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Suite -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=500"
                        alt="Luxury Suite" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-2">Luxury Suite</h3>
                        <p class="text-gray-600 mb-4">Premium suite with panoramic views</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-900">$499/night</span>
                            <button class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                                <a href="book.php">Book Now</a>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Presidential Suite -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=500"
                        alt="Presidential Suite" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-2">Presidential Suite</h3>
                        <p class="text-gray-600 mb-4">Ultimate luxury experience</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-900">$899/night</span>
                            <button class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                                <a href="book.php">Book Now</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Hotel Amenities</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">24/7 Service</h3>
                    <p class="text-gray-600">Round-the-clock assistance</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Spa & Wellness</h3>
                    <p class="text-gray-600">Relaxation sanctuary</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fine Dining</h3>
                    <p class="text-gray-600">Gourmet experience</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pool & Fitness</h3>
                    <p class="text-gray-600">Stay active & refreshed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Photo Gallery</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
                <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
                <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
                <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?auto=format&fit=crop&w=500"
                    alt="Hotel Gallery" class="w-full h-64 object-cover rounded-lg">
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-center mb-12">Contact Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <form action="" method="POST" class="space-y-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Name</label>
                            <input type="text" name="name"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Message</label>
                            <textarea name="message" rows="4"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-900"
                                required></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-900 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition">
                            Send Message
                        </button>
                    </form>

                </div>
                <div>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Address</h3>
                            <p class="text-gray-600">123 Luxury Avenue, Beverly Hills, CA 90210</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Phone</h3>
                            <p class="text-gray-600">+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Email</h3>
                            <p class="text-gray-600">info@luxuryhaven.com</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-600 hover:text-blue-900">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-900">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-900">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Luxury Haven</h3>
                    <p class="text-gray-400">Experience luxury living at its finest</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#rooms" class="text-gray-400 hover:text-white">Rooms</a></li>
                        <li><a href="#amenities" class="text-gray-400 hover:text-white">Amenities</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>123 Luxury Avenue</li>
                        <li>Beverly Hills, CA 90210</li>
                        <li>+1 (555) 123-4567</li>
                        <li>info@luxuryhaven.com</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Newsletter</h3>
                    <form class="space-y-4">
                        <input type="email" placeholder="Your email"
                            class="w-full px-4 py-2 rounded-md bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-900">
                        <button class="w-full bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Luxury Haven. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
    // Mobile menu toggle
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
    </script>
</body>

</html>