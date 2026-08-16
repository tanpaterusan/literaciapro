<?php
Defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-4">Edit Buku</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('index.html'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/buku/buku'); ?>">Data Buku</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>

        </div>
    </div>

    <div class="card-body">
        <?= form_open('index.php/buku/update/' . $buku['id']); ?>
        <div class="form-group">
            <label>ISBN : </label>
            <input class="form-control" type="text" name="isbn" value="<?= $buku['isbn']; ?>">
        </div>
        <div class="form-group">
            <label>Judul : </label>
            <input class="form-control" type="text" name="judul" value="<?= $buku['judul']; ?>">
        </div>
        <div class="form-group">
            <label>Penulis : </label>
            <input class="form-control" type="text" name="penulis" value="<?= $buku['penulis']; ?>">
        </div>
        <div class="form-group">
            <label>Tahun : </label>
            <input class="form-control" type="number" name="tahun" value="<?= $buku['tahun']; ?>">
        </div>
        <div class="form-group">
            <label>Stok : </label>
            <input class="form-control" type="number" name="stok" value="<?= $buku['stok']; ?>">
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('index.php/buku/buku'); ?>" class="btn btn-secondary">Batal</a>
        </div>
        <?= form_close(); ?>
    </div>
</div>