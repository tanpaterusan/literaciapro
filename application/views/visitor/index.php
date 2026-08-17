<!-- Page Header-->
<header class="masthead" style="background-image: url('<?= base_url('assets2/'); ?>assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1><?= $title ?></h1>
                    <span class="subheading">Baca artikel literasi hari ini. <br> Membangun negeri dari literasi.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php foreach ($artikel as $row): ?>
                <div class="post-preview">
                    <a href="<?= base_url('visitor/baca/' . $row['id']) ?>">
                        <h2 class="post-title"><?= $row['judul']; ?></h2>
                        <h3 class="post-subtitle"><?= $row['penulis']; ?></h3>
                    </a>
                    <p class="post-meta">
                        Published on <?= date('d F Y', strtotime($row['tgl_publikasi'])); ?>
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            <?php endforeach; ?>
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="<?= base_url('visitor/semuaArtikel') ?>">Semua Artikel→</a></div>
        </div>
    </div>
</div>