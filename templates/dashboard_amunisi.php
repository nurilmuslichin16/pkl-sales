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

<input type="hidden" id="segment_selected" value="<?= $select_segment; ?>">
<input type="hidden" id="unit_selected" value="<?= $select_unit; ?>">

<div class="row">

	<div class="col-md-2">

		<select name="filter_segment" class="form-control form-control-sm" id="filter_segment" data-plugin="select2">

			<option value="all">All Segment</option>
			<option value="psb" <?= !empty($select_segment) ? ($select_segment == 'psb' ? 'selected' : '') : '' ?>>PSB</option>
			<option value="pda" <?= !empty($select_segment) ? ($select_segment == 'pda' ? 'selected' : '') : '' ?>>PDA</option>
			<option value="addon" <?= !empty($select_segment) ? ($select_segment == 'addon' ? 'selected' : '') : '' ?>>ADDON</option>

		</select>

	</div>

	<div class="col-md-2">

		<select name="filter_unit" class="form-control form-control-sm" id="filter_unit" data-plugin="select2">
			<option value="all">All Unit</option>
			<option value="dcs" <?= !empty($select_unit) ? ($select_unit == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
			<option value="egbis" <?= !empty($select_unit) ? ($select_unit == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
			<!-- <option value="monthly">Bulanan</option>
			<option value="annual">Tahunan</option> -->
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

	<table class="table table-striped table-bordered table-sm">

		<thead>

			<tr>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">SEKTOR</th>

				<th rowspan="2" style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">TEKNISI</th>

				<th colspan="2" style="text-align: center; background: #1E88E5; color: #fff;">PAGI</th>

				<th colspan="2" style="text-align: center; background: #ffb822; color: #fff;">AS H-1</th>

				<th colspan="2" style="text-align: center;background: #43A047; color: #fff;">AS EXP</th>

				<th colspan="2" style="text-align: center;background: #43A047; color: #fff;">REORDER</th>

			</tr>

			<tr>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SDH BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">BLM BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SDH BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">BLM BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SDH BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">BLM BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SDH BA</th>

				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">BLM BA</th>

		</thead>

		<tbody>

			<?php foreach ($all_datel as $index => $row1) { ?>

				<tr>

					<td style="font-size: 14px; font-weight:bold;"><button style="font-size: 10px;" class="btn btn-primary btn-xs ladda-button waves-effect waves-classic" data-toggle="collapse" data-target="#<?= $row1['datel']; ?>" aria-expanded="true" aria-controls="collapse<?= $row1['datel']; ?>">Show/Hide</button> <?= datel_witel($row1['datel']) ?></td>

					<td style="min-width: 200px;">Teknisi</td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=pagi&teknisi=all&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['deal_pagi_sdh_ba']) ? $row1['deal_pagi_sdh_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=pagi&teknisi=all&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['deal_pagi_blm_ba']) ? $row1['deal_pagi_blm_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=h_min_1&teknisi=all&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['as_h_min_1_sdh_ba']) ? $row1['as_h_min_1_sdh_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=h_min_1&teknisi=all&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['as_h_min_1_blm_ba']) ? $row1['as_h_min_1_blm_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=exp&teknisi=all&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['as_exp_sdh_ba']) ? $row1['as_exp_sdh_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=exp&teknisi=all&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['as_exp_blm_ba']) ? $row1['as_exp_blm_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=reorder&teknisi=all&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['reorder_sdh_ba']) ? $row1['reorder_sdh_ba'] : '' ?></a></td>

					<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row1['datel'] . '&amunisi=reorder&teknisi=all&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row1['reorder_blm_ba']) ? $row1['reorder_blm_ba'] : '' ?></a></td>

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

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=pagi&teknisi=' . $row0['t_telegram_id'] . '&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['deal_pagi_sdh_ba']) ? $row0['deal_pagi_sdh_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=pagi&teknisi=' . $row0['t_telegram_id'] . '&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['deal_pagi_blm_ba']) ? $row0['deal_pagi_blm_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=h_min_1&teknisi=' . $row0['t_telegram_id'] . '&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['as_h_min_1_sdh_ba']) ? $row0['as_h_min_1_sdh_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=h_min_1&teknisi=' . $row0['t_telegram_id'] . '&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['as_h_min_1_blm_ba']) ? $row0['as_h_min_1_blm_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=exp&teknisi=' . $row0['t_telegram_id'] . '&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['as_exp_sdh_ba']) ? $row0['as_exp_sdh_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=exp&teknisi=' . $row0['t_telegram_id'] . '&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['as_exp_blm_ba']) ? $row0['as_exp_blm_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=reorder&teknisi=' . $row0['t_telegram_id'] . '&ba=1&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['reorder_sdh_ba']) ? $row0['reorder_sdh_ba'] : '' ?></a></td>

							<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/work_order/ba_amunisi?datel=' . $row0['datel'] . '&amunisi=reorder&teknisi=' . $row0['t_telegram_id'] . '&ba=0&segment=' . $segment . '&unit=' . $select_unit) ?>"><?= !empty($row0['reorder_blm_ba']) ? $row0['reorder_blm_ba'] : '' ?></a></td>

						</tr>

					<?php } ?>

				<?php } ?>

			<?php } ?>

		</tbody>

	</table>

</div>



<script>
	$('#select_waktu').on('change', function() {

		var baseurl = "<?php echo site_url() ?>";

		var url = baseurl + '/welcome/monitoring_amunisi/' + this.value;

		window.location = url;

	});

	$('#filter_segment').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var segment = this.value;
		var unit = $('#unit_selected').val();
		var url = baseurl + 'welcome/monitoring_amunisi/' + segment + '/' + unit;
		window.location = url;
	});

	$('#filter_unit').on('change', function() {
		var baseurl = "<?php echo site_url() ?>";
		var unit = this.value;
		var segment = $('#segment_selected').val();
		var url = baseurl + 'welcome/monitoring_amunisi/' + segment + '/' + unit;
		window.location = url;
	});
</script>