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

   <div class="pull-right" >
    <a href="<?php echo site_url('sales/add_sale');?>" class="btn btn-custom" title="Add Sale"><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add Sale</a>
  </div>

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
          <table id="sales_listing" class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
               <th style="width: 15%">Invoice No.</th>
               <th style="width: 25%">Client</th>
               <th style="width: 10%">Invoice Date</th>
               <th style="width: 10%">Paid Amount</th>
               <th style="width: 10%">Grand Total</th>
               <th style="width: 5%">Payment Status</th>
               <th style="width: 8%">Created</th>
               <th style="width: 20%">Actions</th>
             </tr>
           </thead>
         </table>
       </div><!-- /.box-body -->
     </div>
   </div>
 </div>
</section><!-- /.content -->
</div>
<!-- import via excel -->
<div class="modal fade" id="excel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 40%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Import File</h4>
      </div>
      <div class="modal-body">
       <form action="<?php echo site_url('sales/import_csv') ?>" method="post" enctype="multipart/form-data"> 
           <div class="form-group">
            <label>Enter file name:</label>
            <input type="file" name="import_file" id="import_file" />
            <input type="hidden" id="csrf" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      <?php echo form_close(); ?>
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Back</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Add category Modal -->
<div class="modal fade " id="print_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Print file</h4>
      </div>
      <?php echo form_open(site_url('Sales/print_sale'),array('role'=>"form" ,'id'=>"print_file_form",'name'=>'print_file_form', 'data-parsley-validate'=>"",'target'=>"_blank")); ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
        </div>
        <div class="form-group col-md-12">
          <label class="control-label" for="name">Print file:</label>
           <select class="form-control" name="print_type">
              <option value="Original Copy">Original Copy</option>
              <option value="Duplicate Copy">Duplicate Copy</option>
              <option value="Triplicate Copy">Triplicate Copy</option>
           </select>
           <input type="hidden" name="sale_id" id="sale_id" value="">
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">

        <div class="clearfix"></div>
        <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Submit</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
        <div class="clearfix"></div>
        <div id="add_res" class="text-left" style="margin-top: 5px;"></div>
      </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){
    ajax_datatable = $('table#sales_listing ').DataTable({
      "bServerSide": true,
      "sAjaxSource": "<?php echo site_url('sales/sales_listing'); ?>",
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
            var status="";
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
              links += '<a href="<?php echo site_url('Sales/view_sale').'/';?>'+aData[7]+'" data-sale_id="'+aData[7]+'" title="View Details" class="btn btn-default btn-xs view_sales_records" style="margin-right:5px;"><span class="glyphicon glyphicon-search"></span></a>';
               if(aData[5]!=2){
               links += '<a href="<?php echo site_url('sales/receipt'); ?>/'+aData[7]+'" data-purchase_id="'+aData[7]+'" title="Pay Now" class="btn btn-success btn-xs view_purchase" style="margin-right:7px;" ><i class="fa fa-money"></i></a>';  

              links += '<a href="<?php echo site_url('sales/edit_sale'); ?>/'+aData[7]+'" data-sale_id="'+aData[7]+'" title="Edit Details" class="btn btn-custom btn-primary btn-xs purchase_edit" style="margin-right:7px;"><span class="glyphicon glyphicon-pencil"></span></a>'; 

               links += '<a href="#" data-sale_id="'+aData[7]+'"  title="Delete Sale" class="btn btn-danger btn-xs delete_sale" style="margin-right:5px;" ><span class="fa fa-trash"></span></a>';
               } 
              links += '<a href="" data-sale_id="'+aData[7]+'" title="Print sale" class="btn btn-primary btn-xs print_sale" style="margin-right:5px;" ><span class="fa fa-file"></span></a>';

              links += '<a href="" data-sale_id="'+aData[7]+'" title="Send Invoice" class="btn btn-warning btn-xs send_invoice" style="margin-right:5px;" ><span class="fa fa-envelope"></span></a>';

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
  $(document).on('click','.delete_sale',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this sale? \nThis action will add sale items back to stock.');
    if(response){
      id = $(this).attr('data-sale_id');
      $.ajax({
        url:'<?php echo site_url('sales/delete_sale') ?>/'+id,
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

   //send invoice to email
  $(document).on('click','.send_invoice',function(e){
    e.preventDefault();
    id=$(this).attr('data-sale_id');
    $.ajax({
      url:'<?php echo site_url('sales/send_invoice') ?>/'+id,
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
  });

    $(document).on('click','.print_sale',function(e){
        e.preventDefault();
        var id=$(this).attr('data-sale_id');
        $('#sale_id').val(id);
       $('#print_type').modal('show')
    })
   });
</script>
