<style>
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
    <table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <th>JA</th>
                <th>UNIT</th>
                <th>DATEL</th>
                <th>NAMA PELANGGAN</th>
                <th>PJ ID</th>
                <th>CP</th>
                <th>ALAMAT</th>
                <th>LOKASI SALES</th>
                <th>NAMA SALES</th>
                <th>LOC BY TEKNISI</th>
                <th>JARAK</th>
                <th>MYIR</th>
                <th>ODP SALES</th>
                <th>ODP PLAN</th>
                <th>KETERANGAN</th>
                <th>STATUS</th>
                <th>STATUS JA</th>
                <th>LAST UPDATE</th>
                <th>LAST UPDATE BY</th>
                <th width="50"><i class="icon md-wrench"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datas as $row) {
                $jenis = $row['status'];
                if ($jenis == '33') {
                    $jenis_k = '<span class="badge badge-success">GOLIVE</span>';
                } elseif ($jenis == '11') {
                    $jenis_k = '<span class="badge badge-info">SURVEY & PLAN</span>';
                } elseif ($jenis == '22') {
                    $jenis_k = '<span class="badge badge-info">DEPLOYMENT</span>';
                } elseif ($jenis == '44') {
                    $jenis_k = '<span class="badge badge-danger">KENDALA GOLIVE</span>';
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
                } elseif ($jenis == '10') {
                    $jenis_k = '<span class="badge badge-info">APPROVAL DATEL</span>';
                } elseif ($jenis == '100') {
                    $jenis_k = '<span class="badge badge-danger">REJECTED DATEL</span>';
                } else {
                    $jenis_k = '<span class="badge badge-info">UNIDENTIFIED</span>';
                }
            ?>
                <tr>
                    <td><?= 'JA' . $row['sales_id'] ?></td>
                    <td><?= $row['unit'] ?></td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= 'PJ' . getProjectID($row['project_id']) ?></td>
                    <td><?= $row['cp'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['lat_long'] ?></td>
                    <td><?= $row['nama_sales'] ?></td>
                    <td><?= $row['loc_cust'] ?></td>
                    <td>
                        <?php
                        if (!empty($row['lat_long']) && !empty($row['loc_cust'])) {
                            if (preg_match("/[a-z]/i", $row['lat_long']) || preg_match("/[a-z]/i", $row['loc_cust'])) {
                                echo "Tidak dapat mengukur jarak";
                            } else {
                                $loc_sales = str_replace(" ", "", explode(",", $row['lat_long']));
                                $loc_tek   = str_replace(" ", "", explode(",", $row['loc_cust']));
                                $lat_sales = $loc_sales[0];
                                $lng_sales = $loc_sales[1];
                                $lat_tekns = $loc_tek[0];
                                $lng_tekns = $loc_tek[1];
                                $dstnce = distance($lat_sales, $lng_sales, $lat_tekns, $lng_tekns);
                                if ($dstnce < 5) {
                                    echo "<span class='text-success'>" . $dstnce . "m</span>";
                                } else {
                                    echo "<span class='text-danger'>" . $dstnce . " m</span>";
                                }
                            }
                        } else {
                            echo "Tidak dapat mengukur jarak";
                        }
                        ?>
                    </td>
                    <td><?= $row['myir'] ?></td>
                    <td><?= $row['odp'] ?></td>
                    <td><?= $row['odp_plan'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $jenis_k; ?></td>
                    <td><?= $row['status_ja'] ?></td>
                    <td><?= $row['last_update'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td>
                        <?php if (manjaUlangConstruction($this->session->userdata('level'))) { ?>
                            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['construction_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a><br>
                        <?php } ?>
                        <a style="margin-top: 5px;" class="btn btn-info btn-xs" href="javascript:void(0)" title="Follow UP" onclick="history(<?= $row['sales_id']; ?>)"><i class="icon md-info"></i> History</a>
                        <!-- <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_data(<?= $row['construction_id']; ?>)"><i class="icon md-close"></i> Delete</a> -->
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

        $("#check-all").click(function() {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        $('#seltek').select2({
            width: '100%'
        });

        $('input[type="checkbox"]').click(function() {
            if ($(this).is(":checked")) {
                $('.ap').prop('disabled', false);
            } else {
                $('.ap').prop('disabled', true);
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
            url: "<?php echo site_url('sales/construction/detail') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.construction_id);
                $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="status"]').val(data.status);

                var href = "<?php echo site_url('sales/project/record/redesain/') ?>" + data.project_id;

                if (data.project_code != null) {
                    $('#project_id_now').attr("href", href);
                    $('#project_id_now').html("PJ" + data.project_code);
                    $('#form-project-id-now').show();
                } else {
                    $('#form-project-id-now').hide();
                }

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Order Detail'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        if ($('#ket_update').val() === "") {
            $('#modal_form').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Keterangan update wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_form').modal('show');
            });
        } else {
            $('#btnSave').text('Updating...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable
            var url;

            url = "<?php echo site_url('sales/construction/update') ?>";

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
                                text: 'Data berhasil diupdate!',
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
    }

    function history(id) {
        $(".preloader").css("display", "");
        $(".preloader").preloader();
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sales/track_order/history_popup') ?>/" + id,
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
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">NAMA :</label>
                            <div class="col-md-12">
                                <input name="nama_pelanggan" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">KETERANGAN :</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="keterangan" readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">UBAH PROJEK ID :</label>
                            <div class="col-md-12">
                                <input name="project_id" class="form-control" type="text">
                                <small id="emailHelp" class="form-text text-info">Isikan Project ID dari jarvis jika anda akan mengubah order ini masuk ke project lainnya.</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div id="form-project-id-now" class="form-group">
                            <label class="control-label">PROJEK ID SAAT INI:</label>
                            <div class="col-md-12">
                                <a href="#" id="project_id_now">PJXXXXXX</a>
                                <small id="caption_project_id_now" class="form-text text-info">Klik Project ID untuk melihat record order ini.</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">FOLLOW UP :</label>
                            <div class="col-md-12">
                                <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2">
                                    <option value="">--Pilih Status--</option>
                                    <option value="MANJA ULANG">MANJA ULANG</option>
                                    <option value="BATAL">PELANGGAN BATAL</option>
                                    <!-- <option value="TERMINATE">TERMINATE</option> -->
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">UPDATE KETERANGAN : <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="ket_update" id="ket_update"></textarea>
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

<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_history" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title history">History Order</h3>
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