<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Cart</title>
</head>
<body>
    {{-- 03 update cart buat sesi erorr agar bisa ketahui peringatannya --}}
    @if ($errors->any())
    @foreach ($errors ->all() as $error)
    {{-- looping semua error yang terjadi --}}
        <p>{{ $error }}</p>
    @endforeach
    @endif

    {{-- 04 update cart, done--}}
    @foreach ($carts as $cart)
    <img src="{{url('storage/'.$cart->product->image )}}"  alt="" height="100px">
    <p>Name: {{ $cart->product->name }}</p>
    
    <form action="{{ route('update_cart', $cart) }}" method="post">
    @method('patch')
    @csrf
    <input type="number" name="amount" value="{{ $cart->amount }}">
    <button type="submit">Update button</button>
    </form>       
    
    {{-- //04 delete card, selesai --}}
    <form action="{{ route('delete_cart', $cart) }}" method="post">
    @method('delete')
    @csrf
    <button type="submit">Delete Cart</button>
    </form>
    @endforeach

    {{-- 03 cart lanjut ke web.php--}}
    @foreach ($carts as $cart)
    <img src="{{url('storage/'.$cart->product->image )}}"  alt="" height="100px">
    <p>Name: {{ $cart->product->name }}</p>
    <p>Amount: {{ $cart->amount }}</p>        
    
    @endforeach

    <form action="{{ route('checkout') }}" method="post">
        <button type="submit">Checkout</button>
    </form>
</body>
</html>