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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aktif?</th>
                            <th width="170">Setting</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($userAll as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['NAMA']; ?></td>
                                <td><?= $row['ALAMAT']; ?></td>
                                <td><?= $row['KONTAK']; ?></td>
                                <td><?= $row['USERNAME']; ?></td>
                                <td><?= $row['ROLE']; ?></td>
                                <?php if ($row['IS_ACTIVE'] == 'aktif'): ?>
                                    <td style="color:green"><i class="fas fa-check-circle"></i></td>
                                <?php else: ?>
                                    <td style="color:red"><i class="fas fa-times-circle"></i></td>
                                <?php endif; ?>
                                <td>
                                    <button type="button" class="btn btn-warning"
                                        id="tooltip"
                                        data-bs-placement="top"
                                        title="Setting User"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ubahModal" data-bs-username="<?= $row['USERNAME']; ?>"
                                        data-bs-is_active="<?= $row['IS_ACTIVE']; ?>" data-bs-role="<?= $row['ROLE']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
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

</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="ubahModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUbahUser">
                <div class="col-lg-5 mx-auto mt-3 mb-3">
                    <h3 class="modal-title">Setting User</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="username" id="edit-username">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="edit-is_active">
                        <label class="form-check-label" for="edit-is_active">
                            Aktivasi User
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Ubah Role</label>
                        <select class="form-select" name="role" id="edit-role">
                            <option value="">Ganti role</option>
                            <option value="admin">admin</option>
                            <option value="kontributor">kontributor</option>
                        </select>
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

    // Isi modal saat dibuka
    ubahModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const username = button.getAttribute('data-bs-username');
        const isActive = button.getAttribute('data-bs-is_active');
        const role = button.getAttribute('data-bs-role');

        document.getElementById('edit-username').value = username;
        // checkbox harus pakai .checked, bukan .value
        document.getElementById('edit-is_active').checked = (isActive === 1);
        document.getElementById('edit-role').value = role;
    });

    // Submit AJAX, ganti setUser($_POST) yang tidak bisa jalan di view
    document.getElementById('formUbahUser').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('username', document.getElementById('edit-username').value);
        formData.append('is_active', document.getElementById('edit-is_active').checked ? 1 : 0);
        formData.append('role', document.getElementById('edit-role').value);

        fetch('<?= base_url('admin/setUser') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    document.location.href = '<?= base_url('admin/manageUser') ?>';
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan!');
                console.error(error);
            });
    });
</script>