<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">

        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>

            <div class="card">
                <div class="card-header">
                    Income
                </div>
                <div class="card-body">

                    <?= form_open_multipart('finance/cashIn'); ?>
                    <div class="form-group">
                        <label for="keterangan">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="ex: Cash payment of .....">
                        <?= form_error('description', '<small class="text-danger pl-3">', ' </small>') ?>

                    </div>
                    <div class="form-group">
                        <input class="form-control" type="date" id="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="receipt">Receipt</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label for="image" class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="ex: 100000">
                        <?= form_error('amount', '<small class="text-danger pl-3">', ' </small>') ?>

                    </div>

                    <button type="submit" class="btn btn-dark">Add Income</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!--modal-->
<!-- Button trigger modal -->