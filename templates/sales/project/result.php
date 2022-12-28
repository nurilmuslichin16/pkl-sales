<style type="text/css">
	@media (min-width: 768px) {
	  .modal-xl {
	    width: 90%;
	   max-width:1200px;
	  }
	}
    table thead th {
        font-weight: bold !important;
    }
    .floatThead-container{
        margin-top: -6px !important;
    }
</style>
<form autocomplete="off" action="<?= site_url('sales/project/search') ?>" method="POST">
    <div class="form-group col-md-4">
        <div class="input-search">
            <button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
            <input type="text" class="form-control" name="search" placeholder="Search By Project ID..">
        </div>
    </div>
</form>
<div id="pesan" style="margin: 10px 5px;"></div>
<div class="example table-responsive">
    <table class="table table-hover dataTable table-striped text-nowrap" id="exampleTableTools" data-plugin="floatThead" cellspacing="0" width="100%">
        <thead>
            <tr>
                <!-- <th width="500"><i class="icon md-wrench"></i></th> -->
                <th>PJ-ID</th>
                <th>DATEL</th>
                <th>NAMA LOP</th>
                <th>JENIS</th>
                <th>File Project</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Last Update</th>
                <th>Last Update Status</th>
                <th>Last Update By</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($results as $row) { ?>
            <tr>
                <!-- <td>
                    <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['construction_id'];?>)"><i class="icon md-edit"></i> Follow Up</a>
                    <?php if ($this->session->userdata('level') == 5) { ?>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="delete_data(<?= $row['construction_id'];?>)"><i class="icon md-close"></i> Delete</a>
                    <?php } ?>
                </td> -->
                <td><?= 'PJ'.$row['project_code'] ?></td>
                <td><?= $row['datel'] ?></td>
                <td><?= $row['nama_lop'] ?></td>
                <td><?= $row['jenis_prj'] ?></td>
                <td><?= !empty($row['link_gd']) ? $row['link_gd'] : 'No File Project' ?></td>
                <td><?= $row['progress'] ?></td>
                <td><?= getStatusCons($row['status']) ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= $row['last_update'] ?></td>
                <td><?= $row['last_update_status'] ?></td>
                <td><?= $row['fullname'] ?></td>
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
        buttons: [
            { extend: 'copy', className: 'btn btn-default' },
            { extend: 'excel', className: 'btn btn-success' }
        ]
    });

    $("#check-all").click(function(){
      $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });

    $('#seltek').select2({width: '100%'});

    $('input[type="checkbox"]').click(function() {
        if($(this).is(":checked")){
          $('.ap').prop('disabled', false);
        }
        else{
          $('.ap').prop('disabled', true);
        }
    });

  });

  function detail(id)
{
    //save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sales/construction/detail')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.construction_id);
            $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
            $('[name="alamat"]').val(data.alamat);
            $('[name="cp"]').val(data.cp);
            $('[name="datel"]').val(data.datel);
            $('[name="keterangan"]').val(data.keterangan);
            $('[name="status"]').val(data.status);
            if (data.status == '11') {
                $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status--</option>');
                $("#status_update").append(new Option("DEPLOYMENT", "22"));
                $("#status_update").append(new Option("GO LIVE", "33"));
                $("#status_update").append(new Option("KENDALA", "44"));
            }
            else if (data.status == '22') {
                $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status--</option>');
                $("#status_update").append(new Option("GO LIVE", "33"));
                $("#status_update").append(new Option("KENDALA", "44"));
            }
            else if (data.status == '33') {
                $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status--</option>');
                $("#status_update").append(new Option("MANJA ULANG", "2"));
            }
            else if (data.status == '44') {
                $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status--</option>');
                $("#status_update").append(new Option("SURVEY & PLAN", "11"));
                $("#status_update").append(new Option("DEPLOYMENT", "22"));
                $("#status_update").append(new Option("GO LIVE", "33"));
                $("#status_update").append(new Option("KENDALA", "44"));
            }
            else{
                $('#status_update').empty().append('<option selected="selected" value="">--Pilih Status--</option>');
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Order Detail'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function delete_data(id)
{
    if(confirm('Yakin Hapus Data Ini?'))
    {
        $.ajax({
            url : "<?php echo site_url('sales/construction/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function save()
{
    $('#btnSave').text('Updating...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    url = "<?php echo site_url('sales/construction/update')?>";
    
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                document.getElementById('pesan').innerHTML = data.pesan;
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Update'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Update'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

$('#status_update').change(function() {
    if( $(this).val() == 2) {
        $('#ket_update').prop( "disabled", false );
    } else {       
        $('#ket_update').prop( "disabled", true );
    }
});
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
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <!-- <div class="form-group">
                            <label class="control-label">DATEL :</label>
                            <div class="col-md-12">
                                <select name="datel" class="form-control" disabled>
                                      <option value="">--Pilih Datel--</option>
                                      <option value="PKL">PEKALONGAN</option>
                                      <option value="BTG">BATANG</option>
                                      <option value="PML">PEMALANG</option>
                                      <option value="TEG">TEGAL</option>
                                      <option value="BRB">BREBES</option>
                                      <option value="SLW">SLAWI</option>
                                  </select>
                                  <span class="help-block"></span>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label">NAMA :</label>
                            <div class="col-md-12">
                                <input name="nama_pelanggan" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">ALAMAT :</label>
                            <div class="col-md-12">
                                <textarea name="alamat" rows="3" class="form-control" readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label">CP :</label>
                            <div class="col-md-12">
                                <input name="cp" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label">KETERANGAN :</label>
                            <div class="col-md-12">
                                <textarea class="form-control" rows="3" name="keterangan" readonly></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">FOLLOW UP :</label>
                            <div class="col-md-12">
                                <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2">
                                  <option>--Pilih Status--</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">KETERANGAN :</label>
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