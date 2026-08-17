<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tulis Artikel</h1>
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
    <?php endif; ?>
    <!-- Content -->
    <div class="card text-bg-light mb-3">
        <?= form_open_multipart('kontributor/editArtikel/' . $artikel['id'], ['id' => 'formEditArtikel']); ?>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" value="<?= $artikel['judul']; ?>">
            </div>
            <small class="text-danger"><?= form_error('judul'); ?></small>

            <div class="form-group mt-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <option value="cerpen" <?= set_select('kategori', 'cerpen'); ?>>cerpen</option>
                    <option value="puisi" <?= set_select('kategori', 'puisi'); ?>>puisi</option>
                    <option value="review" <?= set_select('kategori', 'review'); ?>>review</option>
                    <option value="others" <?= set_select('kategori', 'others'); ?>>others</option>
                </select>
            </div>
            <small class="text-danger"><?= form_error('kategori'); ?></small>

            <div class="form-group mt-3">
                <label for="isi_artikel" class="form-label">Isi Artikel</label>
                <input class="form-control" type="hidden" name="isi_artikel" id="isi_artikel" value="<?= $artikel['isi_artikel']; ?>">
                <div id="editor" style="min-height: 160px;"> </div>
            </div>
            <small class="text-danger"><?= form_error('isi_artikel'); ?></small>

            <div class="form-group mb-3 row">
                <label for="gambar" class="form-label">Unggah Ilustrasi</label>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/gambar/') . $artikel['gambar']; ?>" class="img-thumbnail">
                    </div>
                    <input class="form-control" type="file" id="gambar" name="gambar" accept="image/jpeg, image/jpg, image/png" value="<?= set_value('gambar'); ?>">
                </div>
                <small class="text-danger"><?= form_error('gambar'); ?></small>
            </div>

            <div class="col-mt-5">
                <button type="submit" class="btn btn-primary">
                    Request Publish
                    <i class="fas fa-regular fa-paper-plane"></i>
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->