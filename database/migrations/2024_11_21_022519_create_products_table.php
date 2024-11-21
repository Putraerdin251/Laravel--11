<?php
/**
 * File Migration untuk Tabel Products
 * Dibuat oleh: Muhamad Putra Erlangga Syawaludin
 * Kelas: XII RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Fakta Unik: Laravel migrations pertama kali diperkenalkan di Laravel 3 pada tahun 2012.
 * Di masa depan, penggunaan migrations akan semakin penting untuk version control database.
 */

use Illuminate\Database\Migrations\Migration; // Import class Migration untuk membuat migrasi database
use Illuminate\Database\Schema\Blueprint; // Import Blueprint untuk mendefinisikan struktur tabel
use Illuminate\Support\Facades\Schema; // Import Schema facade untuk operasi schema database

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel products.
     * Method up() akan dieksekusi saat melakukan migrate.
     * 
     * Tips Masa Depan: Selalu buat migration yang reversible untuk memudahkan rollback.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key auto-increment
            $table->string('image'); // Kolom untuk menyimpan path/url gambar produk
            $table->string('title'); // Kolom untuk judul/nama produk
            $table->text('description'); // Kolom untuk deskripsi produk yang panjang
            $table->bigInteger('price'); // Kolom untuk harga produk (menggunakan bigInteger untuk angka besar)
            $table->integer('stock')->default(0); // Kolom stok dengan nilai default 0
            $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
        });
    }

    /**
     * Mengembalikan perubahan dari migrasi.
     * Method down() akan dieksekusi saat melakukan rollback.
     * 
     * Fakta Unik: Fitur rollback migrations memungkinkan kita untuk "membatalkan" 
     * perubahan database dengan mudah, fitur yang sangat berguna dalam development.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Menghapus tabel products jika ada
    }
};
