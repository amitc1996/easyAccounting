<?php
if($details)
{
?>
<div class="row">
 <div class="col-md-12">
  <table class="table table-striped table-bordered table-condensed" id="table" style="width: 100%;">
        
        <tr>
            <td><strong>User Role(s)/Group(s)</strong></td>
            <td><?php if($groups){
                $str = ""; 
             foreach($groups as $group  ){
                $str .= htmlspecialchars($group["name"]).', '; 
             }
               $str = trim($str,', ' );
               echo $str;
             
             }
             else{
                echo "None";
             }
             ?></td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["name"]); ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo htmlspecialchars($details[0]["email"]); ?></td>
        </tr>
      
        
  </table>
  </div>      
  </div>
<?php    
}
?>