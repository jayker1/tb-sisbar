<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($announcement as $a) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $a['title']; ?></td>
                        <td><?= $a['topic']; ?></td>
                        <td><?= $a['date_created']; ?></td>
                        <td>
                            <a href="<?= base_url('secretary/editinformation/') . $a['id']; ?>" class="badge badge-success">edit</a>
                            <a href="<?= base_url('secretary/deleteinformation/') . $a['id']; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this <?= $a['title'] ?> schedule?')" class="badge badge-danger" class=" badge badge-danger">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->