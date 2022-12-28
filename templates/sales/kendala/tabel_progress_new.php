<style type="text/css">
    table tr td a {
        color: black;
        text-decoration: none !important;
    }

    #note {
        font-size: 14px;
    }

    #note th {
        font-weight: bold;
    }

    .bawah {
        background-color: #616161;
        color: #fff;
    }

    .bawah a {
        color: #fff !important;
    }
</style>
<div class="row">
    <div class="col-md-2">
        <select name="filter_segment" id="filter_segment" class="form-control" data-plugin="select2">
            <option value="all">Semua Order</option>
            <option value="psb" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'psb' ? 'selected' : '') : '' ?>>PSB</option>
            <option value="pda" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'pda' ? 'selected' : '') : '' ?>>PDA</option>
            <option value="addon" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'addon' ? 'selected' : '') : '' ?>>ADDON</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="filter_unit" id="filter_unit" class="form-control" data-plugin="select2">
            <option value="all">Semua Datel</option>
            <option value="pkl1" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'pkl1' ? 'selected' : '') : '' ?>>PEKALONGAN 1</option>
            <option value="pkl2" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'pkl2' ? 'selected' : '') : '' ?>>PEKALONGAN 2</option>
            <option value="btg" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'btg' ? 'selected' : '') : '' ?>>BATANG</option>
            <option value="pml" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'pml' ? 'selected' : '') : '' ?>>PEMALANG</option>
            <option value="brb" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'brb' ? 'selected' : '') : '' ?>>BREBES</option>
            <option value="slw" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'slw' ? 'selected' : '') : '' ?>>SLAWI</option>
            <option value="teg" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'teg' ? 'selected' : '') : '' ?>>TEGAL</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="filter_by_tgl" id="filter_by_tgl" class="form-control" data-plugin="select2">
            <option value="tgl_ja">By tgl JA Masuk</option>
            <option value="tgl_kendala">By tgl Lapor Kendala</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary" id="daterange-btn"><span><i class="icon md-calendar"></i> &nbsp; Filter Tanggal</span> &nbsp; <i class="icon md-caret-down"></i></button>
    </div>
    <div class="col-md-3 float-right">
        <form autocomplete="off" action="<?= site_url('sales/kendala/search') ?>" method="POST">
            <div class="form-group">
                <div class="input-search">

                    <?php if (aksesOrderRequestSCKendalaProvi($this->session->userdata('level'))) { ?>
                        <button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
                        <input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI">
                    <?php } else { ?>
                        <button type="submit" class="input-search-btn" disabled><i class="icon md-search" aria-hidden="true"></i></button>
                        <input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI" readonly>
                    <?php } ?>

                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">LAST UPDATE</th>
                <th colspan="6" style="text-align: center; background: #1E88E5; color: #fff;">KENDALA PELANGGAN</th>
                <th colspan="3" style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">KENDALA INSTALASI</th>
                <th colspan="3" style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">MAINTENANCE</th>
                <th colspan="4" style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">KENDALA TEKNIS</th>
                <th colspan="6" style="vertical-align : middle;text-align:center; background: #F0A500; color: #000;">ON CONSTRUCTION</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TOTAL</th>
            </tr>
            <tr>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">RNA</th>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">ALAMAT</th>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">PENDING</th>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">PLGN BATAL</th>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">IZIN TANAM TIANG</th>
                <th style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">NJKI</th>
                <th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">TIANG</th>
                <th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">RUTE INSTALASI</th>
                <th style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">PENDING INSTALASI</th>
                <th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ODP LOS</th>
                <th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ODP RETI</th>
                <th style="vertical-align : middle;text-align:center;background: #0E185F; color: #fff;">ONU > 32</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ODP BLM GOLIVE</th>
                <th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">ODP FULL</th>
                <th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">PT2</th>
                <th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">NO FO/ODP</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">REDESAIN</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">APPROVAL DATEL</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">APPROVAL AMO</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">DEPLOYMENT</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">PROSES GOLIVE</th>
                <th style="vertical-align : middle;text-align:center;background: #F0A500; color: #000;">KENDALA GOLIVE</th>
            </tr>
        </thead>
        <tbody id="tabel_kendala">
            <tr>
                <td> 1 - 3 Hari </td>
                <!-- Kendala Pelanggan -->
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['rna']) ? $kd_3['rna'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['alamat']) ? $kd_3['alamat'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['pending']) ? $kd_3['pending'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['batal']) ? $kd_3['batal'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['ijin_tanam_tiang']) ? $kd_3['ijin_tanam_tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['njki']) ? $kd_3['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['tiang']) ? $kd_3['tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['rute']) ? $kd_3['rute'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['pending_instalasi']) ? $kd_3['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['odp_loss']) ? $kd_3['odp_loss'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['odp_reti']) ? $kd_3['odp_reti'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['onu_32']) ? $kd_3['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['odp_blm_live']) ? $kd_3['odp_blm_live'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['odp_full']) ? $kd_3['odp_full'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['pt_dua']) ? $kd_3['pt_dua'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['no_fo']) ? $kd_3['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['redesain']) ? $kd_3['redesain'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['approval_datel']) ? $kd_3['approval_datel'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['approval_amo']) ? $kd_3['approval_amo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['deploy']) ? $kd_3['deploy'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['proses_golive']) ? $kd_3['proses_golive'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['kendala_golive']) ? $kd_3['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_3&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_3['total']) ? $kd_3['total'] : '' ?></a></td>
            </tr>
            <tr>
                <td> > 3 Hari </td>
                <!-- Kendala Pelanggan -->
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['rna']) ? $kd_7['rna'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['alamat']) ? $kd_7['alamat'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['pending']) ? $kd_7['pending'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['batal']) ? $kd_7['batal'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['ijin_tanam_tiang']) ? $kd_7['ijin_tanam_tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['njki']) ? $kd_7['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['tiang']) ? $kd_7['tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['rute']) ? $kd_7['rute'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['pending_instalasi']) ? $kd_7['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['odp_loss']) ? $kd_7['odp_loss'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['odp_reti']) ? $kd_7['odp_reti'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['onu_32']) ? $kd_7['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['odp_blm_live']) ? $kd_7['odp_blm_live'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['odp_full']) ? $kd_7['odp_full'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['pt_dua']) ? $kd_7['pt_dua'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['no_fo']) ? $kd_7['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['redesain']) ? $kd_7['redesain'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['approval_datel']) ? $kd_7['approval_datel'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['approval_amo']) ? $kd_7['approval_amo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['deploy']) ? $kd_7['deploy'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['proses_golive']) ? $kd_7['proses_golive'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['kendala_golive']) ? $kd_7['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_7&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_7['total']) ? $kd_7['total'] : '' ?></a></td>
            </tr>
            <tr>
                <td> > 1 Pekan </td>
                <!-- Kendala Pelanggan -->
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['rna']) ? $kd_14['rna'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['alamat']) ? $kd_14['alamat'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['pending']) ? $kd_14['pending'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['batal']) ? $kd_14['batal'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['ijin_tanam_tiang']) ? $kd_14['ijin_tanam_tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['njki']) ? $kd_14['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['tiang']) ? $kd_14['tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['rute']) ? $kd_14['rute'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['pending_instalasi']) ? $kd_14['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['odp_loss']) ? $kd_14['odp_loss'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['odp_reti']) ? $kd_14['odp_reti'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['onu_32']) ? $kd_14['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['odp_blm_live']) ? $kd_14['odp_blm_live'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['odp_full']) ? $kd_14['odp_full'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['pt_dua']) ? $kd_14['pt_dua'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['no_fo']) ? $kd_14['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['redesain']) ? $kd_14['redesain'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['approval_datel']) ? $kd_14['approval_datel'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['approval_amo']) ? $kd_14['approval_amo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['deploy']) ? $kd_14['deploy'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['proses_golive']) ? $kd_14['proses_golive'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['kendala_golive']) ? $kd_14['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_14&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_14['total']) ? $kd_14['total'] : '' ?></a></td>
            </tr>
            <tr>
                <td> > 2 Pekan </td>
                <!-- Kendala Pelanggan -->
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['rna']) ? $kd_30['rna'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['alamat']) ? $kd_30['alamat'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['pending']) ? $kd_30['pending'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['batal']) ? $kd_30['batal'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['ijin_tanam_tiang']) ? $kd_30['ijin_tanam_tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['njki']) ? $kd_30['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['tiang']) ? $kd_30['tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['rute']) ? $kd_30['rute'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['pending_instalasi']) ? $kd_30['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['odp_loss']) ? $kd_30['odp_loss'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['odp_reti']) ? $kd_30['odp_reti'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['onu_32']) ? $kd_30['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['odp_blm_live']) ? $kd_30['odp_blm_live'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['odp_full']) ? $kd_30['odp_full'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['pt_dua']) ? $kd_30['pt_dua'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['no_fo']) ? $kd_30['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['redesain']) ? $kd_30['redesain'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['approval_datel']) ? $kd_30['approval_datel'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['approval_amo']) ? $kd_30['approval_amo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['deploy']) ? $kd_30['deploy'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['proses_golive']) ? $kd_30['proses_golive'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['kendala_golive']) ? $kd_30['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($kd_30['total']) ? $kd_30['total'] : '' ?></a></td>
            </tr>
            <tr>
                <td> > 1 Bulan </td>
                <!-- Kendala Pelanggan -->
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['rna']) ? $lb_30['rna'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['alamat']) ? $lb_30['alamat'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['pending']) ? $lb_30['pending'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['batal']) ? $lb_30['batal'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['ijin_tanam_tiang']) ? $lb_30['ijin_tanam_tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dbeeff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['njki']) ? $lb_30['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['tiang']) ? $lb_30['tiang'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['rute']) ? $lb_30['rute'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cfffd1;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['pending_instalasi']) ? $lb_30['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['odp_loss']) ? $lb_30['odp_loss'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['odp_reti']) ? $lb_30['odp_reti'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #dee2ff;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['onu_32']) ? $lb_30['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['odp_blm_live']) ? $lb_30['odp_blm_live'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['odp_full']) ? $lb_30['odp_full'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['pt_dua']) ? $lb_30['pt_dua'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #cacedb;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['no_fo']) ? $lb_30['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['redesain']) ? $lb_30['redesain'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['approval_datel']) ? $lb_30['approval_datel'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['approval_amo']) ? $lb_30['approval_amo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['deploy']) ? $lb_30['deploy'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['proses_golive']) ? $lb_30['proses_golive'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['kendala_golive']) ? $lb_30['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td style="vertical-align : middle;text-align:center; background: #fff2d6;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=lb_30&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($lb_30['total']) ? $lb_30['total'] : '' ?></a></td>
            </tr>
            <tr>
                <td class="bawah"> TOTAL </td>
                <!-- Kendala Pelanggan -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=rna&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['rna']) ? $all['rna'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=alamat&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['alamat']) ? $all['alamat'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=pending&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['pending']) ? $all['pending'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=batal&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['batal']) ? $all['batal'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=ijin_tanam_tiang&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['ijin_tanam_tiang']) ? $all['ijin_tanam_tiang'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_pelanggan&kendala=njki&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['njki']) ? $all['njki'] : '' ?></a></td>
                <!-- Kendala Installasi -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=tiang&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['tiang']) ? $all['tiang'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=rute&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['rute']) ? $all['rute'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pending_instalasi&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['pending_instalasi']) ? $all['pending_instalasi'] : '' ?></a></td>
                <!-- Kendala Maintenance -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_loss&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['odp_loss']) ? $all['odp_loss'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_reti&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['odp_reti']) ? $all['odp_reti'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=onu_32&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['onu_32']) ? $all['onu_32'] : '' ?></a></td>
                <!-- Kendala Teknis -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_blm_live&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['odp_blm_live']) ? $all['odp_blm_live'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=odp_full&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['odp_full']) ? $all['odp_full'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=pt_dua&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['pt_dua']) ? $all['pt_dua'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_jaringan&kendala=no_fo&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['no_fo']) ? $all['no_fo'] : '' ?></a></td>
                <!-- On Construction -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=redesain&kendala=redesain&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['redesain']) ? $all['redesain'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_datel&kendala=approval_datel&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['approval_datel']) ? $all['approval_datel'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=approval_amo&kendala=approval_amo&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['approval_amo']) ? $all['approval_amo'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=deploy&kendala=deploy&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['deploy']) ? $all['deploy'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=proses_golive&kendala=proses_golive&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['proses_golive']) ? $all['proses_golive'] : '' ?></a></td>
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=kendala_golive&kendala=kendala_golive&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['kendala_golive']) ? $all['kendala_golive'] : '' ?></a></td>
                <!-- TOTAL -->
                <td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=all&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= !empty($all['total']) ? $all['total'] : '' ?></a></td>
            </tr>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#daterange-btn').daterangepicker({
                closeOnSelect: true,
                showDropdowns: true,
                minYear: 2021,
                maxYear: parseInt(moment().format('YYYY'), 10),
                ranges: {
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '2 Bulan Lalu': [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],
                    '3 Bulan Lalu': [moment().subtract(3, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],
                    'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],
                    'Tahun Lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                let base_url = '<?php echo base_url() ?>';
                let segment = $('#filter_segment').val();
                let unit = $('#filter_unit').val();
                window.location.replace(base_url + "index.php/sales/kendala/progress/" + segment + "/" + unit + "/" + $('#filter_by_tgl').val() + "/" + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'));
            }
        )
    });

    $("#filter").change(function() {
        sel = $('#filter').val();
        ambil_data(sel);
    });

    $("#filter_segment").change(function() {
        segment = $('#filter_segment').val();
        let base_url = '<?php echo base_url() ?>';
        window.location.replace(base_url + "sales/kendala/progress/" + segment);
    });

    $("#filter_unit").change(function() {
        segment = $('#filter_segment').val();
        unit = $('#filter_unit').val();
        let base_url = '<?php echo base_url() ?>';
        window.location.replace(base_url + "sales/kendala/progress/" + segment + "/" + unit);
    });

    function ambil_data(sel) {
        if (sel == 'all') {
            urlto = "<?php echo site_url('sales/kendala/kendala_all') ?>";
        } else {
            urlto = "<?php echo site_url('sales/kendala/kendala_today') ?>";
        }
        $.ajax({
            url: urlto,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let isi = '';

                for (let i = 0; i < data.isi.length; i++) {
                    isi += '<tr>' +
                        '<td style="vertical-align : middle;text-align:center;">' + data.isi[i].datel + '</td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=rna&waktu=' + sel + '">' + data.isi[i].rna + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=alamat&waktu=' + sel + '">' + data.isi[i].alamat + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=pending&waktu=' + sel + '">' + data.isi[i].pending + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=batal&waktu=' + sel + '">' + data.isi[i].batal + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=ijin_tanam_tiang&waktu=' + sel + '">' + data.isi[i].ijin_tanam_tiang + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=njki&waktu=' + sel + '">' + data.isi[i].njki + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=tiang&waktu=' + sel + '">' + data.isi[i].tiang + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=rute&waktu=' + sel + '">' + data.isi[i].rute + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_loss&waktu=' + sel + '">' + data.isi[i].odp_loss + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_reti&waktu=' + sel + '">' + data.isi[i].odp_reti + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=onu_32&waktu=' + sel + '">' + data.isi[i].onu_32 + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=odp_full&waktu=' + sel + '">' + data.isi[i].odp_full + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=pt_dua&waktu=' + sel + '">' + data.isi[i].pt_dua + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=no_fo&waktu=' + sel + '">' + data.isi[i].no_fo + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=all&waktu=' + sel + '">' + data.isi[i].subtotal + '</a></td>' +
                        '<td style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=' + data.isi[i].datel + '&kendala=terminate&waktu=' + sel + '">' + data.isi[i].terminate + '</a></td>' +

                        '</tr>';
                }

                isi += '<tr>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;">TOTAL</td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=rna&waktu=' + sel + '">' + data.total.rna + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=alamat&waktu=' + sel + '">' + data.total.alamat + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=pending&waktu=' + sel + '">' + data.total.pending + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=batal&waktu=' + sel + '">' + data.total.batal + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=ijin_tanam_tiang&waktu=' + sel + '">' + data.total.ijin_tanam_tiang + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=njki&waktu=' + sel + '">' + data.total.njki + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=tiang&waktu=' + sel + '">' + data.total.tiang + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=rute&waktu=' + sel + '">' + data.total.rute + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_loss&waktu=' + sel + '">' + data.total.odp_loss + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_reti&waktu=' + sel + '">' + data.total.odp_reti + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=onu_32&waktu=' + sel + '">' + data.total.onu_32 + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=odp_full&waktu=' + sel + '">' + data.total.odp_full + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=pt_dua&waktu=' + sel + '">' + data.total.pt_dua + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=no_fo&waktu=' + sel + '">' + data.total.no_fo + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=all&waktu=' + sel + '">' + data.total.subtotal + '</a></td>' +
                    '<td class="bawah" style="vertical-align : middle;text-align:center;"><a style="text-decoration: none;" href="kendala/show?datel=all&kendala=terminate&waktu=' + sel + '">' + data.total.terminate + '</a></td>' +
                    '</tr>';

                $("#tabel_kendala").html(isi);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>