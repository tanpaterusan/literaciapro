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
                            <th>Gambar</th>
                            <th>Published?</th>
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
                                <td>
                                    <img src="<?= base_url('assets/img/gambar/' . $row['gambar']) ?>" alt="Ilustrasi" width="100">
                                </td>
                                <td><?= ($row['published'] == 1 ? '<i style="color: green;" class="fas fa-check-circle"></i>' : '<i style="color: red;" class="fas fa-times-circle"></i>'); ?></td>
                                <td>
                                    <a href="<?= base_url('kontributor/bacaArtikel/' . $row['id']) ?>" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Baca Artikel">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a type="button" class="btn btn-info"
                                        id="tooltip"
                                        data-bs-toggle="modal"
                                        data-bs-placement="top"
                                        title="Cek Status Artikel"
                                        data-bs-target="#cekStatus"
                                        data-bs-id="<?= $row['id']; ?>">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <a href="<?= base_url('kontributor/editArtikel/' . $row['id']) ?>" class="btn btn-warning btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Setting Artikel">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('kontributor/hapusArtikel/' . $row['id']) ?>"
                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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

<!-- Modal Cek Status -->
<div class="modal fade" id="cekStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-lg-5 mx-auto mt-3 mb-3">
                <h5 class="modal-title">Cek Status Artikel</h5>
            </div>
            <div class="modal-body">
                <table class="table table-striped-columns">
                    <tr>
                        <th>Status </th>
                        <td id="status-artikel">-</td>
                    </tr>
                    <tr>
                        <th>Keterangan </th>
                        <td id="keterangan-artikel">-</td>
                    </tr>
                    <tr>
                        <th>Tanggal Publish </th>
                        <td id="tglpublish-artikel">-</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    const cekStatusModal = document.getElementById('cekStatus');

    cekStatusModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-bs-id');

        // Kosongkan dulu / kasih placeholder loading
        document.getElementById('status-artikel').textContent = 'Memuat...';
        document.getElementById('keterangan-artikel').textContent = 'Memuat...';
        document.getElementById('tglpublish-artikel').textContent = 'Memuat...';

        fetch('<?= base_url('kontributor/getStatus') ?>/' + id)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('status-artikel').textContent = data.artikel.status;
                    document.getElementById('keterangan-artikel').textContent = data.artikel.keterangan ?? '-';
                    document.getElementById('tglpublish-artikel').textContent = data.artikel.tgl_publikasi ?? '-';
                } else {
                    document.getElementById('status-artikel').textContent = '-';
                    document.getElementById('keterangan-artikel').textContent = '-';
                    document.getElementById('tglpublish-artikel').textContent = '-';
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Gagal mengambil data artikel!');
                console.error(error);
            });
    });
</script>