<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img alt="" src="<?= base_url('assets/images/logo.png') ?>" width="30" height="30" class="d-inline-block align-top"> IT Project List
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add Project
                </button>
        </div>
    </nav>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } else if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="table_data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Deskripsi</th>
                            <th>PIC</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Task Complexity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($data as $d) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nama_project']; ?></td>
                            <td><?php echo $d['deskripsi']; ?></td>
                            <td><?php echo $d['pic']; ?></td>
                            <td><?php echo $d['start_date']; ?></td>
                            <td><?php echo date('d M Y', strtotime($d['due_date'])); ?></td>
                            <?php
                                if ($d['priority'] == 0) {
                                    $ket_priority = '<span class="badge bg-secondary">LOW</span>';
                                } elseif ($d['priority'] == 1) {
                                    $ket_priority = '<span class="badge bg-primary">NORMAL</span>';
                                } elseif ($d['priority'] == 2) {
                                    $ket_priority = '<span class="badge bg-warning">HIGH</span>';
                                } else {
                                    $ket_priority = '<span class="badge bg-danger">URGENT</span>';
                                }
                            ?>
                            <td><?php echo $ket_priority; ?></td>
                            <?php
                                if ($d['status'] == 0) {
                                    $ket_status = '<span class="badge bg-secondary">NOT STARTED</span>';
                                } elseif ($d['status'] == 1) {
                                    $ket_status = '<span class="badge bg-primary">IN PROGRESS</span>';
                                } elseif ($d['status'] == 2) {
                                    $ket_status = '<span class="badge bg-warning">ON HOLD</span>';
                                } else {
                                    $ket_status = '<span class="badge bg-success">COMPLETED</span>';
                                }
                            ?>
                            <td><?php echo $ket_status; ?></td>
                            <?php
                                if ($d['task_complexity'] == 0) {
                                    $ket_task_priority = '<span class="badge bg-success">LOW</span>';
                                } elseif ($d['task_complexity'] == 1) {
                                    $ket_task_priority = '<span class="badge bg-warning">MEDIUM</span>';
                                } else {
                                    $ket_task_priority = '<span class="badge bg-danger">HARD</span>';
                                }
                            ?>
                            <td><?php echo $ket_task_priority; ?></td>
                            <td>
                                <a href="#" id="edit" class="btn btn-warning" data-id="<?=$d['id_project']?>">Edit</a>
                                <a href="<?php echo base_url('home/deleteProject/'.$d['id_project']); ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url('home/addProject')?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_project">Nama Project</label>
                            <input type="text" class="form-control" id="nama_project" name="nama_project" placeholder="Nama Project">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pic">PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic" placeholder="PIC">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select class="form-select" aria-label="Default select example" id="priority" name="priority">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <option value="0">LOW</option>
                                <option value="1">NORMAL</option>
                                <option value="2">HIGH</option>
                                <option value="3">URGENT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="0">NOT STARTED</option>
                                <option value="1">IN PROGRESS</option>
                                <option value="2">ON HOLD</option>
                                <option value="3">COMPLETED</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="task_complexity">Task Complexity</label>
                            <select class="form-select" aria-label="Default select example" id="task_complexity" name="task_complexity">
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="0">LOW</option>
                                <option value="1">MEDIUM</option>
                                <option value="2">HARD</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Of Add Modal -->

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url('home/editProject')?>" method="POST">
                    <input type="hidden" class="form-control" id="id_project_edit" name="id_project_edit">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_project_edit">Nama Project</label>
                            <input type="text" class="form-control" id="nama_project_edit" name="nama_project_edit" placeholder="Nama Project">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_edit">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pic_edit">PIC</label>
                            <input type="text" class="form-control" id="pic_edit" name="pic_edit" placeholder="PIC">
                        </div>
                        <div class="form-group">
                            <label for="start_date_edit">Start Date</label>
                            <input type="date" class="form-control" id="start_date_edit" name="start_date_edit">
                        </div>
                        <div class="form-group">
                            <label for="due_date_edit">Due Date</label>
                            <input type="date" class="form-control" id="due_date_edit" name="due_date_edit">
                        </div>
                        <div class="form-group">
                            <label for="priority_edit">Priority</label>
                            <select class="form-select" aria-label="Default select example" id="priority_edit" name="priority_edit">
                                <option value="" selected disabled>-- Pilih --</option> 
                                <option value="0">LOW</option>
                                <option value="1">NORMAL</option>
                                <option value="2">HIGH</option>
                                <option value="3">URGENT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_edit">Status</label>
                            <select class="form-select" aria-label="Default select example" id="status_edit" name="status_edit">
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="0">NOT STARTED</option>
                                <option value="1">IN PROGRESS</option>
                                <option value="2">ON HOLD</option>
                                <option value="3">COMPLETED</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="task_complexity_edit">Task Complexity</label>
                            <select class="form-select" aria-label="Default select example" id="task_complexity_edit" name="task_complexity_edit">
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="0">LOW</option>
                                <option value="1">MEDIUM</option>
                                <option value="2">HARD</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Of Edit Modal -->

    <script>
        $(document).ready(function() {
            $('#table_data').DataTable();
        });

        $(document).on('click', '#edit', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?=base_url('home/getProjectById/')?>'+id,
                dataType: 'json',
                success: function(data) {
                    $('#id_project_edit').val(id);
                    $('#nama_project_edit').val(data[0].nama_project);
                    $('#deskripsi_edit').val(data[0].deskripsi);
                    $('#pic_edit').val(data[0].pic);
                    $('#start_date_edit').val(data[0].start_date);
                    $('#due_date_edit').val(data[0].due_date);
                    $('#priority_edit').val(data[0].priority);
                    $('#status_edit').val(data[0].status);
                    $('#task_complexity_edit').val(data[0].task_complexity);
                    $('#editModal').modal('show');
                }
            });
        });
    </script>
</body>
</html>