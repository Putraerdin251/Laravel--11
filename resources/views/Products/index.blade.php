<!--
/**
 * File: index.blade.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * File ini adalah template blade untuk menampilkan daftar produk.
 * Menggunakan framework Bootstrap 5 untuk styling modern.
 * 
 * Sejarah Laravel:
 * - Dibuat oleh Taylor Otwell pada tahun 2011
 * - Versi pertama dirilis Juni 2011
 * - Nama Laravel terinspirasi dari Narnia, sebuah lokasi geografis di serial The Chronicles of Narnia
 * - Framework PHP paling populer berdasarkan GitHub stars
 * 
 * Masa Depan Pengembangan:
 * - Implementasi fitur pencarian dan filter produk
 * - Penambahan sorting berdasarkan kolom
 * - Export data ke PDF/Excel
 * - Integrasi dengan API payment gateway
 * - Penerapan Vue.js untuk interaksi dinamis
 * - Implementasi real-time updates dengan websockets
 * - Optimasi performa dengan lazy loading gambar
 * - Penambahan fitur multi bahasa
 */
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags untuk SEO dan responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products - SantriKoding.com</title>
    <!-- Bootstrap 5 CSS untuk styling modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Background gradasi biru dan pink muda -->
<body style="background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%)">

    <!-- Container utama dengan margin top -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Header section -->
                <div>
                    <h3 class="text-center my-4">Aplikasi CRUD Laravel 11 - Manajemen Produk Modern</h3>
                    <h5 class="text-center"><a href="https://smkn2subang.sch.id">www.smkn2subang.sch.id</a></h5>
                    <hr>
                </div>
                <!-- Card untuk menampilkan data produk -->
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Tombol untuk menambah produk baru -->
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                        <!-- Tabel untuk menampilkan daftar produk -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop untuk menampilkan data produk -->
                                @forelse ($products as $product)
                                    <tr>
                                        <!-- Kolom gambar produk -->
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <!-- Kolom judul produk -->
                                        <td>{{ $product->title }}</td>
                                        <!-- Kolom harga dengan format mata uang -->
                                        <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                                        <!-- Kolom stok produk -->
                                        <td>{{ $product->stock }}</td>
                                        <!-- Kolom aksi (show, edit, delete) -->
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Pesan jika data kosong -->
                                    <div class="alert alert-danger">
                                        Data Products belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap dan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script untuk menampilkan notifikasi -->
    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>