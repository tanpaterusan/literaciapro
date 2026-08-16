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
                    <th>Total Kategori</th>
                    <th>Total Artikel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td><?= $row['total_kategori']; ?></td>
                        <td><?= $row['total_artikel']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>