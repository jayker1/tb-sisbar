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
                    Edit Information
                </div>
                <div class="card-body">

                    <form action="<?= base_url('secretary/editinformation/') . $announcement['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Write title here..." value="<?= $announcement['title']; ?>">
                            <?= form_error('title', '<small class="text-danger pl-3">', ' </small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <input type="text" class="form-control" id="topic" name="topic" placeholder="Write topic here..." value="<?= $announcement['topic']; ?>">
                            <?= form_error('topic', '<small class="text-danger pl-3">', ' </small>') ?>
                        </div>
                        <label for="topic">Information</label>
                        <textarea class="form-control" id="information" name="information" placeholder="Write information here..."><?= $announcement['information']; ?></textarea>
                        <?= form_error('information', '<small class="text-danger pl-3">', ' </small>') ?>
                        <br>

                        <button type="submit" class="btn btn-dark">Edit Information</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->