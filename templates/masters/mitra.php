<button class="btn btn-success" onclick="add_data()"><i class="icon md-plus"></i> Tambah Mitra</button>
<div class="table-responsive" style="margin-top: 15px;">
    <table id="table" class="table table-striped table-bordered bulk_action">
        <thead>
            <tr style="background-color: #36459b; color:#fff;">
                <th style="color:#fff;" width="10">NO</th>
                <th style="color:#fff;">Nama Mitra</th>
                <th style="color:#fff;">Kode Singkat</th>
                <th style="color:#fff;">Kategori</th>
                <th style="color:#fff;">PIC</th>
                <th style="color:#fff;">Kontak</th>
                <th style="color:#fff;" width="150">Action</th>
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

        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('masters/mitra/ajax_list') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],

        });

        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
    });



    function add_data() {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data');
    }

    function edit_data(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('masters/mitra/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id_mitra);
                $('[name="nama_mitra"]').val(data.nama_mitra);
                $('[name="singkat"]').val(data.singkat);
                $('[name="jenis_mitra"]').val(data.jenis_mitra);
                $('[name="pic"]').val(data.pic);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="alamat"]').val(data.alamat);
                $('#modal_form').modal('show');
                $('.modal-title').text('Ubah Data');

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
        $('#btnSave').text('Saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('masters/mitra/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('masters/mitra/ajax_update') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    toastr.success('<b>Well Done!</b> <br> Data Successfully updated!');
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }

                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled', false);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Save');
                $('#btnSave').attr('disabled', false);

            }
        });
    }

    function delete_data(id) {
        if (confirm('Anda yakin akan menghapus data ini?')) {
            $.ajax({
                url: "<?php echo site_url('masters/mitra/ajax_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    toastr.success('<b>Well Done!</b> <br> Data Successfully deleted!');
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
                <div class="modal-body">
                    <input type="hidden" value="" name="id" />
                    <div class="form-group">
                        <label class="col-md-12">Nama Mitra <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="nama_mitra" placeholder="Misal : Telkom Akses">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Kode <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="singkat" placeholder="TA">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Kategori <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <select name="jenis_mitra" id="jenis_mitra" class="form-control">
                                <option value="AMO">AMO</option>
                                <option value="DEPLOYER">DEPLOYER</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="pic">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Kontak Penanggung Jawab <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="no_hp">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Alamat</label>
                        <div class="col-md-12">
                            <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
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