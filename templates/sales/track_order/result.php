<form autocomplete="off" action="<?= site_url('sales/track_order/log') ?>" method="POST">
	<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">JA / MYIR / CP</label>
			<input name="sales_id" class="form-control" type="number">
			<span class="help-block"><i>Misal : 12225 (tanpa JA)</i></span>
		</div>
	</div>
	</div>
	<div class="row">
	<div class="col-md-4">
		<div class="form-group">
		<button type="submit" value="Track Order" class="btn btn-primary btn-sm"> Telusuri </button>
		</div>
	</div>
	</div>
</form>
<!-- Panel Tickets -->
<div class="panel">
<div class="panel-heading">
<h3 class="panel-title">Alur Order</h3>
</div>
	<div class="panel-body">
		<ul class="list-group list-group-dividered list-group-full h-350" data-plugin="scrollable">
			<div data-role="container">
				<div data-role="content">
				<?php foreach ($results as $value) { ?>
					<li class="list-group-item">
						<small class="badge badge-round badge-danger float-right"><?= getstatusLog($value['action_status']); ?></small>
						<p><a class="hightlight" href="javascript:void(0)"><?= $value['a_keterangan']; ?></a>
							<span>[<?= getstatusLog($value['action_status']); ?>]</span>
						</p>
						<small>Action by
							<a class="hightlight" href="javascript:void(0)">
							<span><?= $value['action_by']; ?></span>
							</a>
							<?php
								$action_on = explode(" ", $value['action_on']);
								$date = date_indo($action_on[0]);
								$time = substr($action_on[1], 0, 5) ;
								echo '<time datetime="2017-07-01T08:55"> Tanggal '.$date.' Pukul '.$time.'</time>';
							?>
						</small>
					</li>
				<?php } ?>
				</div>
			</div>
		</ul>
	</div>
</div>
<!-- End Panel Tickets -->