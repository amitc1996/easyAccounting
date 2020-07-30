<?php 
$details['title']="Invoice Details";
$this->load->view('email/email_header',$details);?>
<div class="cContent" id="cContent-5" style="padding: 15px;background-color: rgba(255, 255, 255,0.9);">
    <table width="100%" cellspacing="0" cellpadding="0" style="padding: 0px; padding-top: 0px; padding-bottom: 15px;">
        <tbody>
            <tr>
                <td>
                    <table width="100%" cellpadding="0" cellspacing="0" style="">
                        <tbody>
                            <tr>
                                <td bgcolor="">
                                    <div id="txtHolder-5" class="txtEditorClass" style="color: #666666; font-size: 14px; font-family: 'Arial'; text-align: Left">
                                    <p> Dear <?php echo $details['sale_details'][0]['client_name'];?>,<p>
                                    <p>Thank you for your business. Please see attached invoice. If any questions please contact (call or whatsapp) at below number.</p>
                                   <div style="padding:3%;background:#fefff1;border:1px solid #e8deb5;color:#333"> <div style="padding:0 3% 3%;border-bottom:1px solid #e8deb5;text-align:center"> <h4 style="margin-bottom:0"><span class="il">INVOICE</span> AMOUNT</h4> <h2 style="color:#d61916;margin-top:10px"><?php echo moneyFormatIndia($details['sale_details'][0]['grand_total']);?></h2> </div><div style="margin:auto;max-width:350px;padding:3%"> <p><span style="width:40%;padding-left:10%;float:left"><span class="il">Invoice</span> No</span><span style="width:40%;padding-left:10%;display:inline-block"><b><?php echo $details['sale_details'][0]['invoice_number'];?></b></span></p><p><span style="width:40%;padding-left:10%;float:left"><span class="il">Invoice</span> Date</span><span style="width:40%;padding-left:10%"><b><?php echo date("d/m/Y", strtotime($details['sale_details'][0]['invoice_date']));?></b></span></p><p><span style="width:40%;padding-left:10%;float:left">Due Date</span><span style="width:40%;padding-left:10%"><b><?php echo date("d/m/Y", strtotime($details['sale_details'][0]['invoice_date']));?></b></span></p></div><div style="text-align:center;margin:25px 0"></div></div>
                                     <br />
                                     Regards,<br />
                                     The <?php echo $site_name; ?> Team<br/>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </td>
         </tr>
     </tbody>
 </table>
</div>
<?php $this->load->view('email/email_footer');?>