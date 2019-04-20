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
                <div class="col-lg-6"><?= $organisation_info['organisation_name'] ?> - <?= $this->lang->line('project_name'); ?></div>
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
                    <div class="card-header">
                        Login Panel
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('Welcome/index') ?>">
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                <lable class="small"><?php echo form_error('username'); ?></lable>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <lable class="small"><?php echo form_error('password'); ?></lable>
                            </div>
                            <div class="form-group">
                                <label class="small">Type the character you see in this image :</label>
                                <p id="captImg"><?php echo $captchaImg; ?></p>
                                <label class="small">Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</label>
                                <input type="hidden" id="base_url_captcha" value="<?= base_url('Welcome/refresh') ?>">
                                <input required="" autocomplete="off" type="text" class="form-control" name="captcha" placeholder="Type Characters">
                                <?= ($captcha_error ? "<lable class=\"small\"><p>You have mistyped the captcha.</p></lable>" : "") ?>
                            </div>
                            <?php
                            echo $this->session->flashdata('msg');
                            ?>
                            <button class="btn btn-primary" name="submit" type="submit">Login</button>
                        </form>
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