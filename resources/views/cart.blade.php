
<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - GourmetGo</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f7f8fc;
            color: #2d3436;
            font-family: Poppins, sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 45px auto;
            padding: 24px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        h1 { margin: 0 0 8px; }

        .back, .checkout {
            display: inline-block;
            text-decoration: none;
            border: 0;
            border-radius: 10px;
            padding: 11px 17px;
            background: #ff6b35;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
        }

        .message {
            padding: 12px 16px;
            border-radius: 10px;
            background: #eafaf0;
            color: #187443;
            margin: 20px 0;
        }

        .item {
            display: grid;
            grid-template-columns: 90px 1fr auto;
            gap: 18px;
            align-items: center;
            background: white;
            padding: 18px;
            border-radius: 16px;
            margin: 14px 0;
            box-shadow: 0 5px 20px #0000000a;
        }

        .item img {
            width: 90px;
            height: 80px;
            object-fit: contain;
        }

        .name {
            font-weight: 600;
            font-size: 18px;
        }

        .muted {
            color: #777;
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions form {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .quantity {
            width: 75px;
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .small-btn {
            border: 0;
            border-radius: 8px;
            padding: 9px 12px;
            cursor: pointer;
            background: #f1f2f6;
            font-family: inherit;
        }

        .remove { color: #c62828; }

        .summary {
            margin-top: 24px;
            background: white;
            padding: 22px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .empty {
            text-align: center;
            background: white;
            border-radius: 16px;
            padding: 55px 20px;
            margin-top: 25px;
        }

        .empty i {
            font-size: 42px;
            color: #ff6b35;
        }

        @media(max-width: 600px) {
            .item {
                grid-template-columns: 65px 1fr;
                gap: 12px;
            }

            .item img {
                width: 65px;
                height: 65px;
            }

            .item > .actions {
                grid-column: 1 / -1;
            }

            .container {
                padding: 15px;
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">
        <div>
            <h1><i class="fa-solid fa-cart-shopping"></i> Your Cart</h1>
            <div class="muted">Review the items you want to order.</div>
        </div>

        <a class="back" href="{{ route('Menu') }}">
            <i class="fa-solid fa-arrow-left"></i> Continue Shopping
        </a>
    </div>

    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="message" style="background:#fff0f0;color:#b42318">
            {{ $errors->first() }}
        </div>
    @endif

    @forelse($items as $item)

        <div class="item">

            <img
                src="{{ $item->image_url }}"
                alt="{{ $item->name }}"
                class="item-image">


            <div>
                <div class="name">{{ $item->name }}</div>

                <div class="muted">
                    Price: ₹{{ number_format($item->price, 2) }} each
                </div>

                <div style="font-weight:600;margin-top:5px">
                    Subtotal:
                    ₹{{ number_format($item->price * $item->quantity, 2) }}
                </div>
            </div>

            <div class="actions">

                <form action="{{ route('cart.update', $item->id) }}"
                      method="POST">
                    @csrf
                    @method('PATCH')

                    <input class="quantity"
                           type="number"
                           name="quantity"
                           min="1"
                           max="99"
                           value="{{ $item->quantity }}"
                           required>

                    <button class="small-btn"
                            type="submit"
                            title="Update quantity">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>

                <form action="{{ route('cart.remove', $item->id) }}"
                      method="POST"
                      onsubmit="return confirm('Remove this item from your cart?')">
                    @csrf
                    @method('DELETE')

                    <button class="small-btn remove" type="submit">
                        <i class="fa-solid fa-trash"></i> Remove
                    </button>
                </form>

            </div>
        </div>

    @empty

        <div class="empty">
            <i class="fa-solid fa-basket-shopping"></i>
            <h2>Your cart is empty</h2>
            <p class="muted">
                Add delicious food from the menu to see it here.
            </p>
            <a class="back" href="{{ route('Menu') }}">Browse Menu</a>
        </div>

    @endforelse

    @if($items->isNotEmpty())

        <div class="summary">
            <div>
                <div class="muted">Cart Total</div>
                <h2 style="margin:4px 0">
                    ₹{{ number_format($total, 2) }}
                </h2>
            </div>

            <button class="checkout"
                    type="button"
                    onclick="alert('Your cart is ready. Checkout and order placement must be implemented separately.')">
                Proceed to Checkout
            </button>
        </div>

    @endif

</div>

</body>
</html>
