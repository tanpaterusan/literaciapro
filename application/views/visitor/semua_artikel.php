<!-- Main Content-->
<div class="container px-4 px-lg-5 mt-5" style="padding-top: 70px;">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <?php if (!empty($artikel)): ?>
                <?php foreach ($artikel as $row): ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="<?= base_url('assets/img/gambar/') . $row['gambar']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-lg-8">
                            <a href="<?= base_url('visitor/baca/' . $row['id']) ?>">
                                <h2 class="post-title"><?= $row['judul']; ?></h2>
                                <h3 class="post-subtitle"><?= $row['penulis']; ?></h3>
                            </a>
                            <p class="post-meta">
                                Published on <?= date('d F Y', strtotime($row['tgl_publikasi'])); ?>
                            </p>
                        </div>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada artikel.</p>
            <?php endif; ?>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mb-4">
                <?= $pagination ?? '' ?>
            </div>

        </div>
    </div>
</div>