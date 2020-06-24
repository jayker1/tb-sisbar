<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php
    $date1 = date_create($this->session->flashdata('first'));
    $date2 = date_create($this->session->flashdata('last'));

    ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> : <?= date_format($date1, "d-m-Y") ?> / <?= date_format($date2, "d-m-Y") ?> </h1>

    <form class="form-inline" action="<?= base_url('finance/search') ?>" method="post">

        <div class="form-group mb-2">
            <input class="form-control" type="date" id="first_date" value="<?= $this->session->flashdata('first') ?>" name="first_date">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" type="date" id="last_date" value="<?= $this->session->flashdata('last') ?>" name="last_date">
        </div>
        <button type="submit" class="btn btn-dark mb-2">Search</button>

    </form>

    <div class="row">


        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    Accounting Book
                </div>

                <div class="card-body">
                    <!-- <a href="#" class="btn btn-dark mb-3" data-toggle="modal" data-target="#printreport"><i class="fas fa-print"></i> Print Financial Report</a> -->
                    <a href="<?= base_url('finance/print?p=') ?>excel&first=<?= $this->session->flashdata('first') ?>&last=<?= $this->session->flashdata('last') ?>" class=" btn btn-success mb-4"><i class="fas fa-file-excel"></i> Download Excel</a>




                    <div style="width:100%;overflow: scroll;height: 455px;">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Trans.Number</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Income</th>
                                    <th scope="col">Outcome</th>
                                    <th scope="col">Total Cash</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $_cash = 0;
                                foreach ($first_cash as $fc) :

                                    if ($fc['income'] == 0) {
                                        $amount = $fc['outcome'];

                                        $_cash = $_cash - $amount;
                                    } else {
                                        $amount = $fc['income'];
                                        $_cash = $_cash + $amount;
                                    }
                                endforeach;
                                ?>
                                <tr>
                                    <th scope="row">-</th>
                                    <td>-</td>
                                    <td>-</td>

                                    <td>Last Cash</td>
                                    <td style="text-align:right;">-</td>
                                    <td style="text-align:right;">-</td>
                                    <td style="text-align:right;">Rp <?= number_format($_cash, 0, ',', '.') ?>
                                    </td>
                                </tr>

                                <?php
                                if ($_cash != 0) {
                                    $cash = $_cash;
                                } else {
                                    $cash = 0;
                                }
                                $i = 1;
                                foreach ($journal as $j) :

                                    $date = date_create($j['transaction_date']);

                                    if ($j['income'] == 0) {
                                        $amount = $j['outcome'];

                                        $cash = $cash - $amount;
                                    } else {
                                        $amount = $j['income'];
                                        $cash = $cash + $amount;
                                    }
                                ?>

                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= date_format($date, "d F Y") ?></td>
                                        <td><?= $j['transaction_id'] ?></td>
                                        <td><?= $j['description'] ?></td>
                                        <td style="text-align:right;"><?= number_format($j['income'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;"><?= number_format($j['outcome'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;">Rp <?= number_format($cash, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="printreport" tabindex="-1" role="dialog" aria-labelledby="printreportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printreportLabel">Print Financial Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline">

                    <div class="form-group mx-sm-3 mb-2">
                        <a href="<?= base_url('finance/print?p=') ?>excel&first=<?= $this->session->flashdata('first') ?>&last=<?= $this->session->flashdata('last') ?>" class=" btn btn-success mb-3"><i class="fas fa-file-excel"></i> Download Excel</a>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>