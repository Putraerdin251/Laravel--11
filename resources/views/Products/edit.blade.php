<!--
/**
 * File: edit.blade.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * File ini adalah template blade untuk halaman edit produk.
 * Menggunakan framework Bootstrap 5 untuk styling.
 * 
 * Masa Depan Pengembangan:
 * - Bisa ditambahkan validasi JavaScript untuk input
 * - Integrasi dengan API untuk auto-complete
 * - Penambahan preview gambar sebelum upload
 * - Implementasi drag & drop untuk upload file
 * - Penggunaan Vue.js/React untuk membuat lebih interaktif
 */
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags untuk SEO dan responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products - SantriKoding.com</title>
    <!-- Bootstrap 5 CSS untuk styling modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Background abu-abu untuk tampilan yang nyaman di mata -->
<body style="background: lightgray">

    <!-- Container dengan margin atas dan bawah -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Card dengan border 0 dan shadow untuk tampilan modern -->
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Form dengan method POST dan support upload file -->
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        
                            <!-- CSRF token untuk keamanan -->
                            @csrf
                            <!-- Method PUT untuk update data -->
                            @method('PUT')

                            <!-- Form group untuk upload gambar -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">IMAGE</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            
                                <!-- Pesan error untuk validasi gambar -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form group untuk judul produk -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TITLE</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $product->title) }}" placeholder="Masukkan Judul Product">
                            
                                <!-- Pesan error untuk validasi judul -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form group untuk deskripsi produk dengan textarea -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESCRIPTION</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Description Product">{{ old('description', $product->description) }}</textarea>
                            
                                <!-- Pesan error untuk validasi deskripsi -->
                                @error('description')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Row untuk input harga dan stok -->
                            <div class="row">
                                <!-- Kolom untuk input harga -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">PRICE</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" placeholder="Masukkan Harga Product">
                                    
                                        <!-- Pesan error untuk validasi harga -->
                                        @error('price')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Kolom untuk input stok -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">STOCK</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="Masukkan Stock Product">
                                    
                                        <!-- Pesan error untuk validasi stok -->
                                        @error('stock')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol submit dan reset -->
                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap dan CKEditor -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <!-- Inisialisasi CKEditor pada textarea description -->
    <script>
        CKEDITOR.replace( 'description' );
    </script>
</body>
</html>