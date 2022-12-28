<style>
  table thead th {
    font-weight: bold !important;
  }
  .floatThead-container{
    margin-top: -6px !important;
  }
</style>
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
              <th>KATEGORI</th>
              <th>SALES</th>
              <th>TGL MASUK</th>
              <th>TGL UPDATE</th>
              <th>STATUS</th>
              <th>KETERANGAN</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach($datas as $row) {
                $kat = $row['kategori'];
                if ($kat == 1) {
                  $kategori = '<span class="badge badge-success">DEAL, ODP READY</span>';
                }
                elseif ($kat == 2) {
                  $kategori = '<span class="badge badge-warning">NOT DEAL, ODP READY</span>';
                }
                elseif ($kat == 3) {
                  $kategori = '<span class="badge badge-danger">UNSC</span>';
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
              <td><?= $row['tgl_post'] ?></td>
              <td><?= $row['tgl_update'] ?></td>
              <td><?= $row['status'] == 'order' ? 'ordered' : $row['status'] ?></td>
              <td><?= $row['keterangan'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
  </div>