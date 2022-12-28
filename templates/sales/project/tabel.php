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
	<div class="col-md-3">
		<button type="button" class="btn btn-primary" id="daterange-btn"><span><i class="icon md-calendar"></i> &nbsp; Filter Last Update Project</span> &nbsp; <i class="icon md-caret-down"></i></button>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-4"></div>
	<div class="col-md-3 float-right">
		<form autocomplete="off" action="<?= site_url('sales/project/search') ?>" method="POST">
			<div class="form-group">
				<div class="input-search">
					<button type="submit" class="input-search-btn"><i class="icon md-search" aria-hidden="true"></i></button>
					<input type="text" class="form-control" name="search" placeholder="Search By Project ID..">
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
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">DATEL</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">REDESAIN</th>
				<th colspan="5" style="vertical-align : middle;text-align:center; background: #43A047; color: #fff;">PROGRESS CONSTRUCTION</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">TOTAL</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">NEXT PROJECT</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SELESAI GOLIVE</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">TERMINATE</th>
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
			<?php foreach ($list_p as $value) { ?>
				<tr>
					<td><?= datel_witel($value['datel']) == 'UNF' ? 'PEKALONGAN' : datel_witel($value['datel']) ?></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=redesain') ?>"><?= $value['redesain'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=approval_datel') ?>"><?= $value['approval_datel'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=approval_amo') ?>"><?= $value['approval_amo'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=deploy') ?>"><?= $value['deploy'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=golive') ?>"><?= $value['golive'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=kc') ?>"><?= $value['kc'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=all') ?>"><?= $value['subtotal'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=next_project') ?>"><?= $value['next_project'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=selesai_golive') ?>"><?= $value['selesai_golive'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=' . $value['datel'] . '&project=terminate') ?>"><?= $value['terminate'] ?></a></td>
				</tr>
			<?php } ?>
			<tr>
				<th class="bawah">TOTAL</th>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=redesain') ?>"><?= $p_total['redesain'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=approval_datel') ?>"><?= $p_total['approval_datel'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=approval_amo') ?>"><?= $p_total['approval_amo'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=deploy') ?>"><?= $p_total['deploy'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=golive') ?>"><?= $p_total['golive'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=kc') ?>"><?= $p_total['kc'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=all') ?>"><?= $p_total['subtotal'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=next_project') ?>"><?= $p_total['next_project'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=selesai_golive') ?>"><?= $p_total['selesai_golive'] ?></td>
				<td class="bawah" style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show?datel=all&project=terminate') ?>"><?= $p_total['terminate'] ?></td>
			</tr>
		</tbody>
	</table>
	<table id="note">
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Approval DATEL</th>
			<td><i>: Order based on project ID yang menunggu approval DATEL</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Approval AMO</th>
			<td><i>: Order based on project ID yang memerlukan PT2 Plus yang menunggu approval AMO</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Deployment</th>
			<td><i>: Order based on project ID yang masih progress konstruksi</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Golive</th>
			<td><i>: Order based on project ID yang sudah selesai deployment dan masih proses Golive</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Kendala Golive</th>
			<td><i>: Order based on project ID yang sudah selesai deployement tetapi terkendala proses Golive</i></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp</td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Next Project</th>
			<td><i>: Order based on project ID yang memerlukan proses PT3 / menunggu STTF / Tcloud</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Selesai Golive</th>
			<td><i>: Order based on project ID yang sudah selesai golive</i></td>
		</tr>
		<tr>
			<th width=180><i class="icon md-check-circle"></i> Terminate</th>
			<td><i>: Project yang tidak memiliki order JA</i></td>
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
				window.location.replace(base_url + "index.php/sales/project/filter/" + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'));
			}
		)
	});
</script>