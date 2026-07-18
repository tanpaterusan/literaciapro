<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama
$routes->get('/', 'Buku::index');

// ===========================
// ROUTING MANAJEMEN BUKU
// ===========================

// Menampilkan daftar buku
$routes->get('/buku', 'Buku::index');

// Menampilkan form tambah buku
$routes->get('/buku/tambah', 'Buku::create');

// Menyimpan data buku
$routes->post('/buku/simpan', 'Buku::store');

// Menampilkan form edit buku
$routes->get('/buku/edit/(:num)', 'Buku::edit/$1');

// Mengupdate data buku
$routes->post('/buku/update/(:num)', 'Buku::update/$1');

// Menghapus data buku
$routes->get('/buku/hapus/(:num)', 'Buku::delete/$1');
