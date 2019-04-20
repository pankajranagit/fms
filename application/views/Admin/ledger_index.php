<!--start page content-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="pull-left"><b>From :</b> <?= date('F, Y') ?> - <b>To :</b> <?= date('F, Y') ?></div>
                <div class="pull-right">
                    <table class="date-select">
                        <tr>
                            <td>From</td>
                            <td><input type="month" value="<?= date('Y-m') ?>" class="form-control"></td>
                            <td>to</td>
                            <td><input type="month" value="<?= date('Y-m') ?>" class="form-control"></td>
                        </tr>
                    </table>
                </div><br>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-right">Opening Balance : <?= $this->customlib->inr_format($open_bal) ?></h4>
                        <table class="table table-bordered">
                            <thead class="secondary">
                                <tr>
                                    <th nowrap>Date</th>
                                    <th nowrap>Transaction Id</th>
                                    <th nowrap style="width: 350px;">Particular</th>
                                    <th nowrap>Amount Debit</th>
                                    <th nowrap>Amount Credit</th>
                                    <th nowrap>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-15day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>New Project Initiated (Indira Awaas Yojana) fund allotted to Madhya Pradesh</td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $credit[] = 500000000;
                                        $debit[] = 0;
                                        echo $this->customlib->inr_format($credit[0]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[0]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-13day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>Fund Allotted to 10 District for (Indira Awaas Yojana)</td>
                                    <td>
                                        <?php
                                        $credit[] = 0;
                                        $debit[] = 200000000;
                                        echo $this->customlib->inr_format($debit[1]);
                                        ?>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[1]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-12day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>Fund Allotted to 2 District for (Indira Awaas Yojana)</td>
                                    <td>
                                        <?php
                                        $credit[] = 0;
                                        $debit[] = 40000000;
                                        echo $this->customlib->inr_format($debit[2]);
                                        ?>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[2]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-12day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>New Project Initiated (Pradhan Mantri Gram Sadak Yojana) fund allotted to Madhya Pradesh</td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $credit[] = 1000000000;
                                        $debit[] = 0;
                                        echo $this->customlib->inr_format($credit[3]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[3]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-9day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>Fund Allotted to 22 District for (Pradhan Mantri Gram Sadak Yojana)</td>
                                    <td>
                                        <?php
                                        $credit[] = 0;
                                        $debit[] = 500000000;
                                        echo $this->customlib->inr_format($debit[4]);
                                        ?>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[4]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= date('d M, Y', strtotime('-8day', time())) ?></td>
                                    <td>MP<?= rand(10000000, 99999999) ?></td>
                                    <td>New Project Initiated (National Health Mission) fund allotted to Madhya Pradesh</td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $credit[] = 5000000000;
                                        $debit[] = 0;
                                        echo $this->customlib->inr_format($credit[5]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $balance[] = ($open_bal + array_sum($credit)) - array_sum($debit);
                                        echo $this->customlib->inr_format($balance[5]);
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="text-right">Closing Balance : <?= $this->customlib->inr_format($balance[5]) ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
</div>

<!--end page content-->


