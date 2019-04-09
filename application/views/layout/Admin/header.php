<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
        <title><?= $this->lang->line('project_name'); ?> || <?=$topbar?></title>
        <!-- Common plugins -->
        <link href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/simple-line-icons/simple-line-icons.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/pace/pace.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/nano-scroll/nanoscroller.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/metisMenu/metisMenu.min.css') ?>">
        <link href="<?= base_url('assets/plugins/chart-c3/c3.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/plugins/iCheck/blue.css') ?>" rel="stylesheet">
        <!-- dataTables -->
        <link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/plugins/datatables/responsive.bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/plugins/toast/jquery.toast.min.css') ?>" rel="stylesheet">
        <!--template css-->
        <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!--top bar start-->
        <div class="top-bar light-top-bar"><!--by default top bar is dark, add .light-top-bar class to make it light-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="<?= base_url('Administrator') ?>" class="admin-logo">
                            <h1><?= $this->lang->line('project_short_name'); ?></h1>
                        </a>
                        <div class="left-nav-toggle visible-xs visible-sm">
                            <a href="#">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                            </a>
                        </div><!--end nav toggle icon-->
                        <!--start search form-->
                        <div class="search-form hidden-xs">
                            <h4><?=$login_info['organisation_name']?></h4>
                        </div>
                        <!--end search form-->
                    </div>
                    <div class="col-xs-6">
                        <ul class="list-inline top-right-nav">
                            <li><h4>Login Type : <?=$login_info['login_type']?></h4></li>
                            <li class="dropdown avtar-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url('assets/images/avtar-1.jpg') ?>" class="img-circle" width="30" alt="">

                                </a>
                                <ul class="dropdown-menu top-dropdown">
                                    <li><a href="javascript: void(0);"><i class="icon-user"></i> Profile</a></li>
                                    <li><a href="javascript: void(0);"><i class="icon-settings"></i> Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?= base_url('Setting/logout')?>"><i class="icon-logout"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> 
                    </div>
                </div>
            </div>
        </div>
        <!-- top bar end-->