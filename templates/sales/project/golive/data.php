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
<script src="<?= base_url() ?>assets/global/custom/js/web_helper.js"></script>
<div class="preloader" style="display: none;"></div>
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
                <!-- <th>LOKASI</th> -->
                <th>KETERANGAN</th>
                <th>LAST UPDATE</th>
                <th>PROGRESS</th>
                <th>STATUS</th>
                <th><i class="icon md-wrench"></i></th>
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
                }
            ?>
                <tr>
                    <?php if (updateProject($this->session->userdata('level'))) { ?>
                        <td>
                            <?php if ($row['progress'] != 'GOLIVE') { ?>
                                <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['project_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a>
                            <?php } ?>
                            <a class="btn btn-success btn-xs" href="<?= site_url('sales/project/record/' . $project . '/' . $row['project_id'] . '') ?>" title="Record Data"><i class="icon md-search"></i> Record</a>
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
                        $pecah = explode("-", $row['nama_lop']);
                        $sales_id = str_replace("JA", "", $pecah[0]);
                        $project_id = $row['project_id'];
                        //$query = $this->db->get_where('tb_construction', ['project_id' => $row['project_id'], 'aktif' => 1])->result_array();
                        $query = $this->db->query("SELECT * FROM tb_construction WHERE project_id = '$project_id' AND aktif = 1 ORDER BY CASE WHEN sales_id = '$sales_id' THEN 1 END DESC")->result_array();
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
                    <!-- <td><?= $row['lokasi'] ?></td> -->
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['last_update'] ?></td>
                    <td><?= '<span class="text-danger">' . $row['progress'] . '</span>' ?></td>
                    <td><?= $jenis_k ?></td>
                    <td>
                        <a class="btn btn-info btn-xs" href="javascript:void(0)" title="Follow UP" onclick="history(<?= $row['project_id']; ?>)"><i class="icon md-info"></i> History</a>
                    </td>
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

        $('#progress_update').change(function() {
            var cek = $(this).val();

            if (cek == '') {
                $('#btnSave').prop('disabled', true);
            } else {
                $('#btnSave').prop('disabled', false);
            }
        });
    });

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
                $('[name="progress"]').val(data.progress);
                $('[name="nama_loop"]').val(data.nama_lop);
                if (data.progress == 'VALIDASI GOLIVE' || data.progress == 'KENDALA GOLIVE') {
                    $('#progress_update').empty().append('<option selected="selected" value="">--Update Progress--</option>');
                    $("#progress_update").append(new Option("DRAWING SMALL WORLD", "DRAWING SMALL WORLD"));
                    $("#progress_update").append(new Option("PERBAIKAN MAINCORE", "PERBAIKAN MAINCORE"));
                    $("#progress_update").append(new Option("KENDALA", "KENDALA"));
                } else if (data.progress == 'DRAWING SMALL WORLD') {
                    $('#progress_update').empty().append('<option selected="selected" value="">--Update Progress--</option>');
                    $("#progress_update").append(new Option("KONEKSI UIM", "KONEKSI UIM"));
                } else if (data.progress == 'KONEKSI UIM') {
                    $('#progress_update').empty().append('<option selected="selected" value="">--Update Progress--</option>');
                    $("#progress_update").append(new Option("GOLIVE", "GOLIVE"));
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Update Progress Golive'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

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

    function history(id) {
        $(".preloader").css("display", "");
        $(".preloader").preloader();
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sales/track_order/history_project') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let isi = '';
                if (data.isi.length > 0) {
                    for (let i = 0; i < data.isi.length; i++) {
                        let action_status = getstatusLog(data.isi[i].action_status);
                        let keterangan = data.isi[i].a_keterangan === null ? 'TDK ADA KETERANGAN' : data.isi[i].a_keterangan;
                        let action_on = data.isi[i].action_on.split(" ");
                        let date = action_on[0];
                        let time = action_on[1];
                        isi += `<li class="list-group-item">
                                <small class="badge badge-round badge-danger float-right">${action_status}</small>
                                <p><a class="hightlight" href="javascript:void(0)">${keterangan}</a>
                                    <span>[${action_status}]</span>
                                </p>
                                <small>Action by
                                    <a class="hightlight" href="javascript:void(0)">
                                    <span>${data.isi[i].action_by}</span>
                                    </a>
                                    <time datetime="2017-07-01T08:55"> Tanggal ${date} Pukul ${time}</time>
                                </small>
                            </li>`;
                    }
                } else {
                    isi = 'Tidak ada History untuk JA' + id + '';
                }
                $("#history-order").html(isi);
                $('#modal_history').modal('show'); // show bootstrap modal when complete loaded
                $(".preloader").fadeOut();
                $('.history').text('History Order JA' + id); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
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
                <h3 class="modal-title">Follow Up Order</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="" name="progress" />
                    <input type="hidden" value="" name="nama_loop" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Update Next Progress <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select name="progress_update" id="progress_update" class="form-control" placeholder="Pilih" data-plugin="select2">
                                    <option value="">--Pilih Progress--</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Update Keterangan :</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="ket_update" id="ket_update"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary" disabled>Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_history" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title history">Follow Up Order</h3>
            </div>
            <div class="modal-body">
                <!-- Panel Tickets -->
                <div class="panel">
                    <div class="panel-body">
                        <ul class="list-group list-group-dividered list-group-full">
                            <div data-role="container">
                                <div data-role="content" id="history-order">

                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <!-- End Panel Tickets -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>
    function save() {
        $('#btnSave').text('Updating...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('sales/project/golive_update') ?>";

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
                            text: 'Progress berhasil diupdate!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        .then(function() {
                            window.location.reload();
                        });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
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