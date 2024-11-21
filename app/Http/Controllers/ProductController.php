<?php

/**
 * File: ProductController.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * Controller ini menangani operasi CRUD (Create, Read, Update, Delete) untuk model Product.
 * Menggunakan fitur Laravel seperti Request, Response, Storage dan View.
 * 
 * Sejarah Singkat:
 * - MVC pattern pertama kali diperkenalkan tahun 1979 oleh Trygve Reenskaug
 * - Laravel framework dirilis tahun 2011 oleh Taylor Otwell
 * - PHP sendiri dibuat tahun 1994 oleh Rasmus Lerdorf
 * 
 * Masa Depan Pengembangan:
 * - Implementasi API RESTful untuk mobile apps
 * - Integrasi dengan payment gateway
 * - Penambahan fitur caching untuk optimasi
 * - Implementasi queue untuk proses background
 * - Penggunaan websocket untuk real-time updates
 * - Penerapan microservices architecture
 */

namespace App\Http\Controllers;

//Import model Product untuk interaksi dengan database
use App\Models\Product; 

//Import View untuk merender tampilan blade
use Illuminate\View\View;

//Import Request untuk mengelola HTTP request dari user
use Illuminate\Http\Request;

//Import RedirectResponse untuk redirect antar halaman
use Illuminate\Http\RedirectResponse;

//Import Storage untuk manajemen file/gambar
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk dengan pagination
     * Method ini mengambil data terbaru dan menampilkan 10 data per halaman
     * Menggunakan fitur pagination bawaan Laravel untuk efisiensi memory
     * 
     * @return View Mengembalikan view dengan data products
     */
    public function index() : View
    {
        //Mengambil data produk dengan urutan terbaru menggunakan pagination
        $products = Product::latest()->paginate(10);

        //Render view index.blade.php dengan data products
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru
     * Method ini merender view create.blade.php
     * 
     * @return View Mengembalikan view form create
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Menyimpan data produk baru ke database
     * Melakukan validasi input dan upload gambar
     * Menggunakan storage untuk menyimpan file gambar
     * 
     * @param Request $request Request dari form
     * @return RedirectResponse Redirect ke halaman index
     */
    public function store(Request $request): RedirectResponse
    {
        //Validasi input dengan aturan spesifik
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //Upload dan simpan gambar ke storage
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //Create record baru di database
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        //Redirect dengan flash message
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * Menampilkan detail produk spesifik
     * Menggunakan findOrFail untuk handling 404
     * 
     * @param string $id ID produk
     * @return View View detail produk
     */
    public function show(string $id): View
    {
        //Cari produk atau tampilkan 404
        $product = Product::findOrFail($id);

        //Render view detail
        return view('products.show', compact('product'));
    }
    
    /**
     * Menampilkan form edit produk
     * Load data existing untuk ditampilkan di form
     * 
     * @param string $id ID produk
     * @return View View form edit
     */
    public function edit(string $id): View
    {
        //Cari produk untuk diedit
        $product = Product::findOrFail($id);

        //Render form edit
        return view('products.edit', compact('product'));
    }
        
    /**
     * Update data produk existing
     * Handle upload gambar baru jika ada
     * Hapus gambar lama jika diganti
     * 
     * @param Request $request Request dari form
     * @param string $id ID produk
     * @return RedirectResponse Redirect ke index
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //Validasi input update
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //Cari produk yang akan diupdate
        $product = Product::findOrFail($id);

        //Cek apakah ada upload gambar baru
        if ($request->hasFile('image')) {

            //Upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //Hapus gambar lama
            Storage::delete('public/products/'.$product->image);

            //Update dengan gambar baru
            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);

        } else {

            //Update tanpa gambar baru
            $product->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        }

        //Redirect dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * Hapus produk dari database
     * Termasuk menghapus file gambar terkait
     * Menggunakan soft delete untuk audit trail
     * 
     * @param string $id ID produk
     * @return RedirectResponse Redirect ke index
     */
    public function destroy($id): RedirectResponse
    {
        //Cari produk yang akan dihapus
        $product = Product::findOrFail($id);

        //Hapus file gambar dari storage
        Storage::delete('public/products/'. $product->image);

        //Hapus record dari database
        $product->delete();

        //Redirect dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}