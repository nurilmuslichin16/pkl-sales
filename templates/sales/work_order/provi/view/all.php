<style>
  table thead th {
    font-weight: bold !important;
  }

  .floatThead-container {
    margin-top: -6px !important;
  }
</style>
<script src="<?= base_url() ?>assets/global/custom/js/web_helper.js"></script>
<?php if (updateOrderProvi($this->session->userdata('level'))) { ?>
  <button class="btn btn-sm btn-info ap float-right" id="send" onclick="send()" disabled><i class="icon md-mail-send"></i> Resend Order</button>
<?php } ?>
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
        <th>TEKNISI</th>
        <th>TGL MASUK</th>
        <th>TGL UPDATE</th>
        <th>TGL SCBE</th>
        <th>STATUS</th>
        <th>KETERANGAN</th>
        <th><i class="fa fa-gear"></i></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($datas as $row) {
        $kat = $row['kategori'];
        if ($kat == 1) {
          $kategori = '<span class="label label-success">DEAL, ODP READY</span>';
        } elseif ($kat == 2) {
          $kategori = '<span class="label label-warning">NOT DEAL, ODP READY</span>';
        } elseif ($kat == 3) {
          $kategori = '<span class="label label-danger">UNSC</span>';
        } else {
          $kategori = 'NONE';
        }
      ?>
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
          <td><?= $row['myir'] ?></td>
          <td><?= $row['new_sc'] ?></td>
          <td><?= $kategori ?></td>
          <td><?= $row['fullname'] ?></td>
          <td><?= $row['nama_teknisi'] ?></td>
          <td><?= $row['tgl_post'] ?></td>
          <td><?= $row['tgl_update'] ?></td>
          <td><?= $row['tgl_done_fcc'] ?></td>
          <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
          <td><?= $row['keterangan'] ?></td>
          <td>
            <?php if (updateOrderProvi($this->session->userdata('level'))) { ?>
              <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Follow UP" onclick="detail(<?= $row['sales_id']; ?>)"><i class="icon md-edit"></i> Follow Up</a><br>
            <?php } ?>
            <a style="margin-top: 5px;" class="btn btn-info btn-xs" href="javascript:void(0)" title="Follow UP" onclick="history(<?= $row['sales_id']; ?>)"><i class="icon md-info"></i> History</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
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
        $('[name="meid"]').val(data.message_id);
        $('[name="mefrom"]').val(data.fullname == null ? '233116801' : data.message_from);
        $('[name="alamat"]').val(data.alamat);
        $('[name="myir"]').val(data.myir);
        $('[name="keterangan_update"]').val(data.keterangan);
        $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
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
              <div class="col-md-12">
                <div class="form-group">
                  <h4 class="example-title">NAMA :</h4>
                  <input name="nama_pelanggan" class="form-control" type="text" readonly>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <h4 class="example-title">ALAMAT :</h4>
                  <textarea name="alamat" class="form-control" rows="3" readonly></textarea>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <h4 class="example-title">MYIR:</h4>
                  <input name="myir" class="form-control" type="text" readonly>
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <h4 class="example-title">KENDALA : <span class="text-danger">*</span></h4>
                  <select name="kendala" onchange="view_kendala()" class="form-control" data-plugin="select2">
                    <option value="" selected>--Pilih Kendala--</option>
                    <option value="BATAL">BATAL</option>
                    <option value="SUDAH PS">SUDAH PS</option>
                  </select>
                  <span class="help-block"></span>
                </div>
                <div class="form-group" style="display: none;" id="input_ps">
                  <h4 class="example-title">TGL PS : <span class="text-danger">*</span></h4>
                  <input type="text" name="tgl_ps" value="<?= date('Y-m-d') ?>" class="form-control">
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
        <button type="button" id="btnSend" onclick="save()" class="btn btn-primary">Send</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script>
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
    $('#btnSend').text('Sending...'); //change button text
    $('#btnSend').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('sales/work_order/resend_order') ?>";

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
        $('#btnSend').text('Send'); //change button text
        $('#btnSend').attr('disabled', false); //set button enable


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSend').text('Send'); //change button text
        $('#btnSend').attr('disabled', false); //set button enable

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
        if (data.status) {
          $('#modal_detail').modal('hide');
          document.getElementById('pesan').innerHTML = data.pesan;
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
          }
        }
        $('#btnSave').text('Save Changes'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSave').text('Save Changes'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable

      }
    });
  }
</script>