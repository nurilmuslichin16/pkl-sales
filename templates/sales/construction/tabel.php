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
			<option value="all">Semua Unit</option>
			<option value="dcs" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'dcs' ? 'selected' : '') : '' ?>>DCS</option>
			<option value="egbis" <?= !empty($this->uri->segment(5)) ? ($this->uri->segment(5) == 'egbis' ? 'selected' : '') : '' ?>>EGBIS</option>
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
		<form autocomplete="off" action="<?= site_url('sales/construction/search') ?>" method="POST">
			<div class="form-group">
				<div class="input-search">
					<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
					<input type="text" class="form-control" name="search" placeholder="Search JA/CP/SC/MYI">
				</div>
			</div>
		</form>
	</div>
</div>
<br>
<div class="table-responsive">
	<div class="row">
		<div class="col-md-5" style="padding-right: 0;">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th rowspan="2" style="text-align: center; vertical-align : middle; background: #1E88E5; color: #fff;">DATEL</th>
						<th rowspan="2" style="text-align: center; vertical-align : middle; background: #e53935; color: #fff;">ODP BLM <br> GOLIVE</th>
						<th colspan="3" style="text-align: center; vertical-align : middle; background: #495371; color: #fff;">KENDALA TEKNIS</th>
						<th rowspan="2" style="text-align: center; vertical-align : middle; background: #1E88E5; color: #fff;">TOTAL <br> K TEKNIS</th>
						<th rowspan="2" style="text-align: center; vertical-align : middle; background: #e53935; color: #fff;">UNSC</th>
					</tr>
					<tr>
						<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">ODP FULL</th>
						<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">PT2</th>
						<th style="vertical-align : middle;text-align:center;background: #495371; color: #fff;">NO FO/ODP</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list_k as $value) { ?>
						<tr>
							<td><?= datel_witel($value['datel']) ?></td>
							<td style="vertical-align : middle;text-align:center;background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=odp_blm_live&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['odp_blm_live'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=odp_full&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['odp_full'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=pt_dua&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['pt_dua'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;background: #cacedb;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=no_fo&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['no_fo'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=teknis&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['subtotalcons'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=' . $value['datel'] . '&kendala=unsc&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['unsc'] ?></a></td>
						</tr>
					<?php } ?>
					<tr>
						<th class="bawah">TOTAL</th>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_blm_live&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_blm_live'] ?></a></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=odp_full&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['odp_full'] ?></a></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=pt_dua&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['pt_dua'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=no_fo&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['no_fo'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=teknis&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['subtotalcons'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/kendala/show?datel=all&kendala=unsc&waktu=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $k_total['unsc'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-7" style="padding-left: 0;">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">REDESAIN</th>
						<th colspan="5" style="vertical-align : middle;text-align:center;background: #43A047; color: #fff;">PROGRESS CONSTRUCTION</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">TOTAL <br> PROGRESS</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">NEXT PROJECT</th>
						<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SELESAI GOLIVE</th>
					</tr>
					<tr>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">APPROVAL DATEL</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">APPROVAL AMO</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">DEPLOYMENT</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PROSES GOLIVE</th>
						<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">KENDALA GOLIVE</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list_c as $value) { ?>
						<tr>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=redesain&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['redesain'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=approval_datel&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['approval_datel'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=approval_amo&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['approval_amo'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=deploy&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['deploy'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=golive&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['golive'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=kc&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['kc'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['subtotalfu'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=next_project&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['next_project'] ?></a></td>
							<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=' . $value['datel'] . '&cons=selesai_golive&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $value['selesai_golive'] ?></a></td>
						</tr>
					<?php } ?>
					<tr>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=redesain&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['redesain'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=approval_datel&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['approval_datel'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=approval_amo&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['approval_amo'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=deploy&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['deploy'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=golive&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['golive'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=kc&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['kc'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=all&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['subtotalfu'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=next_project&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['next_project'] ?></td>
						<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/construction/show?datel=all&cons=selesai_golive&order=' . $segment . '&unit=' . $unit . '&by_tgl=' . $by_tgl . '&start=' . $start . '&end=' . $end . '') ?>"><?= $c_total['selesai_golive'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table id="note">
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Kendala Teknis</th>
			<td><i>: Order yang menjadi responsibility rekan SDI untuk dilakukan design </i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> ODP Full</th>
			<td><i>: Kendala karena port ODP di lapangan penuh, setelah dilakukan Valins</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> PT2</th>
			<td><i>: Kendala karena di lapangan butuh pembangunan PT2</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> NO FO / ODP</th>
			<td><i>: Kendala karena di lokasi pelanggan tidak ada jaringan FO / ODP dan belum ada rute</i></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp</td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Progress Construction</th>
			<td><i>: Order yang sedang progress Deployment</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Redesign</th>
			<td><i>: Order yang menunggu proses design ulang dari SDI</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Approval Datel</th>
			<td><i>: Order PT2 Plus yang menunggu approval Datel</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Approval AMO</th>
			<td><i>: Order PT2 Plus yang menunggu approval AMO</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Deployment</th>
			<td><i>: Order yang sedang progress konstruksi</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Proses Golive</th>
			<td><i>: Order yang sudah selesai deployment dan sedang proses Golive</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Selesai Golive</th>
			<td><i>: Order yang sudah selesai golive</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Kendala Golive</th>
			<td><i>: Order yang sudah selesai deployement tetapi terkendala proses Golive</i></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp</td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Next Project</th>
			<td><i>: Order yang membutuhkan proses PT3 / menunggu STTF / Tcloud</i></td>
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
				window.location.replace(base_url + "index.php/sales/construction/index/" + segment + "/" + unit + "/" + $('#filter_by_tgl').val() + "/" + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'));
			}
		)
	});

	$("#filter_segment").change(function() {
		segment = $('#filter_segment').val();
		let base_url = '<?php echo base_url() ?>';
		window.location.replace(base_url + "sales/construction/index/" + segment);
	});

	$("#filter_unit").change(function() {
		segment = $('#filter_segment').val();
		unit = $('#filter_unit').val();
		let base_url = '<?php echo base_url() ?>';
		window.location.replace(base_url + "sales/construction/index/" + segment + "/" + unit);
	});
</script>