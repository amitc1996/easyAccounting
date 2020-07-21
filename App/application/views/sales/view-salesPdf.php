<?php
 $sale_details = $details['sale_details'][0];
  $sale_items = $details['sale_items'];

if($company_profile["logo_image"])
$image  = '<div><img src="'.base_url('uploads/logo_sign/'.$company_profile["logo_image"]).'" style="width: 100px;margin-bottom:10px;"  /></div>';
else
$image='';

$gst = false;


function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
$is_discount = array();
$is_grouptax = array();
$total_tax=array();
$tax_group_name=array();
foreach($sale_items as $key => $value)
{
    
    if(!isset($total_tax[$value["tax_id"]]))
    {
    $total_tax[$value["tax_id"]]['taxable_amount'] = $value['total_cost'];  
    $total_tax[$value["tax_id"]]['tax_amount'] = $value['tax_amount'];
    $total_tax[$value["tax_id"]]['tax_name'] = str_replace("/"," ",$value['tax']);
    if($value['is_apply_group_tax']){
     $total_tax[$value["tax_id"]]['grouptax']=json_decode($value['taxes_groups'],true);
    }
    //$total_tax[$value["tax_id"]] = $value['tax'];
    }
    else
    {
      $total_tax[$value["tax_id"]]["tax_amount"] = $total_tax[$value["tax_id"]]["tax_amount"] + $value["tax_amount"];
    } 

    if(isset($value))
    $dis=explode('/',$value['discount']);
     if($dis[1] != '0.00%')
     array_push($is_discount,$dis[1]);
}
foreach ($total_tax as $key => $value) {
  foreach ($value['grouptax'] as $keyi => $val) {
    array_push($tax_group_name,$val['tax_name']);
  }
}
$tax_group_name=array_unique($tax_group_name);

    
    $product_name_width ='170px';
    $cat_width = '102px';

// echo "<pre>";
// print_r(count($is_discount));
// print_r($product_name_width);
// print_r($cat_width);
// die;


?>
<style>
#goods_table table {
    border-collapse: collapse;
}


#goods_table th {
  border-right: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
}
#goods_table td {
  border-right: 1px solid #ccc;
 
}
#goods_table td {
padding: 3px 1px 3px 3px;
 
}
#goods_table th {
padding: 3px 1px 3px 3px;
 
}
label{display:block; }

</style>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm"> 
<table class="table-bordered" style=" margin: 10px; border: 1px solid #ccc; padding: 5px;">
<tr>

 <td style="width: 320px;">
 <?php echo $image; ?>
 <div style="font-size: 20px; font-weight: bold;">
 <?php echo htmlspecialchars(strtoupper($company_profile["company_name"])); ?>
 </div>
 <div style=""><?php echo htmlspecialchars($company_profile["address"])."<br/>".htmlspecialchars($company_profile["city"]).", ".htmlspecialchars($company_profile["state"])."<br/>". htmlspecialchars($company_profile["country"]).", ".htmlspecialchars(@$company_profile["zip"]);?></div>
 <div style="">Phone: <?php echo htmlspecialchars(@$company_profile["work_phone"]); ?></div>
 <div style="">Mobile: <?php echo htmlspecialchars($company_profile["mobile"]); ?></div>
 <div style="">Email: <?php echo htmlspecialchars(@$company_profile["email"]); ?></div>
 </td>
 <td style="width: 152px;text-align: left;vertical-align: top;" ><strong> <ins> TAX-INVOICE</ins> </strong></td>
 <td style="width: 229px;text-align: right;vertical-align: top;"><em><?php echo $print_type?htmlspecialchars('( '.@$print_type.' )'):''; ?></em><br /><br /><?php echo ($company_profile["is_gst"]==1) ? 'GSTIN': 'TIN' ; ?>:<?php echo ($company_profile["is_gst"]==1) ?htmlspecialchars($company_profile['gstin']): htmlspecialchars($company_profile['tax']);?></td>
</tr> 

 
</table>

<table class="table-bordered" style="  margin: 0px 10px 0px 10px; border: 1px solid #ccc; border-top: 0px; ">

 <tr>
 <td style="width:342px; border-right: 1px solid #ccc; padding: 5px 5px 5px 5px;">

  <table>
 <tr><td>Invoice No.</td><td>: <?php echo $sale_details['invoice_number']; ?></td></tr>
 <tr><td>Dated</td><td>: <?php echo date("m/d/Y", strtotime($sale_details['invoice_date']));?></td></tr>
 <tr><td>Reverse Charge</td><td>: <?php echo ($sale_details['is_reverce_charge']==1)?'Yes':'No';?> </td></tr>


 </table>

 </td>
 <td style="width:341px;padding: 5px 5px 5px 5px;vertical-align: top;">
 

<table>
 <tr><td>Transport </td><td>: <?php echo htmlspecialchars($sale_details["transporter_name"]); ?></td></tr>
 <tr><td>Vechicle No.</td><td>: <?php echo htmlspecialchars($sale_details["vechicle_no"]); ?></td></tr>
 <tr><td>Date of Supply</td><td>: <?php echo date("m/d/Y", strtotime($sale_details['invoice_date']));?> </td></tr>
 <tr><td>Place of Supply</td><td>: <?php echo $sale_details["place_of_supply"]; ?> </td></tr>
 </table>
 </td>
 </tr>
</table>
<table class="table-bordered" style="  margin: 0px 10px 0px 10px; border: 1px solid #ccc; border-top: 0px; ">

 <tr>
 <td style="width:342px; border-right: 1px solid #ccc; padding: 5px 5px 5px 5px;">
 
 <table>
 <tr><td><b>Billed to :</b></td></tr>
 </table>
 <table>
 <tr><td><?php echo $sale_details["client_name"]; ?></td></tr>
 <tr><td><?php echo htmlspecialchars($sale_details["b_address"])."<br/>".htmlspecialchars($sale_details["b_city"]).", ".htmlspecialchars($sale_details["b_state"])."<br/>". htmlspecialchars($sale_details["b_country"]).", ".htmlspecialchars(@$sale_details["b_zip"]);?></td></tr>
 </table>
 <br/>
 <table>
 <tr><td>Mobile</td><td>: <?php echo htmlspecialchars($sale_details["client_phone"]); ?></td></tr>
 <tr><td>Email</td><td>: <?php echo htmlspecialchars($sale_details["client_email"]); ?></td></tr>
 
 </table>
 
 </td>
 <td style="width:341px;padding: 5px 5px 5px 5px;vertical-align: top;">
 
 <table>
 <tr><td><b>Shipped to :</b></td></tr>
 </table>
 <table>
 <tr><td><?php echo $sale_details["client_name"]; ?></td></tr>
 <tr><td><?php echo htmlspecialchars($sale_details["s_address"])."<br/>".htmlspecialchars($sale_details["s_city"]).", ".htmlspecialchars($sale_details["s_state"])."<br/>". htmlspecialchars($sale_details["s_country"]).", ".htmlspecialchars(@$sale_details["s_zip"]);?></td></tr>
 </table>
 <br/>
 <table>
 <tr><td>Mobile</td><td>: <?php echo htmlspecialchars($sale_details["client_phone"]); ?></td></tr>
 <tr><td>Email</td><td>: <?php echo htmlspecialchars($sale_details["client_email"]); ?></td></tr>
 
 </table>
 
 </td>
 </tr>
</table>

<table id="goods_table"  style=" margin: 0px 10px 0px 10px; border: 1px solid #ccc;border-top: 0px;">
<tr>
 <th style="width: 10px;font-size: 12px;">Sr.</th>
 <th style="width:<?php echo $product_name_width;?>;font-size: 12px;">Product</th>
 <th style="width: 75px;font-size: 12px;">HSN/SAC</th>
 <th style="width: 25px;font-size: 12px;">Qty.</th>
 <th style="width: 25px;font-size: 12px;">Unit</th>
 <th style="width: 50px;font-size: 12px;">Price</th>
 <th style="width: 55px;font-size: 12px;">Total</th>
 <th style="width: 40px;font-size: 12px;">Disc. %</th>
 <th style="width: 90px;font-size: 12px;" colspan="2"><?php echo ($company_profile["is_gst"]==1) ? 'GST': 'Tax' ; ?></th>
 <th style="width: 54px;font-size: 12px; border-right: 0px;">Amount</th>
</tr>
  <?php
     if($sale_items)
     {   
        $i =1;
        $totqty=0;
        foreach($sale_items as $value)
        {
           $totqty+=$value['item_qty'];
        ?>
        <tr>
          <td style="width: 10px; font-size: 12px;"><?php echo $i;?></td>
          <td style="width:<?php echo $product_name_width;?>;font-size: 12px;"><?php echo htmlspecialchars($value['item_title']);?></td>
          <td style="width: 75px;font-size: 12px;"><?php echo  htmlspecialchars($value['hsn_sac_code']);?></td>
          <td style="width: 25px;font-size: 12px;"><?php echo  htmlspecialchars($value['item_qty']);?></td>
          <td style="width: 25px;font-size: 12px;"><?php echo  htmlspecialchars($value['measurement_name']);?></td>
          <td style="width: 50px;font-size: 12px;"><?php echo  htmlspecialchars($value['unit_cost']);?></td>
          <td style="width: 55px;font-size: 12px;"><?php echo  htmlspecialchars($value['total_cost']);?></td>
         <?php $dis=explode('/',$value['discount']);?> 
          <td style="width: 40px;font-size: 12px;"><?php echo  htmlspecialchars($dis[1]);?></td>
          <?php $tax=explode('/',$value['tax']); ?>
          <td style="width: 45px;font-size: 12px;"><?php echo  htmlspecialchars($tax[1]);?></td>
          <td style="width: 45px;font-size: 12px;"><?php echo  htmlspecialchars($value['tax_amount']);?></td>
          <td style="width: 54px;font-size: 12px; border-right: 0px;text-align: right;"><?php  echo   htmlspecialchars(($value['grand_total_coast']));?></td>
        </tr>
  <?php
  $i++;
        }
     }
     
     if(count($details)<10){
     for($j=1; $j <= (10-count($details));$j++)
     {
     ?>   
     <tr>
          <td style="width: 10px; font-size: 12px;">&nbsp;</td>
          <td style="width:<?php echo $product_name_width;?>;font-size: 12px;">&nbsp;</td>
          <td style="width: 75px;font-size: 12px;">&nbsp;</td>
          <td style="width: 25px;font-size: 12px;">&nbsp;</td>
          <td style="width: 25px;font-size: 12px;">&nbsp;</td>
          <td style="width: 55px;font-size: 12px;">&nbsp;</td>
          <td style="width: 30px;font-size: 12px;">&nbsp;</td>
          <td style="width: 30px;font-size: 12px;">&nbsp;</td>
          <td style="width: 45px;font-size: 12px;">&nbsp;</td>
          <td style="width: 45px;font-size: 12px;">&nbsp;</td>
          <td style="width: 54px;font-size: 12px; border-right: 0px;text-align: right;">&nbsp;</td>
        </tr> 
     <?php  
     } }
     ?>
</table>
<table class="table-bordered" style="  margin: 0px 10px 0px 10px; border: 1px solid #ccc; border-top: 0px; ">

 <tr>
 <td style="width:442px; border-right: 1px solid #ccc; padding: 5px 5px 5px 5px;">
 
 <table>
 <tr><td><b>Bank Details :</b></td></tr>
 </table>
 <table>
 <tr><td>Bank Name</td><td>: <?php echo htmlspecialchars($company_profile["bank_name"]); ?></td></tr>
 <tr><td>Branch</td><td>: <?php echo htmlspecialchars($company_profile["branch_name"]); ?></td></tr>
 <tr><td>A/c No. </td><td>: <?php echo htmlspecialchars($company_profile["account_number"]); ?></td></tr>
 <tr><td>IFSC CODE</td><td>: <?php echo htmlspecialchars($company_profile["ifsc_code"]); ?></td></tr>
 
 </table>
 
 </td>
 <td style="width:240px;padding: 5px 5px 5px 5px;vertical-align: top;">
  <table  style="width: 340px; margin: 0px 10px 0px 10px;">

<!-- <tr><td style="width: 630px;text-align: left;">&nbsp;<strong><?php //echo ($gst) ? 'Composition person can\'t collect tax on supplies': 'VAT- Under Composition Scheme' ; ?></strong> </td><td style="width: 87px;text-align: right;">&nbsp;</td></tr> -->

<tr><td style="width: 157px;text-align: right;">Sub Total </td><td style="width: 70px;text-align: right;">: <?php echo $sale_details["sub_total"];  ?> </td></tr>
<tr><td style="width: 157px;text-align: right;">Discount</td><td style="width: 70px;text-align: right;">: <?php echo $sale_details["total_discount"];  ?> </td></tr>
<?php if($sale_details["total_tax"] != 0) { ?>
<tr><td style="width: 157px;text-align: right;">Tax</td><td style="width: 70px;text-align: right;">: <?php echo $sale_details["total_tax"];  ?> </td></tr>
<?php } ?>
<tr><td><br /></td></tr>
<tr><td style="width: 157px;text-align: right;"><strong>Grand Total(Rupees)</strong> </td><td style="width: 70px;text-align: right;">:<strong> <?php echo round($sale_details["grand_total"]);  ?>/-</strong> </td></tr>
</table>
 
 </td>
 </tr>
</table>
<table  style="width: 720px; margin: 0px 10px 0px 10px; border: 1px solid #ccc;border-top: 0px; ">
  <tr><td style="padding: 5px;" colspan="2">Total Quantity: <strong><?php echo $totqty;  ?> Units</strong></td></tr>
<tr><td style="padding: 5px;" colspan="2">Amount Chargeable (in words): <strong><?php echo ucfirst(convert_number_to_words((int)round($sale_details["grand_total"]))); ?> only.</strong></td></tr>
<tr>
<td>
  <?php if(count($tax_group_name)>1&&count($tax_group_name)<=3){?>
    <table id="goods_table"  style="margin: 0px 10px 0px 0px; border-top: 1px solid #ccc;">
    <tr>
      <th style="width: 100px;font-size: 12px;">Tax Rate</th>
      <th style="width: 100px;font-size: 12px;">Taxable Amount</th>
      <?php 
        $count=count($tax_group_name);
        $width=299/$count;
      foreach ($tax_group_name as $value) {
         echo  '<th style="width: '.$width.'px;font-size: 12px;" colspan="2">'.$value.'</th>';
       }
      ?>
      <th style="width: 100px;font-size: 12px; border-right: 0px;">Total Tax</th>
    </tr>
    <?php 
    $count=count($tax_group_name);
    $swidth=0;
    $width=0;
    if($count===2){
      $swidth=122;
      $width=21;
    }else if($count===3){
      $swidth=105.40;
      $width=22;
    }
    foreach ($total_tax as $key => $tax) {?>
    <tr>
       <?php
       echo '<td style="width: '.$swidth.'px;font-size: 12px;">'.$tax['tax_name'].'</td>';
       echo '<td style="width: '.$swidth.'px;font-size: 12px;">'.$tax['taxable_amount'].'</td>';  
        foreach ($tax['grouptax'] as $key=> $value) {
         $taxamt=($tax['taxable_amount']*$value['tax_percentage'])/100;
         echo  '<td style="width: '.$width.'px;font-size: 12px;">'.$value['tax_percentage'].'%</td>';
         echo  '<td style="width: '.$width.'px;font-size: 12px;">'.$taxamt.'</td>';
         }
        echo '<td style="width: '.$swidth.'px;font-size: 12px;border-right: 0px;">'.$tax['tax_amount'].'</td>';
      ?>
    </tr>
    <?php }?>
  </table>
 <?php }else{?>
  <table id="goods_table"  style="margin: 0px 10px 0px 0px; border-top: 1px solid #ccc;">
    <tr>
      <th style="width: 300px;font-size: 12px;">Tax Rate</th>
      <th style="width: 200px;font-size: 12px;">Taxable Amount</th>
      <th style="width: 189px;font-size: 12px; border-right: 0px;">Total Tax</th>
    </tr>
    <?php 
    foreach ($total_tax as $key => $tax) {?>
    <tr>
       <td style="width: 300px;font-size: 12px;"><?php echo $tax['tax_name'];?></td>
       <td style="width: 200px;font-size: 12px;"><?php echo $tax['taxable_amount'];?></td>
       <td style="width: 189px;font-size: 12px; border-right: 0px;"><?php echo $tax['tax_amount'];?></td>
    </tr>
    <?php }?>
  </table>
 <?php }?>
</td>
</tr>
</table>
<?php if($company_profile["declaration"]){?>
<table id="" class="table-bordered" style="width: 719px; margin: 0px 10px 0px 10px; border: 1px solid #ccc;border-top: 0px; ">
<tr>
<td style="padding:5px;">
 <?php echo htmlspecialchars_decode(stripslashes($company_profile['declaration'])); ?>
</td>
</tr>
</table>
<?php }?>
<table id="" class="table-bordered" style="width: 719px; margin: 0px 10px 0px 10px; border: 1px solid #ccc;border-top: 0px; ">
<tr>
<?php if($company_profile["terms"]){?>
 <td style="width:372px; border-right: 1px solid #ccc; padding: 5px 5px 5px 5px;font-size: 11px;vertical-align: top;">
  <?php echo htmlspecialchars_decode(stripslashes($company_profile['terms'])); ?>
 </td>
<?php }?>
 <td style="width:331px;padding: 5px 0px 5px 0px;">
  
   <div style="text-align: right;padding-top: 15px; padding-right: 5px;"><strong>For <?php echo strtoupper($company_profile["company_name"]); ?> </strong> </div>
  <br /> <br />  
   <div style="text-align: right;padding-top: 10px;padding-right: 5px; ">Authorised Signature</div>
 </td>
</tr>
</table>
</page>
