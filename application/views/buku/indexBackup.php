<main>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dtHorizontalExample" width="100%" cellspacing="0">
                    <thead>
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
                    <tbody style="cursor:pointer;">
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
    </div>
</main>