<!DOCTYPE html>
<html>
<head>
    <title>Your Bill from {{ $cafeName }}</title>
</head>
<body>
    <h2>Thank you for your order from {{ $cafeName }}</h2>
    <p><strong>Date:</strong> {{ $orderDate }}</p>
    <p><strong>Total Amount:</strong> ₹{{ $totalAmount }}</p>

    <h3>Order Details:</h3>
    <pre>{{ $productDetails }}</pre>

    <p>We hope to serve you again soon! 😊</p>
</body>
</html>
