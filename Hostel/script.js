function showPayment(roomType, roomPrice) {
    const roommates = document.getElementById('roommates').value;
    const totalAmount = roomPrice * roommates;

    // Update the price display
    document.getElementById('price-display').innerText = `Total Price: $${totalAmount}`;
    document.getElementById('total-amount').innerText = `$${totalAmount}`;

    // Show the payment details section
    document.getElementById('room-selection').style.display = 'none';
    document.getElementById('payment-details').style.display = 'block';

    // Store booking details in session storage for demonstration
    sessionStorage.setItem('bookingDetails', JSON.stringify({
        roomType: roomType,
        roommates: roommates,
        totalAmount: totalAmount
    }));
}

function confirmBooking() {
    const cardNumber = document.getElementById('card-number').value;

    // Validate card number (for demonstration purposes)
    if (cardNumber.length < 16) {
        alert('Please enter a valid card number.');
        return;
    }

    // Perform payment processing (simulated success for demonstration)
    simulatePaymentSuccess();

    // Reset the form and go back to room selection
    document.getElementById('room-selection').style.display = 'block';
    document.getElementById('payment-details').style.display = 'none';

    // Clear stored booking details
    sessionStorage.removeItem('bookingDetails');
}

function simulatePaymentSuccess() {
    // Simulate a successful payment (for demonstration purposes)
    const bookingDetails = JSON.parse(sessionStorage.getItem('bookingDetails'));
    alert(`Booking confirmed!\n\nRoom Type: ${bookingDetails.roomType}\nRoommates: ${bookingDetails.roommates}\nTotal Amount: $${bookingDetails.totalAmount}`);
}
