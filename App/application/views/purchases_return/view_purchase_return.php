<?php 
$total_price = 0.00;

/*echo "<pre>";print_r($details);die;*/
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
   <div class="pull-right" >
    <a href="<?php echo site_url('purchases');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
  </div>
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
 <div id="alert_area"></div>
    <?php
    $msg = $this->session->flashdata('message');
    $class = $this->session->flashdata('class');
    if($msg)
    {
      echo "<div class='alert alert-dismissable alert-".$class."' id='message_box' ><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
    }
    ?>
  <div class="row">
    <div class="col-xs-12">
      <div id="add_purchase_res"></div>
      <div class="box box-primary">

       <div class="box-body">
          <div class="col-md-6">
                      <table class="table table-condensed table-bordered table-striped">
                      <tr><th>Vendor Name:</th><td><?php echo htmlspecialchars($details["purchase_details"][0]["vendor_name"]); ?></td></tr>
                      <tr><th>Market Place:</th><td><?php echo htmlspecialchars($details["purchase_details"][0]["marketplace_name"]); ?></td></tr>
                      <tr><th>Date Purchased:</th><td><?php echo date("m/d/Y", strtotime($details["purchase_details"][0]["purchase_date"])); ?></td></tr>
                      </table>
                  </div>
                  <div class="clearfix"></div>
                  <h5>Purchase Items</h5>
                  <table id="purchase_itmes" class="table table-condensed table-bordered table-striped">
                        <thead>
                          <tr>
                              <th style="width: 25px;"></th>
                              <th style="width: 350px;">Title</th>
                              <th style="width: 200px;">Sku</th>
                              <th style="width: 200px;">Category</th>
                              <th style="width: 150px;">Location</th>
                              <th style="width: 150px;">Date Listed</th>
                              <th style="width: 350px;">Condition</th>
                              <th style="width: 50px;">Quantity</th>
                              <th style="width: 100px;">Unit Cost</th>                  
                              <th style="width: 100px;"">Estimate price</th>
                              <th class="text-right" style="width: 120px;">Total Cost</th>
                           </tr>
                        </thead>
          </table>
          <?php
                  if(count($details["purchase_items"])>0){
                    foreach($details["purchase_items"] as $val)
                        {
                         $total_price +=  $val["total_cost"];    
                        }
                        }      
                         else
                        echo '<tr><td colspan="14">No purchases items found.</td></tr>';
                    ?>
       </div><!-- /.box-body -->
       <div class="box-footer">
       <div class="col-md-12 text-right"><?php echo '<strong>Grand Total: </strong>'; echo number_format(($total_price),2); ?></div>
       </div>
      <div class="clearfix"></div>
     </div>
     </div>
   </div>
</section><!-- /.content -->
</div>
<!--Edit purchase Modal -->
<div class="modal fade" id="purchaseEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"  style="width: 50%">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Edit Purchase Return Item</h4>
    </div>
    <div id="purchase_edit_response">
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){
     
    ajax_datatable = $('table#purchase_itmes').DataTable({
            "bServerSide": true,
            "sAjaxSource": "<?php echo site_url('purchases_return/purchase_return_items_listing'); ?>",
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "fnServerData": function (sSource, aoData, fnCallback)
            {
              aoData.push( {"name": "<?php echo $csrf['name'];?>", "value":"<?php echo $csrf['hash'];?>"});
              aoData.push( { "name": "purchase_id", "value": "<?php echo $purchase_id; ?>" } );
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success": fnCallback
                });
            },
        
      "fnDrawCallback" : function() {
        $('#loader').fadeOut();
             },
            
              
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            var links="";
            links += '<a class="delete_item" style="color:red; margin-right:5px;" title="Delete Purchase Item" onclick="return confirm(\'Are you sure want to delete this purchase return item?\');" href="<?php echo site_url('purchases_return/delete_purchase_return_item'); ?>/'+aData[0]+'"><i class="fa fa-remove"></i></a>';  
            links += '<a href="#" class="edit_item" data-purchase_edit_id="'+aData[0]+'" title="Edit Purchase Item" ><i class="fa fa-pencil"></i></a>';
            $('td:eq(0)', nRow).html(links);
            $('td:eq(5)', nRow).html(dateSplit(aData[5]));
            return nRow;
       },
        aoColumnDefs: [
       
          {
             bSortable: false,
             aTargets: [0]
          },
        
          
          {
             bSearchable: false,
             aTargets: [0]
          }
        ]
        });

        //Edit purchase
         $(document).on('click','.edit_item',function(e){
            e.preventDefault();
            $('#purchase_edit_response').empty();
            id = $(this).attr('data-purchase_edit_id');
            $.ajax({
               url:'<?php echo site_url('purchases_return/edit_purchase_return_item') ?>/'+id,
               dataType: 'html',
               success:function(result)
               {
                $('#purchase_edit_response').html(result);
               } 
            });
            $('#purchaseEditModal').modal('show');
         });
});
</script>