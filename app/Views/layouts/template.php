<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Sistem Manajemen Buku') ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold" href="<?= base_url('/buku') ?>">
                📚 Sistem Manajemen Buku
            </a>

        </div>
    </nav>

    <div class="container mt-4">

        <?php if (session()->getFlashdata('success')) : ?>

            <div class="alert alert-success alert-dismissible fade show">

                <?= session()->getFlashdata('success'); ?>

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('error')) : ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <?= session()->getFlashdata('error'); ?>

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        <?php endif; ?>


        <?= $this->renderSection('content') ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('script') ?>

</body>

</html>