<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Buku</h3>

<form action="<?= base_url('buku/update/' . $buku['id']) ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label>ISBN</label>
        <input type="text"
            name="isbn"
            value="<?= old('isbn', $buku['isbn']) ?>"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Judul</label>
        <input type="text"
            name="judul"
            value="<?= old('judul', $buku['judul']) ?>"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Penulis</label>
        <input type="text"
            name="penulis"
            value="<?= old('penulis', $buku['penulis']) ?>"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Tahun</label>
        <input type="number"
            name="tahun"
            value="<?= old('tahun', $buku['tahun']) ?>"
            class="form-control">
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number"
            name="stok"
            value="<?= old('stok', $buku['stok']) ?>"
            class="form-control">
    </div>

    <button class="btn btn-primary">

        Simpan

    </button>

    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">

        Kembali

    </a>

</form>

<?= $this->endSection() ?>