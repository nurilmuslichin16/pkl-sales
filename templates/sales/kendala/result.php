<style type="text/css">
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
<form autocomplete="off" action="<?= site_url('sales/kendala/search') ?>" method="POST">
    <div class="form-group col-md-4">
        <div class="input-search">
            <button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
            <input type="text" class="form-control" name="search" placeholder="Search JA..">
        </div>
    </div>
</form>
<div id="pesan" style="margin: 10px 5px;"></div>
<div class="example table-responsive">
    <table class="table table-hover dataTable table-striped text-nowrap" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <?php if (updateKendalaFull($this->session->userdata('level'))) { ?>
                    <th width="500"><i class="icon md-wrench"></i></th>
                <?php } ?>
                <th>JA</th>
                <th>UNIT</th>
                <th>DATEL</th>
                <th>NAMA PELANGGAN</th>
                <th>ALAMAT</th>
                <th>LOKASI SALES</th>
                <th>LOC BY TEKNISI</th>
                <th>JARAK</th>
                <th>MYIR</th>
                <th>ODP</th>
                <th>JENIS KENDALA</th>
                <th>KENDALA</th>
                <th>TGL LAPOR</th>
                <th>LAST UPDATE</th>
                <th>KETERANGAN</th>
                <th>Last Update BY</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($results as $row) { ?>
                <tr>
                    <!-- <td><?= $no++ ?></td> -->
                    <?php if (updateKendalaFull($this->session->userdata('level'))) { ?>
                        <td width="500">
                            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a>
                        </td>
                    <?php } ?>
                    <td><?= 'JA' . $row['sales_id'] ?></td>
                    <td><?= $row['unit'] ?></td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['lat_long'] ?></td>
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
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['kendala'] ?></td>
                    <td><?= $row['tgl_lapor_k'] ?></td>
                    <td><?= $row['tgl_update'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><span class="badge badge-info"><?= getStatusKendala($row['status']) ?></span></td>
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
                if (data.status == 'KENDALA PELANGGAN') {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                    // $("#status_update").append(new Option("FU", "1"));
                    $("#status_update").append(new Option("MANJA ULANG", "2"));
                    // $("#status_update").append(new Option("BATAL", "3"));
                    // $("#status_update").append(new Option("PENDING", "4"));
                } else if ((data.status == 'KENDALA JARINGAN') && (data.kendala != 'ODP FULL' && data.kendala != 'PT2' && data.kendala != 'NO FO/ODP')) {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                    $("#status_update").append(new Option("MANJA ULANG", "2"));
                    // $("#status_update").append(new Option("FU BY MAINTENANCE", "5"));
                    $("#status_update").append(new Option("UNSC", "6"));
                    // $("#status_update").append(new Option("BATAL", "3"));
                } else if ((data.status == 'KENDALA JARINGAN') && (data.kendala == 'ODP FULL' || data.kendala == 'PT2' || data.kendala == 'NO FO/ODP')) {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                    $("#status_update").append(new Option("MANJA ULANG", "2"));
                    // $("#status_update").append(new Option("CREATE PROJECT", "11"));
                    // $("#status_update").append(new Option("DEPLOYMENT", "22"));
                    // $("#status_update").append(new Option("GOLIVE", "33"));
                    // $("#status_update").append(new Option("KENDALA CONSTRUCTION", "44"));
                } else {
                    $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status Kendala--</option>');
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Follow Up Kendala ' + id); // Set title to Bootstrap modal title

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
                                <select name="kendala" id="kendala" class="form-control" data-plugin="select2">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">LOKASI SALES :</label>
                                    <div class="col-md-12">
                                        <input name="lat_long" class="form-control" type="text" placeholder="Misal : -6.921771,108.896762">
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
                                <input name="project_id" class="form-control" type="text" placeholder="Inputkan Projek ID dari JARVIS">
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

<script>
    function fukendala() {
        let sel = $('select[name=status_update]').val();
        if (sel == '2' || sel == '6') {
            $("#kendala").prop('disabled', true);
        } else {
            $("#kendala").prop('disabled', false);
        }
    }
</script>