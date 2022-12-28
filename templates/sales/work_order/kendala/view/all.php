<style>
  table thead th {
    font-weight: bold !important;
  }

  .floatThead-container {
    margin-top: -6px !important;
  }
</style>
<script src="<?= base_url() ?>assets/global/custom/js/web_helper.js"></script>
<div class="preloader" style="display: none;"></div>
<div id="pesan" style="margin: 10px 5px;"></div>
<div class="example table-responsive">
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
        <th>SC</th>
        <th>KATEGORI</th>
        <th>SALES</th>
        <th>TGL MASUK</th>
        <th>TGL SCBE</th>
        <th>TGL KENDALA</th>
        <th>STATUS</th>
        <th>KENDALA</th>
        <th>KETERANGAN</th>
        <th><i class="fa fa-gear"></i></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($datas as $row) {
        $kat = $row['kategori'];
        if ($kat == 1) {
          $kategori = '<span class="badge badge-success">DEAL, ODP READY</span>';
        } elseif ($kat == 2) {
          $kategori = '<span class="badge badge-warning">NOT DEAL, ODP READY</span>';
        } elseif ($kat == 3) {
          $kategori = '<span class="badge badge-danger">UNSC</span>';
        } else {
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
          <td><?= 'JA' . $row['sales_id'] ?></td>
          <td><?= $row['unit'] ?></td>
          <td><?= $row['datel'] ?></td>
          <td><?= $row['nama_pelanggan'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td><?= $row['cp'] ?></td>
          <td><?= $row['odp'] ?></td>
          <td><?= $row['jarak_tiang'] ?></td>
          <td><?= $row['myir'] ?></td>
          <td><?= $row['new_sc'] ?></td>
          <td><?= $kategori ?></td>
          <td><?= $row['fullname'] ?></td>
          <td><?= $row['tgl_post'] ?></td>
          <td><?= $row['tgl_done_fcc'] ?></td>
          <td><?= $row['tgl_lapor_k'] ?></td>
          <td><?= $row['status'] ?></td>
          <td><?= $kate != 'cons' ? $row['kendala'] : '-' ?></td>
          <td><?= $row['keterangan'] ?></td>
          <th>
            <a style="margin-top: 5px;" class="btn btn-info btn-xs" href="javascript:void(0)" title="Follow UP" onclick="history(<?= $row['sales_id']; ?>)"><i class="icon md-info"></i> History</a>
          </th>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
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
            let action_status = getstatusLog(data.isi[i].action_status);
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
</script>

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