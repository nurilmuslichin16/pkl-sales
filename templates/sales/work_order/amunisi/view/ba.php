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
<div class="example table-responsive">
    <div id="pesan" style="margin: 10px 5px;"></div>
    <table class="table table-hover dataTable table-striped" id="exampleTableTools" data-plugin="floatThead">
        <thead>
            <tr>
                <th>JA</th>
                <th>UNIT</th>
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
                <th>TGL SCBE</th>
                <th>STATUS</th>
                <th>KETERANGAN</th>
                <th>Alasan</th>
                <th>Evident</th>
                <th><i class="fa fa-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($datas as $row) { $time = explode(" ", $row['tgl_post']); $tgl_scbe = explode(" ", $row['tgl_done_fcc']); ?>
            <tr>
                <td><?= 'JA'.$row['sales_id'] ?></td>
                <td><?= $row['unit'] ?></td>
                <td><?= $row['datel'] ?></td>
                <td><?= $row['nama_pelanggan'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['cp'] ?></td>
                <td><?= $row['odp'] ?></td>
                <td><?= $row['jarak_tiang'] ?></td>
                <td><?= !empty($row['myir']) ? $row['myir'] : $row['new_sc'] ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['nama_teknisi'] ?></td>
                <td><?= date_indo($time[0]).' '.$time[1]; ?></td>
                <td><?= date_indo($tgl_scbe[0]).' '.$tgl_scbe[1]; ?></td>
                <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= !empty($row['alasan']) ? $row['alasan'] : '<span class="text-danger">Blm update BA</span>' ?></td>
                <td><a href="<?= $row['evident'] ?>" target="_blank"><i class="icon md-link"></i> Lihat Evident</a></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id'];?>)"><i class="icon md-upload"></i> Upload BA</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $("#check-all").click(function(){
      $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });

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
          url : "<?php echo site_url('sales/work_order/ba_detail')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.sales_id);
              $('[name="alasan"]').val(data.alasan).trigger("change");
              $('[name="keterangan"]').val(data.keterangan);
              $('[name="evident"]').val(data.evident);
              $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Order Detail JA'+id); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }
</script>

<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="modal_detail" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Follow Up Order</h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <h4 class="example-title">Alasan Terlambat : <span class="text-danger">*</span></h4>
                            <select name="alasan" id="alasan" class="form-control" data-plugin="select2">
                                <option value="">--Pilih Alasan--</option>
                                <option value="Hujan">Hujan</option>
                                <option value="Kendala Sistem">Kendala Sistem</option>
                                <option value="Keterlambatan proses order oleh TL">Keterlambatan proses order oleh TL</option>
                                <option value="Keterlambatan proses order oleh Teknisi">Keterlambatan proses order oleh Teknisi</option>
                                <option value="Lain-Lain">Lain-Lain</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <h4 class="example-title">Keterangan : <span class="text-danger">*</span></h4>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <h4 class="example-title">Evident : <span class="text-danger">*</span></h4>
                            <input name="evident" class="form-control" type="text" placeholder="Masukan link evident yang sudah di upload ke g-drive">
                            <span class="text-info" style="font-size: 11px;">Upload evident ke <a target="_blank" href="https://drive.google.com/drive/folders/1WgFBV3ks1L5uW90ZH_TpdHt0cJ0--toH?usp=sharing" class="btn btn-xs btn-info"><i class="icon md-upload"></i> Upload Evident</a></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  function save()
  {
    var alasan = $('#alasan').val();
    var keterangan = $('#keterangan').val();
    var evident = $('#evident').val();
    if(alasan === ''){
        $('#modal_detail').modal('hide');
        Swal.fire({
            title: 'Error!',
            text: 'Alasan keterlambatan wajib diisi!',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(function() {
            $('#modal_detail').modal('show');
        });
    }
    else if(keterangan === ''){
        $('#modal_detail').modal('hide');
        Swal.fire({
            title: 'Error!',
            text: 'Keterangan keterlambatan wajib diisi!',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(function() {
            $('#modal_detail').modal('show');
        });
    }
    else if(evident === ''){
        $('#modal_detail').modal('hide');
        Swal.fire({
            title: 'Error!',
            text: 'Evident keterlambatan wajib diisi!',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(function() {
            $('#modal_detail').modal('show');
        });
    }
    else{
        $('#btnSave').text('Saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        url = "<?php echo site_url('sales/work_order/save_ba_amunisi')?>";
        
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
                    $('#modal_detail').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Evident berhasil diupload!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                    .then(function() {
                        window.location.reload();
                    });
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('Send'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }
  }
</script>