<style>
    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }
    }

    table thead th {
        font-weight: bold !important;
    }

    .floatThead-container {
        margin-top: -6px !important;
    }
</style>
<div id="pesan" style="margin: 10px 5px;"></div>
<div class="example table-responsive">
    <table class="table table-hover dataTable table-striped text-nowrap" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <?php if (updateProject($this->session->userdata('level'))) { ?>
                    <th width="50"><i class="icon md-wrench"></i></th>
                <?php } ?>
                <th>PRJID</th>
                <th>JA</th>
                <th>DATEL</th>
                <th>NAMA LOOP</th>
                <th>JENIS PROJEK</th>
                <th>LOKASI</th>
                <th>KETERANGAN</th>
                <th>LAST UPDATE</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datas as $row) {
                $jenis = $row['status'];
                if ($jenis == '33') {
                    $jenis_k = '<span class="badge badge-success">PROSES GOLIVE</span>';
                } elseif ($jenis == '11') {
                    $jenis_k = '<span class="badge badge-info">SURVEY & PLAN</span>';
                } elseif ($jenis == '22') {
                    $jenis_k = '<span class="badge badge-info">DEPLOYMENT</span>';
                } elseif ($jenis == '44') {
                    $jenis_k = '<span class="badge badge-danger">KENDALA</span>';
                } elseif ($jenis == '55') {
                    $jenis_k = '<span class="badge badge-info">REDESAIN</span>';
                } elseif ($jenis == '66') {
                    $jenis_k = '<span class="badge badge-info">APPROVAL AMO</span>';
                } elseif ($jenis == '77') {
                    $jenis_k = '<span class="badge badge-info">NEXT PROJECT</span>';
                } elseif ($jenis == '88') {
                    $jenis_k = '<span class="badge badge-info">SELESAI GOLIVE</span>';
                } elseif ($jenis == '99') {
                    $jenis_k = '<span class="badge badge-danger">TERMINATE</span>';
                } elseif ($jenis == '100') {
                    $jenis_k = '<span class="badge badge-danger">REJECTED DATEL</span>';
                }
            ?>
                <tr>
                    <?php if (updateProject($this->session->userdata('level'))) { ?>
                        <td>
                            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['project_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a>
                            <!-- <a class="btn btn-primary btn-xs" href="<?= site_url('sales/project/follow_up/' . $project . '/' . $row['project_id'] . '') ?>" title="Follow UP"><i class="icon md-edit"></i> Follow Up</a> -->
                            <?php if (cannotDelete($this->session->userdata('level')) == false) { ?>
                                <?php
                                $cekSubPr = $this->db->get_where('tb_construction', ['project_id' => $row['project_id'], 'aktif' => 1])->result();
                                if (!empty($cekSubPr)) {
                                ?>
                                    <a class="btn btn-default btn-xs" href="#" title="Hapus"><i class="icon md-close"></i> Delete</a>
                                <?php } else { ?>
                                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_data(<?= $row['project_id']; ?>)"><i class="icon md-close"></i> Delete</a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    <?php } ?>
                    <td><?= 'PJ' . $row['project_code'] ?></td>
                    <td>
                        <?php
                        $query = $this->db->get_where('tb_construction', ['project_id' => $row['project_id'], 'aktif' => 1])->result_array();
                        $arryJA = array();
                        foreach ($query as $value) {
                            $arryJA[] = 'JA' . $value['sales_id'];
                        }
                        echo implode(', ', $arryJA);
                        ?>
                    </td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_lop'] ?></td>
                    <td><?= $row['jenis_prj'] ?></td>
                    <td><?= $row['lokasi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['last_update'] ?></td>
                    <td><?= $jenis_k ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            dom: 'Bfrtip',
            "scrollX": true,
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-default'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-success'
                }
            ]
        });

    });

    function delete_data(id) {
        Swal.fire({
            title: 'Yakin project akan dihapus?',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('sales/project/delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire('Data berhasil dihapus!')
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        })
    }


    function detail(id) {
        //save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sales/project/detail') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.project_id);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Update Project'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('Updating...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('sales/project/update_next_project') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    Swal.fire({
                            title: 'Berhasil!',
                            text: 'Keterangan berhasil diupdate!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        .then(function() {
                            window.location.reload();
                        });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Update'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Update'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_form" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Title</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Update Keterangan :</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="ket_update" id="ket_update" placeholder="Masukan keterangan. . ."></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->