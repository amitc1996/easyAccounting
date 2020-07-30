
<?php 
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<script src="<?php echo base_url('assets/plugins/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="content-wrapper" style="min-height: 916px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="pull-left">
      <?php echo $title; ?>
    </h1>
    <div class="pull-right" >
       <a href="<?php echo site_url('stocks');?>" class="btn btn-default" title="Back"><span class="glyphicon glyphicon-arrow-left" style="margin-right: 5px;"></span>Back</a>
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
           <div class="box-header with-border">
                  <div class="row">
                     <div class="col-md-3">
                     <div id="date_inventoryFillter" style="background: #fff; cursor: pointer; padding: 6px 12px; border: 1px solid #ccc;margin-right: 10px;">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                     </div>
                      <div class="col-md-8">
                      
                     </div>
                     <div class="col-md-1">
                        <a href="<?php echo site_url('stocks/print_stock_summary');?>" target="_blanck" title="Print Stock Summary" class="btn btn-primary btn-sm view_stock" style="margin-right:5px;" ><span class="glyphicon glyphicon-file"></span></a>
                   </div>
                  </div>
                </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                <h2 class="text-center"><strong><?php echo strtoupper($company_profile["company_name"]); ?></strong></h2>
                 <h3 class="text-center" style="margin-bottom: 0px;">Stock Summary</h3>
                 <p class="text-center">1-Apr-2009 to 30-Apr-2009</p>
               </div>
            </div>
            <table id="stocks_listing" class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th style="width:65%;">Item/Group</th>
                  <th style="width:15%;">Quantity/Unit</th>
                  <th style="width:10%;">Rate</th>
                  <th style="width:10%;">Value</th>
                </tr>
              </thead>
              <tbody id="summary_data">
                 
              </tbody>
              <tfoot id="tfoot">
                 
              </tfoot>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div>


<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js');?>"></script>
 <script>

 var start='';
var end='';
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

});

 function get_data(start,end){
  console.log(start);
   var values = {
            'start_date':start,
            'end_date': end,
            <?php echo $csrf['name'];?>:"<?php echo $csrf['hash'];?>" 
    };
    $.ajax({
        url:'<?php echo site_url('stocks/get_stock_summary_data/') ?>',
        dataType:'json',
        type:'POST',
        data:values,
       success:function(result)
       {
         if(result.length>0){
           var summary_data='';
           var final_avl_stock=0;
           var final_item_value=0;
           $('#summary_data').empty();
            $.each(result, function(index, value) {
               var itemvalue=0;
               itemvalue=value.total_avl_stock*value.unit_cost;
               final_avl_stock+=parseInt(value.total_avl_stock);
               final_item_value+=parseFloat(itemvalue);
                summary_data=`
                  <tr>
                    <td>${value.item_title}</td>
                    <td>${value.total_avl_stock+' '+value.measurement_name}</td>
                    <td>${value.unit_cost}</td>
                    <td>${itemvalue}</td>
                  </tr>
                 `;
                 $('#summary_data').append(summary_data);
                }); 
            var tfootcont='';
            tfootcont=`
                 <tr>
                  <td><strong>Grand Total</strong></td>
                  <td><strong>${final_avl_stock}<strong></td>
                  <td></td>
                  <td><strong>${final_item_value}</strong></td>
                </tr>
            `;
            $('#tfoot').empty().html(tfootcont);
           console.log(result);
         }
         else{
          $('#summary_data').empty().html('<tr><td colspan="4" class="text-center">No record found</td></tr>');
          console.log('empty')
         }
       } 
    });
  }
 </script>