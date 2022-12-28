<form action="#" id="form">
    <div class="row">
        <div class="col-md-4" style="border-right: 1px solid #cfd8dc">
            <h5><b>ID Projek:</b></h5>
            <p style="margin-left: 5%" id="id-project">PJ<?= $project->project_code ?></p>
            <h5><b>Nama LOP:</b></h5>
            <!-- <p style="margin-left: 5%" id="nama-project"></p> -->
            <input type="text" class="form-control" value="<?= $project->nama_lop ?>" name="nama_lop" id="nama_lop">
            <h5><b>Jenis Projek:</b></h5>
            <!-- <p style="margin-left: 5%" id="jenis-project"></p> -->
            <select name="jenis_prj" id="jenis_prj" class="form-control" data-plugin="select2">
                <option value="PT2 SIMPLE" <?= $project->jenis_prj == 'PT2 SIMPLE' ? 'selected' : '' ?>>PT2 SIMPLE</option>
                <option value="PT2 PLUS" <?= $project->jenis_prj == 'PT2 PLUS' ? 'selected' : '' ?>>PT2 PLUS</option>
                <option value="PT3" <?= $project->jenis_prj == 'PT3' ? 'selected' : '' ?>>PT3</option>
                <option value="STTF" <?= $project->jenis_prj == 'STTF' ? 'selected' : '' ?>>STTF</option>
                <option value="TCloud" <?= $project->jenis_prj == 'TCloud' ? 'selected' : '' ?>>TCloud</option>
                <option value="OTHERS" <?= $project->jenis_prj == 'OTHERS' ? 'selected' : '' ?>>OTHERS</option>
            </select>
            <h5><b>Mitra Amo:</b></h5>
            <p style="margin-left: 5%" id="mitra-amo"><?= !empty($project->mitra_amo) ? $project->mitra_amo : '<span class="text-danger">AMO Tidak menunjuk mitra</span>' ?></p>
            <h5><b>Mitra Deployer:</b></h5>
            <p style="margin-left: 5%" id="mitra-deployer"><?= !empty($project->mitra_deployer) ? $project->mitra_deployer : '<span class="text-danger">Deployer Tidak menunjuk mitra</span>' ?></p>
            <!-- <h5><b>Lokasi:</b></h5>
            <p style="margin-left: 5%"><a target="_blank" id="lokasi-project" href="<?php echo ("https://www.google.co.id/maps/search/$project->lokasi") ?>"><i class="icon md-pin-drop"></i> <?= $project->lokasi ?></a></p> -->
            <h5><b>Keterangan:</b></h5>
            <p style="margin-left: 5%" id="keterangan-project"><?= !empty($project->keterangan) ? $project->keterangan : '-' ?></p>
            <h5><b>Last Update Status:</b></h5>
            <p style="margin-left: 5%" id="last_update-project"><?php $tgl = explode(" ", $project->last_update_status);
                                                                echo date_indo($tgl[0]) . ' Pukul ' . $tgl[1] ?></p>
            <h5><b>File:</b></h5>
            <div class="row text-center">
                <?php if (!empty($project->link_gd)) { ?>
                    <div class="col-6">
                        <a id="kml-project" href="<?php echo $project->link_gd; ?>" target="_blank">
                            <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                            <p>G Drive Project</p>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="col-6">
                        <?php if (!empty($project->file_kml)) { ?>
                            <a id="kml-project" href="<?php echo site_url('sales/project/download_kml/' . $project->project_id . ''); ?>">
                                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                                <p>File KML</p>
                            </a>
                        <?php } else { ?>
                            <a id="kml-project" href="#" style="color: #6d0101;">
                                <span class="icon md-close icon-3x" aria-hidden="true"></span>
                                <p>Tidak ada File KML</p>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="col-6">
                        <?php if (!empty($project->file_mc)) { ?>
                            <a id="mc-project" href="<?php echo site_url('sales/project/download_mcore/' . $project->project_id . ''); ?>">
                                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                                <p>File Plan Mancore</p>
                            </a>
                        <?php } else { ?>
                            <a id="mc-project" href="#" style="color: #6d0101;">
                                <span class="icon md-close icon-3x" aria-hidden="true"></span>
                                <p>Tidak ada File Plan Mancore</p>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <h5><b>Update Link G Drive:</b></h5>
            <!-- <p style="margin-left: 5%" id="nama-project"></p> -->
            <input type="hidden" name="old_gdrive" id="old_gdrive" value="<?php echo $project->link_gd; ?>">
            <input type="text" class="form-control" name="update_gdrive" id="update_gdrive">
            <br />
        </div>
        <div class="col-md-3" style="border-right: 1px solid #cfd8dc">
            <h5><b>List ODP:</b></h5>
            <?= list_odp_const($project->project_id) ?>
        </div>
        <div class="col-md-5">
            <h4>Update Redesain Project</h4>
            <hr>
            <div class="alert alert-info">Jangan lupa untuk memperbarui File KML & Maincore pada G-drive Project</div>
            <input type="hidden" value="<?= $project->project_id ?>" name="id" />
            <div class="form-body">
                <!-- <div class="form-group">
                        <label class="control-label">Update Progress Redesain <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2">
                                <option value="">--Pilih Progress--</option>
                                <option value="APPROVAL AMO">APPROVAL AMO</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div> -->
                <!-- <div class="row" style="margin-left: 20px;">
                        <div class="form-group">
                            <label class="control-label">KML <span class="text-danger"><?= empty($project->file_kml) ? '*' : '' ?></span></label>
                            <div class="col-md-12">
                                <input name="userfile[]" type="file" id="file_kml" <?= empty($project->file_kml) ? 'required' : '' ?>>
                                <input type="hidden" value="<?= $project->file_kml ?>" name="file_kml"/> 
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Maincore <span class="text-danger"><?= empty($project->file_mc) ? '*' : '' ?></span></label>
                            <div class="col-md-12">
                                <input name="userfile[]" type="file" id="file_mc" <?= empty($project->file_mc) ? 'required' : '' ?>>
                                <input type="hidden" value="<?= $project->file_mc ?>" name="file_mc"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div> -->
                <div class="form-group">
                    <label class="control-label">UPDATE KETERANGAN : <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="3" name="ket_update" id="ket_update"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<div class="card-footer">
    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary float-right"><i class="icon md-badge-check"></i> Update</button>
    <button type="button" class="btn btn-danger" onclick="window.history.back()"><i class="icon md-arrow-left"></i> Kembali</button>
</div>

<script>
    function save() {
        if ($('#ket_update').val() === "") {
            Swal.fire({
                title: 'Error!',
                text: 'Keterangan update wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else if ($('#nama_lop').val() === "") {
            Swal.fire({
                title: 'Error!',
                text: 'Nama LOP wajib diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else if ($('#jenis_prj').val() === "") {
            Swal.fire({
                title: 'Error!',
                text: 'Jenis Project wajib dipilih!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else {
            var url;
            url = "<?php echo site_url('sales/project/redesain_update') ?>";

            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        Swal.fire({
                                title: 'Berhasil!',
                                text: 'Project berhasil diupdate!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then(function() {
                                window.location.reload();
                            });
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
    }
</script>