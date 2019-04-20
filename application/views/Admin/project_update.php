<!--start page content-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 project_detail">
                        <form method="post" action="<?= base_url('Admin/ManageProject/update') ?>/<?= $proj_id ?>">
                            <label>Project Title</label>
                            <p><?= $all_project[0]['project_title'] ?></p>
                            <hr>
                            <label>Project Type</label>
                            <p><?= $all_project[0]['project_type'] ?></p>
                            <hr>
                            <label>Project Description</label>
                            <p><?= $all_project[0]['project_description'] ?></p>
                            <hr>
                            <label>New Allotment Amount</label>
                            <input type="text" class="form-control" value="<?= set_value('fund_allotted') ?>" name="fund_allotted" placeholder="Enter Amount">
                            <lable class="small text-danger"><?php echo form_error('fund_allotted'); ?></lable>
                            <hr>
                            <button type="submit" name="add_fund" class="btn btn-primary btn-block">Add Fund</button>
                        </form>
                    </div>
                    <div class="col-lg-8 project_detail">
                        <?php $arrAllot = array_column($all_project, 'fund_allotted'); ?>
                        <h4>Total Allotment Till Now : <?= $this->customlib->inr_format(array_sum($arrAllot)) ?></h4>
                        <table class="table table-bordered">
                            <thead class="secondary">
                                <tr>
                                    <th>Sr</th>
                                    <th>Fund Allotted</th>
                                    <th>Allotment Date</th>
                                    <th>Allotment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                foreach ($all_project as $temp) {
                                    ?>
                                    <tr>
                                        <td><?= $sr ?></td>
                                        <td>INR <?= $this->customlib->inr_format($temp['fund_allotted']) ?></td>
                                        <td><?= date('d M, Y H:i A', strtotime($temp['allotment_date'])) ?></td>
                                        <td>
                                            <?php echo ($temp['fund_status'] == 1 ? "<p class='text-success'>Approved</p>" : "<p class='text-danger'>Hold<p>"); ?>
                                        </td>
                                        <td><button class="btn btn-danger btn-xs">Hold</button></td>
                                    </tr>
                                    <?php
                                    $sr++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
</div>

<!--end page content-->


