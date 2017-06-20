<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Redirect to Payment Gateway....</title>
<script src="http://www.lushtrip.com/assets/js/jquery.js" type="text/javascript"></script>
<style>
body{ font-family:Segoe UI,lucida grande,verdana,sans-serif;font-size:13px;color:#3d3d3d}
.paymentBox { float:left;margin-left:10px;width:640px;height:auto;border:1px solid #ccc;margin:0 auto }
.paymentBoxInner { float:left;width:620px; }
.paymentBoxInner span {float:left;  border-bottom:1px solid #ccc;padding:10px;display:block;width:600px;font-weight:bold;font-size:16px;}
.paymentFeatures { float:left;width:640px }
.paymentFeatures ul { float:left; margin0;padding;0}
.paymentFeatures ul li { list-style-type:square;line-height:20px}
</style>

<script type="text/javascript">
var showmessage=false;
  $(document).ready(function()
        {
           document.payuForm.submit();
    });
</script>
</head>
<body>
      <div class="paymentBox">
                     <div class="paymentBoxInner">
                            <span>Your payment request is being processed...</span>
                         </div>
                         <div class="paymentFeatures">
                           <ul>
                                 <li>This is a secure payment gateway using 128 bit encryption.</li>
                                 <li>The Server take about 1 to 5 seconds to process.</li>
                                 <li>Please do not press "Back" or "Refresh" buttons.</li>
                           </ul>
                         </div>
                         <div class="clear"></div>
   </div>
   <form name="payuForm" id="payuForm" action="<?php echo $long_url; ?>">
   </form>
   
</body>
</html>