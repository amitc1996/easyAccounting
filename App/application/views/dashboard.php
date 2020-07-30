<?php 
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<script src="<?php echo base_url('assets/plugins/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>" />

<div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="row">
            <div class="col-md-9">
              <h2>
            Dashboard
            <small></small>
          </h2>
            </div>
          </div>   
        </section>
                <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bolt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Stock Value</span>
                  <span class="info-box-number"><?php echo moneyFormatIndia($stock_value);?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Payable Amount</span>
                  <span class="info-box-number">324234</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Outstanding</span>
                  <span class="info-box-number">23432</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-group"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Clients</span>
                  <span class="info-box-number"><?php echo $total_clients?$total_clients:0?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>
          <!-- Small boxes (Stat box) -->
           <div class="box box-danger">
                <div class="box-header with-border">
                  <div class="row">
                     <div class="col-md-6">
                       <h3 class="box-title">Basic Information</h3>
                     </div>
                     <div class="col-md-6">
                     <div class="pull-right" id="date_inventoryFillter" style="background: #fff; cursor: pointer; padding: 6px 12px; border: 1px solid #ccc;margin-right: 10px;">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                   </div>
                  </div>
                 
                </div><!-- /.box-header -->

                <!-- form start -->
     <div class="box-body">
      <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Purchase</span>
              <span class="info-box-number" id="total_purchase_amt"></span>

              <div class="progress">
                <div class="progress-bar" id="total_purchase_amt_progress"></div>
              </div>
             <span class="progress-description pull-left">
                Payables
              </span>
              <span class="progress-description pull-right" id="purchase_outstanding_amt">
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
            </div><!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box bg-yellow">
            <span class="info-box-icon"><i  class="fa fa-truck fa-flip-horizontal"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Purchase Return</span>
              <span class="info-box-number">5,200</span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <span class="progress-description pull-left">
                Payables
              </span>
              <span class="progress-description pull-right">
                0.00/0.00
              </span>
            </div>
           
          </div>
            </div> <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number" id="total_sale_amt"></span>

              <div class="progress">
                <div class="progress-bar" id="total_sale_amt_progress"></div>
              </div>
              <span class="progress-description pull-left">
                Receivables
              </span>
              <span class="progress-description pull-right" id="sales_outstanding_amt">
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
            </div><!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

         <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-undo"></i></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales Returns</span>
              <span class="info-box-number">163,921</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
             <span class="progress-description pull-left">
                Receivables
              </span>
              <span class="progress-description pull-right">
                0.00/0.00
              </span>
            </div>
          
          </div>
            </div><!-- /.col -->
          </div>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="box box-danger">
                <div class="box-header with-border">
                  <div class="row">
                     <div class="col-md-6">
                       <h3 class="box-title">City wise client total</h3>
                     </div>
                  </div>
                </div><!-- /.box-header -->

                <!-- form start -->
                <div class="box-body">
                  <div class="row">
                     <div class="col-md-12">
                          <div class="card-body">
                            <canvas id="crmpieChartCity" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                          </div>
                     </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>
        </section><!-- /.content -->
      </div>
      <!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js');?>"></script>
 <script>

 var start='';
var end='';
var result_arr=JSON.parse('<?php echo json_encode($total_clients_city_wise);?>');
$(document).ready(function(){
  get_data(start,end)
    //date range start
 function cb(start, end) {
   if(start._isValid && end._isValid)
        {
            $('#date_inventoryFillter span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        else
        {
            $('#date_inventoryFillter span').html('Date');
            
        }
    }
$('#date_inventoryFillter').daterangepicker({
  alwaysShowCalendars:true,
  autoUpdateInput:false,
      startDate: start,
      endDate: end,
      ranges: {
         'None': [null,null],
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      }
  }, cb);
 $('#date_inventoryFillter').on('apply.daterangepicker', function(ev, picker) { 
   start = (picker.startDate.format('YYYY-MM-D')!='Invalid date')?picker.startDate.format('YYYY-MM-D'):'' ;
   end = (picker.endDate.format('YYYY-MM-D')!='Invalid date')?picker.endDate.format('YYYY-MM-D'):'';
   get_data(start,end);
 });

$('#date_inventoryFillter').on('show.daterangepicker', function(ev, picker) { 
  if(!picker.startDate._isValid && !picker.endDate._isValid ){
      $('#date_inventoryFillter').data('daterangepicker').startDate=moment()
      $('#date_inventoryFillter').data('daterangepicker').endDate=moment()
      picker.toggle();
  }
 });
 $('#date_inventoryFillter span').text('Date');

  //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
      var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }

     //pie chart city wise
    var pieCityData        = {
      labels:result_arr.labels,
      datasets: [
        {
          data: result_arr.data,
          backgroundColor :result_arr.colors,
        }
      ]
    }
    var pieChartCanvasCity = $('#crmpieChartCity').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvasCity, {
      type: 'pie',
      data: pieCityData,
      options: pieOptions      
    })



});
//date range end
 function get_data(start,end){
  console.log(start);
   var values = {
            'start_date':start,
            'end_date': end,
            <?php echo $csrf['name'];?>:"<?php echo $csrf['hash'];?>" 
    };
    $.ajax({
        url:'<?php echo site_url('dashboard/get_data/') ?>',
        dataType:'json',
        type:'POST',
        data:values,
       success:function(result)
       {
         if(result){
            var total_sale_amt_progress=(result.sales_outstanding_amount.total_paid_amount/result.sales_outstanding_amount.total_amount)/100;
            var total_purchase_payable_amt_progress=(result.purchase_payable_amount.total_paid_amount/result.purchase_payable_amount.total_amount)/100; 
            $('#sales_outstanding_amt').text((result.sales_outstanding_amount.total_paid_amount?result.sales_outstanding_amount.total_paid_amount:0)+'/'+(result.sales_outstanding_amount.total_amount?result.sales_outstanding_amount.total_amount:0));
            $('#total_sale_amt').text(result.sales_outstanding_amount.total_amount?result.sales_outstanding_amount.total_amount:0);
            $('#total_sale_amt_progress').css('width',total_sale_amt_progress+'%')

             $('#purchase_outstanding_amt').text((result.purchase_payable_amount.total_paid_amount?result.purchase_payable_amount.total_paid_amount:0)+'/'+(result.purchase_payable_amount.total_amount?result.purchase_payable_amount.total_amount:0));
            $('#total_purchase_amt').text(result.purchase_payable_amount.total_amount?result.purchase_payable_amount.total_amount:0);
            $('#total_purchase_amt_progress').css('width',total_purchase_payable_amt_progress+'%')
         }
       } 
    });
  }
 </script>