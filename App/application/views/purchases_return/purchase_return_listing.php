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
  <?php if(in_array(strtolower('purchases_return_return_purchase'),$permissions)){?>
   <div class="pull-right" >
    <a href="<?php echo site_url('purchases_return/return_purchase');?>" class="btn btn-primary" title="Purchase Return"><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Purchase Return</a>
  </div>
  <?php }?>
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div id="alert_area"></div>

  <div class="row">
    <div class="col-xs-12">


      <div class="box box-primary">
        <div class="box-body">
          <table id="purchase_return_listing" class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
               <th>Vendor</th>
               <th>Purchase Date</th>
               <th>Total Price</th>
               <th>Created</th>
               <th class="actions">Actions</th>
             </tr>
           </thead>
         </table>
       </div><!-- /.box-body -->
     </div>
   </div>
 </div>
</section><!-- /.content -->
</div>
<!--Edit blog Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog"  style="width: 60%">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Edit Purchase Return</h4>
    </div>
    <div id="edit_response">
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){
    ajax_datatable = $('table#purchase_return_listing ').DataTable({
      "bServerSide": true,
      "sAjaxSource": "<?php echo site_url('purchases_return/purchase_return_listing'); ?>",
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
      },

      "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
        var links="";
             <?php if(in_array(strtolower('purchases_return_view_purchase_return'),$permissions)){?>
              links += '<a href="<?php echo site_url('purchases_return/view_purchase_return'); ?>/'+aData[4]+'" data-purchase_id="'+aData[4]+'" title="View Details" class="btn btn-default btn-xs view_purchase" style="margin-right:5px;"><span class="glyphicon glyphicon-search"></span></a>'; 
              <?php } if(in_array(strtolower('purchases_return_edit_purchase_return'),$permissions)){?>
              links += '<a href="#" data-purchase_id="'+aData[4]+'" title="Edit Details" class="btn btn-primary btn-xs edit_purchase" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';  
              <?php }?>
                $('td:eq(4)', nRow).html(links);
                $('td:eq(1)', nRow).html(dateSplit(aData[1]));
                $('td:eq(3)', nRow).html(dateSplit(aData[3]));
                return nRow;
              },
              aoColumnDefs: [

              {
               bSortable: false,
               aTargets: [4]
             },


             {
               bSearchable: false,
               aTargets: [2,4]
             }
             ]
           });

 //Edit purchase
 $(document).on('click','.edit_purchase',function(e){
    e.preventDefault();
    $('#edit_response').empty();
    id = $(this).attr('data-purchase_id');
    $.ajax({
       url:'<?php echo site_url('purchases_return/edit_purchase_return') ?>/'+id,
       dataType: 'html',
       success:function(result)
       {
        $('#edit_response').html(result);
       } 
    });
    $('#editModal').modal('show');
 });
 
});
</script>

