<?php
    $info = $this->session->flashdata('info');
    if (!empty($info)) {
        echo $info;
    }
?>
<div class="row">
    <div class="col-md-3" style="border-right: 1px solid #cfd8dc">
        <h5><b>ID Projek:</b></h5>
        <p style="margin-left: 5%" id="id-project">PJ<?= $project->project_code ?></p>
        <h5><b>Nama LOP:</b></h5>
        <p style="margin-left: 5%" id="nama-project"><?= $project->nama_lop ?></p>
        <h5><b>Jenis Projek:</b></h5>
        <p style="margin-left: 5%" id="jenis-project"><?= $project->jenis_prj ?></p>
        <h5><b>Mitra Amo:</b></h5>
        <p style="margin-left: 5%" id="mitra-amo"><?= !empty($project->mitra_amo) ? $project->mitra_amo : '<span class="text-danger">AMO Tidak menunjuk mitra</span>' ?></p>
        <h5><b>Mitra Deployer:</b></h5>
        <p style="margin-left: 5%" id="mitra-deployer"><?= !empty($project->mitra_deployer) ? $project->mitra_deployer : '<span class="text-danger">Deployer Tidak menunjuk mitra</span>' ?></p>
        <!-- <h5><b>Lokasi:</b></h5>
        <p style="margin-left: 5%"><a target="_blank" id="lokasi-project" href="<?php echo("https://www.google.co.id/maps/search/$project->lokasi") ?>"><i class="icon md-pin-drop"></i> <?= $project->lokasi ?></a></p> -->
        <h5><b>Keterangan:</b></h5>
        <p style="margin-left: 5%" id="keterangan-project"><?= !empty($project->keterangan) ? $project->keterangan : '-' ?></p>
        <h5><b>Last Update Status:</b></h5>
        <p style="margin-left: 5%" id="last_update-project"><?php $tgl = explode(" ",$project->last_update_status); echo date_indo($tgl[0]).' Pukul '.$tgl[1] ?></p>
        <h5><b>File:</b></h5>
        <div class="row text-center">
            <?php if(!empty($project->link_gd)) { ?>
                <div class="col-6">
                    <a id="kml-project" href="<?php echo $project->link_gd; ?>" target="_blank">
                    <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                    <p>G Drive Project</p>
                    </a>
                </div>
            <?php }else{ ?>
                <div class="col-6">
                    <?php if(!empty($project->file_kml)) { ?>
                        <a id="kml-project" href="<?php echo site_url('sales/project/download_kml/'.$project->project_id.''); ?>">
                        <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                        <p>File KML</p>
                        </a>
                    <?php }else{ ?>
                        <a id="kml-project" href="#" style="color: #6d0101;">
                        <span class="icon md-close icon-3x" aria-hidden="true"></span>
                        <p>Tidak ada File KML</p>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-6">
                    <?php if(!empty($project->file_mc)) { ?>
                        <a id="mc-project" href="<?php echo site_url('sales/project/download_mcore/'.$project->project_id.''); ?>">
                        <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                        <p>File Plan Mancore</p>
                        </a>
                    <?php }else{ ?>
                        <a id="mc-project" href="#" style="color: #6d0101;">
                        <span class="icon md-close icon-3x" aria-hidden="true"></span>
                        <p>Tidak ada File Plan Mancore</p>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-5" style="border-right: 1px solid #cfd8dc">
        <h4><b>ODP PLAN - ODP LIVE:</b></h4>
        <?= list_odp_const_live($project->project_id) ?>
        <hr>
        <h4>Evident Progress</h4>
        <?php $folder = str_replace(" ", "_", $project->nama_lop); ?>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?= !empty($project->evident_delivery_material) ? '<span class="text-success"><i class="icon md-check"></i> Delivery Material</span>' : '<span class="text-danger"><i class="icon md-close"></i>Delivery Material</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_delivery_material.'') ?>" alt="Delivery Material" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
            <?php if($project->jenis_prj == 'PT2 SIMPLE') { ?>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <?= !empty($project->evident_install_odp) ? '<span class="text-success"><i class="icon md-check"></i> Installasi ODP</span>' : '<span class="text-danger"><i class="icon md-close"></i>Installasi ODP</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_install_odp.'') ?>" alt="Installasi ODP" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <?= !empty($project->evident_tanam_tiang) ? '<span class="text-success"><i class="icon md-check"></i> Penanaman Tiang</span>' : '<span class="text-danger"><i class="icon md-close"></i>Penanaman Tiang</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_tanam_tiang.'') ?>" alt="Penanaman Tiang" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <?= !empty($project->evident_tarik_kabel) ? '<span class="text-success"><i class="icon md-check"></i> Penarikan Kabel</span>' : '<span class="text-danger"><i class="icon md-close"></i>Penarikan Kabel</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_tarik_kabel.'') ?>" alt="Penarikan Kabel" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <?= !empty($project->evident_install_odp) ? '<span class="text-success"><i class="icon md-check"></i> Installasi ODP</span>' : '<span class="text-danger"><i class="icon md-close"></i>Installasi ODP</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_install_odp.'') ?>" alt="Installasi ODP" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-header" id="headingSix">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <?= !empty($project->evident_penyambungan) ? '<span class="text-success"><i class="icon md-check"></i> Penyambungan</span>' : '<span class="text-danger"><i class="icon md-close"></i>Penyambungan</span>' ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                        <img src="<?= site_url('uploads/project/'.$folder.'/'.$project->evident_penyambungan.'') ?>" alt="Penyambungan" class="img-responsive" style="width: 40%;  margin-left: auto; margin-right: auto; display:block;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h4>Upload Kelengkapan Golive</h4>
        <span class="text-danger">Upload file2 kelengkapan golive pada G-Drive project</span><br>
            <div class="row text-center">
                <div class="col-12">
                    <a id="gdrive-project" href="<?= !empty($project->link_gd) ? $project->link_gd : '#' ?>" target="_blank">
                    <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                    <p>G Drive Project</p>
                    </a>
                </div>
            </div>
        <br>
        <hr>
        <form action="<?php echo site_url('sales/project/selesai_deployment')?>" method="POST" enctype="multipart/form-data" id="form" class="form-horizontal" autocomplete="off">
            <input type="hidden" value="<?= $project->project_id ?>" name="id"/> 
            <input type="hidden" value="<?= $project->deployer_id ?>" name="deployer_id"/> 
            <input type="hidden" value="<?= $project->nama_lop ?>" name="nama_lop"/> 
            <div class="form-body">
                <!-- <div class="row" style="margin-left: 20px;">
                    <div class="form-group">
                        <label class="control-label">Maincore <span class="text-danger"><?= empty($project->file_maincore) ? '*' : '' ?></span></label>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file" <?= empty($project->file_maincore) ? 'required' : '' ?>>
                            <input type="hidden" value="<?= $project->file_maincore ?>" name="file_maincore"/> 
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">KML <span class="text-danger"><?= empty($project->file_kml) ? '*' : '' ?></span></label>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file" <?= empty($project->file_kml) ? 'required' : '' ?>>
                            <input type="hidden" value="<?= $project->file_kml ?>" name="file_kml"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 20px;">
                    <div class="form-group">
                        <label class="control-label">Foto Luar ODP <span class="text-danger"><?= empty($project->foto_luar_odp) ? '*' : '' ?></span></label>
                        <input type="hidden" value="<?= $project->foto_luar_odp ?>" name="foto_luar_odp"/>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file" <?= empty($project->foto_luar_odp) ? 'required' : '' ?>>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Foto Bagian Dalam ODP <span class="text-danger"><?= empty($project->foto_dalam_odp) ? '*' : '' ?></span></label>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file" <?= empty($project->foto_dalam_odp) ? 'required' : '' ?>>
                            <input type="hidden" value="<?= $project->foto_dalam_odp ?>" name="foto_dalam_odp"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 20px;">
                    <div class="form-group">
                        <label class="control-label">Foto Terminasi FTM</label>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file">
                            <input type="hidden" value="<?= $project->foto_terminasi_ftm ?>" name="foto_terminasi_ftm"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Foto Terminasi ODC <span class="text-danger"><?= empty($project->foto_terminasi_odc) ? '*' : '' ?></span></label>
                        <div class="col-md-12">
                            <input name="userfile[]" type="file" <?= empty($project->foto_terminasi_odc) ? 'required' : '' ?>>
                            <input type="hidden" value="<?= $project->foto_terminasi_odc ?>" name="foto_terminasi_odc"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="control-label">ID Valins <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="id_valins" value="<?= $project->id_valins ?>" required>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Lat,Lng ODP Golive <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="lokasi_odp" id="lokasi_odp" onchange="cek_tikor()" placeholder="Format penulisan Lat,Lng adalah : -6.8961445,109.6758347" value="<?= $project->lokasi_odp ?>" required>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Update Keterangan :</label>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="3" name="ket_update" id="ket_update"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" id="btnSave" name="submit" class="btn btn-primary float-right"><i class="icon md-badge-check"></i> Selesai Deployment</button>
    <button type="button" class="btn btn-danger" onclick="window.history.back()"><i class="icon md-arrow-left"></i> Kembali</button>
</div>
</form>

<script>
    function cek_tikor(){
        const regexExp = /^((\-?|\+?)?\d+(\.\d+)?),\s*((\-?|\+?)?\d+(\.\d+)?)$/gi;
        if(regexExp.test($('#lokasi_odp').val()) !== true){
            Swal.fire({
                title: 'Error!',
                text: 'Penulisan lat, lng tidak sesuai..!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                $('#btnSave').attr('disabled',true);
            });
        }
        else{
            $('#btnSave').attr('disabled',false);
        }
    }

    function change_odp(odp_id){
        let odp_change = $('#odp_live-'+odp_id).val();
        $.ajax({
            url : "<?php echo site_url('sales/project/change_odp_plan') ?>",
            type : 'POST',
            dataType: "json",
            data : {odp_id: odp_id, new_odp_plan: odp_change},
            success: function(response){
                if(response.status){
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'ODP Plan berhasil dirubah ke '+odp_change+'!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                    .then(function() {
                        window.location.reload();
                    });
                }
                else{
                    alert('Error! Please contact developer.');
                }
            }
        });
        return false;
    }
</script>