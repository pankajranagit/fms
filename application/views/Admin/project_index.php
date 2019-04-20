<!--start page content-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-left">Add project</div>
                <div class="pull-right"><?php echo $this->session->flashdata('msg'); ?></div><br>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="<?= base_url('Admin/ManageProject/add') ?>" class="form-horizontal" method="post">
                            <div class="row form-group">
                                <div class="col-lg-3">
                                    <label>Project Name</label>
                                    <input type="text" value="<?= set_value('project_title') ?>" name="project_title" placeholder="Project Title" class="form-control ">
                                    <lable class="small text-danger"><?php echo form_error('project_title'); ?></lable>
                                </div>
                                <div class="col-lg-3">
                                    <label>Project Type</label>
                                    <?php $project_type = set_value('project_type'); ?>
                                    <select class="form-control" name="project_type">
                                        <option value="">Select Project Type</option>
                                        <?php
                                        foreach ($proj_type as $key => $temp) {
                                            ?> <option <?= ($project_type == $key ? 'selected' : '') ?> value="<?= $key ?>"><?= $temp['lable'] ?></option> <?php
                                        }
                                        ?>
                                    </select>
                                    <a href="#" class="text-warning" data-toggle="modal" data-target="#textModal"><i class="fa fa-info-circle"></i> What is this?</a>
                                    <lable class="small text-danger"><?php echo form_error('project_type'); ?></lable>
                                    <!--modal text start-->
                                    <div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times-circle"></span></button>
                                                    <h3 class="modal-title" id="myModalLabel">What is Project type ?</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    foreach ($proj_type as $key => $temp) {
                                                        ?> 
                                                        <p><b><?= $temp['lable'] ?> : </b><?= $temp['description'] ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--modal text end-->
                                </div>
                                <div class="col-lg-2">
                                    <label>Fund Allotted</label>
                                    <input type="text" value="<?= set_value('project_cost') ?>" name="project_cost" placeholder="Fund Allotted (Rs.)" class="form-control ">
                                    <lable class="small text-danger"><?php echo form_error('project_cost'); ?></lable>
                                </div>
                                <div class="col-lg-4">
                                    <label>Project Description</label>
                                    <textarea name="project_description" placeholder="Project Description" class="form-control"><?= set_value('project_description') ?></textarea>
                                    <lable class="small text-danger"><?php echo form_error('project_description'); ?></lable>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <pre><?php //print_r($all_project) ?></pre>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead class="secondary">
                                <tr>
                                    <th>Sr.</th>
                                    <th>Project Title</th>
                                    <th>Project Type</th>
                                    <th class="text-center">Total Fund Allotted (Rs.)</th>
                                    <th class="text-center">Last Allotment Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                $repeat_projid = 0;
                                $totalFund = 0;
                                foreach ($all_project as $data) {

                                    if ($repeat_projid != $data['id']) {
                                        if ($repeat_projid != 0) {
                                            ?>
                                            <tr>
                                                <td><?= $sr ?></td>
                                                <td><?= $project_title ?></td>
                                                <td><?= $project_type ?></td>
                                                <td class="text-right">
                                                    <?= $this->customlib->inr_format($totalFund) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= date('d, M Y h:i A', strtotime($allotment_date)) ?>
                                                </td>
                                                <td class="text-right">
                                                    <a href="<?= base_url('Admin/ManageProject/update/' . $repeat_projid) ?>" class="btn btn-xs btn-success">
                                                        Update Fund
                                                    </a>
                                                    <button class="btn btn-xs btn-danger">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $sr++;
                                        }


                                        $repeat_projid = $data['id'];

                                        $project_title = "";
                                        $project_type = "";
                                        $allotment_date = "";
                                        $totalFund = 0;

                                        $project_title = $data['project_title'];
                                        $project_type = $data['project_type'];
                                        $allotment_date = $data['allotment_date'];
                                        $totalFund = $totalFund + $data['fund_allotted'];
                                    } else {
                                        $project_title = $data['project_title'];
                                        $project_type = $data['project_type'];
                                        $allotment_date = $data['allotment_date'];
                                        $totalFund = $totalFund + $data['fund_allotted'];
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?= $sr ?></td>
                                    <td><?= $project_title ?></td>
                                    <td><?= $project_type ?></td>
                                    <td class="text-right">
                                        <?= $this->customlib->inr_format($totalFund) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= date('d, M Y h:i A', strtotime($allotment_date)) ?>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?= base_url('Admin/ManageProject/update/' . $data['id']) ?>" class="btn btn-xs btn-success">
                                            Update Fund
                                        </a>
                                        <button class="btn btn-xs btn-danger">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
</div>

<!--end page content-->


