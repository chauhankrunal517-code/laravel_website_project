
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GourmetGo Order Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">

    <div style="
        background: #ff6b35;
        color: white;
        padding: 20px;
        text-align: center;
    ">
        <h1>GourmetGo</h1>
        <p>Fresh Flavors, Fast Delivery.</p>
    </div>

    <div style="padding: 20px;">

        <h2>Hello {{ $order->customer_name }}!</h2>

        <h3>Your order has been placed successfully.</h3>

        <p>Thank you for choosing GourmetGo.</p>

        <p>
            <strong>Order Number:</strong>
            {{ $order->order_number }}
        </p>

        <p>
            <strong>Total Amount:</strong>
            ₹{{ number_format($order->total, 2) }}
        </p>

        <p>
            <strong>Payment Method:</strong>
            {{ strtoupper($order->payment_method) }}
        </p>

        <p>
            Your order invoice is attached to this email in PDF format.
        </p>

        <hr>

        <h3>Delivery Address</h3>

        <p>
            {{ $order->address }},
            {{ $order->city }} -
            {{ $order->pincode }}
        </p>

        <p>Thank you for ordering with GourmetGo!</p>

    </div>

</body>
</html>
