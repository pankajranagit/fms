<?php $lable = $this->customlib->getLable(); ?>
<!--start page content-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-left">Add your organization's hierarchy</div>
                <div class="pull-right"><?php echo $this->session->flashdata('msg'); ?></div><br>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <form role="form" action="<?= base_url('Admin/ManageChild/add') ?>" class="form-horizontal" method="post">
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <input type="text" value="<?= set_value('lable') ?>" name="lable" placeholder="Hierarchy Label" class="form-control ">
                                    <lable class="small text-danger"><?php echo form_error('lable'); ?></lable>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <input type="text" value="<?= set_value('description') ?>" name="description" placeholder="Description (Optional)" class="form-control ">
                                    <lable class="small text-danger"><?php echo form_error('description'); ?></lable>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <?php $parent_id = set_value('parent_id'); ?>
                                    <select class="form-control" name="parent_id">
                                        <option value="">Select Parent</option>
                                        <?php
                                        foreach ($parent as $temp) {
                                            ?> <option <?= ($parent_id == $temp['id'] ? 'selected' : '') ?> value="<?= $temp['id'] ?>"><?= $temp['lable'] ?></option> <?php
                                        }
                                        ?>
                                    </select>
                                    <lable class="small text-danger"><?php echo form_error('parent_id'); ?></lable>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <?php $report_type = set_value('report_type'); ?>
                                    <select class="form-control" name="report_type">
                                        <option value="">Select Reporting Type</option>
                                        <?php
                                        $reporting = $this->customlib->reporting_type();
                                        foreach ($reporting as $key => $temp) {
                                            ?> <option <?= ($report_type == $key ? 'selected' : '') ?> value="<?= $key ?>"><?= $temp['lable'] ?></option> <?php
                                        }
                                        ?>
                                    </select>
                                    <lable class="small text-danger"><?php echo form_error('report_type'); ?></lable>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8" style="height: 245px; overflow: auto">
                        <?php $controller->print_tree($tree); ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        /*echo "<pre>";
                        print_r($hierarchy);
                        echo "</pre>";*/
                        ?>
                        <h4 style="font-weight: normal">Add KYC Detail</h4>
                        <table class="table table-bordered">
                            <thead class="secondary">
                                <tr>
                                    <th>Parent</th>
                                    <th id="LABLEONE"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLEONE', '<?= $lable['LABLEONE'] ?>', '', '')"> <?= $lable['LABLEONE'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th id="LABLETWO"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLETWO', '<?= $lable['LABLETWO'] ?>', '', '')"><?= $lable['LABLETWO'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th></th>
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
                                                echo $lab1_txt;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($lab2_txt != '') {
                                                echo $lab2_txt;
                                            }
                                            ?>
                                        </td>
                                        <td><a class="btn btn-dropbox btn-xs" href="<?= base_url('Admin/ManageChild/KYC/').$data['lable_2_id'] ?>">Add KYC</a></td>
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


