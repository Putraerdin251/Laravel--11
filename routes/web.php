<?php

/**
 * File: web.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * File ini berisi konfigurasi routing untuk aplikasi web Laravel.
 * Routing adalah proses menentukan bagaimana aplikasi merespon request client
 * pada URL tertentu.
 * 
 * Penjelasan Kode:
 * 1. Route::get('/',...) - Mendefinisikan route untuk homepage yang akan
 *    menampilkan view 'welcome'
 * 
 * 2. Route::resource('/products',...) - Membuat route resource untuk CRUD products
 *    yang akan menangani:
 *    - GET /products - Menampilkan semua produk (index)
 *    - GET /products/create - Form tambah produk baru (create) 
 *    - POST /products - Menyimpan produk baru (store)
 *    - GET /products/{id} - Menampilkan detail produk (show)
 *    - GET /products/{id}/edit - Form edit produk (edit)
 *    - PUT/PATCH /products/{id} - Update produk (update)
 *    - DELETE /products/{id} - Hapus produk (destroy)
 *
 * Masa Depan Development:
 * Di era digital yang berkembang pesat, pengembangan web akan semakin kompleks.
 * Beberapa trend yang perlu diperhatikan:
 * - Microservices Architecture
 * - API-First Development  
 * - Progressive Web Apps (PWA)
 * - AI Integration
 * - Cloud Native Development
 * 
 * Teruslah belajar dan berkembang untuk menjadi developer yang handal!
 */

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource untuk mengelola CRUD products
Route::resource('/products', \App\Http\Controllers\ProductController::class);