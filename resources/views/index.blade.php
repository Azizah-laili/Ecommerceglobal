<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Product</title>
</head>
<body>
{{--     03. buat tampilannya --}}
    @foreach ($products as $product)
    <h1>ini show all product</h1>
        <p>Name: {{ $product->name }}</p>
        <p>Description: {{ $product->description }}</p>
        <p>Rp: {{ $product->price}}</p>
        <p>Stock: {{ $product->stock }}</p>
        {{-- dibuat karna kita ambil storage dari link env app_UR, lalu lanjut ke web.php --}}
        <img src="{{ url('storage/'.$product->image) }}" alt="" height="100px">
    
        {{-- 03 buat form agar bisa ada button atau linkdelete--}}
        <form action="{{ route('delete_product', $product) }}" method="POST">
            @method('delete') {{-- ubah method jaddi delete --}}
            @csrf
            <button type="submit">Delete detail</button>
            </form>

        
        <h1>ini akhir dari show all product</h1>
        @endforeach


        {{--     04. buat tampilan utnuk mengarahkan ke show product --}}
    @foreach ($products as $product)
    <h1>ini show  product</h1>
        <p>Name: {{ $product->name }}</p>
        {{-- dibuat karna kita ambil storage dari link env app_UR, lalu lanjut ke web.php --}}
        <img src="{{ url('storage/'.$product->image) }}" alt="" height="100px">

        {{-- buat form agar bisa ada button atau link ke show_product  dan selesai--}}
        <form action="{{ route('show_product', $product) }}" method="get">
        <button type="submit">Show detail</button>
        </form>

         {{-- 03 buat form agar bisa ada button atau linkdelete--}}
         <form action="{{ route('delete_product', $product) }}" method="POST">
            @method('delete') {{-- ubah method jaddi delete --}}
            @csrf
            <button type="submit">Delete detail</button>
            </form>

        <h1>ini akhir dari show  product</h1>
        @endforeach
</body>
</html>