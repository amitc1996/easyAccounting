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
 <!--      <a href="<?php echo site_url('sales/generate_xlsx');?>" class="btn btn-primary" title="Export to CSV"><span class="glyphicon glyphicon-open " style="margin-right: 5px;"></span>Export to CSV</a> -->
   <!--   <button data-target="#excel_modal" data-toggle='modal' class="btn btn-primary" title="Import via CSV"><span class="glyphicon glyphicon-download-alt" style="margin-right: 5px;"></span>Import via CSV</button> --> 
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
                echo '<div class="col-md-12" style="margin-bottom:45px;">';
                echo "<div class='alert alert-dismissable alert-".$class."' id='message_box' ><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
                echo '</div>';
                echo '<script>setTimeout(function(){$(\'#message_box\').fadeOut(\'slow\')},3000);</script>';
                echo '<div class="clearfix"><br /></div>';
              }
            ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-body">
          <table id="sales_listing" class="table table-bordered table-striped table-condensed">
            <thead>
              <tr>
               <th>Invoice No.</th>
               <th>Client</th>
               <th>Invoice Date</th>
               <th>Paid Amount</th>
               <th>Grand Total</th>
               <th>Payment Status</th>
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
               links += '<a href="<?php echo site_url('sales/edit_sale'); ?>/'+aData[7]+'" data-purchase_id="'+aData[4]+'" title="Edit Details" class="btn btn-custom btn-primary btn-xs purchase_edit" style="margin-right:7px;"><span class="glyphicon glyphicon-pencil"></span></a>'; 
              links += '<a href="" data-sale_id="'+aData[7]+'" title="Print sale" class="btn btn-primary btn-xs print_sale" style="margin-right:5px;" ><span class="fa fa-print"></span></a>';
               if(aData[5]!=2){
               links += '<a href="<?php echo site_url('sales/receipt'); ?>/'+aData[7]+'" data-purchase_id="'+aData[7]+'" title="Pay Now" class="btn btn-warning btn-xs view_purchase" style="margin-right:7px;" ><i class="fa fa-money"></i></a>';  
               }
               // links += '<a href="<?php //echo site_url('sales/edit_sale'); ?>/'+aData[5]+'"  data-sale_id="'+aData[4]+'" title="Edit Sale" class="btn btn-primary btn-xs edit_sale" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';  
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
    $(document).on('click','.print_sale',function(e){
        e.preventDefault();
        var id=$(this).attr('data-sale_id');
        $('#sale_id').val(id);
       $('#print_type').modal('show')
    })
   });
</script>
