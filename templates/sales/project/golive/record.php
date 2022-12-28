<div class="row">
    <div class="col-md-4" style="border-right: 1px solid #cfd8dc">
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
    <div class="col-md-3" style="border-right: 1px solid #cfd8dc">
        <h5><b>List ODP:</b></h5>
        <?= list_odp_const($project->project_id) ?>
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
    <div class="col-md-5">
        <!-- <h4>Kelengkapan Golive</h4>
        <h5><b>File:</b></h5>
        <div class="row text-center">
            <div class="col-4">
                <a id="kml-project" href="<?php echo site_url('sales/project/download_golive_mc/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>File Maincore</p>
                </a>
            </div>
            <div class="col-4">
                <a id="mc-project" href="<?php echo site_url('sales/project/download_golive_kml/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>File KML</p>
                </a>
            </div>
            <div class="col-4">
                <a id="mc-project" href="<?php echo site_url('sales/project/download_golive_foto_luar_odp/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>Foto Luar ODP</p>
                </a>
            </div>
            <div class="col-4">
                <a id="mc-project" href="<?php echo site_url('sales/project/download_golive_foto_dalam_odp/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>Foto Dalam ODP</p>
                </a>
            </div>
            <div class="col-4">
                <a id="mc-project" href="<?php echo site_url('sales/project/download_golive_foto_terminasi_odc/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>Foto Terminasi ODC</p>
                </a>
            </div>
            <div class="col-4">
                <a id="mc-project" href="<?php echo site_url('sales/project/download_golive_foto_terminasi_ftm/'.$project->project_id.''); ?>">
                <span class="icon md-cloud-download icon-3x" aria-hidden="true"></span>
                <p>Foto Terminasi FTM</p>
                </a>
            </div>
        </div>
        <br><br> -->
        <h5><b>ID Valins:</b></h5>
        <p style="margin-left: 5%" id="jenis-project"><?= $project->id_valins ?></p>
    </div>
</div>