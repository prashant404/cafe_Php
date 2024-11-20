<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            height: auto;
        }
        .greeting {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .bill-details {
            margin: 20px 0;
            text-align: left;
        }
        .bill-details p {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="greeting">
                <p>Welcome to The Bean Scene!</p>
                <p>Thank you for choosing us.</p>
            </div>
        </div>

        <div class="bill-details">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</p>
        </div>

        <h2>Ordered Products:</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>Rs. {{ number_format($product->price, 2) }}</td>
                        <td>Rs. {{ number_format($product->pivot->quantity * $product->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Goodbye, we hope to see you soon!</p>
            <p>Have a wonderful day!</p>
        </div>
    </div>
</body>
</html>
