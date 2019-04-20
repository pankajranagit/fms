<!--start page content-->
<?php $lable = $this->customlib->getLable(); ?>
<style>
    .padd_table{
        margin-top: -4px;
    }
    .padd_table td{
        padding-right: 5px;
    }
</style>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="widget white-bg  padding-0">
            <div class="row row-table">
                <div class="col-xs-4 text-center pv-15 bg-primary">
                    <em class="fa fa-inr fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-15 text-center">
                    <h3 class="mv-0 font-100" style="font-size: 18px">Rs. <?= $this->customlib->inr_format($total) ?></h3>
                    <div class="text-uppercase font-700">Total Fund</div>
                </div>
            </div>
        </div><!--end widget-->
    </div><!--end col-->
    <div class="col-lg-4 col-md-6">
        <div class="widget white-bg  padding-0">
            <div class="row row-table">
                <div class="col-xs-4 text-center pv-15 bg-danger">
                    <em class="fa fa-inr fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-15 text-center">
                    <h3 class="mv-0 font-100" style="font-size: 18px">Rs. <?= $this->customlib->inr_format($assigned) ?></h3>
                    <div class="text-uppercase font-700">Assigned Fund</div>
                </div>
            </div>
        </div><!--end widget-->
    </div><!--end col-->
    <div class="col-lg-4 col-md-6">
        <div class="widget white-bg  padding-0">
            <div class="row row-table">
                <div class="col-xs-4 text-center pv-15 bg-success">
                    <em class="fa fa-inr fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-15 text-center">
                    <h3 class="mv-0 font-100" style="font-size: 18px">Rs. <?= $this->customlib->inr_format($available) ?></h3>
                    <div class="text-uppercase font-700">Available Fund</div>
                </div>
            </div>
        </div><!--end widget-->
    </div><!--end col-->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-left" id="DEPARTMENT">Select Any <a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('DEPARTMENT', '<?= $lable['DEPARTMENT'] ?>', 'Select Any', 'to assign fund')"><?= $lable['DEPARTMENT'] ?> <i class="fa fa-pencil"></i></a> to assign fund</div>
                <a href="<?= base_url('Admin/ManageFund/assign') ?>" class="btn btn-warning pull-right" style="margin-top: -4px;">Bulk Fund Assignment</a><br>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        /* echo "<pre>";
                          print_r($hierarchy);
                          echo "</pre>"; */
                        ?>
                        <table class="table table-bordered fms-table">
                            <thead class="secondary">
                                <tr>
                                    <th>Parent</th>
                                    <th id="LABLEONE"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLEONE', '<?= $lable['LABLEONE'] ?>', '', '')"> <?= $lable['LABLEONE'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th id="LABLETWO"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLETWO', '<?= $lable['LABLETWO'] ?>', '', '')"><?= $lable['LABLETWO'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th class="text-center">Total Assigned Fund</th>
                                    <th class="text-center">Available Fund</th>
                                    <th class="text-center">Last Assigned</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                $rootname = "";
                                $lable_1 = "";
                                $lable_2 = "";
                                foreach ($hierarchy as $data) {
                                    if ($rootname != $data['root_name']) {
                                        $rootname = $data['root_name'];
                                        $root_txt = $rootname;
                                    }
                                    if ($lable_1 != $data['lable_1']) {
                                        $lable_1 = $data['lable_1'];
                                        $lab1_txt = $lable_1;
                                    }

                                    if ($lable_2 != $data['lable_2']) {
                                        $lable_2 = $data['lable_2'];
                                        $lab2_txt = $lable_2;
                                    }
                                    ?>
                                    <tr>
                                        <td> <h4><?= $root_txt ?></h4> </td>
                                        <td>
                                            <?php
                                            if ($lab1_txt != '') {
                                                ?> <h4><?= $lab1_txt ?></h4> <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($lab2_txt != '') {
                                                ?> <h4><a class="" href="<?= base_url('Admin/ManageChild/KYC/') . $data['lable_2_id'] ?>"><?= $lab2_txt ?></a></h4> <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                        <td class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                        <td class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                    </tr>
                                    <?php
                                    $root_txt = '';
                                    $lab1_txt = '';
                                    $lab2_txt = '';
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
<script>
    var base_url = "<?= base_url() ?>";
    function editThis(id, old_value, prefix, postfix) {
        html = "<table class='padd_table'>";
        html += "<tr>";
        html += "<td id='prefix'>" + prefix + "</td>";
        html += "<td><input onkeyup='change_default(this.id, this.value)' type='text' id='EDIT_" + id + "' value='" + old_value + "' class='form-control' placeholder='New Lable'></td>";
        html += "<td id='postfix'>" + postfix + "</td>";
        html += "<td><a href='' class='btn btn-danger'><i class='fa fa-check'></i></a></td>";
        html += "<tr>";
        html += "<table>";
        document.getElementById(id).innerHTML = html;
        document.getElementById('editable').focus();
    }

    function change_default(id, value) {
        var default_lable = id.split("_")['1'];
        var new_lable = value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
            }
        };
        xhttp.open("POST", base_url + "Setting/set_labeling", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("default_lable=" + default_lable + "&new_lable=" + new_lable);
        
    }
</script>


