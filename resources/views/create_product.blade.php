<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
</head>
<body>
    {{-- 9. setelah buat PorductController maka lanjut buat form ini --}}
    <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <input type="text" name="name" placeholder="Name">
        <br>
        <input type="text" name="description" placeholder="description">
        <br>
        <input type="number" name="price" placeholder="price">
        <br>
        <input type="number" name="stock" placeholder="stock" >
        <br>
        <input type="file" name="image">
        <br>
        <button type="submit">Submit data</button>
    </form>

    {{-- 10.setelah selesai, lanjut buat route dari web.php untuk action untuk dapat action="{{ route('store_product')""  --}}
    
</body>
</html>