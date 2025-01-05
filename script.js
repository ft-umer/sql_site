// Responsive Navbar Toggle
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    hamburger.classList.toggle('active');
});

// Reservation Form Validation
const reservationForm = document.querySelector('.reservation-form');

reservationForm.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent form submission to test validation

    // Get form inputs
    const name = document.querySelector('input[name="name"]');
    const email = document.querySelector('input[name="email"]');
    const date = document.querySelector('input[name="date"]');
    const time = document.querySelector('input[name="time"]');
    const guests = document.querySelector('select[name="guests"]');

    // Simple validation checks
    if (!name.value.trim()) {
        alert('Please enter your name.');
        name.focus();
        return;
    }

    if (!validateEmail(email.value)) {
        alert('Please enter a valid email address.');
        email.focus();
        return;
    }

    if (!date.value) {
        alert('Please select a reservation date.');
        date.focus();
        return;
    }

    if (!time.value) {
        alert('Please select a reservation time.');
        time.focus();
        return;
    }

    if (!guests.value) {
        alert('Please select the number of guests.');
        guests.focus();
        return;
    }

    // If all checks pass
    alert('Reservation successful!');
    reservationForm.reset(); // Reset form fields
});

// Email Validation Function
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}
