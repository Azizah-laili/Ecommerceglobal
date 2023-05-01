<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //1. ini berfungsi sebagai show
    public function create_product()
    {
        return view('create_product');
    }

    //2. ini berfungsi sebagai penyimpan data
    public function store_product(Request $request){

        //2. lakukan validasi untuk memenuhi persyaratan dalam isi data dalam bentu array
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'description'=>'required',
            'image' =>'required'
        ]);
        
        //5.untuk image, pertama perlu mengambil file dengan parameternya ('image)
        $file = $request->file('image');
        
        /*6. kedua, lalu menyimpannya dengan path. time-ambil waktu sekarang lalu ditambahi underscore, ditambahi
        dengan nama product kemudia diakhiri dengan titik lalu dengan extension asli produk*/
         $path = time().'_'.$request->name.'.'.$file->getClientOriginalExtension();

         //7. lalu gambar disimpan pada local public
         Storage::disk('local')->put('public/'.$path,file_get_contents($file));

    //3. ini berfungsi sebagai create atau insert data
        Product::create([
            'name' => $request->name,
            //4. name:price merupakan kolom tabel dari price dan mentautkannya
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,

            //4.image perlu manipulasi data untk menyimpannya dalam bentuk path
            'image'=>$path
        ]);
        return Redirect::route('create_product');

        //8 lanjut buat viewny
    }
    


    //01 SHOW ALL PRODUCT
    public function index_product()
    {
        //02 panggil semua data product dan simpan pada object products
        $products = Product::all();
        //buat nama indeex_product dan parsing dalam view lalu lanjut ke view
        return view('index',compact('products'));
    }


    //01 SHOW PRODUCT ->BERFUNGSI UNTUK MEMBELAH INFORMASI, setela ini lanjut ke view tampilan
    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }


    //01 UPDATE/EDIT PRODUCT, pertama show product pada form input
    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    //02 kemudian buat bagia update datanya, semua bagian dibawah hampir sama dengan store_product, lalu lanjut ke view edit input
    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'description'=>'required',
            'image' =>'required'
        ]);
        
        //2.untuk image, pertama perlu mengambil file dengan parameternya ('image)
        $file = $request->file('image');
        
        /*2. kedua, lalu menyimpannya dengan path. time-ambil waktu sekarang lalu ditambahi underscore, ditambahi
        dengan nama product kemudia diakhiri dengan titik lalu dengan extension asli produk*/
         $path = time().'_'.$request->name.'.'.$file->getClientOriginalExtension();

         //2. lalu gambar disimpan pada local public
         Storage::disk('local')->put('public/'.$path,file_get_contents($file));

    //2. bagian ini saja yang diubah dari store_product
        $product->update([
            'name' => $request->name,
            //2. name:price merupakan kolom tabel dari price dan mentautkannya
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,

            //2.image perlu manipulasi data untk menyimpannya dalam bentuk path
            'image'=>$path
        ]);
        return Redirect::route('show_product', $product);
    }


    /* 01 DELETE lanjut ke web.php*/
    public function delete_product(Product $product)
    {
        $product->delete();
        /* return Redirect::route('index_product') ;*/
        return redirect()->back();
    }
}
