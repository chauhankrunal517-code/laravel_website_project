
<!DOCTYPE html>
<html>
<head>
    <title>Order Successful - GourmetGo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            text-align: center;
            padding: 60px 15px;
        }

        .success-box {
            background: white;
            padding: 40px;
            max-width: 500px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .success-icon {
            color: #28a745;
            font-size: 65px;
        }

        .order-number {
            background: #fff1e9;
            padding: 12px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 8px;
        }

        .success {
            color: #198754;
            font-weight: bold;
        }

        a {
            display: inline-block;
            background: #ff6b35;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="success-box">

        <div class="success-icon">✓</div>

        <h2>Order Placed Successfully!</h2>

        <p>Thank you for ordering with GourmetGo.</p>

        <div class="order-number">
            <strong>Order Number:</strong>
            {{ $order->order_number }}
        </div>

        <p>
            <strong>Total:</strong>
            ₹{{ number_format($order->total, 2) }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ $order->email }}
        </p>

        @if(session('email_warning'))

            <div class="warning">
                {{ session('email_warning') }}
            </div>

        @else

            <p class="success">
                ✓ Invoice PDF sent successfully to your email!
            </p>

        @endif

        <a href="{{ url('/') }}">
            Continue Shopping
        </a>

    </div>

</body>
</html>
