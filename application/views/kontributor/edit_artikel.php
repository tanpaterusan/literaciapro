<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Artikel</h1>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <!-- Content -->
    <div class="card text-bg-light mb-3">
        <div class="card-body">
            <?= form_open_multipart('kontributor/editArtikel/' . $artikel['id'], ['id' => 'formEditArtikel']); ?>

            <div class="form-group mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" value="<?= set_value('judul', $artikel['judul']); ?>">
                <small class="text-danger"><?= form_error('judul'); ?></small>
            </div>

            <div class="form-group mt-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <option value="cerpen" <?= set_select('kategori', 'cerpen', ($artikel['kategori'] == 'cerpen')); ?>>cerpen</option>
                    <option value="puisi" <?= set_select('kategori', 'puisi', ($artikel['kategori'] == 'puisi')); ?>>puisi</option>
                    <option value="review" <?= set_select('kategori', 'review', ($artikel['kategori'] == 'review')); ?>>review</option>
                    <option value="others" <?= set_select('kategori', 'others', ($artikel['kategori'] == 'others')); ?>>others</option>
                </select>
                <small class="text-danger"><?= form_error('kategori'); ?></small>
            </div>

            <div class="form-group mt-3">
                <label for="isi_artikel" class="form-label">Isi Artikel</label>
                <input type="hidden" name="isi_artikel" id="isi_artikel" value="<?= set_value('isi_artikel', htmlspecialchars_decode($artikel['isi_artikel'])); ?>">
                <div id="editor" style="min-height: 160px; background-color: #fff;"></div>
                <small class="text-danger"><?= form_error('isi_artikel'); ?></small>
            </div>

            <div class="form-group mb-3 mt-3">
                <label for="gambar" class="form-label">Unggah Ilustrasi</label>
                <div class="row align-items-center">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/gambar/') . $artikel['gambar']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" id="gambar" name="gambar" accept="image/jpeg, image/jpg, image/png">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('gambar'); ?></small>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    Update Artikel
                    <i class="fas fa-regular fa-paper-plane"></i>
                </button>
                <a href="<?= base_url('kontributor/index'); ?>" class="btn btn-secondary">Batal</a>
            </div>

            <?= form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->