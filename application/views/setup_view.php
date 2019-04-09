<head>
    <title><?= $this->lang->line('project_name'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
    <style>
        body{
            background-color: #2196F3;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="login-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"><?= $this->lang->line('project_name'); ?> | Organization Registration</div>
                <div class="col-lg-6 text-right d-sm-block d-none"><?= date('l d, F Y') ?></div>
            </div>
        </div>
    </div>
    <div class="container-fluid login-section">
        <div class="row">
            <div class="col-lg-4 offset-2" style="color: #FFF;">
                <h3>Instructions</h3><hr style="background-color: #fff;">
                <ol>
                    <li>Please enter valid Email Id &amp; Mobile Number</li>
                    <li>A verification link is being sent to your registered email id after registration. Please verify it then only your account will verify.</li>
                    <li>Username &amp; Password has been sent to your register Email Id</li>
                    <li>Mobile Number is further used for OTP verification</li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Organization Registration
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('msg')) {
                            ?> 
                            <h4>Email Verification</h4>
                            <p> <?php echo $this->session->flashdata('msg'); ?> </p> 
                            <?php
                        } else {
                            ?>
                            <form method="post" action="<?= base_url('welcome/setup') ?>">
                                <div class="form-group">
                                    <label>Name of Organization</label>
                                    <input name="organisation_name" value="<?php echo set_value('organisation_name'); ?>" type="text" class="form-control" placeholder="Name of Organization">
                                    <lable class="small"><?php echo form_error('organisation_name'); ?></lable>
                                </div>
                                <div class="form-group">
                                    <label>Organization's Head</label>
                                    <input name="head_name" value="<?php echo set_value('head_name'); ?>" type="text" class="form-control" placeholder="Organization's Head">
                                    <lable class="small"><?php echo form_error('head_name'); ?></lable>
                                </div>
                                <div class="form-group">
                                    <label>Head Email Id</label>
                                    <input name="head_email" value="<?php echo set_value('head_email'); ?>" type="text" class="form-control" placeholder="Email Id">
                                    <lable class="small"><?php echo form_error('head_email'); ?></lable>
                                </div>
                                <div class="form-group">
                                    <label>Head Mobile Number</label>
                                    <input name="head_mobile" value="<?php echo set_value('head_mobile'); ?>" type="text" class="form-control" placeholder="Mobile Number">
                                    <lable class="small"><?php echo form_error('head_mobile'); ?></lable>
                                </div>
                                <button class="btn btn-primary" name="submit" type="submit">Register</button>
                            </form>
                            <?php
                        }
                        ?>
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