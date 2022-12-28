<style type="text/css">
	table tr td a {
		color: black;
		text-decoration: none;
	}
</style>
<form method="POST" action="<?= site_url('sales/work_order/work_order_filter') ?>">
	<div class="row">
		<div class="col-lg-3">
			<div class="form-group">
				<label><b>FILTER DEAL TGL AWAL</b></label>
				<div class="row">
					<div class="col-xs-8 col-sm-11">
						<div class="input-group">
							<input class="form-control date-picker" name="ftgl_awal" id="ftgl" type="text" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
			</div>  
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label><b>FILTER DEAL TGL AKHIR</b></label>
				<div class="row">
					<div class="col-xs-8 col-sm-11">
						<div class="input-group">
							<input class="form-control date-picker" name="ftgl_akhir" id="ftgl" type="text" data-date-format="yyyy-mm-dd" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>
			</div>  
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>&nbsp</label>
				<div class="row">
					<div class="col-xs-8 col-sm-11">
						<div class="input-group">
							<button type="submit" name="filter" class="btn btn-danger"><i class="fa fa-filter"></i> Show</button>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
</form>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
    	<thead>
    		<tr>
	    		<th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">DATEL</th>
	    		<th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">DEAL H1</th>
	    		<th rowspan="2" style="vertical-align : middle;text-align:center; background: #DD4B39; color: #fff;">DEAL H-1</th>
	    		<th colspan="6" style="text-align: center; background: #0073B7; color: #fff;">AMUNISI</th>
	    		<th rowspan="2" style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">PELANGGAN NOK</th>
	    		<th rowspan="2" style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">JARINGAN NOK</th>
	    		<th colspan="4" style="text-align: center;background: #FFA000; color: #fff;">PROGRESS PROVISIONING</th>
	    	</tr>
	    	<tr>
	    		<th style="vertical-align : middle;text-align:center;background: #00A65A; color: #fff;">PAGI</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">SORE</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">AS H-1</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">AS EXP</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">REORDER</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">TOTAL</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">HR</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">FALLOUT</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">COMP</th>
	    		<th style="vertical-align : middle;text-align:center;background: #DD4B39; color: #fff;">PS</th>
	    	</tr>
    	</thead>
    	<tbody>
    		<?php foreach ($list_wo as $key) { ?>
				<tr>
	    			<td><?= $key['datel'] ?></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel='.$key['datel'].'&kategori=today') ?>"><?= $key['deal_hi'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel='.$key['datel'].'&kategori=yesterday') ?>"><?= $key['deal_h_min_1'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=pagi') ?>"><?= $key['deal_pagi'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=sore') ?>"><?= $key['deal_sore'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=h_min_1') ?>"><?= $key['as_h_min_1'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=exp') ?>"><?= $key['as_exp'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=reorder') ?>"><?= $key['reorder'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel='.$key['datel'].'&amunisi=all') ?>"><?= $key['deal_pagi']+$key['deal_sore']+$key['as_h_min_1']+$key['as_exp']+$key['reorder'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel='.$key['datel'].'&kategori=kp') ?>"><?= $key['p_nok'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel='.$key['datel'].'&kategori=kj') ?>"><?= $key['j_nok'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel='.$key['datel'].'&kategori=hr') ?>"><?= $key['hr'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel='.$key['datel'].'&kategori=fact') ?>"><?= $key['fact'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel='.$key['datel'].'&kategori=comp') ?>"><?= $key['comp'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel='.$key['datel'].'&kategori=ps') ?>"><?= $key['ps'] ?></a></td>
	    		</tr>
    		<?php } ?>
    			<tr>
    				<th>TOTAL</th>
    				<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel=all&kategori=today') ?>"><?= $wo_total['deal_hi'] ?></a></td>
    				<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/deal?datel=all&kategori=yesterday') ?>"><?= $wo_total['deal_h_min_1'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=pagi') ?>"><?= $wo_total['deal_pagi'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=sore') ?>"><?= $wo_total['deal_sore'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=h_min_1') ?>"><?= $wo_total['as_h_min_1'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=exp') ?>"><?= $wo_total['as_exp'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=reorder') ?>"><?= $wo_total['reorder'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/amunisi?datel=all&amunisi=all') ?>"><?= $wo_total['deal_pagi']+$wo_total['deal_sore']+$wo_total['as_h_min_1']+$wo_total['as_exp']+$wo_total['reorder'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kp') ?>"><?= $wo_total['p_nok'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/kendala?datel=all&kategori=kj') ?>"><?= $wo_total['j_nok'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=hr') ?>"><?= $wo_total['hr'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=fact') ?>"><?= $wo_total['fact'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=comp') ?>"><?= $wo_total['comp'] ?></a></td>
	    			<td style="vertical-align : middle;text-align:center;"><a href="<?= site_url('sales/work_order/provi?datel=all&kategori=ps') ?>"><?= $wo_total['ps'] ?></a></td>
    			</tr>
    	</tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });
</script>