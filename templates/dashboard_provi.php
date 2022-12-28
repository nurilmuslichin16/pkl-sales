<style type="text/css">
    table tbody tr td a {

        color: #212121;

        text-decoration: none !important;

    }

    table {

        font-size: 11px;

    }

    .bawah {

        background-color: #616161;

        color: #fff;

    }

    .bawah a {

        color: #fff !important;

    }
</style>

<input type="hidden" id="datel_selected" value="<?= $datel; ?>">
<input type="hidden" id="unit_selected" value="<?= $unit; ?>">

<div class="row">

    <div class="col-md-2">

        <select name="filter_datel" class="form-control form-control-sm" id="filter_datel" data-plugin="select2">

            <option value="all">-All SEKTOR-</option>

            <option value="pkl1" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'pkl1' ? 'selected' : '') : '' ?>>PEKALONGAN 1</option>

            <option value="pkl2" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'pkl2' ? 'selected' : '') : '' ?>>PEKALONGAN 2</option>

            <option value="btg" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'btg' ? 'selected' : '') : '' ?>>BATANG</option>

            <option value="pml" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'pml' ? 'selected' : '') : '' ?>>PEMALANG</option>

            <option value="brb" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'brb' ? 'selected' : '') : '' ?>>BREBES</option>

            <option value="slw" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'slw' ? 'selected' : '') : '' ?>>SLAWI</option>

            <option value="teg" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'teg' ? 'selected' : '') : '' ?>>TEGAL</option>

        </select>

    </div>

    <div class="col-md-2">

        <select name="filter_unit" class="form-control form-control-sm" id="filter_unit" data-plugin="select2">
            <option value="all">-All Unit-</option>
            <option value="dcs" <?= !empty($unit) ? ($unit == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
            <option value="egbis" <?= !empty($unit) ? ($unit == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
        </select>

        <!-- <div class="input-group">

			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fstartdate" id="ftgl" placeholder="Filter Start Date" type="text" data-date-format="yyyy-mm-dd" required />

			<span class="input-group-addon">

				<i class="fa fa-calendar bigger-110"></i>

			</span>

		</div> -->

    </div>

    <div class="col-md-2">

        <!-- <div class="input-group">

			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fenddate" id="ftgl" placeholder="Filter End Date" type="text" data-date-format="yyyy-mm-dd" required />

			<span class="input-group-addon">

				<i class="fa fa-calendar bigger-110"></i>

			</span>

		</div> -->

    </div>

    <div class="col-md-1">

        <!-- <button type="button" name="filterbtn" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Show Data</button> -->

    </div>

    <div class="col-md-2"></div>

    <div class="col-md-3 float-right">

        <form autocomplete="off" action="<?= site_url('sales/sc_update/search_sc') ?>" method="POST">

            <div class="form-group">

                <div class="input-search">

                    <button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>

                    <input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI">

                </div>

            </div>

        </form>

    </div>

</div>

<div class="table-responsive">

    <table class="table table-striped table-bordered table-sm" data-plugin="floatThead">

        <thead>

            <tr>

                <th colspan="19" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff; font-size:16px;">PROGRESS PROVISIONING PSB</th>

            </tr>

            <tr>

                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">SEKTOR</th>

                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TIME</th>

                <th colspan="5" style="text-align: center; background: #1E88E5; color: #fff;">PROGRESS ORDER</th>

                <th colspan="2" style="text-align: center; background: #ffb822; color: #fff;">REQUEST SC</th>

                <th colspan="5" style="text-align: center;background: #43A047; color: #fff;">PROGRESS PROVISIONING</th>

                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PELANGGAN<br>NOK</th>

                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">JARINGAN<br>NOK</th>

                <!-- <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">TERMINATE</th> -->

                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">TOTAL <br> WO</th>

                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">TOTAL <br> PROGRESS</th>

            </tr>

            <tr>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WO</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ORDERED</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OTW</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OGP</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">CEK ONU</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT SC</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">DONE SC</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT ACT</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PROG ACT</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">FALLOUT</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ACT COMP</th>

                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PS</th>

            </tr>

        </thead>

        <tbody>

            <?php if ($datel == 'brb' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">BREBES</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['wo']) ? $brb_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['ordered']) ? $brb_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['otw']) ? $brb_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['ogp']) ? $brb_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['cek_onu']) ?  $brb_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['waitsc']) ? $brb_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['donesc']) ? $brb_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['wait_act']) ? $brb_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['prog_act']) ? $brb_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['fact']) ? $brb_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['comp']) ? $brb_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['ps']) ? $brb_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['p_nok']) ? $brb_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['j_nok']) ? $brb_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($brb_reorder['terminate']) ? $brb_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=BRB&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($brb_reorder['all_amunisi'] + $brb_reorder['all_kendala'] + $brb_reorder['all_reqsc'] + $brb_reorder['all_provi']) + ($brb_as_exp['all_amunisi'] + $brb_as_exp['all_kendala'] + $brb_as_exp['all_reqsc'] + $brb_as_exp['all_provi']) + ($brb_as_h_min_1['all_amunisi'] + $brb_as_h_min_1['all_kendala'] + $brb_as_h_min_1['all_reqsc'] + $brb_as_h_min_1['all_provi']) + ($brb_pagi['all_amunisi'] + $brb_pagi['all_kendala'] + $brb_pagi['all_reqsc'] + $brb_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=BRB&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($brb_reorder['all_kendala'] + $brb_reorder['all_reqsc'] + $brb_reorder['all_provi']) + ($brb_as_exp['all_kendala'] + $brb_as_exp['all_reqsc'] + $brb_as_exp['all_provi']) + ($brb_as_h_min_1['all_kendala'] + $brb_as_h_min_1['all_reqsc'] + $brb_as_h_min_1['all_provi']) + ($brb_pagi['all_kendala'] + $brb_pagi['all_reqsc'] + $brb_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['wo']) ? $brb_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ordered']) ? $brb_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['otw']) ? $brb_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ogp']) ? $brb_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['cek_onu']) ?  $brb_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['waitsc']) ? $brb_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['donesc']) ? $brb_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['wait_act']) ? $brb_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['prog_act']) ? $brb_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['fact']) ? $brb_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['comp']) ? $brb_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ps']) ? $brb_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['p_nok']) ? $brb_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['j_nok']) ? $brb_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($brb_as_exp['terminate']) ? $brb_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['wo']) ? $brb_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['ordered']) ? $brb_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['otw']) ? $brb_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['ogp']) ? $brb_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['cek_onu']) ?  $brb_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['waitsc']) ? $brb_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['donesc']) ? $brb_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['wait_act']) ? $brb_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['prog_act']) ? $brb_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['fact']) ? $brb_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['comp']) ? $brb_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['ps']) ? $brb_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['p_nok']) ? $brb_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['j_nok']) ? $brb_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($brb_as_h_min_1['terminate']) ? $brb_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['wo']) ? $brb_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['ordered']) ? $brb_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['otw']) ? $brb_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['ogp']) ? $brb_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['cek_onu']) ?  $brb_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['waitsc']) ? $brb_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['donesc']) ? $brb_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['wait_act']) ? $brb_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['prog_act']) ? $brb_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['fact']) ? $brb_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['comp']) ? $brb_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['ps']) ? $brb_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['p_nok']) ? $brb_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['j_nok']) ? $brb_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($brb_pagi['terminate']) ? $brb_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['wo']) ? $brb_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['ordered']) ? $brb_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['otw']) ? $brb_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['ogp']) ? $brb_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['cek_onu']) ?  $brb_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['waitsc']) ? $brb_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['donesc']) ? $brb_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['wait_act']) ? $brb_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['prog_act']) ? $brb_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['fact']) ? $brb_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['comp']) ? $brb_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['ps']) ? $brb_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['p_nok']) ? $brb_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['j_nok']) ? $brb_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($brb_sore['terminate']) ? $brb_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BRB&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($brb_sore['all_amunisi'] + $brb_sore['all_kendala'] + $brb_sore['all_reqsc'] + $brb_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BRB&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($brb_sore['all_kendala'] + $brb_sore['all_reqsc'] + $brb_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['wo']) ? $brb_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['ordered']) ? $brb_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['otw']) ? $brb_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['ogp']) ? $brb_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['cek_onu']) ?  $brb_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['waitsc']) ? $brb_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BRB&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['donesc']) ? $brb_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['wait_act']) ? $brb_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['prog_act']) ? $brb_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['fact']) ? $brb_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['comp']) ? $brb_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['ps']) ? $brb_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['p_nok']) ? $brb_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['j_nok']) ? $brb_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($brb_all['terminate']) ? $brb_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BRB&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($brb_all['all_amunisi'] + $brb_all['all_kendala'] + $brb_all['all_reqsc'] + $brb_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'btg' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">BATANG</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['wo']) ? $btg_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['ordered']) ? $btg_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['otw']) ? $btg_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['ogp']) ? $btg_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['cek_onu']) ?  $btg_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['waitsc']) ? $btg_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['donesc']) ? $btg_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['wait_act']) ? $btg_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['prog_act']) ? $btg_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['fact']) ? $btg_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['comp']) ? $btg_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['ps']) ? $btg_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['p_nok']) ? $btg_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['j_nok']) ? $btg_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($btg_reorder['terminate']) ? $btg_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=BTG&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($btg_reorder['all_amunisi'] + $btg_reorder['all_kendala'] + $btg_reorder['all_reqsc'] + $btg_reorder['all_provi']) + ($btg_as_exp['all_amunisi'] + $btg_as_exp['all_kendala'] + $btg_as_exp['all_reqsc'] + $btg_as_exp['all_provi']) + ($btg_as_h_min_1['all_amunisi'] + $btg_as_h_min_1['all_kendala'] + $btg_as_h_min_1['all_reqsc'] + $btg_as_h_min_1['all_provi']) + ($btg_pagi['all_amunisi'] + $btg_pagi['all_kendala'] + $btg_pagi['all_reqsc'] + $btg_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=BTG&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($btg_reorder['all_kendala'] + $btg_reorder['all_reqsc'] + $btg_reorder['all_provi']) + ($btg_as_exp['all_kendala'] + $btg_as_exp['all_reqsc'] + $btg_as_exp['all_provi']) + ($btg_as_h_min_1['all_kendala'] + $btg_as_h_min_1['all_reqsc'] + $btg_as_h_min_1['all_provi']) + ($btg_pagi['all_kendala'] + $btg_pagi['all_reqsc'] + $btg_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['wo']) ? $btg_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ordered']) ? $btg_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['otw']) ? $btg_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ogp']) ? $btg_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['cek_onu']) ?  $btg_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['waitsc']) ? $btg_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['donesc']) ? $btg_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['wait_act']) ? $btg_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['prog_act']) ? $btg_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['fact']) ? $btg_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['comp']) ? $btg_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ps']) ? $btg_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['p_nok']) ? $btg_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['j_nok']) ? $btg_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($btg_as_exp['terminate']) ? $btg_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['wo']) ? $btg_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['ordered']) ? $btg_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['otw']) ? $btg_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['ogp']) ? $btg_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['cek_onu']) ?  $btg_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['waitsc']) ? $btg_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['donesc']) ? $btg_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['wait_act']) ? $btg_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['prog_act']) ? $btg_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['fact']) ? $btg_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['comp']) ? $btg_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['ps']) ? $btg_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['p_nok']) ? $btg_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['j_nok']) ? $btg_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($btg_as_h_min_1['terminate']) ? $btg_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['wo']) ? $btg_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['ordered']) ? $btg_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['otw']) ? $btg_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['ogp']) ? $btg_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['cek_onu']) ?  $btg_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['waitsc']) ? $btg_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['donesc']) ? $btg_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['wait_act']) ? $btg_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['prog_act']) ? $btg_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['fact']) ? $btg_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['comp']) ? $btg_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['ps']) ? $btg_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['p_nok']) ? $btg_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['j_nok']) ? $btg_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($btg_pagi['terminate']) ? $btg_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['wo']) ? $btg_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['ordered']) ? $btg_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['otw']) ? $btg_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['ogp']) ? $btg_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['cek_onu']) ?  $btg_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['waitsc']) ? $btg_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['donesc']) ? $btg_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['wait_act']) ? $btg_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['prog_act']) ? $btg_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['fact']) ? $btg_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['comp']) ? $btg_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['ps']) ? $btg_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['p_nok']) ? $btg_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['j_nok']) ? $btg_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($btg_sore['terminate']) ? $btg_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BTG&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($btg_sore['all_amunisi'] + $btg_sore['all_kendala'] + $btg_sore['all_reqsc'] + $btg_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BTG&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($btg_sore['all_kendala'] + $btg_sore['all_reqsc'] + $btg_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['wo']) ? $btg_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['ordered']) ? $btg_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['otw']) ? $btg_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['ogp']) ? $btg_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['cek_onu']) ?  $btg_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['waitsc']) ? $btg_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=BTG&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['donesc']) ? $btg_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['wait_act']) ? $btg_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['prog_act']) ? $btg_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['fact']) ? $btg_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['comp']) ? $btg_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BTG&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['ps']) ? $btg_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['p_nok']) ? $btg_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['j_nok']) ? $btg_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BTG&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($btg_all['terminate']) ? $btg_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=BTG&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($btg_all['all_amunisi'] + $btg_all['all_kendala'] + $btg_all['all_reqsc'] + $btg_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'pkl1' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">PEKALONGAN 1</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['wo']) ? $pkl1_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ordered']) ? $pkl1_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['otw']) ? $pkl1_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ogp']) ? $pkl1_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['cek_onu']) ?  $pkl1_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['waitsc']) ? $pkl1_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['donesc']) ? $pkl1_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['wait_act']) ? $pkl1_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['prog_act']) ? $pkl1_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['fact']) ? $pkl1_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['comp']) ? $pkl1_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ps']) ? $pkl1_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['p_nok']) ? $pkl1_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['j_nok']) ? $pkl1_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['terminate']) ? $pkl1_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL1&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($pkl1_reorder['all_amunisi'] + $pkl1_reorder['all_kendala'] + $pkl1_reorder['all_reqsc'] + $pkl1_reorder['all_provi']) + ($pkl1_as_exp['all_amunisi'] + $pkl1_as_exp['all_kendala'] + $pkl1_as_exp['all_reqsc'] + $pkl1_as_exp['all_provi']) + ($pkl1_as_h_min_1['all_amunisi'] + $pkl1_as_h_min_1['all_kendala'] + $pkl1_as_h_min_1['all_reqsc'] + $pkl1_as_h_min_1['all_provi']) + ($pkl1_pagi['all_amunisi'] + $pkl1_pagi['all_kendala'] + $pkl1_pagi['all_reqsc'] + $pkl1_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL1&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($pkl1_reorder['all_kendala'] + $pkl1_reorder['all_reqsc'] + $pkl1_reorder['all_provi']) + ($pkl1_as_exp['all_kendala'] + $pkl1_as_exp['all_reqsc'] + $pkl1_as_exp['all_provi']) + ($pkl1_as_h_min_1['all_kendala'] + $pkl1_as_h_min_1['all_reqsc'] + $pkl1_as_h_min_1['all_provi']) + ($pkl1_pagi['all_kendala'] + $pkl1_pagi['all_reqsc'] + $pkl1_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['wo']) ? $pkl1_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ordered']) ? $pkl1_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['otw']) ? $pkl1_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ogp']) ? $pkl1_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['cek_onu']) ?  $pkl1_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['waitsc']) ? $pkl1_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['donesc']) ? $pkl1_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['wait_act']) ? $pkl1_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['prog_act']) ? $pkl1_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['fact']) ? $pkl1_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['comp']) ? $pkl1_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ps']) ? $pkl1_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['p_nok']) ? $pkl1_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['j_nok']) ? $pkl1_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['terminate']) ? $pkl1_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['wo']) ? $pkl1_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['ordered']) ? $pkl1_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['otw']) ? $pkl1_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['ogp']) ? $pkl1_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['cek_onu']) ?  $pkl1_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['waitsc']) ? $pkl1_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['donesc']) ? $pkl1_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['wait_act']) ? $pkl1_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['prog_act']) ? $pkl1_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['fact']) ? $pkl1_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['comp']) ? $pkl1_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['ps']) ? $pkl1_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['p_nok']) ? $pkl1_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['j_nok']) ? $pkl1_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl1_as_h_min_1['terminate']) ? $pkl1_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['wo']) ? $pkl1_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['ordered']) ? $pkl1_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['otw']) ? $pkl1_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['ogp']) ? $pkl1_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['cek_onu']) ?  $pkl1_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['waitsc']) ? $pkl1_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['donesc']) ? $pkl1_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['wait_act']) ? $pkl1_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['prog_act']) ? $pkl1_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['fact']) ? $pkl1_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['comp']) ? $pkl1_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['ps']) ? $pkl1_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['p_nok']) ? $pkl1_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['j_nok']) ? $pkl1_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl1_pagi['terminate']) ? $pkl1_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['wo']) ? $pkl1_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['ordered']) ? $pkl1_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['otw']) ? $pkl1_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['ogp']) ? $pkl1_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['cek_onu']) ?  $pkl1_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['waitsc']) ? $pkl1_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['donesc']) ? $pkl1_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['wait_act']) ? $pkl1_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['prog_act']) ? $pkl1_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['fact']) ? $pkl1_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['comp']) ? $pkl1_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['ps']) ? $pkl1_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['p_nok']) ? $pkl1_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['j_nok']) ? $pkl1_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($pkl1_sore['terminate']) ? $pkl1_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL1&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($pkl1_sore['all_amunisi'] + $pkl1_sore['all_kendala'] + $pkl1_sore['all_reqsc'] + $pkl1_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL1&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($pkl1_sore['all_kendala'] + $pkl1_sore['all_reqsc'] + $pkl1_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['wo']) ? $pkl1_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['ordered']) ? $pkl1_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['otw']) ? $pkl1_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['ogp']) ? $pkl1_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL1&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['cek_onu']) ?  $pkl1_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['waitsc']) ? $pkl1_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL1&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['donesc']) ? $pkl1_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['wait_act']) ? $pkl1_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['prog_act']) ? $pkl1_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['fact']) ? $pkl1_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['comp']) ? $pkl1_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL1&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['ps']) ? $pkl1_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['p_nok']) ? $pkl1_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['j_nok']) ? $pkl1_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL1&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($pkl1_all['terminate']) ? $pkl1_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL1&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($pkl1_all['all_amunisi'] + $pkl1_all['all_kendala'] + $pkl1_all['all_reqsc'] + $pkl1_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'pkl2' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">PEKALONGAN 2</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['wo']) ? $pkl2_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ordered']) ? $pkl2_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['otw']) ? $pkl2_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ogp']) ? $pkl2_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['cek_onu']) ?  $pkl2_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['waitsc']) ? $pkl2_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['donesc']) ? $pkl2_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['wait_act']) ? $pkl2_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['prog_act']) ? $pkl2_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['fact']) ? $pkl2_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['comp']) ? $pkl2_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ps']) ? $pkl2_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['p_nok']) ? $pkl2_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['j_nok']) ? $pkl2_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['terminate']) ? $pkl2_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL2&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($pkl2_reorder['all_amunisi'] + $pkl2_reorder['all_kendala'] + $pkl2_reorder['all_reqsc'] + $pkl2_reorder['all_provi']) + ($pkl2_as_exp['all_amunisi'] + $pkl2_as_exp['all_kendala'] + $pkl2_as_exp['all_reqsc'] + $pkl2_as_exp['all_provi']) + ($pkl2_as_h_min_1['all_amunisi'] + $pkl2_as_h_min_1['all_kendala'] + $pkl2_as_h_min_1['all_reqsc'] + $pkl2_as_h_min_1['all_provi']) + ($pkl2_pagi['all_amunisi'] + $pkl2_pagi['all_kendala'] + $pkl2_pagi['all_reqsc'] + $pkl2_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL2&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($pkl2_reorder['all_kendala'] + $pkl2_reorder['all_reqsc'] + $pkl2_reorder['all_provi']) + ($pkl2_as_exp['all_kendala'] + $pkl2_as_exp['all_reqsc'] + $pkl2_as_exp['all_provi']) + ($pkl2_as_h_min_1['all_kendala'] + $pkl2_as_h_min_1['all_reqsc'] + $pkl2_as_h_min_1['all_provi']) + ($pkl2_pagi['all_kendala'] + $pkl2_pagi['all_reqsc'] + $pkl2_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['wo']) ? $pkl2_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ordered']) ? $pkl2_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['otw']) ? $pkl2_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ogp']) ? $pkl2_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['cek_onu']) ?  $pkl2_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['waitsc']) ? $pkl2_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['donesc']) ? $pkl2_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['wait_act']) ? $pkl2_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['prog_act']) ? $pkl2_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['fact']) ? $pkl2_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['comp']) ? $pkl2_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ps']) ? $pkl2_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['p_nok']) ? $pkl2_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['j_nok']) ? $pkl2_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['terminate']) ? $pkl2_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['wo']) ? $pkl2_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['ordered']) ? $pkl2_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['otw']) ? $pkl2_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['ogp']) ? $pkl2_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['cek_onu']) ?  $pkl2_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['waitsc']) ? $pkl2_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['donesc']) ? $pkl2_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['wait_act']) ? $pkl2_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['prog_act']) ? $pkl2_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['fact']) ? $pkl2_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['comp']) ? $pkl2_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['ps']) ? $pkl2_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['p_nok']) ? $pkl2_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['j_nok']) ? $pkl2_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pkl2_as_h_min_1['terminate']) ? $pkl2_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['wo']) ? $pkl2_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['ordered']) ? $pkl2_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['otw']) ? $pkl2_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['ogp']) ? $pkl2_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['cek_onu']) ?  $pkl2_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['waitsc']) ? $pkl2_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['donesc']) ? $pkl2_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['wait_act']) ? $pkl2_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['prog_act']) ? $pkl2_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['fact']) ? $pkl2_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['comp']) ? $pkl2_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['ps']) ? $pkl2_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['p_nok']) ? $pkl2_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['j_nok']) ? $pkl2_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($pkl2_pagi['terminate']) ? $pkl2_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['wo']) ? $pkl2_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['ordered']) ? $pkl2_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['otw']) ? $pkl2_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['ogp']) ? $pkl2_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['cek_onu']) ?  $pkl2_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['waitsc']) ? $pkl2_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['donesc']) ? $pkl2_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['wait_act']) ? $pkl2_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['prog_act']) ? $pkl2_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['fact']) ? $pkl2_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['comp']) ? $pkl2_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['ps']) ? $pkl2_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['p_nok']) ? $pkl2_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['j_nok']) ? $pkl2_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($pkl2_sore['terminate']) ? $pkl2_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL2&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($pkl2_sore['all_amunisi'] + $pkl2_sore['all_kendala'] + $pkl2_sore['all_reqsc'] + $pkl2_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL2&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($pkl2_sore['all_kendala'] + $pkl2_sore['all_reqsc'] + $pkl2_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['wo']) ? $pkl2_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['ordered']) ? $pkl2_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['otw']) ? $pkl2_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['ogp']) ? $pkl2_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PKL2&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['cek_onu']) ?  $pkl2_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['waitsc']) ? $pkl2_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PKL2&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['donesc']) ? $pkl2_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['wait_act']) ? $pkl2_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['prog_act']) ? $pkl2_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['fact']) ? $pkl2_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['comp']) ? $pkl2_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PKL2&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['ps']) ? $pkl2_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['p_nok']) ? $pkl2_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['j_nok']) ? $pkl2_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PKL2&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($pkl2_all['terminate']) ? $pkl2_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PKL2&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($pkl2_all['all_amunisi'] + $pkl2_all['all_kendala'] + $pkl2_all['all_reqsc'] + $pkl2_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'pml' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">PEMALANG</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['wo']) ? $pml_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['ordered']) ? $pml_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['otw']) ? $pml_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['ogp']) ? $pml_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['cek_onu']) ?  $pml_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['waitsc']) ? $pml_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['donesc']) ? $pml_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['wait_act']) ? $pml_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['prog_act']) ? $pml_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['fact']) ? $pml_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['comp']) ? $pml_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['ps']) ? $pml_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['p_nok']) ? $pml_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['j_nok']) ? $pml_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($pml_reorder['terminate']) ? $pml_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PML&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($pml_reorder['all_amunisi'] + $pml_reorder['all_kendala'] + $pml_reorder['all_reqsc'] + $pml_reorder['all_provi']) + ($pml_as_exp['all_amunisi'] + $pml_as_exp['all_kendala'] + $pml_as_exp['all_reqsc'] + $pml_as_exp['all_provi']) + ($pml_as_h_min_1['all_amunisi'] + $pml_as_h_min_1['all_kendala'] + $pml_as_h_min_1['all_reqsc'] + $pml_as_h_min_1['all_provi']) + ($pml_pagi['all_amunisi'] + $pml_pagi['all_kendala'] + $pml_pagi['all_reqsc'] + $pml_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=PML&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($pml_reorder['all_kendala'] + $pml_reorder['all_reqsc'] + $pml_reorder['all_provi']) + ($pml_as_exp['all_kendala'] + $pml_as_exp['all_reqsc'] + $pml_as_exp['all_provi']) + ($pml_as_h_min_1['all_kendala'] + $pml_as_h_min_1['all_reqsc'] + $pml_as_h_min_1['all_provi']) + ($pml_pagi['all_kendala'] + $pml_pagi['all_reqsc'] + $pml_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['wo']) ? $pml_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ordered']) ? $pml_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['otw']) ? $pml_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ogp']) ? $pml_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['cek_onu']) ?  $pml_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['waitsc']) ? $pml_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['donesc']) ? $pml_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['wait_act']) ? $pml_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['prog_act']) ? $pml_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['fact']) ? $pml_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['comp']) ? $pml_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ps']) ? $pml_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['p_nok']) ? $pml_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['j_nok']) ? $pml_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($pml_as_exp['terminate']) ? $pml_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['wo']) ? $pml_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['ordered']) ? $pml_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['otw']) ? $pml_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['ogp']) ? $pml_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['cek_onu']) ?  $pml_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['waitsc']) ? $pml_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['donesc']) ? $pml_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['wait_act']) ? $pml_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['prog_act']) ? $pml_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['fact']) ? $pml_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['comp']) ? $pml_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['ps']) ? $pml_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['p_nok']) ? $pml_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['j_nok']) ? $pml_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($pml_as_h_min_1['terminate']) ? $pml_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['wo']) ? $pml_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['ordered']) ? $pml_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['otw']) ? $pml_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['ogp']) ? $pml_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['cek_onu']) ?  $pml_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['waitsc']) ? $pml_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['donesc']) ? $pml_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['wait_act']) ? $pml_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['prog_act']) ? $pml_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['fact']) ? $pml_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['comp']) ? $pml_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['ps']) ? $pml_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['p_nok']) ? $pml_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['j_nok']) ? $pml_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($pml_pagi['terminate']) ? $pml_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['wo']) ? $pml_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['ordered']) ? $pml_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['otw']) ? $pml_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['ogp']) ? $pml_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['cek_onu']) ?  $pml_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['waitsc']) ? $pml_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['donesc']) ? $pml_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['wait_act']) ? $pml_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['prog_act']) ? $pml_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['fact']) ? $pml_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['comp']) ? $pml_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['ps']) ? $pml_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['p_nok']) ? $pml_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['j_nok']) ? $pml_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($pml_sore['terminate']) ? $pml_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PML&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($pml_sore['all_amunisi'] + $pml_sore['all_kendala'] + $pml_sore['all_reqsc'] + $pml_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PML&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($pml_sore['all_kendala'] + $pml_sore['all_reqsc'] + $pml_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['wo']) ? $pml_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['ordered']) ? $pml_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['otw']) ? $pml_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['ogp']) ? $pml_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=PML&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['cek_onu']) ?  $pml_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['waitsc']) ? $pml_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=PML&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['donesc']) ? $pml_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['wait_act']) ? $pml_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['prog_act']) ? $pml_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['fact']) ? $pml_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['comp']) ? $pml_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=PML&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['ps']) ? $pml_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['p_nok']) ? $pml_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['j_nok']) ? $pml_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=PML&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($pml_all['terminate']) ? $pml_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=PML&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($pml_all['all_amunisi'] + $pml_all['all_kendala'] + $pml_all['all_reqsc'] + $pml_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'slw' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">SLAWI</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['wo']) ? $slw_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['ordered']) ? $slw_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['otw']) ? $slw_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['ogp']) ? $slw_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['cek_onu']) ?  $slw_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['waitsc']) ? $slw_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['donesc']) ? $slw_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['wait_act']) ? $slw_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['prog_act']) ? $slw_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['fact']) ? $slw_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['comp']) ? $slw_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['ps']) ? $slw_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['p_nok']) ? $slw_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['j_nok']) ? $slw_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($slw_reorder['terminate']) ? $slw_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=SLW&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($slw_reorder['all_amunisi'] + $slw_reorder['all_kendala'] + $slw_reorder['all_reqsc'] + $slw_reorder['all_provi']) + ($slw_as_exp['all_amunisi'] + $slw_as_exp['all_kendala'] + $slw_as_exp['all_reqsc'] + $slw_as_exp['all_provi']) + ($slw_as_h_min_1['all_amunisi'] + $slw_as_h_min_1['all_kendala'] + $slw_as_h_min_1['all_reqsc'] + $slw_as_h_min_1['all_provi']) + ($slw_pagi['all_amunisi'] + $slw_pagi['all_kendala'] + $slw_pagi['all_reqsc'] + $slw_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=SLW&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($slw_reorder['all_kendala'] + $slw_reorder['all_reqsc'] + $slw_reorder['all_provi']) + ($slw_as_exp['all_kendala'] + $slw_as_exp['all_reqsc'] + $slw_as_exp['all_provi']) + ($slw_as_h_min_1['all_kendala'] + $slw_as_h_min_1['all_reqsc'] + $slw_as_h_min_1['all_provi']) + ($slw_pagi['all_kendala'] + $slw_pagi['all_reqsc'] + $slw_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['wo']) ? $slw_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ordered']) ? $slw_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['otw']) ? $slw_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ogp']) ? $slw_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['cek_onu']) ?  $slw_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['waitsc']) ? $slw_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['donesc']) ? $slw_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['wait_act']) ? $slw_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['prog_act']) ? $slw_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['fact']) ? $slw_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['comp']) ? $slw_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ps']) ? $slw_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['p_nok']) ? $slw_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['j_nok']) ? $slw_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($slw_as_exp['terminate']) ? $slw_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['wo']) ? $slw_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['ordered']) ? $slw_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['otw']) ? $slw_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['ogp']) ? $slw_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['cek_onu']) ?  $slw_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['waitsc']) ? $slw_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['donesc']) ? $slw_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['wait_act']) ? $slw_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['prog_act']) ? $slw_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['fact']) ? $slw_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['comp']) ? $slw_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['ps']) ? $slw_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['p_nok']) ? $slw_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['j_nok']) ? $slw_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($slw_as_h_min_1['terminate']) ? $slw_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['wo']) ? $slw_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['ordered']) ? $slw_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['otw']) ? $slw_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['ogp']) ? $slw_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['cek_onu']) ?  $slw_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['waitsc']) ? $slw_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['donesc']) ? $slw_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['wait_act']) ? $slw_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['prog_act']) ? $slw_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['fact']) ? $slw_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['comp']) ? $slw_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['ps']) ? $slw_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['p_nok']) ? $slw_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['j_nok']) ? $slw_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($slw_pagi['terminate']) ? $slw_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['wo']) ? $slw_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['ordered']) ? $slw_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['otw']) ? $slw_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['ogp']) ? $slw_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['cek_onu']) ?  $slw_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['waitsc']) ? $slw_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['donesc']) ? $slw_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['wait_act']) ? $slw_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['prog_act']) ? $slw_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['fact']) ? $slw_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['comp']) ? $slw_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['ps']) ? $slw_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['p_nok']) ? $slw_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['j_nok']) ? $slw_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($slw_sore['terminate']) ? $slw_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=SLW&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($slw_sore['all_amunisi'] + $slw_sore['all_kendala'] + $slw_sore['all_reqsc'] + $slw_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=SLW&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($slw_sore['all_kendala'] + $slw_sore['all_reqsc'] + $slw_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['wo']) ? $slw_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['ordered']) ? $slw_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['otw']) ? $slw_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['ogp']) ? $slw_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=SLW&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['cek_onu']) ?  $slw_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['waitsc']) ? $slw_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=SLW&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['donesc']) ? $slw_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['wait_act']) ? $slw_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['prog_act']) ? $slw_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['fact']) ? $slw_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['comp']) ? $slw_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=SLW&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['ps']) ? $slw_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['p_nok']) ? $slw_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['j_nok']) ? $slw_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=SLW&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($slw_all['terminate']) ? $slw_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=SLW&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($slw_all['all_amunisi'] + $slw_all['all_kendala'] + $slw_all['all_reqsc'] + $slw_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'teg' || $datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">TEGAL</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['wo']) ? $teg_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['ordered']) ? $teg_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['otw']) ? $teg_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['ogp']) ? $teg_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['cek_onu']) ?  $teg_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['waitsc']) ? $teg_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['donesc']) ? $teg_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['wait_act']) ? $teg_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['prog_act']) ? $teg_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['fact']) ? $teg_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['comp']) ? $teg_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['ps']) ? $teg_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['p_nok']) ? $teg_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['j_nok']) ? $teg_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($teg_reorder['terminate']) ? $teg_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=TEG&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($teg_reorder['all_amunisi'] + $teg_reorder['all_kendala'] + $teg_reorder['all_reqsc'] + $teg_reorder['all_provi']) + ($teg_as_exp['all_amunisi'] + $teg_as_exp['all_kendala'] + $teg_as_exp['all_reqsc'] + $teg_as_exp['all_provi']) + ($teg_as_h_min_1['all_amunisi'] + $teg_as_h_min_1['all_kendala'] + $teg_as_h_min_1['all_reqsc'] + $teg_as_h_min_1['all_provi']) + ($teg_pagi['all_amunisi'] + $teg_pagi['all_kendala'] + $teg_pagi['all_reqsc'] + $teg_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=TEG&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($teg_reorder['all_kendala'] + $teg_reorder['all_reqsc'] + $teg_reorder['all_provi']) + ($teg_as_exp['all_kendala'] + $teg_as_exp['all_reqsc'] + $teg_as_exp['all_provi']) + ($teg_as_h_min_1['all_kendala'] + $teg_as_h_min_1['all_reqsc'] + $teg_as_h_min_1['all_provi']) + ($teg_pagi['all_kendala'] + $teg_pagi['all_reqsc'] + $teg_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['wo']) ? $teg_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ordered']) ? $teg_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['otw']) ? $teg_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ogp']) ? $teg_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['cek_onu']) ?  $teg_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['waitsc']) ? $teg_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['donesc']) ? $teg_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['wait_act']) ? $teg_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['prog_act']) ? $teg_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['fact']) ? $teg_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['comp']) ? $teg_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ps']) ? $teg_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['p_nok']) ? $teg_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['j_nok']) ? $teg_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($teg_as_exp['terminate']) ? $teg_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['wo']) ? $teg_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['ordered']) ? $teg_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['otw']) ? $teg_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['ogp']) ? $teg_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['cek_onu']) ?  $teg_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['waitsc']) ? $teg_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['donesc']) ? $teg_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['wait_act']) ? $teg_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['prog_act']) ? $teg_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['fact']) ? $teg_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['comp']) ? $teg_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['ps']) ? $teg_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['p_nok']) ? $teg_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['j_nok']) ? $teg_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($teg_as_h_min_1['terminate']) ? $teg_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['wo']) ? $teg_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['ordered']) ? $teg_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['otw']) ? $teg_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['ogp']) ? $teg_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['cek_onu']) ?  $teg_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['waitsc']) ? $teg_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['donesc']) ? $teg_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['wait_act']) ? $teg_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['prog_act']) ? $teg_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['fact']) ? $teg_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['comp']) ? $teg_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['ps']) ? $teg_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['p_nok']) ? $teg_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['j_nok']) ? $teg_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($teg_pagi['terminate']) ? $teg_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['wo']) ? $teg_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['ordered']) ? $teg_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['otw']) ? $teg_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['ogp']) ? $teg_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['cek_onu']) ?  $teg_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['waitsc']) ? $teg_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['donesc']) ? $teg_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['wait_act']) ? $teg_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['prog_act']) ? $teg_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['fact']) ? $teg_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['comp']) ? $teg_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['ps']) ? $teg_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['p_nok']) ? $teg_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['j_nok']) ? $teg_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($teg_sore['terminate']) ? $teg_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=TEG&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($teg_sore['all_amunisi'] + $teg_sore['all_kendala'] + $teg_sore['all_reqsc'] + $teg_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=TEG&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($teg_sore['all_kendala'] + $teg_sore['all_reqsc'] + $teg_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['wo']) ? $teg_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['ordered']) ? $teg_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['otw']) ? $teg_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['ogp']) ? $teg_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=TEG&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['cek_onu']) ?  $teg_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['waitsc']) ? $teg_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=TEG&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['donesc']) ? $teg_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['wait_act']) ? $teg_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['prog_act']) ? $teg_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['fact']) ? $teg_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['comp']) ? $teg_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=TEG&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['ps']) ? $teg_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['p_nok']) ? $teg_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['j_nok']) ? $teg_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=TEG&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($teg_all['terminate']) ? $teg_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=TEG&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($teg_all['all_amunisi'] + $teg_all['all_kendala'] + $teg_all['all_reqsc'] + $teg_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>



            <?php if ($datel == 'all') { ?>

                <tr>

                    <td style="font-weight: bold; vertical-align : middle;" rowspan="6">ALL DATEL</td>

                    <td style="font-weight: bold;"><i>REORDER PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['wo']) ? $all_reorder['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['ordered']) ? $all_reorder['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['otw']) ? $all_reorder['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['ogp']) ? $all_reorder['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['cek_onu']) ?  $all_reorder['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['waitsc']) ? $all_reorder['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['donesc']) ? $all_reorder['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['wait_act']) ? $all_reorder['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['prog_act']) ? $all_reorder['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['fact']) ? $all_reorder['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['comp']) ? $all_reorder['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['ps']) ? $all_reorder['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['p_nok']) ? $all_reorder['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['j_nok']) ? $all_reorder['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=reorder&unit=' . $unit) ?>"><?= !empty($all_reorder['terminate']) ? $all_reorder['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=all&kategori=total_wo&time=total_non_sore&unit=' . $unit) ?>"><?= ($all_reorder['all_amunisi'] + $all_reorder['all_kendala'] + $all_reorder['all_reqsc'] + $all_reorder['all_provi']) + ($all_as_exp['all_amunisi'] + $all_as_exp['all_kendala'] + $all_as_exp['all_reqsc'] + $all_as_exp['all_provi']) + ($all_as_h_min_1['all_amunisi'] + $all_as_h_min_1['all_kendala'] + $all_as_h_min_1['all_reqsc'] + $all_as_h_min_1['all_provi']) + ($all_pagi['all_amunisi'] + $all_pagi['all_kendala'] + $all_pagi['all_reqsc'] + $all_pagi['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center" rowspan="4"><a href="<?= site_url('sales/work_order_provi/total?datel=all&kategori=total_prog&time=total_non_sore&unit=' . $unit) ?>"><?= ($all_reorder['all_kendala'] + $all_reorder['all_reqsc'] + $all_reorder['all_provi']) + ($all_as_exp['all_kendala'] + $all_as_exp['all_reqsc'] + $all_as_exp['all_provi']) + ($all_as_h_min_1['all_kendala'] + $all_as_h_min_1['all_reqsc'] + $all_as_h_min_1['all_provi']) + ($all_pagi['all_kendala'] + $all_pagi['all_reqsc'] + $all_pagi['all_provi'])  ?></a></td>

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS EXP</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['wo']) ? $all_as_exp['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['ordered']) ? $all_as_exp['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['otw']) ? $all_as_exp['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['ogp']) ? $all_as_exp['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['cek_onu']) ?  $all_as_exp['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['waitsc']) ? $all_as_exp['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['donesc']) ? $all_as_exp['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['wait_act']) ? $all_as_exp['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['prog_act']) ? $all_as_exp['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['fact']) ? $all_as_exp['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['comp']) ? $all_as_exp['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['ps']) ? $all_as_exp['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['p_nok']) ? $all_as_exp['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['j_nok']) ? $all_as_exp['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=as_exp&unit=' . $unit) ?>"><?= !empty($all_as_exp['terminate']) ? $all_as_exp['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>AS H-1</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['wo']) ? $all_as_h_min_1['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['ordered']) ? $all_as_h_min_1['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['otw']) ? $all_as_h_min_1['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['ogp']) ? $all_as_h_min_1['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['cek_onu']) ?  $all_as_h_min_1['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['waitsc']) ? $all_as_h_min_1['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['donesc']) ? $all_as_h_min_1['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['wait_act']) ? $all_as_h_min_1['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['prog_act']) ? $all_as_h_min_1['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['fact']) ? $all_as_h_min_1['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['comp']) ? $all_as_h_min_1['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['ps']) ? $all_as_h_min_1['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['p_nok']) ? $all_as_h_min_1['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['j_nok']) ? $all_as_h_min_1['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=as_h_min_1&unit=' . $unit) ?>"><?= !empty($all_as_h_min_1['terminate']) ? $all_as_h_min_1['terminate'] : '' ?></a></td> -->

                </tr>

                <tr>

                    <td style="font-weight: bold;"><i>PAGI</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['wo']) ? $all_pagi['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['ordered']) ? $all_pagi['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['otw']) ? $all_pagi['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['ogp']) ? $all_pagi['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['cek_onu']) ?  $all_pagi['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['waitsc']) ? $all_pagi['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['donesc']) ? $all_pagi['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['wait_act']) ? $all_pagi['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['prog_act']) ? $all_pagi['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['fact']) ? $all_pagi['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['comp']) ? $all_pagi['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['ps']) ? $all_pagi['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['p_nok']) ? $all_pagi['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['j_nok']) ? $all_pagi['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=pagi&unit=' . $unit) ?>"><?= !empty($all_pagi['terminate']) ? $all_pagi['terminate'] : '' ?></a></td> -->

                </tr>

                <tr style="background: #ffc58a;">

                    <td style="font-weight: bold;"><i>SORE</i></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['wo']) ? $all_sore['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['ordered']) ? $all_sore['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['otw']) ? $all_sore['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['ogp']) ? $all_sore['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['cek_onu']) ?  $all_sore['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['waitsc']) ? $all_sore['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['donesc']) ? $all_sore['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background:#ffc58a;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['wait_act']) ? $all_sore['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['prog_act']) ? $all_sore['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['fact']) ? $all_sore['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['comp']) ? $all_sore['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;background: #ffc58a"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['ps']) ? $all_sore['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['p_nok']) ? $all_sore['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['j_nok']) ? $all_sore['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=sore&unit=' . $unit) ?>"><?= !empty($all_sore['terminate']) ? $all_sore['terminate'] : '' ?></a></td> -->

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=all&kategori=total_wo&time=total_sore&unit=' . $unit) ?>"><?= ($all_sore['all_amunisi'] + $all_sore['all_kendala'] + $all_sore['all_reqsc'] + $all_sore['all_provi'])  ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=all&kategori=total_prog&time=total_sore&unit=' . $unit) ?>"><?= ($all_sore['all_kendala'] + $all_sore['all_reqsc'] + $all_sore['all_provi'])  ?></a></td>

                </tr>

                <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">

                    <td style="font-weight: bold;"><i>TOTAL</i></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=all&unit=' . $unit) ?>"><?= !empty($all_all['wo']) ? $all_all['wo'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=all&unit=' . $unit) ?>"><?= !empty($all_all['ordered']) ? $all_all['ordered'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=all&unit=' . $unit) ?>"><?= !empty($all_all['otw']) ? $all_all['otw'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=all&unit=' . $unit) ?>"><?= !empty($all_all['ogp']) ? $all_all['ogp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=all&unit=' . $unit) ?>"><?= !empty($all_all['cek_onu']) ?  $all_all['cek_onu'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=waitsc&time=all&unit=' . $unit) ?>"><?= !empty($all_all['waitsc']) ? $all_all['waitsc'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/request_sc?datel=all&kategori=donesc&time=all&unit=' . $unit) ?>"><?= !empty($all_all['donesc']) ? $all_all['donesc']  : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=all&unit=' . $unit) ?>"><?= !empty($all_all['wait_act']) ? $all_all['wait_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=all&unit=' . $unit) ?>"><?= !empty($all_all['prog_act']) ? $all_all['prog_act'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=all&unit=' . $unit) ?>"><?= !empty($all_all['fact']) ? $all_all['fact'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=all&unit=' . $unit) ?>"><?= !empty($all_all['comp']) ? $all_all['comp'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=all&unit=' . $unit) ?>"><?= !empty($all_all['ps']) ? $all_all['ps'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=all&unit=' . $unit) ?>"><?= !empty($all_all['p_nok']) ? $all_all['p_nok'] : '' ?></a></td>

                    <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=all&unit=' . $unit) ?>"><?= !empty($all_all['j_nok']) ? $all_all['j_nok'] : '' ?></a></td>

                    <!-- <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=terminate&time=all&unit=' . $unit) ?>"><?= !empty($all_all['terminate']) ? $all_all['terminate'] : '' ?></a></td> -->

                    <td colspan="2" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/total?datel=all&kategori=total_wo&time=all&unit=' . $unit) ?>"><?= ($all_all['all_amunisi'] + $all_all['all_kendala'] + $all_all['all_reqsc'] + $all_all['all_provi']) ?></a></td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>



<script>
    $('#select_datel').on('change', function() {

        var baseurl = "<?php echo site_url() ?>";

        var url = baseurl + '/welcome/provisioning/all/' + this.value;

        window.location = url;

    });

    $('#filter_datel').on('change', function() {
        var baseurl = "<?php echo site_url() ?>";
        var datel = this.value;
        var unit = $('#unit_selected').val();
        var url = baseurl + 'welcome/provisioning/all/' + datel + '/' + unit;
        window.location = url;
    });

    $('#filter_unit').on('change', function() {
        var baseurl = "<?php echo site_url() ?>";
        var unit = this.value;
        var datel = $('#datel_selected').val();
        var url = baseurl + 'welcome/provisioning/all/' + datel + '/' + unit;
        window.location = url;
    });
</script>