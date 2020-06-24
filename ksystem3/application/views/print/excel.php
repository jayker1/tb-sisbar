<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Financial Report of K-Radio Station.xls");

$date1 = date_create($this->session->flashdata('first'));
$date2 = date_create($this->session->flashdata('last'));

?>
<table class="table table-hover">
    <thead>
        <tr>
            <th colspan=6 height="20px">Financial Report</th>
        </tr>
        <tr>
            <th colspan=6 height="20px">K-Radio Station</th>
        </tr>
        <tr>
            <th colspan=6 height="20px">Monthly Period : <?= date_format($date1, " F Y") ?> - <?= date_format($date2, "F Y")  ?></th>
        </tr>


        <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Trans.Number</th>
            <th scope="col">Description</th>
            <th scope="col">Income</th>
            <th scope="col">Outcome</th>
            <th scope="col">Cash(Rp)</th>
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
            <th scope="row"></th>
            <td>-</td>
            <td>-</td>

            <td>Last Cash</td>
            <td style="text-align:right;">-</td>
            <td style="text-align:right;">-</td>
            <td style="text-align:right;"> <?= $_cash ?>
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
                <td style="text-align:right;"><?= $j['income'] ?></td>
                <td style="text-align:right;"><?= $j['outcome'] ?></td>
                <td style="text-align:right;"><?= $cash ?>
                </td>
            </tr>
        <?php $i++;
        endforeach ?>
    </tbody>
</table>