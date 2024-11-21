<!--
/**
 * File: show.blade.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * File ini adalah template blade untuk menampilkan detail produk.
 * Menggunakan framework Bootstrap 5 untuk styling modern.
 * 
 * Sejarah PHP:
 * - PHP diciptakan oleh Rasmus Lerdorf pada tahun 1994
 * - Awalnya PHP adalah singkatan dari Personal Home Page
 * - Sekarang PHP adalah Hypertext Preprocessor
 * - PHP versi 8 membawa fitur-fitur modern seperti JIT compiler
 * 
 * Masa Depan Pengembangan:
 * - Integrasi dengan API untuk fitur rekomendasi produk
 * - Implementasi zoom pada gambar produk
 * - Penambahan fitur share ke social media
 * - Rating dan review produk
 * - Sistem keranjang belanja
 * - Integrasi payment gateway
 */
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags untuk SEO dan responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products - SantriKoding.com</title>
    <!-- Bootstrap 5 CSS untuk styling modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Background abu-abu untuk tampilan yang nyaman di mata -->
<body style="background: lightgray">

    <!-- Container dengan margin atas dan bawah -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Kolom untuk menampilkan gambar produk -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Menampilkan gambar dari storage dengan style responsive -->
                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <!-- Kolom untuk menampilkan detail produk -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Judul produk -->
                        <h3>{{ $product->title }}</h3>
                        <hr/>
                        <!-- Harga produk dengan format mata uang Indonesia -->
                        <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                        <!-- Deskripsi produk dengan HTML parsing -->
                        <code>
                            <p>{!! $product->description !!}</p>
                        </code>
                        <hr/>
                        <!-- Informasi stok produk -->
                        <p>Stock : {{ $product->stock }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap untuk fungsionalitas komponen -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>