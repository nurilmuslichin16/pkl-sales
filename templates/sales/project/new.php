<?php
$info = $this->session->flashdata('info');
if (!empty($info)) {
    echo $info;
}
?>
<form action="<?php echo site_url('sales/project/create_project') ?>" method="POST" enctype="multipart/form-data" id="formsp" class="form-horizontal" autocomplete="off">
    <!-- <input type="hidden" name="datel" id="datel" value="<?= $this->uri->segment(5) ?>"> -->
    <input type="hidden" name="kendala" id="kendala" value="<?= $this->uri->segment(4) ?>">
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">DATEL <span class="text-danger">*</span> :</label>
                    <div class="col-md-12">
                        <select name="datel" id="datel" class="form-control" data-plugin="select2" required>
                            <option value="">Pilih Datel</option>
                            <option value="BTG" <?= $this->uri->segment(5) == 'BTG' ? 'selected' : '' ?>>BATANG</option>
                            <option value="PKL1" <?= $this->uri->segment(5) == 'PKL1' ? 'selected' : '' ?>>PEKALONGAN 1</option>
                            <option value="PKL2" <?= $this->uri->segment(5) == 'PKL2' ? 'selected' : '' ?>>PEKALONGAN 2</option>
                            <option value="PML" <?= $this->uri->segment(5) == 'PML' ? 'selected' : '' ?>>PEMALANG</option>
                            <option value="BRB" <?= $this->uri->segment(5) == 'BRB' ? 'selected' : '' ?>>BREBES</option>
                            <option value="TEG" <?= $this->uri->segment(5) == 'TEG' ? 'selected' : '' ?>>TEGAL</option>
                            <option value="SLW" <?= $this->uri->segment(5) == 'SLW' ? 'selected' : '' ?>>SLAWI</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">NAMA LOP <span class="text-danger">*</span> :</label>
                    <div class="col-md-12">
                        <input name="nama_loop" class="form-control" type="text" required>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">JENIS <span class="text-danger">*</span> :</label>
                    <div class="col-md-12">
                        <select name="jenis_prj" class="form-control" data-plugin="select2" onchange="require()" required>
                            <option value="">--Pilih Jenis--</option>
                            <option value="PT2 SIMPLE">PT2 SIMPLE</option>
                            <option value="PT2 PLUS">PT2 PLUS</option>
                            <option value="PT3">PT3</option>
                            <option value="STTF">STTF</option>
                            <option value="TCloud">TCloud</option>
                            <option value="OTHERS">OTHERS</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="control-label">Lokasi (Koordinat) :</label>
                    <div class="col-md-12">
                        <input name="lokasi" class="form-control" type="text" placeholder="Misal : -6.8958555,109.639484">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">LINK G-DRIVE :</label>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="3" name="link_gd" required></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="fileKML" class="form-control-label">File KML</label>
                            <div class="row">
                                <label class="custom-file" style="margin: auto">
                                <input type="file" name="userfile[]" class="file_input">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="fileKML" class="form-control-label">File MC</label>
                            <div class="row">
                                <label class="custom-file" style="margin: auto">
                                <input type="file" name="userfile[]" class="file_input">
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label">KETERANGAN :</label>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="3" name="keterangan_project"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <label class="control-label"><b>Pilih Order JA <span class="text-danger">*</span> :</b></label>
                <div class="row">
                    <div class="col-sm-8 nopadding">
                        <div class="col-md-12">
                            <select name="order_ja" id="order_ja" class="form-control" data-plugin="select2" data-placeholder="Pilih Order JA" multiple disabled>
                                <?php $no = 1;
                                foreach ($datas as $row) { ?>
                                    <option value="<?= $row['sales_id'] ?>"><?= 'JA' . $row['sales_id'] . ' ' . $row['nama_pelanggan'] . ' ' . $row['odp'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-4 nopadding">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="odp" name="odp" placeholder="Nama ODP" disabled>
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btnAdd" onclick="my_add_fields();"> <span class="icon md-plus" aria-hidden="true"></span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <p><strong>List ODP Project</strong></p>
                <div class="list-pesanan">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style="background: #3f51b5;">
                                    <th style="color: #fff;">Order JA</th>
                                    <th style="color: #fff;">Nama ODP</th>
                                    <th style="color: #fff;" width="50px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="isiTabel">
                                <tr class="project0">
                                    <td colspan="7" style="text-align: center;">Belum ada ODP</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="form-project" style="display: none;">
        </div>
        <button type="submit" name="submit" class="btn btn-primary float-right"><i class="icon md-check"></i> Save</button>
        <button type="button" class="btn btn-warning" onclick="window.history.back()"><i class="icon md-arrow-left"></i> Kembali</button>
    </div>
</form>

<script type="text/javascript">
    var room = 1;

    function require() {
        $("#odp").prop('disabled', false);
        $("#order_ja").prop('disabled', false);
        let jenis = $('select[name=jenis_prj]').val();
        if (jenis == 'PT3' || jenis == 'OTHERS') {
            $("#order_ja").prop('required', false);
            $("#odp").prop('required', false);
        } else {
            $("#order_ja").prop('required', true);
            $("#odp").prop('required', true);
        }
    }

    function bersihkanForm() {
        $("#order_ja").val('').trigger('change')
        $('#odp').val('');
    }

    function my_add_fields() {
        $("#order_ja").prop('required', false);
        $("#odp").prop('required', false);
        var order_ja = $('#order_ja').val();
        var nama_odp = $('#odp').val();

        if (order_ja == "") {
            Swal.fire({
                title: 'Error!',
                text: 'Pilih order JA untuk odp tersebut!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
            return;
        } else if (nama_odp == "") {
            Swal.fire({
                title: 'Error!',
                text: 'Isikan nama ODP untuk order JA tersebut!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
            return;
        }

        $.ajax({
            url: "<?php echo site_url('sales/project/cek_odp') ?>?odp=" + nama_odp,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.status === false) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.pesan,
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    return;
                    $('#odp').val("");
                    $('#order_ja').val("");
                } else {
                    let combobox = document.getElementById("order_ja");
                    let paket = combobox.options[combobox.selectedIndex].text;
                    let sales_id = $('#order_ja').val();
                    let odp = $('#odp').val();

                    room++;

                    // List Pembangunan
                    var objTo = document.getElementById("isiTabel");
                    var divtest = document.createElement("tr");
                    divtest.setAttribute("class", "project" + room);
                    divtest.innerHTML = '<td>' + sales_id + '</td><td>' + odp + '</td><th><button class="btn btn-danger btn-xs" type="button" id="btnRemove" onclick="my_remove_fields(' + room + ')"><i class="icon md-minus" aria-hidden="true"></i> </button></th>';
                    objTo.appendChild(divtest);

                    // Form Pembangunan
                    var to = document.getElementById("form-project");
                    var isi = document.createElement("div");
                    isi.setAttribute("class", "daftar-pesanan" + room);
                    isi.innerHTML = '<input type="text" value="' + sales_id + '" name="sales_id_selected[]" id="sales_id_selected" /><input type="text" value="' + odp + '" name="odp_plan[]" id="odp_plan" />';
                    to.appendChild(isi);

                    bersihkanForm();
                    $('.project0').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data!');
            }
        });
    }

    function my_remove_fields(rid) {
        $('.project' + rid).remove();
        $('.daftar-pesanan' + rid).remove();

        room -= 1;
        if (room == 0) {
            $('.project0').show();
            $("#order_ja").prop('required', true);
            $("#odp").prop('required', true);
        }
    }
</script>