<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- ini wajib dibuat agar tau id product --}}
    <title>{{ $product->name}}</title>
</head>
<body>
    

    


    <button>
    <a href="{{ route('index_product') }}">Back</a></button>
        {{-- 02 tampilan view dari show product, lalu lanjut ke web.php --}}
        <p>Name: {{ $product->name }}</p>
        <p>Description: {{ $product->description }}</p>
        <p>Rp: {{ $product->price}}</p>
        <p>Stock: {{ $product->stock }}</p>
        
        {{-- dibuat karna kita ambil storage dari link env app_UR, lalu lanjut ke web.php --}}
        <img src="{{ url('storage/'.$product->image) }}" alt="" height="100px">
    <form action="{{ route('edit_product', $product) }}" method="get">
        <button type="submit">Edit Product</button>
    </form>
    <br>

   {{--  06. menambhakan barang kecart --}}
    <form action="{{ route('add_to_cart', $product) }}" method="POST">
      @csrf
        <input type="number" name="amount" value="1">
        <button type="submit">Add to cart</button>
        @if ($errors->any())
    @foreach ($errors ->all() as $error)
    {{-- looping semua error yang terjadi --}}
        <p>{{ $error }}</p>
    @endforeach
    @endif
    </form>
</body>
</html>