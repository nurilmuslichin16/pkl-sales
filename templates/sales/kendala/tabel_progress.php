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

	.table-bordered td,
	.table-bordered th {
		border: 1px solid #eee !important;
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
			<option value="pkl" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'pkl' ? 'selected' : '') : '' ?>>PEKALONGAN</option>
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
					<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
					<input type="text" class="form-control" name="search" placeholder="Search JA..">
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
				<th style="vertical-align : middle;text-align:center; background: #e53935; color: #fff;">STATUS</th>
				<th style="text-align: center; background: #e53935; color: #fff;">
					< 3 Hari</th>
				<th style="text-align: center; background: #e53935; color: #fff;">
					< 7 Hari</th>
				<th style="text-align: center; background: #e53935; color: #fff;">
					< 14 Hari</th>
				<th style="text-align: center; background: #e53935; color: #fff;">
					< 30 Hari</th>
				<th style="text-align: center; background: #e53935; color: #fff;"> > 30 Hari</th>
				<th style="text-align: center; background: #e53935; color: #fff;"> TOTAL</th>
			</tr>
		</thead>
		<?php foreach ($pk_all as $index => $row1) { ?>
			<?php
			switch ($index) {
				case '0':
					$bgColor = "#1E88E5";
					break;

				case '1':
					$bgColor = "#fce5d7";
					break;

				case '2':
					$bgColor = "#ffe699";
					break;

				case '3':
					$bgColor = "#ffe699";
					break;

				case '4':
					$bgColor = "#ffe699";
					break;

				default:
					# code...
					break;
			}
			?>
			<tr style="background: <?= $bgColor ?> ;">
				<td style="font-size: 14px; font-weight:bold; color:#191818;"><button style="font-size: 10px;" class="btn btn-primary btn-xs ladda-button waves-effect waves-classic" data-toggle="collapse" data-target="#<?= progK($row1['status']); ?>" aria-expanded="true" aria-controls="collapse<?= progK($row1['status']); ?>"><i class="icon md-triangle-down"></i></button> <?= $row1['status'] ?></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=kd_3') ?>"><?= !empty($row1['kd_3']) ? $row1['kd_3'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=kd_7') ?>"><?= !empty($row1['kd_7']) ? $row1['kd_7'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=kd_14') ?>"><?= !empty($row1['kd_14']) ? $row1['kd_14'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=kd_30') ?>"><?= !empty($row1['kd_30']) ? $row1['kd_30'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=lb_30') ?>"><?= !empty($row1['lb_30']) ? $row1['lb_30'] : '' ?></a></td>
				<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=all&last_update=all') ?>"><?= !empty($row1['total']) ? $row1['total'] : '' ?></a></td>
			</tr>
			<?php $no = 1;
			foreach ($pk as $key => $row0) { ?>
				<?php if ($row1['status'] == $row0['status']) { ?>
					<tr class="collapse" id="<?= progK($row0['status']); ?>">
						<td><?= $row0['kendala']; ?></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=kd_3') ?>"><?= !empty($row0['kd_3']) ? $row0['kd_3'] : '' ?></a></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=kd_7') ?>"><?= !empty($row0['kd_7']) ? $row0['kd_7'] : '' ?></a></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=kd_14') ?>"><?= !empty($row0['kd_14']) ? $row0['kd_14'] : '' ?></a></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=kd_30') ?>"><?= !empty($row0['kd_30']) ? $row0['kd_30'] : '' ?></a></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=lb_30') ?>"><?= !empty($row0['lb_30']) ? $row0['lb_30'] : '' ?></a></td>
						<td style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=' . progK($row1['status']) . '&kendala=' . getProgKendala($row0['kendala']) . '&last_update=all') ?>"><?= !empty($row0['total']) ? $row0['total'] : '' ?></a></td>
					</tr>
				<?php } ?>
			<?php } ?>
		<?php } ?>
		<tr class="bawah">
			<td class="bawah" style="font-size: 14px; font-weight:bold;">TOTAL</td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_3') ?>"><?= !empty($pk_total['kd_3']) ? $pk_total['kd_3'] : '' ?></a></td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_7') ?>"><?= !empty($pk_total['kd_7']) ? $pk_total['kd_7'] : '' ?></a></td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_14') ?>"><?= !empty($pk_total['kd_14']) ? $pk_total['kd_14'] : '' ?></a></td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=kd_30') ?>"><?= !empty($pk_total['kd_30']) ? $pk_total['kd_30'] : '' ?></a></td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=lb_30') ?>"><?= !empty($pk_total['lb_30']) ? $pk_total['lb_30'] : '' ?></a></td>
			<td class="bawah" style="vertical-align : middle;text-align:center"><a href="<?= site_url('sales/kendala/show_progress?datel=' . $datel . '&order=' . $segment . '&status=all&kendala=all&last_update=all') ?>"><?= !empty($pk_total['total']) ? $pk_total['total'] : '' ?></a></td>
		</tr>
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
</script>