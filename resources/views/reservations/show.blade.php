<h1>Reservation Details</h1>
<p><strong>Hotel:</strong> {{ $reservation->hotel->name }}</p>
<p><strong>Room:</strong> {{ $reservation->room->room_number }}</p>
<p><strong>Customer:</strong> {{ $reservation->customer->name }}</p>
<p><strong>Check-in Date:</strong> {{ $reservation->checkin_date }}</p>
<p><strong>Check-out Date:</strong> {{ $reservation->checkout_date }}</p>
<p><strong>Status:</strong> {{ $reservation->status }}</p>