<?php
$supplier_orgnisation_name = array(
  'name'  => 'supplier_orgnisation_name',
  'id'  => 'supplier_orgnisation_name',
  'value' => set_value('supplier_orgnisation_name'),
  'class'=>'form-control',
  'placeholder'=>'Company Name',
  'data-parsley-required'=>'true'
);
$supplier_orgnisation_phone = array(
  'name'  => 'supplier_orgnisation_phone',
  'id'  => 'supplier_orgnisation_phone',
  'value' => set_value('supplier_orgnisation_phone'),
  'class'=>'form-control',
  'placeholder'=>'Company Phone',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid phone number'
);
$supplier_email = array(
  'name'  => 'supplier_email',
  'id'  => 'supplier_email',
  'value' => set_value('supplier_email'),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-type'=>'email'
);
$gstin = array(
  'name'  => 'gstin',
  'id'  => 'gstin',
  'value' => set_value('gstin'),
  'class'=>'form-control',
  'placeholder'=>'GSTIN',
  'data-parsley-pattern'=>'^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$',
  'data-parsley-pattern-message'=>'Enter valid gstin number',
);
$supplier_name = array(
  'name'  => 'supplier_name',
  'id'  => 'supplier_name',
  'value' => set_value('supplier_name'),
  'class'=>'form-control',
  'placeholder'=>'Contact Person Name',
);
$supplier_mobile = array(
  'name'  => 'supplier_mobile',
  'id'  => 'supplier_mobile',
  'value' => set_value('supplier_mobile'),
  'class'=>'form-control',
  'placeholder'=>'Mobile',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid mobile number'
);
$supplier_tax_number = array(
  'name'  => 'supplier_tax_number',
  'id'  => 'supplier_tax_number',
  'value' => set_value('supplier_tax_number'),
  'class'=>'form-control',
  'placeholder'=>'Service Tax Number',
);
$supplier_address_b = array(
  'name'  => 'supplier_address_b',
  'id'  => 'supplier_address_b',
  'value' => set_value('supplier_address_b'),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4
);
$supplier_city_b = array(
  'name'  => 'supplier_city_b',
  'id'  => 'supplier_city_b',
  'value' => set_value('supplier_city_b'),
  'class'=>'form-control',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$supplier_state_b = array(
  'name'  => 'supplier_state_b',
  'id'  => 'supplier_state_b',
  'value' => set_value('supplier_state_b'),
  'class'=>'form-control',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$supplier_country_b = array(
  'name'  => 'supplier_country_b',
  'id'  => 'supplier_country_b',
  'value' => set_value('supplier_country_b'),
  'class'=>'form-control',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$supplier_zip_b = array(
  'name'  => 'supplier_zip_b',
  'id'  => 'supplier_zip_b',
  'value' => set_value('supplier_zip_b'),
  'class'=>'form-control',
  'placeholder'=>'Pincode',
  'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);
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
      <?php  if(in_array(strtolower('suppliers_add_supplier'),$permissions)){?> 
      <a href="#" class="btn btn-custom" title="Add supplier" data-toggle="modal" data-target="#add_supplier" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
            <table id="suppliers_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Company Name</th>
                  <th>Company Phone</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created On</th>
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

<!--Add supplier Modal -->
<div class="modal fade " id="add_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog model-lg" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Supplier</h4>
      </div>
       <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"supplier_add_form",'name'=>'supplier_add_form', 'data-parsley-validate'=>"")); ?>
     <div class="modal-body">
       <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_orgnisation_name">Company Name:</label>
          <?php echo form_input($supplier_orgnisation_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_orgnisation_phone">Company Phone:</label>
          <?php echo form_input($supplier_orgnisation_phone); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_email">Email:</label>
          <?php echo form_input($supplier_email); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_name">Contact Person Name:</label>
          <?php echo form_input($supplier_name); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_mobile">Mobile:</label>
          <?php echo form_input($supplier_mobile); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="gstin">GSTIN:</label>
          <?php echo form_input($gstin); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="supplier_tax_number">Service Tax Number:</label>
          <?php echo form_input($supplier_tax_number); ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
         <hr>
          <label class="control-label" for="supplier_address_b">Address:</label>
          <?php echo form_textarea($supplier_address_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_city_b">City:</label>
          <?php echo form_input($supplier_city_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_state_b">State:</label>
          <?php echo form_input($supplier_state_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_country_b">Country:</label>
          <?php echo form_input($supplier_country_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="supplier_zip_b">Pincode:</label>
          <?php echo form_input($supplier_zip_b); ?>
        </div>
      </div>
     </div>
     <div class="modal-footer">
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-custom pull-right save" style="margin-left: 5px;"><i class="fa fa-spinner fa-spin formloader"></i> Add</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left: 5px;">Back</button>
        <div class="clearfix"></div>
        <div id="add_res" class="text-left" style="margin-top: 5px;"></div>
      </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit vendor -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_supplier" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog model-lg" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Supplier</h4>
      </div>
      <div id="edit_supplier_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->

<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var suppliers_listing= "";
$('#supplier_add_form').parsley();
//supplier same as billing address
$(document).ready(function(){
  $('#sam_as_billing_addrs').on('change',function(){
  if($(this).prop('checked')){
     $('#supplier_address_s').val($('#supplier_address_b').val());
     $('#supplier_city_s').val($('#supplier_city_b').val());
     $('#supplier_state_s').val($('#supplier_state_b').val());
     $('#supplier_country_s').val( $('#supplier_country_b').val());
     $('#supplier_zip_s').val($('#supplier_zip_b').val());
  }
  else{
    $('.s_addr').val('');
  }
});
//supplier listing
  suppliers_listing = $('table#suppliers_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('suppliers/suppliers_listing'); ?>",
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
      var links="";
      links += '<a href="<?php echo site_url('suppliers/view_supplier').'/';?>'+aData[5]+'" data-product_id="'+aData[5]+'" title="View Details" class="btn btn-default btn-xs view_supplier" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';

    <?php  if(in_array(strtolower('suppliers_edit_supplier'),$permissions)){?>
      links += '<a href="#" data-supplier_id="'+aData[5]+'" title="Edit Details" class="btn btn-custom btn-xs edit_supplier" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
    <?php } if(in_array(strtolower('suppliers_delete_supplier'),$permissions)){?>
      links +='<a href="#" data-supplier_id="'+aData[5]+'" title="Delete Details" class="btn btn-danger btn-xs delete_supplier"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
      <?php } ?>
      $('td:eq(4)', nRow).html((aData[4]=='0000-00-00 00:00:00')?'-':dateSplit(aData[4]));
      $('td:eq(5)', nRow).html(links);
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [5]
      },
      {
        bSearchable: false,
        aTargets: [5]
      }
    ]
  });

  //Add supplier
  $('#supplier_add_form').parsley();
  $("#supplier_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#supplier_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('suppliers/add_supplier'); ?>',
      dataType:'json',
      type:'POST',
      data:values,
      // shows the loader element before sending.
      beforeSend: function (){before(_this)},
      // hides the loader after completion of request, whether successfull or failor.
      complete: function (){complete(_this)},
      success:function(result){
        if(result.status==1){
          toastr.success(result.message);
          $('#supplier_add_form')[0].reset();
          $('#supplier_add_form').parsley().reset();

          suppliers_listing.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit supplier
  $(document).on('click','.edit_supplier',function(e){
    e.preventDefault();
    id = $(this).attr('data-supplier_id');
    $.ajax({
      url:'<?php echo site_url('suppliers/edit_supplier') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
       $('#edit_supplier_content').html(result);
      }
    });
    $('#edit_supplier').modal('show');
  });

  //Delete supplier
  $(document).on('click','.delete_supplier',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this supplier?');
    if(response){
      id = $(this).attr('data-supplier_id');
      $.ajax({
        url:'<?php echo site_url('suppliers/delete_supplier') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
            $('#alert_area').empty().html('<div class="alert alert-success  alert-dismissable" id="disappear">'+result.message+'</div>');
            setTimeout(function(){$('#disappear').fadeOut('slow')},3000);
            suppliers_listing.fnDraw();
          }
          else
          {
            $('#alert_area').empty().html('<div class="alert alert-danger  alert-dismissable">'+result.message+'</div>');
          }
        }
      });
    }
    return false;
  });
});
</script>
