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
     <?php echo @$title; ?>
     <small></small>
   </h1>
   <?php if(in_array(strtolower('purchases_new_purchase'),$permissions)){?>
   <div class="pull-right" >
    <a href="<?php echo site_url('purchases/new_purchase');?>" class="btn btn-custom" title="New Purchase"><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add Purchase</a>
  </div>
  <?php } ?> 
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-body">
          <table id="purchase_listing" class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
               <th style="width: 10%">Po Number</th>
               <th style="width: 25%">Supplier</th>
               <th style="width: 10%">Purchase Date</th>
               <th style="width: 10%">Paid Amount</th>
               <th style="width: 10%">Grand Total</th>
               <th style="width: 10%">Payment Status</th>
               <th style="width: 10%">Created</th>
               <th style="width: 15%">Actions</th>
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
  $(document).ready(function(){
    ajax_datatable = $('table#purchase_listing ').DataTable({
      "bServerSide": true,
      "sAjaxSource": "<?php echo site_url('purchases/purchase_listing'); ?>",
      "sPaginationType": "full_numbers",
      "iDisplayLength":25,
      "fnServerData": function (sSource, aoData, fnCallback)
      {
         // ajax post csrf send. 
         var csrf = {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"};
         aoData.push(csrf);
        $('#loader3').show();
        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "data": aoData,
          "success": fnCallback
        });
      },

      "fnDrawCallback" : function() {
        $('#loader1').fadeOut();
      },


      "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
             if(aData[5]==0){
              status="<small class='label label-danger'>UnPaid</small>";
            }
            else if(aData[5]==1){
              status="<small class='label label-warning'>Partial</small>";
            }
             else if(aData[5]==2){
              status="<small class='label label-success'>Paid</small>";
            }
        var links="";
              links += '<a href="<?php echo site_url('purchases/view_purchase'); ?>/'+aData[7]+'" data-purchase_id="'+aData[7]+'" title="View Details" class="btn btn-default btn-xs view_purchase" style="margin-right:7px;" ><span class="glyphicon glyphicon-search"></span></a>';  
                if(aData[5]!=2){
                links += '<a href="<?php echo site_url('purchases/edit_purchase'); ?>/'+aData[7]+'" data-purchase_id="'+aData[7]+'" title="Edit Details" class="btn btn-custom btn-primary btn-xs purchase_edit" style="margin-right:7px;"><span class="glyphicon glyphicon-pencil"></span></a>'; 
                
                 links += '<a href="#" data-purchase_id="'+aData[7]+'" title="Delete Purchase" class="btn btn-danger btn-xs delete_purchase" style="margin-right:5px;" ><span class="fa fa-trash"></span></a>';   

               links += '<a href="<?php echo site_url('purchases/payment'); ?>/'+aData[7]+'" data-purchase_id="'+aData[7]+'" title="Pay Now" class="btn btn-warning btn-xs view_purchase" style="margin-right:7px;" ><i class="fa fa-money"></i></a>';  
               }
                $('td:eq(5)', nRow).html(status);
                $('td:eq(7)', nRow).html(links);
                $('td:eq(2)', nRow).html(dateSplit(aData[2]));
                $('td:eq(6)', nRow).html(dateSplit(aData[6]));
                return nRow;
              },
              aoColumnDefs: [

              {
               bSortable: false,
               aTargets: [7]
             },


             {
               bSearchable: false,
               aTargets: [7]
             }
             ]
           });

    //Delete product
  $(document).on('click','.delete_purchase',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this purchase? \nThis action will reduce purchase items from stock.');
    if(response){
      id = $(this).attr('data-purchase_id');
      $.ajax({
        url:'<?php echo site_url('purchases/delete_purchase') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {

             toastr.success(result.message);
            ajax_datatable.fnDraw();
          }
          else
          {
            toastr.error(result.message);
          }
        }
      });
    }
    return false;
  });

});

</script>

