<?php
Defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Buku</h4>

            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#bukuModal">
                <i class="fa-solid fa-plus"></i>
                Tambah Buku
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

                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($buku as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['isbn']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['penulis']; ?></td>
                        <td><?= $row['tahun']; ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <a href="<?= base_url('index.php/buku/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <a href="<?= base_url('index.php/buku/hapus/' . $row['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus buku ini?')"
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


<!-- Modal Tambah Buku -->
<div class="modal fade" id="bukuModal" tabindex="-1" role="dialog" aria-labelledby="bukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bukuModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('index.php/buku/tambah'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>ISBN : </label>
                    <input class="form-control" type="text" name="isbn" id="isbn">
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
                    <label>Tahun : </label>
                    <input class="form-control" type="number" name="tahun" id="tahun">
                </div>
                <div class="form-group">
                    <label>Stok : </label>
                    <input class="form-control" type="number" name="stok" id="stok">
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