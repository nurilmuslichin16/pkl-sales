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
<script src="<?= base_url() ?>assets/global/custom/js/web_helper.js"></script>
<?php if (updateOrderAmunisi($this->session->userdata('level'))) { ?>
    <button class="btn btn-sm btn-info ap float-right" id="send" onclick="send()" disabled><i class="icon md-mail-send"></i> Send Order</button>
<?php } ?>
<div class="preloader" style="display: none;"></div>
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
                <th>MYIR/SC</th>
                <th>KATEGORI</th>
                <th>SALES</th>
                <th>LOC BY TEKNISI</th>
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
                    <td><?= $row['datel'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['cp'] ?></td>
                    <td><?= $row['odp'] ?></td>
                    <td><?= $row['jarak_tiang'] ?></td>
                    <td><?= !empty($row['myir']) ? $row['myir'] : $row['new_sc'] ?></td>
                    <td><?= getIDSegment($row['segment']) ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['loc_cust'] ?></td>
                    <td><?= $row['nama_teknisi'] ?></td>
                    <td><?= date_indo($time[0]) . ' ' . $time[1]; ?></td>
                    <td><?= date_indo($tgl_update[0]) . ' ' . $tgl_update[1]; ?></td>
                    <td><?= date_indo($tgl_scbe[0]) . ' ' . $tgl_scbe[1]; ?></td>
                    <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td>
                        <?php if (updateOrderAmunisi($this->session->userdata('level'))) { ?>
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
    var checkModal = false;

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
                $('.opt-ob').show();
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
                checkModal = true;
                $('.modal-title').text('Order Detail JA' + id); // Set title to Bootstrap modal title

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
                        let action_status = statusLog(data.isi[i].action_status);
                        console.log(action_status + " - " + data.isi[i].action_status);
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

    function statusLog(status) {
        if (status == '1') {
            return 'WAITING';
        } else if (status == '2') {
            return 'ORDERED TO TEKNISI';
        } else if (status == '3') {
            return 'SET TO WAIT SC';
        } else if (status == '4') {
            return 'SET TO PROGRESS FCC';
        } else if (status == '5') {
            return 'SET TO DONE SC';
        } else if (status == '6') {
            return 'SET TO KENDALA';
        } else if (status == '7') {
            return 'SET TO HR';
        } else if (status == '8') {
            return 'SET TO FALLOUT';
        } else if (status == '9') {
            return 'SET TO COMPLETE';
        } else if (status == '10') {
            return 'SET TO PS';
        } else if (status == '11') {
            return 'KENDALA SET TO FOLLOW UP';
        } else if (status == '12') {
            return 'KENDALA SET TO MANJA ULANG';
        } else if (status == '13') {
            return 'KENDALA SET TO BATAL';
        } else if (status == '14') {
            return 'KENDALA SET TO PENDING';
        } else if (status == '15') {
            return 'KENDALA SET TO FOLLOW UP BY MAINTENANCE';
        } else if (status == '16') {
            return 'KENDALA SET TO UNSC';
        } else if (status == '17') {
            return 'ORDER SET TO UPDATE SC';
        } else if (status == '18') {
            return 'ORDER SET TO BLM DEPO';
        } else if (status == '19') {
            return 'ORDER SET TO KENDALA SC';
        } else if (status == '20') {
            return 'ORDER SET TO DONE INSTALL AP';
        } else if (status == '21') {
            return 'ORDER SET TO KENDALA PROVISIONING WMS';
        } else if (status == '22') {
            return 'ORDER SET TO WAIT FCC';
        } else if (status == '23') {
            return 'ORDER SET TO KENDALA FCC';
        } else if (status == '24') {
            return 'ORDER SET TO PROGRESS FCC';
        } else if (status == '25') {
            return 'ORDER SET TO SCBE';
        } else if (status == '26') {
            return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 SIMPLE';
        } else if (status == '27') {
            return 'ORDER SET TO PROGRESS CONSTRUCTION PT2 PLUS';
        } else if (status == '28') {
            return 'ORDER SET TO PROGRESS CONSTRUCTION PT3';
        } else if (status == '29') {
            return 'UPDATE LOCATION REAL';
        } else if (status == '30') {
            return 'UPDATE KETERANGAN KENDALA';
        } else if (status == '31') {
            return 'ORDER CONSTRUCTION SET TO MANJA ULANG';
        } else if (status == '32') {
            return 'ORDER CONSTRUCTION SET TO KENDALA PELANGGAN BATAL';
        } else if (status == '33') {
            return 'ORDER CONSTRUCTION SET TO KENDALA TERMINATE';
        } else if (status == '34') {
            return 'ORDER CONSTRUCTION APPROVED BY AMO';
        } else if (status == '35') {
            return 'ORDER CONSTRUCTION REJECTED BY AMO';
        } else if (status == '36') {
            return 'ORDER CONSTRUCTION SET TO REDESAIN';
        } else if (status == '37') {
            return 'ORDER CONSTRUCTION SELESAI DEPLOYMENT (VALIDASI GOLIVE)';
        } else if (status == '38') {
            return 'ORDER CONSTRUCTION SET TO KENDALA GOLIVE';
        } else if (status == '39') {
            return 'ORDER CONSTRUCTION SET TO PERBAIKAN MAINCORE';
        } else if (status == '40') {
            return 'ORDER CONSTRUCTION SET TO SELESAI GOLIVE';
        } else if (status == '41') {
            return 'ORDER CONSTRUCTION SET TO PROSES GOLIVE';
        } else if (status == '42') {
            return 'ORDER CONSTRUCTION REDESAIN PUSH TO APPROVAL AMO';
        } else if (status == '43') {
            return 'KENDALA SET TO TDK TER FOLLOW UP';
        } else if (status == '44') {
            return 'ORDER CONSTRUCTION APPROVED BY DATEL';
        } else if (status == '45') {
            return 'ORDER CONSTRUCTION REJECTED BY DATEL';
        } else if (status == '111') {
            return 'UPDATE DATEL';
        }
    }

    function changeDatel() {
        if (checkModal) {
            checkModal = false;
            $('#modal_detail').modal('hide');

            var url = "<?php echo site_url('sales/work_order/changeDatel') ?>";

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        Swal.fire({
                                title: 'Success!',
                                text: 'Berhasil! Mengubah Datel JA' + data.sales_id,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then(function() {
                                window.location.reload();
                            });
                    } else {
                        Swal.fire({
                                title: 'Failed!',
                                text: 'Gagal! Mengubah Datel JA' + data.sales_id,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                            .then(function() {
                                window.location.reload();
                            });
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSave').text('Send'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable

                }
            });
        }
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
                                    <select id="datel" name="datel" onchange="changeDatel()" class="form-control" data-plugin="select2">
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
                                    <select name="kendala" id="kendala" onchange="view_kendala()" class="form-control" data-plugin="select2">
                                        <option value="" selected>--Pilih Kendala--</option>
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


<script type="text/javascript">
    function view_kendala() {
        sel = $('select[name=kendala]').val();
        if (sel == "SUDAH PS" || sel == "RNA" || sel == "ALAMAT" || sel == "BATAL" || sel == "PENDING") {
            $(".required").css("display", "none");
            if (sel == "SUDAH PS") {
                $("#input_ps").css("display", "");
            }
        } else {
            $(".required").css("display", "");
            $("#input_ps").css("display", "none");
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
        const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/gi;

        if ($('#kendala').val() === "") {
            checkModal = false;
            $('#modal_detail').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Pilih kendala terlebih dahulu!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_detail').modal('show');
                checkModal = true;
            });
        } else if ($('#keterangan').val() === "") {
            checkModal = false;
            $('#modal_detail').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Isikan keterangan terkait kendala ini!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_detail').modal('show');
                checkModal = true;
            });
        } else if (($('#kendala').val() == "NO FO/ODP" || $('#kendala').val() == "ODP FULL" || $('#kendala').val() == "PT2") && ($('#loc_cust').val() === "")) {
            checkModal = false;
            $('#modal_detail').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Lokasi pelanggan wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_detail').modal('show');
                checkModal = true;
            });
        } else if ($('#loc_cust').val() !== "" && (regexExp.test($('#loc_cust').val()) !== true)) {
            checkModal = false;
            $('#modal_detail').modal('hide');
            Swal.fire({
                title: 'Error!',
                text: 'Penulisan lat, lng tidak sesuai..!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#modal_detail').modal('show');
                checkModal = true;
            });
        } else {
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
                        checkModal = false;
                        $('#modal_detail').modal('hide');
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
    }
</script>