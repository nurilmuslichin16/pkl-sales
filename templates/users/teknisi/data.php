<style>
    .blocked {
        background-color: #ffc400 !important;
    }
</style>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Sektor</label>
            <select name="fdatel" class="form-control" id="fdatel">
                <option value="all">-All Datel-</option>
                <option value="PKL1">PEKALONGAN 1</option>
                <option value="PKL2">PEKALONGAN 2</option>
                <option value="PML">PEMALANG</option>
                <option value="BRB">BREBES</option>
                <option value="BTG">BATANG</option>
                <option value="TEG">TEGAL</option>
                <option value="SLW">SLAWI</option>
            </select>
        </div>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-3">
        <!-- <a href="<?= site_url('sales/upload/jadwal') ?>" class="btn btn-sm btn-primary float-right">Upload Jadwal</a>&nbsp -->
        <a href="#" class="btn btn-sm btn-primary float-right">Upload Jadwal</a>&nbsp
        <button class="btn btn-sm btn-success float-right" style="margin-right: 5px;" id="aktifkan">Aktifkan Teknisi</button>
    </div>
</div>
<div class="table-responsive" style="margin-top: 15px;">
    <table id="table" class="table table-striped table-bordered bulk_action">
        <thead>
            <tr style="background-color: #36459b; color:#fff;">
                <th width="40">
                    <label class="pos-rel">
                        <input type="checkbox" id="check-all" />
                        <span class="lbl"></span>
                    </label>
                </th>
                <th style="color:#fff;">Datel</th>
                <th style="color:#fff;">NIK</th>
                <th style="color:#fff;">Nama Teknisi</th>
                <th style="color:#fff;">CREW</th>
                <th style="color:#fff;">MITRA</th>
                <th style="color:#fff;">KATEGORI</th>
                <th style="color:#fff;" width="90">Active</th>
                <th style="color:#fff;" width="90">Action</th>
            </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
</div>

<script type="text/javascript">
    var save_method;
    var table;


    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "iDisplayLength": 50,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('users/teknisi/users_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.datel = $('#fdatel').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //last column
                "orderable": false, //set not orderable
            }, ],

        });

        $("#check-all").click(function() {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        $('#aktifkan').click(function() {

            var appConfirm = confirm("Aktifkan user?");
            if (appConfirm == true) {
                var users_arr = [];
                $("#check-item:checked").each(function() {
                    var userid = $(this).val();
                    users_arr.push(userid);
                });

                // Array length
                var length = users_arr.length;

                if (length > 0) {

                    $.ajax({
                        url: "<?php echo site_url('users/teknisi/approve_user') ?>",
                        type: 'post',
                        data: {
                            user_ids: users_arr
                        },
                        dataType: "JSON",
                        success: function(response) {
                            reload_table();
                            document.getElementById('pesan').innerHTML = response.pesan;
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    });
                }
            }
        });

        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    $('#fdatel').on('change', function() {
        table.ajax.reload();
    });

    function edit_users(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('users/teknisi/users_edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                var level = $("#level_user").val();

                if (level != 5) {
                    $("#input_kategori").hide();
                }

                $('[name="id"]').val(data.t_telegram_id);
                $('[name="nik"]').val(data.nik);
                $('[name="nama_teknisi"]').val(data.nama_teknisi);
                $('[name="crew"]').val(data.crew);
                $('[name="datel"]').val(data.datel);
                $('[name="mitra"]').val(data.mitra);
                $('[name="active"]').val(data.active);
                $('[name="libur"]').val(data.libur);
                $('[name="jenis"]').val(data.jenis);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Users');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('users/teknisi/users_add') ?>";
        } else {
            url = "<?php echo site_url('users/teknisi/users_update') ?>";
        }

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
                            reload_table();
                        });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save');
                $('#btnSave').attr('disabled', false);

            }
        });
    }

    function delete_users(id) {
        if (confirm('Are you sure delete this data?')) {
            $.ajax({
                url: "<?php echo site_url('users/teknisi/users_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        .then(function() {
                            reload_table();
                        });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>

<!-- Modal -->
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" id="form">
                <input type="hidden" id="level_user" value="<?= $this->session->userdata('level'); ?>">
                <div class="modal-body">
                    <input type="hidden" value="" name="id" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Libur</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <input class="form-control date-picker" data-plugin="datepicker" data-multidate="true" name="libur" id="libur" type="text" data-date-format="dd" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                </span>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Datel</label>
                        <div class="col-md-12">
                            <select name="datel" class="form-control">
                                <option value="BRB">BRB</option>
                                <option value="BTG">BTG</option>
                                <option value="PKL1">PKL1</option>
                                <option value="PKL2">PKL2</option>
                                <option value="PML">PML</option>
                                <option value="SLW">SLW</option>
                                <option value="TEG">TEG</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">NIK</label>
                        <div class="col-md-12">
                            <input name="nik" placeholder="NIK" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama</label>
                        <div class="col-md-12">
                            <input name="nama_teknisi" placeholder="Nama Teknisi" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">CREW</label>
                        <div class="col-md-12">
                            <input name="crew" placeholder="CREW" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">MITRA</label>
                        <div class="col-md-12">
                            <input name="mitra" placeholder="Nama Mitra" class="form-control" type="text">
                            <span class="help-block">Misal : HCP, TA, KOPEGTEl, GLOBAL</span>
                        </div>
                    </div>
                    <div id="input_kategori" class="form-group">
                        <label class="control-label col-md-3">Kategori</label>
                        <div class="col-md-12">
                            <select name="jenis" class="form-control">
                                <option value="rb">Resource Base</option>
                                <option value="ob">Order Base</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">User Active</label>
                        <div class="col-md-12">
                            <select name="active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>