<?php
if($details){
 //echo "<pre>";print_r($hrecords);die;
?>
<div class="row">
 <div class="col-md-6">
  <table class="table table-striped table-bordered table-condensed" id="table" style="width: 100%;">
        <tr>
            <td><strong>SKU Id:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["sku"]); ?></td>
        </tr>
        <tr>
            <td><strong>Product Name:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["item_title"]); ?></td>
        </tr>
        <tr>
            <td><strong>HSN/SAC Code:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["hsn_sac_code"]); ?></td>
        </tr>
         <tr>
            <td><strong>Category:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["category_name"]); ?></td>
        </tr>
        <tr>
            <td><strong>Brand:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["brand_name"]); ?></td>
        </tr>
        <tr>
            <td><strong>Product Description:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["product_description"]); ?></td>
        </tr>
         <tr>
            <td><strong>Created:</strong></td>
            <td><?php echo date("m/d/Y", strtotime($details[0]["created"])); ?></td>
        </tr>
  </table>
  </div>  
  <div class="col-md-6">
  <table class="table table-striped table-bordered table-condensed" id="table" style="width: 100%;">
        <tr>
            <td><strong>IGST%:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["igst"]); ?></td>
        </tr>
        <tr>
            <td><strong>CGST%:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["cgst"]); ?></td>
        </tr>
        <tr>
            <td><strong>SGST%:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["sgst"]); ?></td>
        </tr>
        <tr>
            <td><strong>Unit:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["measurement_name"]); ?></td>
        </tr>
         <tr>
            <td><strong>Product Price:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["unit_cost"]); ?></td>
        </tr>
         <tr>
            <td><strong>Salling price:</strong></td>
            <td><?php  echo htmlspecialchars($details[0]["salling_price"]); ?></td>
        </tr>
  </table>
  </div>
  <div class="col-md-12">
  <h4>History</h4>
  
  
  <?php
  if(isset($hrecords)){
  ?>
  <table id="history_tbl" class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th>Action</th>
            <th>Date</th>
            <th>Item Title</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Unit</th>
            <th>IGST</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>Unit Cost</th>
            <th>Salling Price</th>
            <th>Hsn/Sac Code</th>
            <th>Description</th>
    
        </tr>
        </thead>
 <tbody>
  <?php  
    foreach($hrecords as $record){
  ?>  
    <tr>
      <td><?php echo $record["action"]; ?></td>
      <td><?php echo $record["created"]; ?></td>
      <td><?php echo $record["item_title"]; ?></td>
      <td><?php echo $record["category_name"]; ?></td>
      <td><?php echo $record["brand_name"]; ?></td>
      <td><?php echo $record["measurement_name"]; ?></td>
      <td><?php echo $record["igst"]; ?></td>
      <td><?php echo $record["cgst"]; ?></td>
      <td><?php echo $record["sgst"]; ?></td>
      <td><?php echo $record["unit_cost"]; ?></td>
      <td><?php echo $record["salling_price"]; ?></td>
      <td><?php echo $record["hsn_sac_code"]; ?></td>
      <td><?php echo $record["product_description"]; ?></td>
    </tr>
  <?php  
    }
  ?>
  </tbody>
  </table>
  <?php    
  }
  else{
    echo '<div class="alert alert-info">No records found.</div>';
  }
  
  ?>
  
  </div>    
  </div>
<?php    
}?>