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
<input type="hidden" id="segment_selected" value="<?= $segment; ?>">
<input type="hidden" id="unit_selected" value="<?= $unit; ?>">
<div class="row">
	<div class="col-md-2">
		<select name="filter_segment" id="filter_segment" class="form-control" data-plugin="select2">
			<option value="all">Semua Order</option>
			<option value="psb" <?= !empty($segment) ? ($segment == 'psb' ? 'selected' : '') : '' ?>>PSB</option>
			<option value="pda" <?= !empty($segment) ? ($segment == 'pda' ? 'selected' : '') : '' ?>>PDA</option>
			<option value="addon" <?= !empty($segment) ? ($segment == 'addon' ? 'selected' : '') : '' ?>>ADDON</option>
		</select>
	</div>
	<div class="col-md-2">
		<select name="filter_unit" class="form-control form-control-sm" id="filter_unit" data-plugin="select2">
			<option value="all" <?= !empty($unit) ? ($unit == 'all' ? 'selected' : '') : '' ?>>Semua Unit</option>
			<option value="dcs" <?= !empty($unit) ? ($unit == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
			<option value="egbis" <?= !empty($unit) ? ($unit == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
			<!-- <option value="monthly">Bulanan</option>
			<option value="annual">Tahunan</option> -->
		</select>
	</div>
	<!-- <div class="col-md-2">
	 	<div class="input-group">
			<input class="form-control date-picker form-control-sm" data-plugin="datepicker" name="fstartdate" id="ftgl" placeholder="Filter Start Date" type="text" data-date-format="yyyy-mm-dd" required />
			<span class="input-group-addon">
				<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	 </div> -->
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
	<table class="table table-striped table-bordered table-sm">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">SEKTOR</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TEKNISI</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">JOB <br> TODAY</th>
				<th colspan="4" style="text-align: center; background: #1E88E5; color: #fff;">PROGRESS ORDER</th>
				<th colspan="2" style="text-align: center; background: #ffb822; color: #fff;">REQUEST SC</th>
				<th colspan="5" style="text-align: center;background: #43A047; color: #fff;">PROGRESS PROVISIONING</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PELANGGAN<br>NOK</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">JARINGAN<br>NOK</th>
			</tr>
			<tr>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">WO</th>
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
			<?php foreach ($all_datel as $index => $row1) { ?>
				<tr>
					<td style="font-size: 14px; font-weight:bold;"><button style="font-size: 10px;" class="btn btn-primary btn-xs ladda-button waves-effect waves-classic" data-toggle="collapse" data-target="#<?= $row1['datel']; ?>" aria-expanded="true" aria-controls="collapse<?= $row1['datel']; ?>">Show/Hide</button> <?= datel_witel($row1['datel']) ?></td>
					<td style="min-width: 200px;">Teknisi</td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/job_today?datel=' . $row1['datel'] . '&kategori=all_today&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['all_today']) ? $row1['all_today'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row1['datel'] . '&kategori=wo&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['wo']) ? $row1['wo'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row1['datel'] . '&kategori=otw&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['otw']) ? $row1['otw'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row1['datel'] . '&kategori=ogp&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['ogp']) ? $row1['ogp'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row1['datel'] . '&kategori=cek_onu&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['cek_onu']) ? $row1['cek_onu'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=' . $row1['datel'] . '&kategori=waitsc&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['waitsc']) ? $row1['waitsc'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=' . $row1['datel'] . '&kategori=donesc&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['donesc']) ? $row1['donesc'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row1['datel'] . '&kategori=wait_act&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['wait_act']) ? $row1['wait_act'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row1['datel'] . '&kategori=prog_act&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['prog_act']) ? $row1['prog_act'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row1['datel'] . '&kategori=fact&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['fact']) ? $row1['fact'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row1['datel'] . '&kategori=comp&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['comp']) ? $row1['comp'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row1['datel'] . '&kategori=ps&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['ps']) ? $row1['ps'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=' . $row1['datel'] . '&kategori=p_nok&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['p_nok']) ? $row1['p_nok'] : '' ?></a></td>
					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=' . $row1['datel'] . '&kategori=j_nok&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row1['j_nok']) ? $row1['j_nok'] : '' ?></a></td>
				</tr>
				<?php $no = 1;
				foreach ($all_teknisi as $key => $row0) { ?>
					<?php if ($row1['datel'] == $row0['datel']) { ?>
						<tr class="collapse" id="<?= $row0['datel']; ?>">
							<td><?= $no++; ?></td>
							<td style="min-width: 200px;">
								<?php
								echo $row0['crew'] . ' ';
								echo getTeknisibyCrew($row0['crew']);
								?>
							</td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/job_today?datel=' . $row0['datel'] . '&kategori=all_today&teknisi=' . $row0['progress_to'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['all_today']) ? $row0['all_today'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row0['datel'] . '&kategori=wo&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['wo']) ? $row0['wo'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row0['datel'] . '&kategori=otw&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['otw']) ? $row0['otw'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row0['datel'] . '&kategori=ogp&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['ogp']) ? $row0['ogp'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=' . $row0['datel'] . '&kategori=cek_onu&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['cek_onu']) ? $row0['cek_onu'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=' . $row0['datel'] . '&kategori=waitsc&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['waitsc']) ? $row0['waitsc'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=' . $row0['datel'] . '&kategori=donesc&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['donesc']) ? $row0['donesc'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row0['datel'] . '&kategori=wait_act&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['wait_act']) ? $row0['wait_act'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row0['datel'] . '&kategori=prog_act&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['prog_act']) ? $row0['prog_act'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row0['datel'] . '&kategori=fact&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['fact']) ? $row0['fact'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row0['datel'] . '&kategori=comp&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['comp']) ? $row0['comp'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=' . $row0['datel'] . '&kategori=ps&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['ps']) ? $row0['ps'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=' . $row0['datel'] . '&kategori=p_nok&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['p_nok']) ? $row0['p_nok'] : '' ?></a></td>
							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=' . $row0['datel'] . '&kategori=j_nok&teknisi=' . $row0['t_telegram_id'] . '&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($row0['j_nok']) ? $row0['j_nok'] : '' ?></a></td>
						</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<tr>
				<th style="font-size: 14px; font-weight:bold; vertical-align : middle;text-align:center;" colspan="2">TOTAL</th>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/job_today?datel=all&kategori=all_today&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['all_today']) ? $all_total['all_today'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=all&kategori=wo&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['wo']) ? $all_total['wo'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=all&kategori=otw&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['otw']) ? $all_total['otw'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=all&kategori=ogp&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['ogp']) ? $all_total['ogp'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/progress?datel=all&kategori=cek_onu&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['cek_onu']) ? $all_total['cek_onu'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=all&kategori=waitsc&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['waitsc']) ? $all_total['waitsc'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/request_sc?datel=all&kategori=donesc&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['donesc']) ? $all_total['donesc'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=all&kategori=wait_act&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['wait_act']) ? $all_total['wait_act'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=all&kategori=prog_act&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['prog_act']) ? $all_total['prog_act'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=all&kategori=fact&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['fact']) ? $all_total['fact'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=all&kategori=comp&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['comp']) ? $all_total['comp'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/provi?datel=all&kategori=ps&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['ps']) ? $all_total['ps'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=all&kategori=p_nok&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['p_nok']) ? $all_total['p_nok'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order_teknisi/kendala?datel=all&kategori=j_nok&teknisi=all&segment=' . $segment . '&unit=' . $unit) ?>"><?= !empty($all_total['j_nok']) ? $all_total['j_nok'] : '' ?></a></td>
			</tr>
		</tbody>
	</table>
</div>

<script>
	// $('#select_waktu').on('change', function() {
	// 	var baseurl = "<?php echo site_url() ?>";
	// 	var url = baseurl + '/welcome/index/provisioning/' + this.value;
	// 	window.location = url;
	// });

	$('#filter_segment').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var segment = this.value;
		var unit = $('#unit_selected').val();
		var url = baseurl + 'welcome/teknisi/' + segment + '/' + unit;
		window.location = url;
	});

	$('#filter_unit').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var unit = this.value;
		var segment = $('#segment_selected').val();
		var url = baseurl + 'welcome/teknisi/' + segment + '/' + unit;
		window.location = url;
	});
</script>