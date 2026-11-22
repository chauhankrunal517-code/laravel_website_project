
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GourmetGo Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 12px;
        }

        .header {
            background: #ff6b35;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .details {
            width: 100%;
            margin-top: 25px;
        }

        .details td {
            padding: 8px;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        .items th {
            background: #ff6b35;
            color: white;
            padding: 12px;
        }

        .items td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 25px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>GourmetGo</h1>
        <p>Fresh Flavors, Fast Delivery.</p>
        <h2>ORDER INVOICE</h2>
    </div>

    <h3>Customer Information</h3>

    <table class="details">
        <tr>
            <td><strong>Invoice Number</strong></td>
            <td>{{ $order->order_number }}</td>
        </tr>

        <tr>
            <td><strong>Order Date</strong></td>
            <td>{{ $order->created_at }}</td>
        </tr>

        <tr>
            <td><strong>Customer Name</strong></td>
            <td>{{ $order->customer_name }}</td>
        </tr>

        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $order->email }}</td>
        </tr>

        <tr>
            <td><strong>Mobile</strong></td>
            <td>{{ $order->phone }}</td>
        </tr>

        <tr>
            <td><strong>Delivery Address</strong></td>
            <td>
                {{ $order->address }},
                {{ $order->city }} -
                {{ $order->pincode }}
            </td>
        </tr>
    </table>

    <h3>Order Details</h3>

    <table class="items">
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>

                    <td>
                        ₹{{ number_format($item['price'], 2) }}
                    </td>

                    <td>{{ $item['quantity'] }}</td>

                    <td>
                        ₹{{ number_format($item['subtotal'], 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Amount:
        ₹{{ number_format($order->total, 2) }}
    </div>

    <p>
        <strong>Payment Method:</strong>
        {{ strtoupper($order->payment_method) }}
    </p>

    <p>
        <strong>Payment Status:</strong>
        {{ $order->payment_status }}
    </p>

    <p>
        <strong>Order Status:</strong>
        {{ $order->order_status }}
    </p>

    <div class="footer">
        <h3>Thank You For Ordering!</h3>
        <p>GourmetGo - Fresh Flavors, Fast Delivery.</p>
    </div>

</body>
</html>
