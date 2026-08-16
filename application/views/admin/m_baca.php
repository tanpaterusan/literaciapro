<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Baca Artikel</h1>

    <div class="card">
        <img src="<?= base_url('assets/img/gambar/') . $artikel['gambar']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <p class="card-text"><?= htmlspecialchars_decode($artikel['isi_artikel']) ?></p>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->