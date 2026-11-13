
<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Successful - GourmetGo</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f8fc;
            font-family: Poppins, sans-serif;
            color: #2d3436;
        }

        .container {
            max-width: 650px;
            margin: 55px auto;
            padding: 20px;
        }

        .box {
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 5px 25px #0000000a;
            text-align: center;
        }

        .success-icon {
            color: #16a34a;
            font-size: 65px;
            margin-bottom: 15px;
        }

        h1 {
            color: #168348;
        }

        .details {
            background: #f7f8fc;
            padding: 20px;
            border-radius: 12px;
            text-align: left;
            margin-top: 25px;
        }

        .details p {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 10px;
        }

        .food {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .food img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .home-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 13px 25px;
            background: linear-gradient(135deg, #ff6b35, #ff914d);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .muted {
            color: #777;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="box">

        <i class="fa-solid fa-circle-check success-icon"></i>

        <h1>Order Placed Successfully!</h1>

        <p>
            Thank you for ordering from GourmetGo.
        </p>

        @if(session('success'))
            <p style="color:#168348;font-weight:600">
                {{ session('success') }}
            </p>
        @endif

        <div class="details">

            <h3>Order Details</h3>

            <p>
                <span>Order Number</span>
                <strong>{{ $order->order_number }}</strong>
            </p>

            <p>
                <span>Customer</span>
                <strong>{{ $order->customer_name }}</strong>
            </p>

            <p>
                <span>Phone</span>
                <strong>{{ $order->phone }}</strong>
            </p>

            <p>
                <span>Payment Method</span>
                <strong>{{ $order->payment_method }}</strong>
            </p>

            <p>
                <span>Payment Status</span>
                <strong>{{ $order->payment_status }}</strong>
            </p>

            @if($order->payment_reference)
                <p>
                    <span>Demo Reference</span>
                    <strong>{{ $order->payment_reference }}</strong>
                </p>
            @endif

            <p>
                <span>Order Status</span>
                <strong>{{ $order->order_status }}</strong>
            </p>

            <p>
                <span>Total Amount</span>
                <strong style="color:#ff6b35">
                    ₹{{ number_format($order->total, 2) }}
                </strong>
            </p>

            <h3>Ordered Food</h3>

            @foreach($orderItems as $item)

                <div class="food">

                    <img src="{{ $item['image_url'] }}"
                         alt="{{ $item['name'] }}">

                    <div style="flex:1">
                        <strong>{{ $item['name'] }}</strong>

                        <div class="muted">
                            Quantity: {{ $item['quantity'] }}
                        </div>
                    </div>

                    <strong>
                        ₹{{ number_format($item['subtotal'], 2) }}
                    </strong>

                </div>

            @endforeach

        </div>

        <a href="{{ route('Menu') }}" class="home-btn">
            <i class="fa-solid fa-utensils"></i>
            Continue Shopping
        </a>

    </div>

</div>

</body>
</html>
