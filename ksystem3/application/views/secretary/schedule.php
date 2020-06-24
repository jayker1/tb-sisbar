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

            <a href="" class="btn btn-dark mb-3" data-toggle="modal" data-target="#newScheduleModal">Add New Schedule</a>
        </div>
        <!-- /.container-fluid -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Time</th>
                    <th scope="col">Day</th>
                    <th scope="col">Action</th>
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
                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#newEditScheduleModal<?= $s['id']; ?>">edit</a>
                            <a href="<?= base_url('secretary/deleteschedule/') . $s['id']; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this <?= $s['name'] ?> schedule?')" class="badge badge-danger" class=" badge badge-danger">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- End of Main Content -->
    <!-- Modal -->
    <div class="modal fade" id="newScheduleModal" tabindex="-1" role="dialog" aria-labelledby="newScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newScheduleModalLabel">Add New Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('secretary/schedule'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form_group mb-3">
                            <select name="name" id="name" class="form-control">
                                <option value="">
                                    Select Member
                                </option>
                                <?php foreach ($member as $m) : ?>
                                    <option value="<?= $m['name']; ?>"><?= $m['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="time" id="time" class="form-control">
                                <option value="">Select Time</option>
                                <option value="07.30 AM - 09.30 AM">07.30 AM - 09.30 AM</option>
                                <option value="09.30 AM - 11.30 AM">09.30 AM - 11.30 AM</option>
                                <option value="01.00 PM - 03.00 PM">01.00 PM - 03.00 PM</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="day" id="day" class="form-control">
                                <option value="">Select Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <?php foreach ($schedule as $s) : ?>
        <div class="modal fade" id="newEditScheduleModal<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newEditScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newEditScheduleModalLabel">Edit Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('secretary/editschedule/') . $s['id']; ?>" method="post">
                        <div class="modal-body">
                            <div class="form_group mb-3">
                                <select name="name" id="name" class="form-control">
                                    <option value="<?= $s['name']; ?>">
                                        <?= $s['name']; ?>
                                    </option>
                                    <?php foreach ($member as $m) : ?>
                                        <option value="<?= $m['name']; ?>"><?= $m['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="time" id="time" class="form-control">
                                    <option value="<?= $s['time'] ?>"><?= $s['time'] ?></option>
                                    <option value="07.30 AM - 09.30 AM">07.30 AM - 09.30 AM</option>
                                    <option value="09.30 AM - 11.30 AM">09.30 AM - 11.30 AM</option>
                                    <option value="01.00 PM - 03.00 PM">01.00 PM - 03.00 PM</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="day" id="day" class="form-control">
                                    <option value="<?= $s['day'] ?>"><?= $s['day'] ?></option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>