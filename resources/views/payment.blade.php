
<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment - GourmetGo</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f8fc;
            color: #2d3436;
            font-family: Poppins, sans-serif;
        }

        .container {
            max-width: 1050px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1.3fr 0.7fr;
            gap: 22px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px #0000000a;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-top: 0;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 9px;
            margin-bottom: 15px;
            font-family: inherit;
        }

        textarea {
            min-height: 85px;
            resize: vertical;
        }

        .payment-option {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .payment-option input {
            width: auto;
            margin: 0 8px 0 0;
        }

        .payment-option label {
            display: inline;
            cursor: pointer;
        }

        .demo-note {
            background: #fff5e9;
            color: #a54b00;
            padding: 12px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .item img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .item-info {
            flex: 1;
        }

        .muted {
            color: #777;
            font-size: 13px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-size: 21px;
            font-weight: 700;
            margin-top: 20px;
        }

        .pay-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff6b35, #ff914d);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            color: #ff6b35;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .error {
            color: #b42318;
            background: #fff0f0;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        @media(max-width: 750px) {
            .layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('cart.index') }}" class="back">
        <i class="fa-solid fa-arrow-left"></i> Back to Cart
    </a>

    <h1>
        <i class="fa-solid fa-credit-card"></i>
        Checkout & Payment
    </h1>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        <div class="layout">

            <div>

                <div class="box">

                    <h2>Delivery Information</h2>

                    <label>Full Name</label>
                    <input type="text"
                           name="customer_name"
                           value="{{ old('customer_name') }}"
                           placeholder="Enter your full name"
                           required>

                    <label>Mobile Number</label>
                    <input type="tel"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="10 digit mobile number"
                           pattern="[0-9]{10}"
                           maxlength="10"
                           required>

                    <label>Delivery Address</label>
                    <textarea name="address"
                              placeholder="House number, street, area"
                              required>{{ old('address') }}</textarea>

                    <label>City</label>
                    <input type="text"
                           name="city"
                           value="{{ old('city') }}"
                           placeholder="Enter city"
                           required>

                    <label>PIN Code</label>
                    <input type="text"
                           name="pincode"
                           value="{{ old('pincode') }}"
                           placeholder="6 digit PIN code"
                           pattern="[0-9]{6}"
                           maxlength="6"
                           required>

                </div>

                <div class="box">

                    <h2>Select Payment Method</h2>

                    <div class="demo-note">
                        <i class="fa-solid fa-circle-info"></i>
                        Demo payment only. No real money will be charged.
                        Do not enter real bank or card details.
                    </div>

                    <div class="payment-option">
                        <input type="radio"
                               id="upi"
                               name="payment_method"
                               value="upi_demo"
                               {{ old('payment_method', 'upi_demo') == 'upi_demo' ? 'checked' : '' }}
                               required>

                        <label for="upi">
                            <i class="fa-brands fa-google-pay"></i>
                            UPI Demo Payment
                        </label>
                    </div>

                    <div class="payment-option">
                        <input type="radio"
                               id="card"
                               name="payment_method"
                               value="card_demo"
                               {{ old('payment_method') == 'card_demo' ? 'checked' : '' }}>

                        <label for="card">
                            <i class="fa-regular fa-credit-card"></i>
                            Debit / Credit Card Demo
                        </label>
                    </div>

                    <div class="payment-option">
                        <input type="radio"
                               id="cod"
                               name="payment_method"
                               value="cod"
                               {{ old('payment_method') == 'cod' ? 'checked' : '' }}>

                        <label for="cod">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            Cash on Delivery
                        </label>
                    </div>

                </div>

            </div>

            <div>

                <div class="box">

                    <h2>Order Summary</h2>

                    @foreach($items as $item)

                        <div class="item">

                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->name }}">

                            <div class="item-info">
                                <strong>{{ $item->name }}</strong>

                                <div class="muted">
                                    ₹{{ number_format($item->price, 2) }}
                                    × {{ $item->quantity }}
                                </div>
                            </div>

                            <strong>
                                ₹{{ number_format($item->price * $item->quantity, 2) }}
                            </strong>

                        </div>

                    @endforeach

                    <div class="total">
                        <span>Total</span>
                        <span>₹{{ number_format($total, 2) }}</span>
                    </div>

                    <br>

                    <button type="submit" class="pay-btn">
                        <i class="fa-solid fa-lock"></i>
                        Place Order
                    </button>

                    <p class="muted" style="text-align:center;margin-top:12px">
                        Secure demo order confirmation
                    </p>

                </div>

            </div>

        </div>

    </form>

</div>

</body>
</html>
