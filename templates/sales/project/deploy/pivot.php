<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none !important;
	}
	.bawah{
		background-color: #616161;
		color: #fff;
	}
	.bawah a{
		color: #fff !important;
	}
</style>

<div class="table-responsive">
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">DATEL</th>
				<th colspan="8" style="vertical-align : middle;text-align:center; background: #43A047; color: #fff;">PROGRESS DEPLOYER</th>
				<th rowspan="2" style="vertical-align : middle;text-align:center;background: #1E88E5; color: #fff;">TOTAL</th>
			</tr>
			<tr>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PERSIAPAN & <br> TUNJUK MITRA</th>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">DELIVERY <br> MATERIAL</th>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PENANAMAN <br> TIANG</th>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PENARIKAN <br> KABEL</th>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">INSTALL <br> ODP</th>
				<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PENYAMBUNGAN</th>
        		<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">SELESAI FISIK & <br> MENUNGGU MAINCORE</th>
        		<th style="vertical-align : middle;text-align:center;background: #e53935; color: #fff;">PERBAIKAN <br> MAINCORE</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list_pr as $value) { ?>
				<tr>
					<td><?= datel_witel($value['datel']) ?></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=tunjuk_mitra') ?>"><?= $value['tunjuk_mitra'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=delivery_material') ?>"><?= $value['delivery_material'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=tanam_tiang') ?>"><?= $value['tanam_tiang'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=tarik_kabel') ?>"><?= $value['tarik_kabel'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=install_odp') ?>"><?= $value['install_odp'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=penyambungan') ?>"><?= $value['penyambungan'] ?></a></td>
          			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=selesai_fisik') ?>"><?= $value['selesai_fisik'] ?></a></td>
          			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=perbaikan_mc') ?>"><?= $value['perbaikan_mc'] ?></a></td>
					<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel='.$value['datel'].'&progress=all') ?>"><?= $value['total'] ?></a></td>
				</tr>
			<?php } ?>
				<tr>
					<th class="bawah" >TOTAL</th>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=tunjuk_mitra') ?>"><?= $pr_total['tunjuk_mitra'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=delivery_material') ?>"><?= $pr_total['delivery_material'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=tanam_tiang') ?>"><?= $pr_total['tanam_tiang'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=tarik_kabel') ?>"><?= $pr_total['tarik_kabel'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=install_odp') ?>"><?= $pr_total['install_odp'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=penyambungan') ?>"><?= $pr_total['penyambungan'] ?></td>
            		<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=selesai_fisik') ?>"><?= $pr_total['selesai_fisik'] ?></td>
              		<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=perbaikan_mc') ?>"><?= $pr_total['perbaikan_mc'] ?></td>
					<td class="bawah"style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/project/show_deploy?datel=all&progress=all') ?>"><?= $pr_total['total'] ?></td>
				</tr>
		</tbody>
	</table>
</div>
