<?php
if($details){
$csrf = array(
  'name' => $this->security->get_csrf_token_name(),
  'hash' => $this->security->get_csrf_hash()
);
?>
<div class="row">
 <div class="col-md-12">
  <table class="table table-striped table-bordered table-condensed" id="table" style="width: 100%;">
        <tr>
            <td><strong>Wherehouse:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["wherehouse_name"]); ?></td>
        </tr>
        <tr>
            <td><strong>Product Name:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["item_title"]); ?></td>
        </tr>
        <tr>
            <td><strong>Available Stock:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["stock"]); ?></td>
        </tr>
         <tr>
            <td><strong>Created:</strong></td>
            <td><?php echo date("m/d/Y", strtotime($details[0]["created"])); ?></td>
        </tr>
  </table>
  </div>  
  <div class="col-md-12">
  <h4>History</h4>
  <table id="history_tbl" class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th>Action</th>
            <th>Date</th>
            <th>Stock</th>
            <th>Description</th>
        </tr>
        </thead>
 <tbody>
  </tbody>
  </table>
  </div>    
  </div>
<?php }?>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script>
  $(document).ready(function(){
    ajax_datatable = $('table#history_tbl ').DataTable({
      "bServerSide": true,
      "sAjaxSource": "<?php echo site_url('stocks/get_stock_history/'.$details[0]['stock_id']); ?>",
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
});
});
</script>
