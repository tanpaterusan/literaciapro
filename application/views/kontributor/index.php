<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Artikel Anda</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <div class="card-body"> -->
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
                                <td><?= htmlspecialchars_decode($row['isi_artikel']); ?></td>
                                <td><?= $row['tgl_publikasi']; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/gambar/' . $row['gambar']) ?>" alt="Ilustrasi" width="100">
                                </td>
                                <td>
                                    <a href="<?= base_url('kontributor/editArtikel/' . $row['id']) ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="<?= base_url('kontributor/hapusArtikel/' . $row['id']) ?>"
                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                        class="btn btn-danger btn-sm">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->