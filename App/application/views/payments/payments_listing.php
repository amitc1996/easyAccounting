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
     <div class="pull-right" >
        <?php  if(in_array(strtolower('payments_add_payment'),$permissions)){?>
    <a href="<?php echo site_url('payments/add_payment');?>" class="btn btn-custom" title="Add Payment"><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add Payment</a>
  <?php }?>
  </div>
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
            <table id="payment_datatable" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Voucher No</th>
                  <th>To Account</th>
                  <th>From Account</th>
                  <th>Voucher Date</th>
                  <th>Transaction For</th>
                  <th>Amount</th>
                  <th>Created</th>
                  <!-- <th class="actions">Actions</th> -->
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
var payment_datatable= "";
$(document).ready(function(){
  //payment listing
  payment_datatable = $('table#payment_datatable ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('payments/payments_listing'); ?>",
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
    "fnDrawCallback" : function() {
    },
    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
      var currentDate="";
      // var links="";
   
      // links += '<a href="#" data-category_id="'+aData[3]+'" title="Edit Details" class="btn btn-primary btn-custom btn-xs edit_category" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
      // $('td:eq(3)', nRow).html(links);
       $('td:eq(3)', nRow).html(dateSplit(aData[3]));
       $('td:eq(6)', nRow).html(dateSplit(aData[6]));
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [3]
      },
      {
        bSearchable: false,
        aTargets: [3]
      }
    ]
  });
    });
</script>
