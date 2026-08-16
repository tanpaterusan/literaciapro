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
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Tanggal Publikasi</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Published?</th>
                            <th width="170">Opsi</th>
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
                                <td><?= $row['tgl_publikasi']; ?></td>
                                <td><?= $row['STATUS']; ?></td>
                                <td><?= $row['KETERANGAN']; ?></td>
                                <?php if ($row['PUBLISHED'] == 1): ?>
                                    <td style="color:green"><i class="fas fa-check-circle"></i></td>
                                <?php else: ?>
                                    <td style="color:red"><i class="fas fa-times-circle"></i></td>
                                <?php endif; ?>
                                <td style="text-align: center;">
                                    <a class="btn btn-info"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Baca Artikel"
                                        href="<?= base_url('admin/bacaArtikel/' . $row['id']) ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a type="button" class="btn btn-warning"
                                        id="tooltip"
                                        data-bs-toggle="modal"
                                        data-bs-placement="top"
                                        title="Setting Artikel"
                                        data-bs-target="#ubahModal"
                                        data-bs-id="<?= $row['id']; ?>"
                                        data-bs-status="<?= $row['STATUS']; ?>" data-bs-keterangan="<?= $row['KETERANGAN']; ?>"
                                        data-bs-published="<?= $row['PUBLISHED']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Edit Data -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUbahArtikel">
                <div class="col-lg-5 mx-auto mt-3 mb-3">
                    <h3 class="modal-title">Setting Artikel</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-status" class="form-label">Ubah Status</label>
                        <select class="form-select" name="status" id="edit-status">
                            <option value="">-- Ubah Status --</option>
                            <option value="approved">approved</option>
                            <option value="rejected">rejected</option>
                            <option value="takedown">takedown</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="edit-keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="published" id="edit-published">
                        <label class="form-check-label" for="edit-published">
                            Published?
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const ubahModal = document.getElementById('ubahModal');

    ubahModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-bs-id');
        const status = button.getAttribute('data-bs-status');
        const keterangan = button.getAttribute('data-bs-keterangan');
        const published = button.getAttribute('data-bs-published');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-status').value = status;
        document.getElementById('edit-keterangan').value = keterangan;
        document.getElementById('edit-published').checked = (published === '1');
    });

    document.getElementById('formUbahArtikel').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('id', document.getElementById('edit-id').value);
        formData.append('status', document.getElementById('edit-status').value);
        formData.append('keterangan', document.getElementById('edit-keterangan').value);
        formData.append('published', document.getElementById('edit-published').checked ? 1 : 0);

        fetch('<?= base_url('admin/setArtikel') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    document.location.href = '<?= base_url('admin/manageArtikel') ?>';
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan!');
                console.error(error);
            });
    });
</script>

<!-- Modal Edit Data
<div class="modal fade" id="ubahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUbahArtikel">
                <div class="col-lg-5 mx-auto mt-3 mb-3">
                    <h3 class="modal-title">Setting Artikel</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="edit-status" class="form-label">Ubah Status</label>
                            <select class="form-select" name="status" id="edit-status">
                                <option value="">-- Ubah Status --</option>
                                <option value="approved">approved</option>
                                <option value="rejected">rejected</option>
                                <option value="takedown">takedown</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="edit-keterangan" rows="3"></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="published" id="edit-published">
                            <label class="form-check-label" for="edit-published">
                                Published?
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const ubahModal = document.getElementById('ubahModal');

    // Isi modal saat dibuka
    ubahModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-bs-id');
        const status = button.getAttribute('data-bs-status');
        const keterangan = button.getAttribute('data-bs-keterangan');
        const published = button.getAttribute('data-bs-published');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-status').value = status;
        document.getElementById('edit-keterangan').value = keterangan;
        document.getElementById('edit-published').checked = (published === '1');
    });

    document.getElementById('formUbahArtikel').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('id', document.getElementById('edit-id').value);
        formData.append('status', document.getElementById('edit-status').value);
        formData.append('keterangan', document.getElementById('edit-keterangan').value);
        formData.append('published', document.getElementById('edit-published').checked ? 1 : 0);

        fetch('<?= base_url('admin/setArtikel') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    document.location.href = '<?= base_url('admin/manageArtikel') ?>';
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan!');
                console.error(error);
            });
    });
</script>
 -->