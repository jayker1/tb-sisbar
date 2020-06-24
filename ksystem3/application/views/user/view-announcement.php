<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('message') ?>

            <div class="card">
                <div class="card-header">
                    Information Detail
                </div>
                <div class="card-body">
                    <h5 class="card-title">Title</h5>
                    <h6 class="card-title"><?= $announcement['title']; ?></h6>

                    <h5 class="card-title">Topic</h5>
                    <h6 class="card-title"><?= $announcement['topic']; ?></h6>

                    <h5 class="card-title">Information</h5>
                    <h6 class="card-title"><?= $announcement['information']; ?></h6>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->