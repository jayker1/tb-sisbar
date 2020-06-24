<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
        </div>
        <!-- /.container-fluid -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Time</th>
                    <th scope="col">Day</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($schedule as $s) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $s['name']; ?></td>
                        <td><?= $s['time']; ?></td>
                        <td><?= $s['day']; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- End of Main Content -->