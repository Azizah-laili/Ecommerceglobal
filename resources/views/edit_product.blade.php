<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit {{ $product->name }}</title>
</head>
<body>
    {{-- 03. edit/uploud view, setelah ini ke web.php --}}
    {{-- note, ectype dibutuhkan karna kita uploud data gambar atau file --}}
    <form action="{{ route('update_product',$product) }}" method="POST" enctype="multipart/form-data">
    @method('patch')
        @csrf
    
    <br>
    <label for="">nama</label>
    <input type="text" name="name" value="{{ $product->name }}">
    <br>
    <label for="">deskripsi</label>
    <input type="text" name="description" value="{{ $product->description }}">
    <br>
    <label for="">Rp</label>
    <input type="number" name="price" value="{{ $product->price }}">
    <br>
    <label for="">Stock</label>
    <input type="number" name="stock" value="{{ $product->stock }}">
    <br>
    <label for="">image</label>
    <input type="file" name="image">
    <br>
    <button type="submit">Update data</button>
</form>
</body>
</html>