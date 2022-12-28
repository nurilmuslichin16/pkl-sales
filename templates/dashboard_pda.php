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

<div class="row">
    <div class="col-md-2">
        <select name="filter_unit" class="form-control form-control-sm" id="filter_unit" data-plugin="select2">
            <option value="all">-All Unit-</option>
            <option value="dcs" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
            <option value="egbis" <?= !empty($this->uri->segment(4)) ? ($this->uri->segment(4) == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
        </select>
        <!-- <select name="waktu" class="form-control form-control-sm" id="select_waktu" data-plugin="select2">
			<option value="">-Pilih Waktu-</option>
			<option value="all">All</option>
			<option value="daily">Harian</option>
			<option value="monthly">Bulanan</option>
			<option value="annual">Tahunan</option>
		</select> -->
    </div>
    <div class="col-md-2">
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
        <form autocomplete="off" action="<?= site_url('sales/sc_update/search_sc&unit=' . $unit) ?>" method="POST">
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
                <th colspan="14" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff; font-size:16px;">PROGRESS PROVISIONING PDA</th>
            </tr>
            <tr>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">SEKTOR</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TIME</th>
                <th colspan="5" style="text-align: center; background: #1E88E5; color: #fff;">PROGRESS ORDER</th>
                <th colspan="5" style="text-align: center;background: #43A047; color: #fff;">PROGRESS PROVISIONING</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PELANGGAN<br>NOK</th>
                <th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">JARINGAN<br>NOK</th>
            </tr>
            <tr>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WO</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ORDERED</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OTW</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">OGP</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">CEK ONU</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WAIT ACT</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PROG ACT</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">FALLOUT</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">ACT COMP</th>
                <th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">BREBES</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['wo']) ? $brb_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['ordered']) ? $brb_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['otw']) ? $brb_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['ogp']) ? $brb_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['cek_onu']) ?  $brb_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['wait_act']) ? $brb_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['prog_act']) ? $brb_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['fact']) ? $brb_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['comp']) ? $brb_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['ps']) ? $brb_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['p_nok']) ? $brb_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($brb_reorder['j_nok']) ? $brb_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['wo']) ? $brb_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ordered']) ? $brb_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['otw']) ? $brb_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ogp']) ? $brb_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['cek_onu']) ?  $brb_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['wait_act']) ? $brb_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['prog_act']) ? $brb_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['fact']) ? $brb_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['comp']) ? $brb_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['ps']) ? $brb_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['p_nok']) ? $brb_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($brb_as_exp['j_nok']) ? $brb_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['wo']) ? $brb_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['ordered']) ? $brb_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['otw']) ? $brb_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['ogp']) ? $brb_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['cek_onu']) ?  $brb_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['wait_act']) ? $brb_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['prog_act']) ? $brb_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['fact']) ? $brb_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['comp']) ? $brb_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['ps']) ? $brb_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['p_nok']) ? $brb_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($brb_hi['j_nok']) ? $brb_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['wo']) ? $brb_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['ordered']) ? $brb_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['otw']) ? $brb_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['ogp']) ? $brb_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=BRB&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['cek_onu']) ?  $brb_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['wait_act']) ? $brb_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['prog_act']) ? $brb_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['fact']) ? $brb_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['comp']) ? $brb_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=BRB&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['ps']) ? $brb_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['p_nok']) ? $brb_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=BRB&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($brb_all['j_nok']) ? $brb_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">BATANG</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=BTG&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['wo']) ? $btg_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['ordered']) ? $btg_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['otw']) ? $btg_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['ogp']) ? $btg_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['cek_onu']) ?  $btg_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['wait_act']) ? $btg_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['prog_act']) ? $btg_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['fact']) ? $btg_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['comp']) ? $btg_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['ps']) ? $btg_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['p_nok']) ? $btg_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($btg_reorder['j_nok']) ? $btg_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['wo']) ? $btg_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ordered']) ? $btg_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['otw']) ? $btg_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ogp']) ? $btg_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['cek_onu']) ?  $btg_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['wait_act']) ? $btg_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['prog_act']) ? $btg_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['fact']) ? $btg_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['comp']) ? $btg_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['ps']) ? $btg_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['p_nok']) ? $btg_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($btg_as_exp['j_nok']) ? $btg_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['wo']) ? $btg_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['ordered']) ? $btg_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['otw']) ? $btg_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['ogp']) ? $btg_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['cek_onu']) ?  $btg_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['wait_act']) ? $btg_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['prog_act']) ? $btg_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['fact']) ? $btg_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['comp']) ? $btg_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['ps']) ? $btg_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['p_nok']) ? $btg_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($btg_hi['j_nok']) ? $btg_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['wo']) ? $btg_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['ordered']) ? $btg_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['otw']) ? $btg_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['ogp']) ? $btg_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=btg&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['cek_onu']) ?  $btg_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['wait_act']) ? $btg_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['prog_act']) ? $btg_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['fact']) ? $btg_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['comp']) ? $btg_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=btg&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['ps']) ? $btg_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['p_nok']) ? $btg_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=btg&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($btg_all['j_nok']) ? $btg_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">PEKALONGAN 1</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['wo']) ? $pkl1_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ordered']) ? $pkl1_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['otw']) ? $pkl1_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ogp']) ? $pkl1_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['cek_onu']) ?  $pkl1_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['wait_act']) ? $pkl1_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['prog_act']) ? $pkl1_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['fact']) ? $pkl1_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['comp']) ? $pkl1_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['ps']) ? $pkl1_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['p_nok']) ? $pkl1_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_reorder['j_nok']) ? $pkl1_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['wo']) ? $pkl1_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ordered']) ? $pkl1_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['otw']) ? $pkl1_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ogp']) ? $pkl1_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['cek_onu']) ?  $pkl1_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['wait_act']) ? $pkl1_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['prog_act']) ? $pkl1_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['fact']) ? $pkl1_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['comp']) ? $pkl1_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['ps']) ? $pkl1_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['p_nok']) ? $pkl1_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_as_exp['j_nok']) ? $pkl1_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['wo']) ? $pkl1_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['ordered']) ? $pkl1_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['otw']) ? $pkl1_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['ogp']) ? $pkl1_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['cek_onu']) ?  $pkl1_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['wait_act']) ? $pkl1_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['prog_act']) ? $pkl1_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['fact']) ? $pkl1_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['comp']) ? $pkl1_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['ps']) ? $pkl1_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['p_nok']) ? $pkl1_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_hi['j_nok']) ? $pkl1_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['wo']) ? $pkl1_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['ordered']) ? $pkl1_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['otw']) ? $pkl1_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['ogp']) ? $pkl1_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl1&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['cek_onu']) ?  $pkl1_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['wait_act']) ? $pkl1_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['prog_act']) ? $pkl1_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['fact']) ? $pkl1_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['comp']) ? $pkl1_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl1&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['ps']) ? $pkl1_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['p_nok']) ? $pkl1_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl1&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl1_all['j_nok']) ? $pkl1_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">PEKALONGAN 2</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['wo']) ? $pkl2_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ordered']) ? $pkl2_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['otw']) ? $pkl2_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ogp']) ? $pkl2_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['cek_onu']) ?  $pkl2_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['wait_act']) ? $pkl2_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['prog_act']) ? $pkl2_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['fact']) ? $pkl2_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['comp']) ? $pkl2_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['ps']) ? $pkl2_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['p_nok']) ? $pkl2_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_reorder['j_nok']) ? $pkl2_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['wo']) ? $pkl2_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ordered']) ? $pkl2_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['otw']) ? $pkl2_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ogp']) ? $pkl2_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['cek_onu']) ?  $pkl2_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['wait_act']) ? $pkl2_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['prog_act']) ? $pkl2_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['fact']) ? $pkl2_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['comp']) ? $pkl2_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['ps']) ? $pkl2_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['p_nok']) ? $pkl2_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_as_exp['j_nok']) ? $pkl2_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['wo']) ? $pkl2_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['ordered']) ? $pkl2_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['otw']) ? $pkl2_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['ogp']) ? $pkl2_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['cek_onu']) ?  $pkl2_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['wait_act']) ? $pkl2_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['prog_act']) ? $pkl2_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['fact']) ? $pkl2_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['comp']) ? $pkl2_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['ps']) ? $pkl2_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['p_nok']) ? $pkl2_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_hi['j_nok']) ? $pkl2_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['wo']) ? $pkl2_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['ordered']) ? $pkl2_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['otw']) ? $pkl2_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['ogp']) ? $pkl2_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pkl2&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['cek_onu']) ?  $pkl2_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['wait_act']) ? $pkl2_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['prog_act']) ? $pkl2_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['fact']) ? $pkl2_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['comp']) ? $pkl2_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pkl2&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['ps']) ? $pkl2_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['p_nok']) ? $pkl2_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pkl2&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pkl2_all['j_nok']) ? $pkl2_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">PEMALANG</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['wo']) ? $pml_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['ordered']) ? $pml_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['otw']) ? $pml_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['ogp']) ? $pml_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['cek_onu']) ?  $pml_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['wait_act']) ? $pml_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['prog_act']) ? $pml_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['fact']) ? $pml_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['comp']) ? $pml_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['ps']) ? $pml_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['p_nok']) ? $pml_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($pml_reorder['j_nok']) ? $pml_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['wo']) ? $pml_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ordered']) ? $pml_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['otw']) ? $pml_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ogp']) ? $pml_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['cek_onu']) ?  $pml_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['wait_act']) ? $pml_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['prog_act']) ? $pml_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['fact']) ? $pml_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['comp']) ? $pml_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['ps']) ? $pml_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['p_nok']) ? $pml_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($pml_as_exp['j_nok']) ? $pml_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['wo']) ? $pml_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['ordered']) ? $pml_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['otw']) ? $pml_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['ogp']) ? $pml_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['cek_onu']) ?  $pml_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['wait_act']) ? $pml_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['prog_act']) ? $pml_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['fact']) ? $pml_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['comp']) ? $pml_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['ps']) ? $pml_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['p_nok']) ? $pml_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($pml_hi['j_nok']) ? $pml_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['wo']) ? $pml_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['ordered']) ? $pml_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['otw']) ? $pml_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['ogp']) ? $pml_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=pml&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['cek_onu']) ?  $pml_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['wait_act']) ? $pml_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['prog_act']) ? $pml_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['fact']) ? $pml_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['comp']) ? $pml_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=pml&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['ps']) ? $pml_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['p_nok']) ? $pml_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=pml&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($pml_all['j_nok']) ? $pml_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">SLAWI</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['wo']) ? $slw_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['ordered']) ? $slw_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['otw']) ? $slw_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['ogp']) ? $slw_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['cek_onu']) ?  $slw_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['wait_act']) ? $slw_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['prog_act']) ? $slw_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['fact']) ? $slw_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['comp']) ? $slw_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['ps']) ? $slw_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['p_nok']) ? $slw_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($slw_reorder['j_nok']) ? $slw_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['wo']) ? $slw_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ordered']) ? $slw_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['otw']) ? $slw_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ogp']) ? $slw_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['cek_onu']) ?  $slw_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['wait_act']) ? $slw_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['prog_act']) ? $slw_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['fact']) ? $slw_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['comp']) ? $slw_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['ps']) ? $slw_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['p_nok']) ? $slw_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($slw_as_exp['j_nok']) ? $slw_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['wo']) ? $slw_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['ordered']) ? $slw_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['otw']) ? $slw_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['ogp']) ? $slw_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['cek_onu']) ?  $slw_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['wait_act']) ? $slw_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['prog_act']) ? $slw_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['fact']) ? $slw_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['comp']) ? $slw_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['ps']) ? $slw_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['p_nok']) ? $slw_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($slw_hi['j_nok']) ? $slw_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['wo']) ? $slw_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['ordered']) ? $slw_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['otw']) ? $slw_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['ogp']) ? $slw_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=slw&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['cek_onu']) ?  $slw_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['wait_act']) ? $slw_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['prog_act']) ? $slw_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['fact']) ? $slw_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['comp']) ? $slw_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=slw&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['ps']) ? $slw_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['p_nok']) ? $slw_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=slw&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($slw_all['j_nok']) ? $slw_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">TEGAL</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['wo']) ? $teg_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['ordered']) ? $teg_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['otw']) ? $teg_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['ogp']) ? $teg_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['cek_onu']) ?  $teg_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['wait_act']) ? $teg_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['prog_act']) ? $teg_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['fact']) ? $teg_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['comp']) ? $teg_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['ps']) ? $teg_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['p_nok']) ? $teg_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($teg_reorder['j_nok']) ? $teg_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['wo']) ? $teg_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ordered']) ? $teg_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['otw']) ? $teg_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ogp']) ? $teg_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['cek_onu']) ?  $teg_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['wait_act']) ? $teg_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['prog_act']) ? $teg_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['fact']) ? $teg_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['comp']) ? $teg_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['ps']) ? $teg_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['p_nok']) ? $teg_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($teg_as_exp['j_nok']) ? $teg_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['wo']) ? $teg_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['ordered']) ? $teg_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['otw']) ? $teg_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['ogp']) ? $teg_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['cek_onu']) ?  $teg_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['wait_act']) ? $teg_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['prog_act']) ? $teg_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['fact']) ? $teg_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['comp']) ? $teg_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['ps']) ? $teg_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['p_nok']) ? $teg_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($teg_hi['j_nok']) ? $teg_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['wo']) ? $teg_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['ordered']) ? $teg_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['otw']) ? $teg_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['ogp']) ? $teg_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=teg&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['cek_onu']) ?  $teg_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['wait_act']) ? $teg_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['prog_act']) ? $teg_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['fact']) ? $teg_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['comp']) ? $teg_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=teg&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['ps']) ? $teg_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['p_nok']) ? $teg_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=teg&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($teg_all['j_nok']) ? $teg_all['j_nok'] : '' ?></a></td>
            </tr>

            <tr>
                <td style="font-weight: bold; vertical-align : middle;" rowspan="4">ALL DATEL</td>
                <td style="font-weight: bold;"><i>REORDER</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['wo']) ? $all_reorder['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['ordered']) ? $all_reorder['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['otw']) ? $all_reorder['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['ogp']) ? $all_reorder['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['cek_onu']) ?  $all_reorder['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['wait_act']) ? $all_reorder['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['prog_act']) ? $all_reorder['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['fact']) ? $all_reorder['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['comp']) ? $all_reorder['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['ps']) ? $all_reorder['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['p_nok']) ? $all_reorder['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=reorder&order=pda&unit=' . $unit) ?>"><?= !empty($all_reorder['j_nok']) ? $all_reorder['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER EXP</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['wo']) ? $all_as_exp['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['ordered']) ? $all_as_exp['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['otw']) ? $all_as_exp['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['ogp']) ? $all_as_exp['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['cek_onu']) ?  $all_as_exp['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['wait_act']) ? $all_as_exp['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['prog_act']) ? $all_as_exp['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['fact']) ? $all_as_exp['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['comp']) ? $all_as_exp['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['ps']) ? $all_as_exp['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['p_nok']) ? $all_as_exp['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=as_exp&order=pda&unit=' . $unit) ?>"><?= !empty($all_as_exp['j_nok']) ? $all_as_exp['j_nok'] : '' ?></a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;"><i>ORDER HI</i></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['wo']) ? $all_hi['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['ordered']) ? $all_hi['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: #ffb822"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['otw']) ? $all_hi['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['ogp']) ? $all_hi['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['cek_onu']) ?  $all_hi['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background:#f8bbd0;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['wait_act']) ? $all_hi['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['prog_act']) ? $all_hi['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['fact']) ? $all_hi['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['comp']) ? $all_hi['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;background: palegreen"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['ps']) ? $all_hi['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['p_nok']) ? $all_hi['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=hi&order=pda&unit=' . $unit) ?>"><?= !empty($all_hi['j_nok']) ? $all_hi['j_nok'] : '' ?></a></td>
            </tr>
            <tr style="border-bottom: 3px dashed black; background: #ff8a8a; color:#fff;">
                <td style="font-weight: bold;"><i>TOTAL</i></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=wo&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['wo']) ? $all_all['wo'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ordered&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['ordered']) ? $all_all['ordered'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=otw&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['otw']) ? $all_all['otw'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=ogp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['ogp']) ? $all_all['ogp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/progress?datel=all&kategori=cek_onu&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['cek_onu']) ?  $all_all['cek_onu'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=wait_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['wait_act']) ? $all_all['wait_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=prog_act&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['prog_act']) ? $all_all['prog_act'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=fact&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['fact']) ? $all_all['fact'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=comp&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['comp']) ? $all_all['comp'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order_provi/provi?datel=all&kategori=ps&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['ps']) ? $all_all['ps'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=p_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['p_nok']) ? $all_all['p_nok'] : '' ?></a></td>
                <td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_provi/kendala?datel=all&kategori=j_nok&time=all&order=pda&unit=' . $unit) ?>"><?= !empty($all_all['j_nok']) ? $all_all['j_nok'] : '' ?></a></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    $('#select_waktu').on('change', function() {
        var baseurl = "<?php echo site_url() ?>";
        var url = baseurl + '/welcome/pda/' + this.value;
        window.location = url;
    });

    $('#filter_unit').on('change', function() {
        var baseurl = "<?php echo site_url() ?>";
        var unit = this.value;
        //var datel = $('#datel_selected').val();
        var url = baseurl + 'welcome/pda/all/' + unit;
        window.location = url;
    });
</script>