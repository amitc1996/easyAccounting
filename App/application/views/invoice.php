<?php
$sale_details = $details['sale_details'][0];
$sale_items = $details['sale_items'];
if($company_profile["signature_image"])
$image  = '<div><img src="'.base_url('uploads/logo_sign/'.$company_profile["signature_image"]).'" style="width: 100px;margin-bottom:10px; margin-top:10px;margin-left:160px;"  /></div>';
else
$image='  <br /> <br /> ';
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
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="utf-8">
  <title>Create PDF from View in CodeIgniter Example</title>
</head>

<style type="text/css">
table{
  width: 100%;
  border-collapse: collapse;
}

.tax-inv-heading{
  margin-top: 0px;
  font-size: 15px;
  margin-bottom: 0px;
}
.tax-compname-heading{
  margin-top: 0px;
  font-size: 30px;
  margin-bottom: 0px;
}
.address-content{
  margin-top: 0px;
  font-size: 15px;
  margin-bottom: 0px;
}
.contdetails-content{
  margin-top:0px;
}
.border_bottum{
  border-bottom: 0.5px solid;
}
table tr td{
  font-size: 12px;
}
#goods_table table {
    border-collapse: collapse;
}


#goods_table th {
  border-right: 0.5px solid;
  border-bottom: 0.5px solid;
}
#goods_table td {
  border-right: 0.5px solid;
 
}
/*#goods_table td {
padding: 1px 1px 1px 1px;
 
}*/
/*#goods_table th {
padding: 1px 1px 1px 1px;
 
}*/
.text-center{
  text-align: center;
}

label{display:block; }
</style>
<body>
  <table style="border-top: 0.5px solid;border-right: 0.5px solid;border-left: 0.5px solid;">
    <tr>
      <td style="width: 80%;text-align: left;vertical-align: top;"><strong>GSTIN : <?php echo htmlspecialchars($company_profile['gstin']);?></strong></td>
      <td style="width: 20%;text-align: right;vertical-align: top;"><em><?php echo $print_type?htmlspecialchars('( '.@$print_type.' )'):''; ?></em></td>
    </tr>
  </table>
  <table style="border-bottom: 0.5px solid;border-right: 0.5px solid;border-left: 0.5px solid;">
    <tr>
      <td>
       <p class="text-center tax-inv-heading"><strong><ins>TAX-INVOICE</ins></strong></p>
       <p class="text-center tax-compname-heading"><strong><?php echo strtoupper($company_profile["company_name"]); ?></strong></p>
       <p class="text-center address-content"><?php echo htmlspecialchars(strtoupper($company_profile["address"]).",".htmlspecialchars($company_profile["city"]));?></p>
       <p class="text-center contdetails-content"><strong>Tel.:<?php echo htmlspecialchars(@$company_profile["work_phone"]).' / '. htmlspecialchars($company_profile["mobile"]).' Email:'.htmlspecialchars(@$company_profile["email"]); ?></strong></p>
     </td>
   </tr>
 </table>
 <table>
   <tr>
     <td style="width:50%;vertical-align: top; border-bottom: 0.5px solid;border-left: 0.5px solid;border-right: 0.5px solid;">
      <table>
       <tr><td style="width: 25%;">Invoice No.</td><td style="width: 75%;">: <?php echo $details['sale_details'][0]['invoice_number']; ?></td></tr>
       <tr><td style="width: 25%;">Date Of Invoice</td><td style="width: 75%;">: <?php echo date("m/d/Y", strtotime($details['sale_details'][0]['invoice_date']));?></td></tr>
       <tr><td style="width: 25%;">Place of Supply</td><td style="width: 75%;">: <?php echo $details['sale_details'][0]["place_of_supply"]; ?> </td></tr>
       <tr><td style="width: 25%;">Reverse Charge</td><td style="width: 75%;">: <?php echo ($details['sale_details'][0]['is_reverce_charge']==1)?'Yes':'No';?> </td></tr>
     </table>
   </td>
  <td style="width:50%;vertical-align: top; border-bottom: 0.5px solid;border-left: 0.5px solid;border-right: 0.5px solid;">
    <table>
     <tr><td style="width: 25%;">GR/RR No. </td><td style="width: 75%;">: </td></tr>
     <tr><td style="width: 25%;">Transport</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["transporter_name"]); ?></td></tr>
     <tr><td style="width: 25%;">Vehicle No.</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["vechicle_no"]); ?></td></tr>
     <tr><td style="width: 25%;">Station</td><td style="width: 75%;">: <?php echo $details['sale_details'][0]["place_of_supply"]; ?> </td></tr>
   </table>
 </td>
</tr>

</table>
<table>

 <tr>
 <td style="width:50%;vertical-align: top; border-bottom: 0.5px solid;border-left: 0.5px solid;border-right: 0.5px solid;">
 
 <table>
 <tr><td><b>Billed to :</b></td></tr>
 </table>
 <table>
 <tr><td><?php echo $details['sale_details'][0]["client_name"]; ?></td></tr>
 <tr><td><?php echo htmlspecialchars($details['sale_details'][0]["b_address"])."<br/>".htmlspecialchars($details['sale_details'][0]["b_city"]).", ".htmlspecialchars($details['sale_details'][0]["b_state"])."<br/>". htmlspecialchars($details['sale_details'][0]["b_country"])." ".htmlspecialchars(@$details['sale_details'][0]["b_zip"]);?></td></tr>
 </table>
<table style="margin-top: 5px;">
 <tr><td style="width: 25%;">Party Mobile No</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["client_phone"]); ?></td></tr>
 <tr><td style="width: 25%;">GSTIN/UIN</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["client_gstin_no"]); ?></td></tr>
 
 </table>
 
 </td>
 <td style="width:50%;vertical-align: top; border-bottom: 0.5px solid;border-left: 0.5px solid;border-right: 0.5px solid;">
 
 <table>
 <tr><td><b>Shipped to :</b></td></tr>
 </table>
 <table>
 <tr><td><?php echo $details['sale_details'][0]["client_name"]; ?></td></tr>
 <tr><td><?php echo htmlspecialchars($details['sale_details'][0]["s_address"])."<br/>".htmlspecialchars($details['sale_details'][0]["s_city"]).", ".htmlspecialchars($details['sale_details'][0]["s_state"])."<br/>". htmlspecialchars($details['sale_details'][0]["s_country"])." ".htmlspecialchars(@$details['sale_details'][0]["s_zip"]);?></td></tr>
 </table>
 <table style="margin-top: 5px;">
 <tr><td style="width: 25%;">Party Mobile No</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["client_phone"]); ?></td></tr>
 <tr><td style="width: 25%;">GSTIN/UIN</td><td style="width: 75%;">: <?php echo htmlspecialchars($details['sale_details'][0]["client_gstin_no"]); ?></td></tr>
 
 </table>
 </td>
 </tr>
</table>
<table id="goods_table"  style= "border-bottom: 0.5px solid; border-right: 0.5px solid;border-left: 0.5px solid;">
<tr>
 <th style="width:5px;font-size: 12px;">S.N.</th>
 <th style="width: 120px;font-size: 12px;">Description Of Goods</th>
 <th style="width: 40px;font-size: 12px;">HSN/SAC Code</th>
 <th style="width: 25px;font-size: 12px;">Qty.</th>
 <th style="width: 25px;font-size: 12px;">Unit</th>
 <th style="width: 40px;font-size: 12px;">Rate</th>
 <th style="width: 25px;font-size: 12px;">Disc</th>
 <th style="width: 25px;font-size: 12px;">CGST Rate</th>
 <th style="width: 25px;font-size: 12px;">CGST Amount</th>
 <th style="width: 25px;font-size: 12px;">SGST Rate</th>
 <th style="width: 25px;font-size: 12px;">SGST Amount</th>
 <th style="width: 54px;font-size: 12px; border-right: 0px;">Amount (Rs.)</th>
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
           <td style="width:5px;font-size: 12px;"><?php echo $i;?></td>
           <td style="width: 120px;font-size: 12px;"><?php echo htmlspecialchars($value['item_title']);?></td>
           <td style="width: 40px;font-size: 12px;"><?php echo  htmlspecialchars($value['hsn_sac_code']);?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo  htmlspecialchars($value['item_qty']);?>.</td>
           <td style="width: 25px;font-size: 12px;"><?php echo  htmlspecialchars($value['measurement_name']);?></td>
           <td style="width: 40px;font-size: 12px;"><?php echo  htmlspecialchars($value['unit_cost']);?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo htmlspecialchars($value['discount'].' %');?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo htmlspecialchars($value['cgst'].' %');?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo htmlspecialchars($value['cgst_amount']);?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo htmlspecialchars($value['sgst'].' %');?></td>
           <td style="width: 25px;font-size: 12px;"><?php echo htmlspecialchars($value['sgst_amount']);?></td>
           <td style="width: 54px;font-size: 12px; border-right: 0px;"><?php  echo   htmlspecialchars(($value['grand_total_coast']));?></td>
        </tr>
  <?php
  $i++;
        }
     }
     
     if(count($details)<15){
     for($j=1; $j <= (15-count($details));$j++)
     {
     ?>   
     <tr>
         <td style="width:5px;font-size: 10px;">&nbsp;</td>
           <td style="width: 120px;font-size: 10px;">&nbsp;</td>
           <td style="width: 40px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 40px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 25px;font-size: 10px;">&nbsp;</td>
           <td style="width: 54px;font-size: 10px; border-right: 0px;">&nbsp;</td>
        </tr> 
     <?php  
     } }
     ?>
     <table  style="border-bottom:0.5px solid;border-left:0.5px solid;">
     <tr>
         <td colspan="11">Amount Chargeable (in words): <strong><?php echo ucfirst(convert_number_to_words((int)round($sale_details["grand_total"]))); ?> only.</td>
         <td colspan="1"><strong><?php echo $sale_details["grand_total"];  ?></strong></td>
     </tr>
      <tr>
         <td colspan="11" style="text-align: right;">Less : Round Off (-)</td>
         <td colspan="1"><?php echo $sale_details['less_round_off'];?></td>
     </tr>
     <tr>
         <td colspan="11">Total Quantity: <strong><?php echo $totqty;  ?> Units</strong></td></td>
         <td colspan="1" style="border-top:0.5px solid"><strong><?php echo $sale_details["grand_total"];  ?>/-</strong></td>
     </tr>
   </table>
</table>
<table  style="width: 701px; border-bottom: 0.5px solid;border-left:0.5px solid;">
<tr>

 <td style="width:401px; padding:4px;border-right:0.5px solid;font-size: 11px;vertical-align: top;">
  <table id="goods_table"  style="margin: 0px 10px 0px 0px; border-top: 1px solid #ccc;">
    <tr>
      <th style="font-size: 12px;">Tax Rate</th>
      <th style="font-size: 12px;">Taxable Amount</th>
      <th style="font-size: 12px; border-right: 0px;">Total Tax</th>
    </tr>
   
    <tr>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px; border-right: 0px;">8</td>
    </tr>
    <tr>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px; border-right: 0px;">8</td>
    </tr>
    <tr>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px; border-right: 0px;">8</td>
    </tr>
    <tr>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px; border-right: 0px;">8</td>
    </tr>
     <tr>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px;">5</td>
       <td style="font-size: 12px; border-right: 0px;">8</td>
    </tr>
  </table>
 </td>

 <td style="width:260px;padding: 5px 0px 5px 0px; border-right:0.5px solid;">
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
</tr>
</table>
<table  style="width: 701px;border-bottom:0.5px solid;border-right:0.5px solid;border-left:0.5px solid;">
<tr>
<?php if($company_profile["terms"]){?>
 <td style="width:401px; padding: 4px; border-right: 0.5px solid; font-size: 11px;vertical-align: top;">
  <?php echo htmlspecialchars_decode(stripslashes($company_profile['terms'])); ?>
 </td>
<?php }?>
 <td style="width:260px;padding: 5px 0px 5px 0px;">
  <br />
  <div style="text-align: right;padding-top: 0px; padding-right: 5px;"><strong>For <?php echo strtoupper($company_profile["company_name"]); ?> </strong> </div> 
    <?php echo $image; ?>
   <div style="text-align: right;padding-top: 0px;padding-right: 5px; ">Authorised Signature</div>
 </td>
</tr>
</table>
</body>
</html>