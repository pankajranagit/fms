<head>
    <title><?= $this->lang->line('project_name'); ?></title>
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>
<body>
    <div class="login-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"><?= $this->lang->line('project_name'); ?></div>
                <div class="col-lg-6 text-right d-sm-block d-none"><?= date('l d, F Y') ?></div>
            </div>
        </div>
    </div>
    <div class="container-fluid login-section">
        <div class="row">
            <div class="col-lg-4 offset-lg-2">
                <img src="<?= base_url('assets/images/logo-png-min.png') ?>" class="img-fluid">
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <?=$message?>
                        <hr>
                        <a class="btn btn-primary" href="<?= base_url() ?>">Login now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>
</html>