<?php
if($details)
{

  $sale_details = $details['sale_details'][0];
 // echo"<pre>";print_r($sale_details) ;die;
  $sale_items = $details['sale_items'];
  ?>
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
     <?php echo @$title; ?>
     <small></small>
   </h1>
  
   <div class="pull-right" >
    <a href="<?php echo site_url('sales');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
  </div> 
  <div class="clearfix"></div>
</section>

<!-- Main content -->
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $company_profile['company_name'];?>
            <small class="pull-right">Date: <?php echo date("m/d/Y", strtotime($sale_details['invoice_date']));?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
          From
          <address>
            <strong><?php echo $company_profile['company_name'];?></strong><br>
            <?php echo $company_profile['address'];?><br>
            <?php echo $company_profile['city'].', '.$company_profile['state'];?><br>
            <?php echo $company_profile['country'].', '.$company_profile['zip'];?><br>
            Phone: <?php echo $company_profile['mobile'];?><br>
            Email: <?php echo $company_profile['email'];?><br>
            <?php echo ($company_profile["is_gst"]==1) ? 'GSTIN': 'TIN' ; ?>: <?php echo ($company_profile["is_gst"]==1) ?htmlspecialchars($company_profile['gstin']): htmlspecialchars($company_profile['tax']);?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          Billed To :
          <address>
            <strong><?php echo $sale_details['client_name'];?></strong><br>
            <?php echo $sale_details['b_address'];?><br>
            <?php echo $sale_details['b_city'].', '.$sale_details['b_state'];?><br>
            <?php echo $sale_details['b_country'].', '.$sale_details['b_zip'];?><br>
            Phone: <?php echo $sale_details['client_phone'];?><br>
            Email: <?php echo $sale_details['client_email'];?><br>
            Tax: <?php echo $sale_details['client_tax_no'];?>
          </address>
        </div>
         <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          Shipped To :
          <address>
            <strong><?php echo $sale_details['client_name'];?></strong><br>
            <?php echo $sale_details['s_address'];?><br>
            <?php echo $sale_details['s_city'].', '.$sale_details['s_state'];?><br>
            <?php echo $sale_details['s_country'].', '.$sale_details['s_zip'];?><br>
            Phone: <?php echo $sale_details['client_phone'];?><br>
            Email: <?php echo $sale_details['client_email'];?><br>
            Tax: <?php echo $sale_details['client_tax_no'];?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>Invoice <?php echo $sale_details['invoice_number'];?></b><br>
          <br>
          <b>Order ID:</b> <?php echo $sale_details['client_order'];?><br>
          <b>Reverse Charge:</b><?php echo ($sale_details['is_reverce_charge']==1)?'Yes':'No';?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-condensed">
            <thead>
            <tr>
              <th>Serial</th>
              <th>Product</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
              <th colspan="2">Discount</th>
              <th colspan="2">IGST</th>
              <th colspan="2">CGST</th>
              <th colspan="2">SGST</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
            foreach ($sale_items as $sale_item) {
             ?>
            <tr>
              <td><?php echo $i;?></td>
              <td><?php echo $sale_item['item_title'];?></td>
              <td><?php echo $sale_item['measurement_name'];?></td>
              <td><?php echo $sale_item['unit_cost'];?></td>
              <td><?php echo $sale_item['item_qty'];?></td>
              <td><?php echo $sale_item['total_cost'];?></td>
              <td><?php echo $sale_item['discount'];?></td>
              <td><?php echo $sale_item['discount_amount'];?></td>
              <td><?php echo $sale_item['igst'];?></td>
              <td><?php echo $sale_item['igst_amount'];?></td>
              <td><?php echo $sale_item['cgst'];?></td>
              <td><?php echo $sale_item['cgst_amount'];?></td>
              <td><?php echo $sale_item['sgst'];?></td>
              <td><?php echo $sale_item['sgst_amount'];?></td>
              <td><?php echo $sale_item['grand_total_coast'];?></td>
            </tr>
            <?php $i++; }?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-8">
        <?php if($sale_details['notes']){?>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?php echo $sale_details['notes'];?>
          </p>
      <?php }?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $sale_details['sub_total'];?></td>
              </tr>
             <tr>
                <th>Total Discount:</th>
                <td><?php echo $sale_details['total_discount'];?></td>
              </tr>
              <tr>
                <th>Total IGST:</th>
                <td><?php echo $sale_details['total_igst'];?></td>
              </tr>
               <tr>
                <th>Total CGST:</th>
                <td><?php echo $sale_details['total_cgst'];?></td>
              </tr>
               <tr>
                <th>Total SGST:</th>
                <td><?php echo $sale_details['total_sgst'];?></td>
              </tr>
                <tr>
                <th>Total:</th>
                <td><?php echo $sale_details['total'];?></td>
                </tr>
              <tr>
                <th>(-)Less Round Off:</th>
                <td><?php echo $sale_details['less_round_off'];?></td>
                </tr>
              <tr>
                <th>Grand Total:</th>
                <td><?php echo $sale_details['grand_total'];?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
</div>
 <?php
}else{
  echo "No Record Found.";
}
?>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>


