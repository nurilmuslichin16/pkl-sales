<div id="pesan" style="margin: 10px 5px;"></div>
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
        <!-- <h5><b>Lokasi:</b></h5>
        <p style="margin-left: 5%"><a target="_blank" id="lokasi-project" href="<?php echo("https://www.google.co.id/maps/search/$project->lokasi") ?>"><i class="icon md-pin-drop"></i> <?= $project->lokasi ?></a></p> -->
        <h5><b>Keterangan:</b></h5>
        <p style="margin-left: 5%" id="keterangan-project"><?= !empty($project->keterangan) ? $project->keterangan : '-' ?></p>
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
    </div>
    <div class="col-md-5">
        <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="<?= $project->project_id ?>" name="id"/> 
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label">MITRA DEPLOYER<span class="text-danger">*</span> </label>
                    <div class="col-md-12">
                        <select name="mitra_deployer" id="mitra_deployer" class="form-control" placeholder="Pilih" data-plugin="select2" required>
                            <option value="">--Pilih Mitra--</option>
                            <?php
                                foreach($mitra as $row)
                                {
                                    echo "<option value=$row[singkat]>$row[nama_mitra]</option>";
                                }
                            ?>
                        </select>
                        <span class="text-info" style="font-size: 11px;">Belum ada mitra? <a target="_blank" href="<?= site_url('masters/mitra') ?>" class="btn btn-xs btn-info"><i class="icon md-plus"></i> Tambah Mitra Baru</a> | Baru menambahkan mitra baru? <button onclick="window.location.reload()" class="btn btn-xs btn-warning"><i class="icon md-refresh"></i> Reload</button> </span>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">KENDALA..?</label>
                    <div class="col-md-12">
                        <select name="status_update" id="status_update" class="form-control" placeholder="Pilih" data-plugin="select2">
                        <option value="">-Pilih-</option>
                        <option value="55">REDESAIN</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">UPDATE KETERANGAN :</label>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="3" name="ket_update" id="ket_update"></textarea>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card-footer">
    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary float-right"><i class="icon md-badge-check"></i> Update</button>
    <button type="button" class="btn btn-danger" onclick="window.history.back()"><i class="icon md-arrow-left"></i> Kembali</button>
</div>

<script>

    function save()
    {
        if($('#mitra_deployer').val() === "" && $('#status_update').val() === ""){
            Swal.fire({
                title: 'Error!',
                text: 'Pilih mitra terlebih dahulu!',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
        else{
            var url;
            url = "<?php echo site_url('sales/project/update_mitra_deployer')?>";
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Progress berhasil diupdate!',
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
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');

                }
            });
        }
    }
</script>