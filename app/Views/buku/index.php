<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <div class="d-flex justify-content-between align-items-center">

            <h4 class="mb-0">Daftar Buku</h4>

            <a href="<?= base_url('buku/tambah') ?>" class="btn btn-light">

                <i class="bi bi-plus-circle"></i>

                Tambah Buku

            </a>

        </div>

    </div>

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

                        <td><?= esc($row['isbn']) ?></td>

                        <td><?= esc($row['judul']) ?></td>

                        <td><?= esc($row['penulis']) ?></td>

                        <td><?= esc($row['tahun']) ?></td>

                        <td><?= esc($row['stok']) ?></td>

                        <td>

                            <a href="<?= base_url('buku/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <a href="<?= base_url('buku/hapus/' . $row['id']) ?>"
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

<?= $this->endSection() ?>