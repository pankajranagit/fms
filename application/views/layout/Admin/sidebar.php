<!--left navigation start-->
<aside class="float-navigation light-navigation">
    <div class="nano">
        <div class="nano-content">
            <ul class="metisMenu nav" id="menu">
                <li class="nav-heading"><span>Main Navigation</span></li>
                <li class="<?=$this->session->userdata('active') == 'Dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('Admin/Dashboard') ?>"><i class="icon-home"></i> Dashboard</a>
                </li>
                <!--<li><a href="landing/index.html" target="_blank" class="bg-primary"><i class="icon-star"></i>Landing page</a></li>-->
            </ul>
        </div><!--nano content-->
    </div><!--nano scroll end-->
</aside>
<!--left navigation end-->
<!--main content start-->
<section class="main-content container">
    <!--page header start-->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h4><?=$topbar?></h4>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb">
                    <li><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                    <li><?=$topbar?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--page header end-->