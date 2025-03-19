<!DOCTYPE html>
<html>
<head>
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            border: 2px solid #007BFF;
            border-radius: 10px;
            background: #f9f9f9;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #007BFF;
        }
        .header h1 {
            color: #007BFF;
            font-size: 24px;
            margin: 0;
        }
        .order-details {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .order-details th, .order-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .order-details th {
            background: #007BFF;
            color: #fff;
        }
        .product-image {
            text-align: center;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .product-image img {
            display: block;
            max-width: 300px;
            max-height: 250px;
            width: auto;
            height: auto;
            border-radius: 5px;
            border: 2px solid #ddd;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Order Invoice</h1>
    </div>

    <table class="order-details" width="100%">
        <tr>
            <th colspan="2">Customer Details</th>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $order->email }}</td>
        </tr>
        <tr>
            <td><strong>Phone:</strong></td>
            <td>{{ $order->phone }}</td>
        </tr>
        <tr>
            <td><strong>Customer ID:</strong></td>
            <td>{{ $order->user_id }}</td>
        </tr>

        <tr>
            <th colspan="2">Product Details</th>
        </tr>
        <tr>
            <td><strong>Product Title:</strong></td>
            <td>{{ $order->product_title }}</td>
        </tr>
        <tr>
            <td><strong>Quantity:</strong></td>
            <td>{{ $order->quantity }}</td>
        </tr>
        <tr>
            <td><strong>Total Price:</strong></td>
            <td>N{{ number_format($order->price, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Payment Status:</strong></td>
            <td>{{ ucfirst($order->payment_status) }}</td>
        </tr>
        <tr>
            <td><strong>Product ID:</strong></td>
            <td>{{ $order->product_id }}</td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: center;">Product Image</th>
        </tr>
        <tr>
            <td colspan="2" class="product-image">
                <img src="product/{{ $order->image }}" alt="Product Image">
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for shopping with us!</p>
    </div>
</div>

</body>
</html>
