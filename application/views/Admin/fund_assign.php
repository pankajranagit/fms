<?php $lable = $this->customlib->getLable(); ?>
<!--start page content-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-left">Assign Project Wise Fund</div>
                <div class="pull-right">
                    <button style="margin-top: -4px;" class="btn btn-default"><i class="fa fa-file-excel-o"></i>&nbsp; Import Excel</button>
                </div>
                <br>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php
                        $idArr = array_column($project_list, 'id');
                        $currIndex = array_search($curr_proj_id, $idArr);
                        //echo "<pre>"; print_r($project_list); echo "</pre>"; 
                        ?>
                        <label>Allotment for the project</label>
                        <select class="form-control" onchange="changeUrl(this.value)">
                            <?php
                            foreach ($project_list as $data) {
                                ?> <option <?= ($curr_proj_id == $data['id'] ? 'selected' : '') ?> value="<?= $data['id'] ?>"><?= $data['project_title'] ?></option> <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-8">
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 150px; background-color: #607d8b; color: #fff">Available Fund</td>
                                <td style="color: #000" id="totfund_<?=$sr?>"><?= $this->customlib->inr_format($project_list[$currIndex]['Total_Fund_Allotted']) ?></td>
                                <td style="width: 150px; background-color: #607d8b; color: #fff">Allotted Fund</td>
                                <td style="color: #000" id="allotted_<?=$sr?>"><?= $this->customlib->inr_format($project_list[$currIndex]['Total_Fund_Allotted']) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 150px; background-color: #607d8b; color: #fff">Project Type</td>
                                <td colspan="3" style="color: #000"><?= $project_list[$currIndex]['project_type'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered fms-table">
                            <thead class="secondary">
                                <tr>
                                    <th id="LABLEONE"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLEONE', '<?= $lable['LABLEONE'] ?>', '', '')"> <?= $lable['LABLEONE'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th id="LABLETWO"><a href="javascript:void(0)" title="Click here to change this lable" class="inline-edit" onclick="editThis('LABLETWO', '<?= $lable['LABLETWO'] ?>', '', '')"><?= $lable['LABLETWO'] ?> <i class="fa fa-pencil"></i></a></th>
                                    <th class="text-center">Total Assigned Fund</th>
                                    <th class="text-center">Available Fund</th>
                                    <th class="text-center">Last Assigned</th>
                                    <th class="text-center" style="width: 200px;">New Allotment</th>
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
                                                ?> <h4><?= $lab2_txt ?></h4> <?php
                                            }
                                            ?>
                                        </td>
                                        <td id="assign_<?=$sr?>" class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                        <td id="available_<?=$sr?>" class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                        <td class="text-right"><?= $this->customlib->inr_format(0) ?></td>
                                        <td><input  id="newallot_<?=$sr?>" type="text" name="" class="form-control"></td>
                                    </tr>
                                    <?php
                                    $root_txt = '';
                                    $lab1_txt = '';
                                    $lab2_txt = '';
                                    
                                    $sr++;
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="text-right"></td>
                                    <td>
                                        <button class="btn btn-block btn-primary">Update Allottment</button>
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
<script>
    base_url = '<?= base_url() ?>';
    function changeUrl(id) {
        window.location.href = base_url + "Admin/ManageFund/assign/" + id;
    }
</script>
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
    
    //totfund_
    //allotted_
    //assign_
    //available_
    //newallot_
    
</script>


