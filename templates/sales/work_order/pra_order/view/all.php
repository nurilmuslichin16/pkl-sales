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
<div class="example table-responsive">
    <div id="pesan" style="margin: 10px 5px;"></div>
    <table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <th>#</th>
                <th>JA</th>
                <th>UNIT</th>
                <th>DATEL</th>
                <th>NAMA PELANGGAN</th>
                <th>ALAMAT</th>
                <th>CP</th>
                <th>ODP</th>
                <th>JARAK TIANG</th>
                <th>MYIR</th>
                <th>SALES</th>
                <th>TGL MASUK</th>
                <th>TGL UPDATE</th>
                <th>STATUS</th>
                <th>KETERANGAN</th>
                <?php if (updateOrderFCC($this->session->userdata('level'))) { ?>
                    <th><i class="fa fa-gear"></i></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datas as $row) {
                $time = explode(" ", $row['tgl_post']);
                $tgl_update = explode(" ", $row['tgl_update']); ?>
                <tr>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" id="check-item" name="sales_id[]" value="<?= $row['sales_id'] ?>" />
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td><?= 'JA' . $row['sales_id'] ?></td>
                    <td><?= $row['unit'] ?></td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['cp'] ?></td>
                    <td><?= $row['odp'] ?></td>
                    <td><?= $row['jarak_tiang'] ?></td>
                    <td><?= $row['myir'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= date_indo($time[0]) . ' ' . $time[1]; ?></td>
                    <td><?= date_indo($tgl_update[0]) . ' ' . $tgl_update[1]; ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <?php if (updateOrderFCC($this->session->userdata('level'))) { ?>
                        <td>
                            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#check-all").click(function() {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
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
            url: "<?php echo site_url('sales/sc_update/detail') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.sales_id);
                $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
                $('[name="datel"]').val(data.datel).trigger('change');
                $('[name="meid"]').val(data.message_id);
                $('[name="mefrom"]').val(data.fullname == null ? '233116801' : data.message_from);
                $('[name="no_ktp"]').val(data.no_ktp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="cp"]').val(data.cp);
                $('[name="lat_long"]').val(data.lat_long);
                $('[name="email"]').val(data.email);
                $('[name="odp"]').val(data.odp);
                $('[name="jarak_tiang"]').val(data.jarak_tiang);
                $('[name="myir"]').val(data.myir);
                $('[name="tgl_masuk"]').val(data.tgl_post);
                $('[name="status"]').val(data.status);
                $('[name="status_fcc"]').val(data.status_id).trigger('change');
                $('[name="keterangan_update"]').val(data.keterangan);
                $('[name="sales_name"]').val(data.fullname == null ? 'Anonim' : data.fullname);
                $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Order Detail JA' + id); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>



<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Follow Up Order</h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form">
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="" name="meid" />
                    <input type="hidden" value="" name="mefrom" />
                    <input type="hidden" value="" name="sales_name" />
                    <input type="hidden" value="" name="status_id" id="status_id" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <h4 class="example-title">DATEL :</h4>
                                    <select name="datel" class="form-control" data-plugin="select2">
                                        <option value="">--Pilih Datel--</option>
                                        <option value="PKL1">PEKALONGAN 1</option>
                                        <option value="PKL2">PEKALONGAN 2</option>
                                        <option value="BTG">BATANG</option>
                                        <option value="PML">PEMALANG</option>
                                        <option value="TEG">TEGAL</option>
                                        <option value="BRB">BREBES</option>
                                        <option value="SLW">SLAWI</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">NAMA :</h4>
                                    <input name="nama_pelanggan" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">KTP :</h4>
                                    <input name="no_ktp" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">ALAMAT :</h4>
                                    <textarea name="alamat" class="form-control" rows="3" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">CP :</h4>
                                    <input name="cp" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h4 class="example-title">LOKASI :</h4>
                                    <input name="lat_long" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">JARAK :</h4>
                                    <input name="jarak_tiang" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">ODP :</h4>
                                    <input name="odp" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">MYIR:</h4>
                                    <input name="myir" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <h4 class="example-title">TGL MASUK:</h4>
                                    <input name="tgl_masuk" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">NAMA SALES:</h4>
                                    <input name="sales_name" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">STATUS:</h4>
                                    <input name="status" class="form-control" type="text" readonly>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">CATATAN :</h4>
                                    <textarea name="keterangan_update" class="form-control" rows="5" readonly></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h4 class="example-title">UPDATE STATUS :</h4>
                                    <select name="status_fcc" class="form-control" data-plugin="select2">
                                        <option value="" selected>--Pilih Status--</option>
                                        <option value="41">WAIT FCC</option>
                                        <!-- <option value="43">PROGRESS FCC</option> -->
                                        <option value="42">KENDALA FCC</option>
                                        <option value="1">SCBE</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">UNIT :</h4>
                                    <select name="unit" class="form-control" data-plugin="select2">
                                        <option value="" selected>--Pilih Unit--</option>
                                        <option value="DCS">DCS</option>
                                        <option value="DBS">DBS</option>
                                        <option value="DES">DES</option>
                                        <option value="DGS">DGS</option>
                                        <option value="BGES">BGES</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">KETERANGAN :</h4>
                                    <textarea name="keterangan" class="form-control" rows="5" placeholder="misal: DONE"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                <button type="button" id="btnKendala" onclick="kendala()" class="btn btn-danger">Kendala</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal_kendala" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Order To Kendala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="kendala_form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="" name="meid" />
                    <input type="hidden" value="" name="mefrom" />
                    <input type="hidden" value="" name="sales_name" />
                    <div class="form-group">
                        <h4 class="example-title">KENDALA : <span class="text-danger">*</span></h4>
                        <select name="kendala" id="kendala" class="form-control" onchange="cekKendala()">
                            <option value="" selected>--Pilih Kendala--</option>
                            <option value="RNA">RNA</option>
                            <option value="ALAMAT">ALAMAT</option>
                            <option value="BATAL">BATAL</option>
                            <option value="PENDING">PENDING</option>
                            <option value="PENDING INSTALASI">PENDING INSTALASI</option>
                            <option value="NJKI">NJKI</option>
                            <option value="IJIN TANAM TIANG">IJIN TANAM TIANG</option>
                            <option value="ONU > 32">ONU > 32</option>
                            <option value="ODP FULL">ODP FULL</option>
                            <option value="ODP LOSS">ODP LOSS</option>
                            <option value="ODP RETI">ODP RETI</option>
                            <option value="ODP BLM LIVE">ODP BLM GOLIVE</option>
                            <option value="TIANG">TIANG</option>
                            <option value="PT2">PT2</option>
                            <option value="NO FO/ODP">NO FO/ODP</option>
                            <option value="RUTE INSTALASI">RUTE INSTALASI</option>
                            <option value="SUDAH PS">SUDAH PS</option>
                            <option value="TERMINATE">TERMINATE</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <h4 class="example-title">LOKASI PELANGGAN : <span class="text-danger required">*</span> </h4>
                        <input type="text" name="loc_cust" id="loc_cust" placeholder="(Lat,Long) -6.8958555,109.639484" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <h4 class="example-title">KETERANGAN : <span class="text-danger">*</span></h4>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="misal: DONE"></textarea>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group" style="display: none;" id="input_ps">
                        <h4 class="example-title">TGL PS : <span class="text-danger">*</span></h4>
                        <input type="text" name="tgl_ps" value="<?= date('Y-m-d') ?>" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSaveKendala" onclick="saveKendala()" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function cekKendala() {
        var sel = $('#kendala').val();
        if (sel === 'SUDAH PS') {
            $("#input_ps").css("display", "");
        } else {
            $("#input_ps").css("display", "none");
        }
    }

    function save() {
        $('#btnSave').text('Saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('sales/work_order/update_fcc') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_detail').modal('hide');
                    document.getElementById('pesan').innerHTML = data.pesan;
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        if (data.inputerror[i] == 'status_fcc' || 'unit') {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]); //select span help-block class set text error string
                        } else {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                }
                $('#btnSave').text('Save Changes'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Save Changes'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }

    function saveKendala() {
        const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/gi;
        if ($('#kendala').val() === "") {
            $('#modal_kendala').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Pilih kendala terlebih dahulu!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_kendala').modal('show');
            });
        } else if ($('#keterangan').val() === "") {
            $('#modal_kendala').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Isikan keterangan terkait kendala ini!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_kendala').modal('show');
            });
        } else if (($('#kendala').val() == "NO FO/ODP" || $('#kendala').val() == "ODP FULL" || $('#kendala').val() == "PT2") && ($('#loc_cust').val() === "")) {
            $('#modal_kendala').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Lokasi pelanggan wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_kendala').modal('show');
            });
        } else if ($('#loc_cust').val() !== "" && (regexExp.test($('#loc_cust').val()) !== true)) {
            $('#modal_kendala').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Penulisan lat, lng tidak sesuai..!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_kendala').modal('show');
            });
        } else {
            $('#btnSaveKendala').text('Saving...'); //change button text
            $('#btnSaveKendala').attr('disabled', true); //set button disable
            var url;

            url = "<?php echo site_url('sales/work_order/create_kendala') ?>";

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#kendala_form').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_kendala').modal('hide');
                        Swal.fire({
                                title: 'Berhasil!',
                                text: 'JA' + data.sales_id + ' diupdate sebagai kendala ' + data.kendala + '',
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
                    $('#btnSaveKendala').text('Save Changes'); //change button text
                    $('#btnSaveKendala').attr('disabled', false); //set button enable


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKendala').text('Save Changes'); //change button text
                    $('#btnSaveKendala').attr('disabled', false); //set button enable

                }
            });
        }
    }

    function kendala() {
        $('#modal_detail').modal('hide');
        $('#modal_kendala').modal('show');
    }
</script>