<?php

/**
 * File: Product.php
 * Author: Muhamad Putra Erlangga Syawaludin
 * Kelas: XI RPL
 * Asal: Karangploso, Kabupaten Malang, Jawa Timur
 * 
 * Deskripsi:
 * Model Product ini merupakan representasi dari tabel products di database
 * Model ini menggunakan trait HasFactory untuk membuat data dummy/testing
 * 
 * Properti fillable berisi daftar kolom yang bisa diisi secara massal:
 * - image: menyimpan nama file gambar produk
 * - title: menyimpan judul/nama produk
 * - description: menyimpan deskripsi lengkap produk
 * - price: menyimpan harga produk
 * - stock: menyimpan jumlah stok produk
 * 
 * Model ini mewarisi class Model dari Laravel untuk operasi database
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];
}