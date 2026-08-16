<?php
Defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Rekap Artikel</h4>

            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#bukuModal">
                <i class="fa-solid fa-plus"></i>
                Tambah Artikel
            </button>

        </div>
    </div>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Isi Artikel</th>
                    <th>Tanggal Publikasi</th>
                    <th>Gambar</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['penulis']; ?></td>
                        <td><?= $row['isi_artikel']; ?></td>
                        <td><?= $row['tanggal_publikasi']; ?></td>
                        <td>
                            <img src="<?= base_url('assets/images/' . $row['gambar']) ?>" alt="Gambar Artikel" width="100">
                        </td>
                        <td>
                            <a href="<?= base_url('index.php/artikel/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a href="<?= base_url('index.php/artikel/hapus/' . $row['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Tambah Artikel -->
<div class="modal fade" id="artikelModal" tabindex="-1" role="dialog" aria-labelledby="artikelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="artikelModalLabel">Tambah Artikel</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('index.php/artikel/tambah'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori : </label>
                    <input class="form-control" type="text" name="kategori" id="kategori">
                </div>
                <div class="form-group">
                    <label>Judul : </label>
                    <input class="form-control" type="text" name="judul" id="judul">
                </div>
                <div class="form-group">
                    <label>Penulis : </label>
                    <input class="form-control" type="text" name="penulis" id="penulis">
                </div>
                <div class="form-group">
                    <label>Isi Artikel : </label>
                    <input class="form-control" type="text" name="isi_artikel" id="isi_artikel">
                </div>
                <div class="form-group">
                    <label>Tanggal Publikasi : </label>
                    <input class="form-control" type="date" name="tanggal_publikasi" id="tanggal_publikasi">
                </div>
                <div class="form-group">
                    <label>Gambar : </label>
                    <input class="form-control" type="file" name="gambar" id="gambar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
</div>