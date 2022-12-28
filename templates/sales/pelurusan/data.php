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
    .swal2-container {
      z-index: 20000 !important;
    }
</style>
<div id="pesan" style="margin: 10px 5px;"></div>
<table class="table table-hover dataTable table-bordered" id="table" data-plugin="floatThead" width="100%">
    <thead>
        <tr>
            <th width="10">NO</th>
            <th>DATEL</th>
            <th>ODP DEPLOY</th>
            <th>STATUS</th>
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
        "sDom": '<"dt-panelmenu clearfix"Bfr>t<"dt-panelfooter clearfix"ip>',
        "buttons": ['copy', 'excel', 'csv', 'pdf'],

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sales/pelurusan/list_data')?>",
            "type": "POST"
        },

        "language": {                
            "infoFiltered": ""
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

});

function show_sc(odp)
{
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sales/pelurusan/show_sc')?>/" + odp,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            let isi = '';
            if(data.isi.length > 0){
                for (let i = 0; i < data.isi.length; i++) {
                    isi += '<tr>'+
                        '<td>'+ data.isi[i].datel +'</td>'+
                        '<td>'+ data.isi[i].order_type +'</td>'+
                        '<td>'+ data.isi[i].atas_nama +'</td>'+
                        '<td>'+ data.isi[i].voice +'</td>'+
                        '<td>'+ data.isi[i].internet +'</td>'+
                        '<td>'+ data.isi[i].odp +'</td>'+
                        '<td>'+ data.isi[i].port +'</td>'+
                        '<td>'+ data.isi[i].sn +'</td>'+
                        '<td>'+ data.isi[i].sc +'</td>'+
                        '<td>'+ data.isi[i].status +'</td>'+
                        '<td><a class="btn btn-xs btn-success" href="javascript:void(0)" title="Inventory lurus" onclick="update_lurus('+data.isi[i].create_id+')"><i class="icon md-check"></i> Inventory Lurus</a></td>'+
                    '</tr>';
                }
            }
            else{
                isi = '<tr><td colspan="11" style="vertical-align : middle;text-align:center;"><span class="text-danger">No Data. . .</span></td></tr>';
            }
            
            $("#list-data").html(isi);
            $('#modal_show_sc').modal('show');
            $('.modal-title').text('List Pelurusan Data');

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

function update_lurus(id)
{
    //$('#modal_show_sc').modal('hide');
    Swal.fire({
      title: 'Apakah anda yakin data inventory sudah lurus?',
      text: "Data akan dinyatakan lurus jika anda mengupdatenya!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, sudah lurus'
    }).then((result) => {
      if (result.isConfirmed) {
        var url;
        url = "<?php echo site_url('sales/pelurusan/update')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: {create_id:id},
            dataType: "JSON",
            success: function(data)
            {
                if(data.status){
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil...',
                      text: 'Data berhasil diupdate!'
                    })
                }
                else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Gagal mengupdate data!',
                    })
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                })
            }
        });
      }
    });
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_show_sc" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">List Data</h3>
            </div>
            <div class="modal-body form">
                <div class="table-responsive">
                    <table id="ods" class="table table-striped table-bordered text-nowrap" style="zoom: 80%;">
                        <thead>
                            <tr>
                                <th>Datel</th>
                                <th>Order Type</th>
                                <th>Atas Nama</th>
                                <th>Voice</th>
                                <th>Internet</th>
                                <th>ODP</th>
                                <th>Port</th>
                                <th>SN</th>
                                <th>SC</th>
                                <th>Status</th>
                                <th>Update Pelurusan</th>
                            </tr>
                        </thead>
                        <tbody id="list-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->