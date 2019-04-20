<!--start page content-->
<?php $lable = $this->customlib->getLable(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= $lable['LABLEONE'] ?> : <?= $unit_detail['parent_lable'] ?> >> <?= $lable['LABLETWO'] ?> : <?= $unit_detail['lable'] ?>
            </div>
            <div class="panel-body kyc">
                <form action="<?= base_url('Admin/ManageChild/KYC/') . $hierarchy_id ?>" method="POST">
                    <h4><?= $lable['LABLETWO'] ?> Head Detail</h4>
                    <div class="row form-group">
                        <div class="col-lg-3">
                            <label class="font-100">Head Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">Head Designation</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">Head Email</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">Head Contact</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label class="font-100">Office Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <h4><?= $lable['LABLETWO'] ?> Bank Detail</h4>
                    <div class="row form-group">
                        <div class="col-lg-3">
                            <label class="font-100">Bank Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">Bank Branch</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">Account Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="font-100">IFSC Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div><hr>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <button class="btn btn-warning">Save KYC Only</button>
                            <button class="btn btn-primary">Save KYC &amp; Send Login Detail</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--end col-->
</div>

<!--end page content-->


