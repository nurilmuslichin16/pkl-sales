<!-- Bootstrap modal -->
<div class="modal fade modal-3d-sign" id="default" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">History</h3>
            </div>
            <div class="modal-body form">
                <!-- Panel Tickets -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">History Order</h3>
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
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#default').modal({backdrop: 'static', keyboard: false})
        $('#default').modal('show');
    });
</script>
