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
<button class="btn btn-sm btn-info ap float-right" id="send" onclick="send()" disabled><i class="icon md-mail-send"></i> Send Order</button>
<div class="example table-responsive">
    <div id="pesan" style="margin: 10px 5px;"></div>

    <table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <th>#</th>
                <th>JA</th>
                <th>UNIT</th>
                <th>JENIS</th>
                <th>DATEL</th>
                <th>NAMA PELANGGAN</th>
                <th>ALAMAT</th>
                <th>CP</th>
                <th>ODP</th>
                <th>JARAK TIANG</th>
                <th>MYIR/SC</th>
                <th>SALES</th>
                <th>ORDERED TO</th>
                <th>TGL MASUK</th>
                <th>LAST UPDATE</th>
                <th>TGL SCBE</th>
                <th>STATUS</th>
                <th>KETERANGAN</th>
                <th><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($datas as $row) {
                $time = explode(" ", $row['tgl_post']);
                $tgl_scbe = explode(" ", $row['tgl_done_fcc']);
                $tgl_update = explode(" ", $row['tgl_update']); ?>
                <tr>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" id="check-item" name="sales_id[]" value="<?= $row['sales_id'] . "-" . $row['unit'] ?>" />
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td><?= 'JA' . $row['sales_id'] ?></td>
                    <td><?= $row['unit'] ?></td>
                    <td><?= $row['add_on_type'] ?></td>
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['cp'] ?></td>
                    <td><?= $row['odp'] ?></td>
                    <td><?= $row['jarak_tiang'] ?></td>
                    <td><?= !empty($row['myir']) ? $row['myir'] : $row['new_sc'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['nama_teknisi'] ?></td>
                    <td><?= date_indo($time[0]) . ' ' . $time[1]; ?></td>
                    <td><?= date_indo($tgl_update[0]) . ' ' . $tgl_update[1]; ?></td>
                    <td><?= date_indo($tgl_scbe[0]) . ' ' . $tgl_scbe[1]; ?></td>
                    <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a>
                    </td>
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

    function send() {
        var values = [];
        var unit = null;
        var cek = true;
        $.each($('input:checked'), function(index, input) {
            const inputArray = input.value.split("-");
            if (unit == null) {
                unit = inputArray[1];
            } else if (unit != inputArray[1]) {
                cek = false;
            }
            values.push(inputArray[0]);
        });

        if (cek) {
            if (unit == "DCS") {
                $('.opt-rb').show();
                $('.opt-ob').hide();
                $('.opt-').hide();
            } else {
                $('.opt-ob').show();
                $('.opt-rb').hide();
                $('.opt-').hide();
            }
            var str1 = "Tiket Dipilih : " + values.join(',');
            var str2 = values.join(',');
            $(".text").html(str1);
            $('#target').val(str2);
            $('#modal_form').modal('show');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Order Unit yang dipilih tidak boleh berbeda!',
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                location.reload();
            })
        }
    }

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
                $('[name="keterangan_update"]').val(data.keterangan);
                $('[name="sales_name"]').val(data.fullname == null ? 'Anonim' : data.fullname);
                if (data.sc != null) {
                    $("#new_sc").prop('readonly', false);
                } else {
                    $("#new_sc").prop('readonly', true);
                    $("#sc_lama").prop('readonly', false);
                }
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
<div class="modal fade modal-3d-sign" id="modal_form" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Send Order</h4>
            </div>
            <div class="modal-body form">
                <form method="POST" id="send_form">
                    <input type="hidden" id="target" name="sales_id" />

                    <div class="form-body">
                        <div class="form-group">
                            <h4 class="example-title">Teknisi</h4>
                            <select name="teknisi" class="form-control" id="seltek">
                                <option value="">-Pilih Teknisi-</option>
                                <?php
                                foreach ($teknisi as $row) {
                                    echo '<option class=opt-' . $row['jenis'] . ' value="' . $row['t_telegram_id'] . '">' . $row['crew'] . ' | ' . getTeknisibyCrew($row['crew']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Send</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

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
                    <input type="hidden" value="" name="req_sc_by" />
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
                                    <h4 class="example-title">KENDALA : <span class="text-danger">*</span></h4>
                                    <select name="kendala" onchange="view_kendala()" class="form-control" data-plugin="select2">
                                        <option value="" selected>--Pilih Kendala--</option>
                                        <option value="RNA">RNA</option>
                                        <option value="ALAMAT">ALAMAT</option>
                                        <option value="BATAL">BATAL</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="ODP FULL">ODP FULL</option>
                                        <option value="ODP LOSS">ODP LOSS</option>
                                        <option value="ODP RETI">ODP RETI</option>
                                        <option value="ODP BLM LIVE">ODP BLM LIVE</option>
                                        <option value="TIANG">TIANG</option>
                                        <option value="PT2">PT2</option>
                                        <option value="NO FO/ODP">NO FO/ODP</option>
                                        <option value="RUTE INSTALASI">RUTE INSTALASI</option>
                                        <option value="CROSING JALAN">CROSSING JALAN</option>
                                        <option value="IJIN TANAM TIANG">IJIN TANAM TIANG</option>
                                        <option value="ONU > 32">ONU > 32</option>
                                        <option value="SUDAH PS">SUDAH PS</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">LOKASI PELANGGAN : <span class="text-danger required">*</span> </h4>
                                    <input type="text" name="loc_cust" placeholder="(Lat,Long) -6.8958555,109.639484" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <h4 class="example-title">KETERANGAN : <span class="text-danger">*</span></h4>
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
                <button type="button" id="btnSave" onclick="create_kendala()" class="btn btn-primary">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function view_kendala() {
        sel = $('select[name=kendala]').val();
        if (sel == "SUDAH PS" || sel == "RNA" || sel == "ALAMAT" || sel == "BATAL" || sel == "PENDING") {
            $(".required").css("display", "none");
        } else {
            $(".required").css("display", "");
        }
    }

    function save() {
        $('#btnSave').text('Sending...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('sales/work_order/send_order') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#send_form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    document.getElementById('pesan').innerHTML = data.pesan;
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }

    function create_kendala() {
        $('#btnSave').text('Membuat Kendala...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('sales/work_order/create_kendala') ?>";

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
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }
</script>