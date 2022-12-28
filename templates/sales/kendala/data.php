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
<input type="hidden" id="akseskendalafull" value="<?= updateKendalaFull($this->session->userdata('level')) == false ? '1' : '0' ?>">
<div id="pesan" style="margin: 10px 5px;"></div>
<?php if ($kndala == 'odp_full' || $kndala == 'pt_dua' || $kndala == 'no_fo' || $kndala == 'teknis' || $kndala == 'unsc') { ?>
    <?php if (createProject($this->session->userdata('level'))) { ?>
        <a class="btn btn-danger float-right" style="color:#fff;" href="<?= site_url('sales/project/new_project/' . $kndala . '/' . $datel . '') ?>"><i class="icon md-plus"></i> Create Project</a>
    <?php } ?>
<?php } ?>
<div class="example table-responsive">
    <table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <th>JA</th>
                <th>UNIT</th>
                <th>DATEL</th>
                <th>NAMA PELANGGAN</th>
                <th>ALAMAT</th>
                <th>LOC BY SALES</th>
                <th>Nama Sales</th>
                <th>LOC BY TEKNISI</th>
                <th>JARAK</th>
                <th>SC</th>
                <th>MYIR</th>
                <th>ODP</th>
                <th>JENIS KENDALA</th>
                <th>KENDALA</th>
                <th>TGL INPUT</th>
                <th>LAST UPDATE</th>
                <th>KETERANGAN</th>
                <th>Last Update BY</th>
                <th><i class="icon md-wrench"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datas as $row) { ?>
                <tr>
                    <!-- <td><?= $no++ ?></td> -->
                    <td><?= 'JA' . $row['sales_id'] ?></td>
                    <td><?= $row['unit'] ?></td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
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
                    <td><?= $row['new_sc'] ?></td>
                    <td><?= $row['myir'] ?></td>
                    <td><?= $row['odp'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['kendala'] ?></td>
                    <td><?= $row['tgl_lapor_k'] ?></td>
                    <td><?= $row['tgl_update'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td>
                        <?php if (updateKendala($this->session->userdata('level')) && ($kndala != 'all' && $kndala != 'redesain' && $kndala != 'approval_datel' && $kndala != 'approval_amo' && $kndala != 'deploy' && $kndala != 'proses_golive' && $kndala != 'kendala_golive')) { ?>
                            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a><br>
                        <?php } ?>
                        <a style="margin-top: 5px;" class="btn btn-info btn-xs" href="javascript:void(0)" title="Follow UP" onclick="history(<?= $row['sales_id']; ?>)"><i class="icon md-info"></i> History</a>
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

        $disabled = $("#akseskendalafull").val();

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sales/kendala/detail') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.sales_id);
                $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                $('[name="datel"]').val(data.datel);
                $('[name="kendala"]').val(data.kendala).trigger('change');
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="loc_cust"]').val(data.loc_cust);
                $('[name="lat_long"]').val(data.lat_long);
                $('[name="status"]').val(data.status);

                if (((data.status == 'KENDALA JARINGAN') && (data.kendala == 'PENDING INSTALASI')) || ((data.status == 'KENDALA PELANGGAN') && (data.kendala == 'PENDING'))) {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                    $("#status_update").append(new Option("TDK TER-FOLLOW UP", "3"));
                    $("#status_update").append(new Option("MANJA ULANG", "2"));
                } else {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                    $("#status_update").append(new Option("MANJA ULANG", "2"));
                }

                // if ($disabled == '1') {
                //     $("#kendala").prop('disabled', true);
                //     $("#lat_long").prop('disabled', true);
                //     $("#loc_cust").prop('disabled', true);
                //     $("#status_update").prop('disabled', true);
                //     $("#ket_update").prop('disabled', true);
                // }

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Follow Up Kendala ' + id); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
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

    function save() {
        const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/gi;
        if (($('#kendala').val() == "NO FO/ODP" || $('#kendala').val() == "ODP FULL" || $('#kendala').val() == "PT2") && ($('#loc_cust').val() === "")) {
            $('#modal_form').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Lokasi pelanggan wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_form').modal('show');
            });
        } else if ($('#loc_cust').val() !== "" && (regexExp.test($('#loc_cust').val()) !== true)) {
            $('#modal_form').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Penulisan lat, lng tidak sesuai..!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_form').modal('show');
            });
        } else {
            $('#btnSave').text('Updating...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable
            var url;

            url = "<?php echo site_url('sales/kendala/update') ?>";

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
                                text: 'Kendala berhasil diupdate!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then(function() {
                                window.location.reload();
                            });
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
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

    function fukendala() {
        let sel = $('select[name=status_update]').val();
        if (sel == '2' || sel == '3') {
            $("#kendala").prop('disabled', true);
        } else {
            $("#kendala").prop('disabled', false);
        }
    }

    function cekKendala() {
        var sel = $('#kendala').val();
        if (sel === 'SUDAH PS') {
            $("#input_ps").css("display", "");
        } else {
            $("#input_ps").css("display", "none");
        }
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
                            <label class="control-label">GESER KENDALA :</label>
                            <div class="col-md-12">
                                <select name="kendala" id="kendala" class="form-control" onchange="cekKendala()" data-plugin="select2">
                                    <option value="">--Pilih Kendala--</option>
                                    <option value="RNA">RNA</option>
                                    <option value="ALAMAT">ALAMAT</option>
                                    <option value="BATAL">BATAL</option>
                                    <option value="TERMINATE">TERMINATE</option>
                                    <option value="PENDING">PENDING</option>
                                    <option value="PENDING INSTALASI">PENDING INSTALASI</option>
                                    <option value="ODP FULL">ODP FULL</option>
                                    <option value="ODP LOSS">ODP LOSS</option>
                                    <option value="ODP RETI">ODP RETI</option>
                                    <option value="ODP BLM LIVE">ODP BLM GOLIVE</option>
                                    <option value="TIANG">TIANG</option>
                                    <option value="PT2">PT2</option>
                                    <option value="NO FO/ODP">NO FO/ODP</option>
                                    <option value="RUTE INSTALASI">RUTE INSTALASI</option>
                                    <option value="NJKI">NJKI</option>
                                    <option value="IJIN TANAM TIANG">IJIN TANAM TIANG</option>
                                    <option value="ONU > 32">ONU > 32</option>
                                    <option value="SUDAH PS">SUDAH PS</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;" id="input_ps">
                            <label class="control-label">TGL PS : <span class="text-danger">*</span> </label>
                            <div class="col-md-12">
                                <input type="text" name="tgl_ps" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                            <span class="help-block"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">LOKASI SALES :</label>
                                    <div class="col-md-12">
                                        <input name="lat_long" id="lat_long" class="form-control" type="text" placeholder="Misal : -6.921771,108.896762">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">LOKASI REAL : <span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <input name="loc_cust" id="loc_cust" class="form-control" type="text" placeholder="Misal : -6.921771,108.896762">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
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
                            <label class="control-label">FOLLOW UP KENDALA :</label>
                            <div class="col-md-12">
                                <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2" onchange="fukendala()">
                                    <option>--Pilih Status--</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">PROJEK ID :</label>
                            <div class="col-md-12">
                                <input name="project_id" id="project_id" class="form-control" type="text" placeholder="Inputkan Projek ID dari JARVIS" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                <small id="emailHelp" class="form-text text-muted">Jika belum memiliki Projek ID dari Jarvis, maka silahkan create project terlebih dahulu</small>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">KETERANGAN UPDATE:</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="2" name="ket_update" id="ket_update"></textarea>
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