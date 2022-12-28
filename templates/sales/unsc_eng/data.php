<style type="text/css">
	table thead th {
		font-weight: bold !important;
	}
	.floatThead-container{
		margin-top: -6px !important;
	}
</style>
<div id="pesan" style="margin: 10px 5px;"></div>
<!-- <div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label><b>FILTER KATEGORI :</b></label>
            <select class="form-control input-sm" id="fkat" name="fkat" data-plugin="select2">
                <option value="">ALL</option>
                <option value="2">NOT DEAL, ODP READY</option>
                <option value="3">UNSC</option>
            </select>
        </div> 
    </div>
</div> -->
<table class="table table-hover dataTable table-striped" id="table" data-plugin="floatThead" width="100%">
    <thead>
        <tr>
            <th width="10">JA</th>
            <th>DATEL</th>
            <th>PLGN</th>
            <th>KTP</th>
            <th>ALAMAT</th>
            <th>LOKASI</th>
            <th>CP</th>
            <th>ODP</th>
            <th>TGL MASUK</th>
            <th>FROM</th>
            <th>STATUS</th>
            <th>KATEGORI</th>
            <th><i class="icon md-wrench"></i></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
<script type="text/javascript">

var save_method;
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "iDisplayLength": 50,
        "fixedHeader": true,
        "scrollX": true,
        "scrollY": "450px",
        "scrollCollapse": true,

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sales/unsc_engagement/unsc_eng_list')?>",
            "type": "POST",
            "data": function ( data ) {
                data.fkat = $('#fkat').val();
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    $('#fkat').on('change', function() {
        table.ajax.reload();
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
        url : "<?php echo site_url('sales/unsc_engagement/detail')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.sales_id);
            $('[name="nama_pelanggan"]').val(data.nama_pelanggan);
			$('[name="myir"]').val(data.myir);
            $('[name="datel"]').val(data.datel);
            $('[name="alamat"]').val(data.alamat);
            $('[name="post_on"]').val(data.tgl_post);
            $('[name="status"]').val(data.status);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Order Detail'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    url = "<?php echo site_url('sales/unsc_engagement/update')?>";
    
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
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false);
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
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
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
                        </div>
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
                                <textarea class="form-control" rows="3" name="alamat" readonly></textarea>
                                <span class="help-block"></span>
                            </div>
						</div>
						<div class="form-group">
                            <label class="control-label">MYIR :</label>
                            <div class="col-md-12">
                                <input name="myir" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">TGL MASUK :</label>
                            <div class="col-md-12">
                                <input name="post_on" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">UPDATE KENDALA :</label>
                            <div class="col-md-12">
                                <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2">
								  	<option>--Pilih Status--</option>
								  	<option value="2">MANJA ULANG</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">KETERANGAN UDPATE:</label>
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