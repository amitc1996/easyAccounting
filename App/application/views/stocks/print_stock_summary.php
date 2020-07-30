
<!DOCTYPE html>
<html>
<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta charset="utf-8">
  <title>Stock Summary</title>
</head>

<style type="text/css">
table{
  width: 100%;
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
  /*border-right: 0.5px solid;*/
  border-top: 0.5px solid;
  border-bottom: 0.5px solid;
}

#goods_table td {
padding: 5px 5px 5px 5px;
 
}
#goods_table th {
padding: 5px 5px 5px 5px;
 
}
.text-center{
  text-align: center;
}

label{display:block; }
</style>
<body style="border:0.5px solid;">
   <p class="text-center tax-compname-heading"><strong><?php echo strtoupper($company_profile["company_name"]); ?></strong></p>
   <p class="text-center address-content"><strong>Stock Summary</strong></p>
   <p class="text-center address-content">1-Apr-2020 To 30-Apr-2020</p>
<table id="goods_table"  style= "margin-top:15px;">
  <thead>
 <tr style="border-top: 2px solid;">
          <th style="width:55%; font-size: 14px;">Particulars</th>
          <th style="width:15%; font-size: 14px;">Quantity</th>
          <th style="width:15%; font-size: 14px;">Rate</th>
          <th style="width:15%; font-size: 14px;">Value</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td style="width:55%; font-size: 12px;">Dax smooth</td>
    <td style="width:15%; font-size: 12px;">5</td>
    <td style="width:15%; font-size: 12px;">6</td>
    <td style="width:15%; font-size: 12px;">555</td>
  </tr>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="3" style="border-bottom: 0.5px solid;border-top: 0.5px solid; font-size: 14px;"><strong>Grand Total</td>
    <td style="border-bottom: 0.5px solid;border-top: 0.5px solid; font-size: 14px;">5</td>
  </tr>
  </tfoot>
</table>
</body>
</html>