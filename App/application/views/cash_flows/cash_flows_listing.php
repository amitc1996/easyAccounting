<?php
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>

    </h1>
    <div class="clearfix"></div>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div id="alert_area">
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-danger">
          <div class="box-body">
            <table id="stocks_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>To Account</th>
                  <th>From Account</th>
                  <th>Amount</th>
                </tr>
              </thead>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var stock_datatable= "";
$('#category_add_form').parsley();
$(document).ready(function(){
  stock_datatable = $('table#stocks_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('cash_flows/cash_flows_listig'); ?>",
    "sPaginationType": "full_numbers",
    "iDisplayLength":25,
    "fnServerData": function (sSource, aoData, fnCallback)
    {
      var csrf = {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"};
      aoData.push(csrf);
      $.ajax({
        "dataType": 'json',
        "type": "POST",
        "url": sSource,
        "data": aoData,
        "success": fnCallback
      });
    },
  });
 });
</script>
