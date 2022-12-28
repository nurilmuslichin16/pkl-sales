<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-1">
  <button class="btn btn-sm btn-danger ap" id="deal"><i class="fa fa-paper-plane"></i> DEAL, ODP READY</button>
  <div class="widget-box widget-color-dark" id="widget-box-1">
    <div class="widget-header">
      <h5 class="widget-title">NULL KATEGORI</h5>
      <div class="widget-toolbar">

        <a href="javascript:history.back();" class="purle">
          <i class="ace-icon fa fa-arrow-left"></i>
        </a>

        <a href="#" data-action="fullscreen" class="orange2">
          <i class="ace-icon fa fa-expand"></i>
        </a>

        <a href="javascript:void(0)" onclick="reload_table()" data-action="reload">
          <i class="ace-icon fa fa-refresh"></i>
        </a>

        <a href="#" data-action="collapse">
          <i class="ace-icon fa fa-chevron-up"></i>
        </a>

        <a href="#" data-action="close">
          <i class="ace-icon fa fa-times"></i>
        </a>
      </div>
    </div>

    <div class="widget-body">
      <div class="widget-main">
        <div id="pesan" style="margin: 10px 5px;"></div>
        <table id="table" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" id="check-all" />
                        <span class="lbl"></span>
                    </label>
                  </th>
                  <th>JA</th>
                  <th>UNIT</th>
                  <th>DATEL</th>
                  <th>NAMA PELANGGAN</th>
                  <th>ALAMAT</th>
                  <th>CP</th>
                  <th>ODP</th>
                  <th>JARAK TIANG</th>
                  <th>MYIR</th>
                  <th>KATEGORI</th>
                  <th>SALES</th>
                  <th>ORDERED TO</th>
                  <th>TGL MASUK</th>
                  <th>STATUS</th>
                  <th>KETERANGAN</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($datas as $row) {
                    $kat = $row['kategori'];
                    if ($kat == 1) {
                      $kategori = '<span class="label label-success">DEAL, ODP READY</span>';
                    }
                    elseif ($kat == 2) {
                      $kategori = '<span class="label label-warning">NOT DEAL, ODP READY</span>';
                    }
                    elseif ($kat == 3) {
                      $kategori = '<span class="label label-danger">UNSC</span>';
                    }
                    else{
                      $kategori = 'NONE';
                    }
                ?>
                <tr>
                  <td>
                    <label class="pos-rel">
                      <input type="checkbox" class="ace" id="check-item" name="sales_id[]" value="<?= $row['sales_id'] ?>" />
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td><?= 'JA'.$row['sales_id'] ?></td>
                  <td><?= $row['unit'] ?></td>
                  <td><?= $row['datel'] ?></td>
                  <td><?= $row['nama_pelanggan'] ?></td>
                  <td><?= $row['alamat'] ?></td>
                  <td><?= $row['cp'] ?></td>
                  <td><?= $row['odp'] ?></td>
                  <td><?= $row['jarak_tiang'] ?></td>
                  <td><?= $row['myir'] ?></td>
                  <td><?= $kategori ?></td>
                  <td><?= $row['fullname'] ?></td>
                  <td><?= $row['nama_teknisi'] ?></td>
                  <td><?= $row['tgl_post'] ?></td>
                  <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
                  <td><?= $row['keterangan'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
        dom: 'Bfrtip',
        "pageLength": 100,
        "scrollX": true,
        buttons: [
            { extend: 'copy', className: 'btn btn-default' },
            { extend: 'excel', className: 'btn btn-success' }
        ]
    });

    $("#check-all").click(function(){
      $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
      $('#deal').prop('disabled', !$('.ace:checked').length);
    });

    $('#deal').click(function(){
        var appConfirm = confirm("Kirim Amunisi?");
        if (appConfirm == true) {
            var users_arr = [];
            $("#check-item:checked").each(function(){
                var userid = $(this).val();
                users_arr.push(userid);
            });

            // Array length
            var length = users_arr.length;

            if(length > 0){

              $.ajax({
                url: "<?php echo site_url('sales/no_kategori/send_no_kat')?>",
                type: 'post',
                data: {user_ids: users_arr},
                dataType: "JSON",
                success: function(response){
                    reload_table();
                    document.getElementById('pesan').innerHTML = response.pesan;
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
              });
            }
        }
    });
  });
</script>