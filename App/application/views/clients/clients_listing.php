<?php
$client_orgnisation_name = array(
  'name'  => 'client_orgnisation_name',
  'id'  => 'client_orgnisation_name',
  'value' => set_value('client_orgnisation_name'),
  'class'=>'form-control',
  'placeholder'=>'Company Name',
  'data-parsley-required'=>'true'
);
$client_orgnisation_phone = array(
  'name'  => 'client_orgnisation_phone',
  'id'  => 'client_orgnisation_phone',
  'value' => set_value('client_orgnisation_phone'),
  'class'=>'form-control mask',
  'placeholder'=>'Company Phone',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid phone number'
);
$client_email = array(
  'name'  => 'client_email',
  'id'  => 'client_email',
  'value' => set_value('client_email'),
  'class'=>'form-control',
  'placeholder'=>'Email',
  'data-parsley-type'=>'email'
);
$client_name = array(
  'name'  => 'client_name',
  'id'  => 'client_name',
  'value' => set_value('client_name'),
  'class'=>'form-control',
  'placeholder'=>'Contact Person Name',
);
$client_mobile = array(
  'name'  => 'client_mobile',
  'id'  => 'client_mobile',
  'value' => set_value('client_mobile'),
  'class'=>'form-control mask',
  'placeholder'=>'Mobile',
  'data-parsley-pattern'=>'\+?\d[\d -]{8,12}\d',
  'data-parsley-pattern-message'=>'Enter valid mobile number',
  'data-inputmask'=>"'mask': '999 999 9999'",
);
$client_tax_number = array(
  'name'  => 'client_tax_number',
  'id'  => 'client_tax_number',
  'value' => set_value('client_tax_number'),
  'class'=>'form-control',
  'placeholder'=>'Tax Number.',
);
$gstin = array(
  'name'  => 'gstin',
  'id'  => 'gstin',
  'value' => set_value('gstin'),
  'class'=>'form-control mask',
  'placeholder'=>'GSTIN',
  'data-parsley-pattern'=>'^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$',
  'data-parsley-pattern-message'=>'Enter valid gstin number',
);
$client_address_b = array(
  'name'  => 'client_address_b',
  'id'  => 'client_address_b',
  'value' => set_value('client_address_b'),
  'class'=>'form-control',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$client_city_b = array(
  'name'  => 'client_city_b',
  'id'  => 'client_city_b',
  'value' => set_value('client_city_b'),
  'class'=>'form-control',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$client_state_b = array(
  'name'  => 'client_state_b',
  'id'  => 'client_state_b',
  'value' => set_value('client_state_b'),
  'class'=>'form-control',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$client_country_b = array(
  'name'  => 'client_country_b',
  'id'  => 'client_country_b',
  'value' => set_value('client_country_b'),
  'class'=>'form-control',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$client_zip_b = array(
  'name'  => 'client_zip_b',
  'id'  => 'client_zip_b',
  'value' => set_value('client_zip_b'),
  'class'=>'form-control',
  'placeholder'=>'Pincode',
   'data-parsley-pattern'=>'^[\d\+\-\.\(\)\/\s]*$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);

$client_address_s = array(
  'name'  => 'client_address_s',
  'id'  => 'client_address_s',
  'value' => set_value('client_address_s'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Address',
  'data-parsley-required'=>'true',
  'rows'=>4,
);
$client_city_s = array(
  'name'  => 'client_city_s',
  'id'  => 'client_city_s',
  'value' => set_value('client_city_s'),
  'class'=>'form-control s_addr',
  'placeholder'=>'City',
  'data-parsley-required'=>'true'
);
$client_state_s = array(
  'name'  => 'client_state_s',
  'id'  => 'client_state_s',
  'value' => set_value('client_state_s'),
  'class'=>'form-control s_addr',
  'placeholder'=>'State',
  'data-parsley-required'=>'true'
);
$client_country_s = array(
  'name'  => 'client_country_s',
  'id'  => 'client_country_s',
  'value' => set_value('client_country_s'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Country',
  'data-parsley-required'=>'true'
);
$client_zip_s = array(
  'name'  => 'client_zip_s',
  'id'  => 'client_zip_s',
  'value' => set_value('client_zip_s'),
  'class'=>'form-control s_addr',
  'placeholder'=>'Pincode',
  'data-parsley-pattern'=>'^[1-9][0-9]{5}$',
  'data-parsley-pattern-message'=>'Enter valid pincode'
);
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<style type="text/css">
  .addr_label{
    margin-bottom: -20px;
  }
</style>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>

    </h1>
  
    <div class="pull-right" >
       <?php if(in_array(strtolower('clients_add_client'),$permissions)){?> 
      <a href="#" class="btn  btn-custom" title="Add Client" data-toggle="modal" data-target="#add_client" ><span class="glyphicon glyphicon-plus-sign " style="margin-right: 5px;"></span>Add</a>
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
            <table id="clients_listing" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Company Name</th>
                  <th>Company Phone</th>
                  <th>Contact Person Name</th>
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

<!--Add client Modal -->
<div class="modal fade " id="add_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog model-lg" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Client</h4>
      </div>
      <?php echo form_open($this->uri->uri_string(),array('role'=>"form" ,'id'=>"client_add_form",'name'=>'client_add_form', 'data-parsley-validate'=>"")); ?>
      <div class="modal-body">
        <div class="row">
        <div class="form-group col-md-6">
          <label class="control-label" for="client_orgnisation_name">Company Name:</label>
          <?php echo form_input($client_orgnisation_name); ?>
         
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_orgnisation_phone">Company Phone:</label>
          <?php echo form_input($client_orgnisation_phone); ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_email">Email:</label>
          <?php echo form_input($client_email); ?>
        </div>
        
        <div class="form-group col-md-6">
          <label class="control-label" for="client_name">Contact Person Name:</label>
          <?php echo form_input($client_name); ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_mobile">Mobile:</label>
          <?php echo form_input($client_mobile); ?>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-6">
          <label class="control-label" for="gstin">GSTIN:</label>
          <?php echo form_input($gstin); ?>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label" for="client_tax_number">Service Tax Number:</label>
          <?php echo form_input($client_tax_number); ?>
        </div>
        <div class="clearfix"></div>
      </div>
        <div class="row">
          <div class="col-md-12 addr_label">
          <h4>Billing Address:</h4>
          </div>
      
        <div class="form-group col-md-12">
         <hr>
          <label class="control-label" for="client_address_b">Address:</label>
          <?php echo form_textarea($client_address_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_city_b">City:</label>
          <?php echo form_input($client_city_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_state_b">State:</label>
          <?php echo form_input($client_state_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_country_b">Country:</label>
          <?php echo form_input($client_country_b); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_zip_b">Pincode:</label>
          <?php echo form_input($client_zip_b); ?>
        </div>
      </div>
        <div class="clearfix"></div>
         <div class="row">
          <div class="col-md-12 addr_label">
          <h4>Shipping Address:</h4>
          </div>
        <div class="form-group col-md-12">
          <hr>
          <div class="checkbox" style="margin-top: -5px;">
            <label>
              <input type="checkbox" id="sam_as_billing_addrs"> Same as billing address
            </label>
          </div>
          <label class="control-label" for="client_address_s">Address:</label>
          <?php echo form_textarea($client_address_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_city_s">City:</label>
          <?php echo form_input($client_city_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_state_s">State:</label>
          <?php echo form_input($client_state_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_country_s">Country:</label>
          <?php echo form_input($client_country_s); ?>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label" for="client_zip_s">Pincode:</label>
          <?php echo form_input($client_zip_s); ?>
        </div>
      </div>
        <div class="clearfix"></div>
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

<!-- Edit client -->
<div class="modal fade" role="dialoge" tabindex="-1" id="edit_client" aria-labelledby ="myModalLabel" aria-hidden="true">
  <div class="modal-dialog model-lg" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Client</h4>
      </div>
      <div id="edit_content"></div>
    </div><!-- modal content-->
  </div><!-- modal dialog-->
</div><!-- /modal-->
<!-- Main content -->
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
var client_datatable= "";
$('#client_add_form').parsley();
$(document).ready(function(){
$('.mask').inputmask()
//perform same as billing
$('#sam_as_billing_addrs').on('change',function(){
  if($(this).prop('checked')){
     $('#client_address_s').val($('#client_address_b').val());
     $('#client_city_s').val($('#client_city_b').val());
     $('#client_state_s').val($('#client_state_b').val());
     $('#client_country_s').val( $('#client_country_b').val());
     $('#client_zip_s').val($('#client_zip_b').val());
  }
  else{
    $('.s_addr').val('');
  }
});

//perform client listing
  client_datatable = $('table#clients_listing ').DataTable({
    "bServerSide": true,
    "sAjaxSource": "<?php echo site_url('clients/clients_listing'); ?>",
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
       <?php  if(in_array(strtolower('clients_edit_client'),$permissions)){?> 

        links += '<a href="<?php echo site_url('clients/view_client').'/';?>'+aData[5]+'" data-product_id="'+aData[5]+'" title="View Details" class="btn btn-default btn-xs view_client" style="margin-right:5px;" ><span class="glyphicon glyphicon-search"></span></a>';

      links += '<a href="#" data-client_id="'+aData[5]+'" title="Edit Details" class="btn btn-custom btn-xs edit_client" style="margin-right:5px;" ><span class="glyphicon glyphicon-pencil"></span></a>';
       <?php } if(in_array(strtolower('clients_delete_client'),$permissions)){?> 
      links +='<a href="#" data-client_id="'+aData[5]+'" title="Delete Details" class="btn btn-danger btn-xs delete_client"  style="margin-right:5px;"><span class="glyphicon glyphicon-trash"></span></a>';
        <?php }?> 
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

  //Add client
  $('#client_add_form').parsley();
  $("#client_add_form").on('submit',function(){
    var _this=$(this);
    var values = $('#client_add_form').serialize();
    $.ajax({
      url:'<?php echo site_url('clients/add_client'); ?>',
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
          $('#client_add_form')[0].reset();
          $('#client_add_form').parsley().reset();

          client_datatable.fnDraw();

        }else{
          toastr.error(result.message);
        }
      }
    });
    return false;
  });

  //Edit client
  $(document).on('click','.edit_client',function(e){
    e.preventDefault();
    id = $(this).attr('data-client_id');
    $.ajax({
      url:'<?php echo site_url('clients/edit_client') ?>/'+id,
      dataType: 'html',
      success:function(result)
      {
        $('#edit_content').html(result);
      }
    });
    $('#edit_client').modal('show');
  });

  //Delete client
  $(document).on('click','.delete_client',function(e){
    e.preventDefault();
    var response = confirm('Are you sure want to delete this client?');
    if(response){
      id = $(this).attr('data-client_id');
      $.ajax({
        url:'<?php echo site_url('clients/delete_client') ?>/'+id,
        dataType: 'json',
        success:function(result)
        {
          if(result.status==1)
          {
           toastr.success(result.message);
            client_datatable.fnDraw();
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
