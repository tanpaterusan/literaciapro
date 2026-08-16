<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card text-bg-warning mb-3" style=" max-width: 18rem;">
                <div class="card-header">Total Kontributor</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $artikel['KONTRIBUTOR'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-bg-secondary mb-3" style=" max-width: 18rem;">
                <div class="card-header">Total Artikel Terpublikasi</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $artikel['PUBLISH'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-bg-success mb-3" style=" max-width: 18rem;">
                <div class="card-header">Total Artikel Belum Dipublikasi</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $artikel['UNPUBLISH'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card text-bg-danger mb-3" style=" max-width: 18rem;">
                <div class="card-header">Total Kategori</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $artikel['KATEGORI'] ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->