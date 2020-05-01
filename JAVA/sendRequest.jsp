<%@ page
	import="java.util.List,
                 java.util.ArrayList,
                 java.util.Collections,
                 java.util.Iterator,
                 java.util.Enumeration,
                 java.security.MessageDigest,
                 java.util.Map,
                 java.net.URLEncoder,
                 java.util.HashMap,
                 java.nio.charset.StandardCharsets,
                 java.math.BigInteger,  
				 java.nio.charset.StandardCharsets,
				 java.security.MessageDigest,  
				 java.security.NoSuchAlgorithmException"%> 
<%
String payg_url = "https://uat.pay-g.in/ProcessPayment/EcomPayment/ProcessPayment";
String SecureHashKey = "1e612caab7194578bdb821d72ae7512e";

Map fields = new HashMap();
for (Enumeration en = request.getParameterNames(); en.hasMoreElements();) {
    String fieldName = (String) en.nextElement();
    String fieldValue = request.getParameter(fieldName);
    System.out.println(fieldName + " :" + fieldValue);
    fields.put(fieldName, fieldValue);
}

//this need to be same order for hashing to work
String txn_details = SecureHashKey + '|' + fields.get("MerchantKeyId").toString() + '|' + fields.get("RequestUniqueId").toString() + '|' + fields.get("AuthenticationKey").toString() + '|' + fields.get("AuthenticationToken").toString() + '|' + fields.get("Amount").toString();
System.out.println("txn_details" + " :" + txn_details);
MessageDigest digest = MessageDigest.getInstance("SHA-256");
byte[] byteData = digest.digest(txn_details.getBytes(StandardCharsets.UTF_8));
BigInteger number = new BigInteger(1, byteData);

StringBuilder hexString = new StringBuilder(number.toString(16));
while (hexString.length() < 32) {
    hexString.insert(0, '0');
}

String hashData = hexString.toString();

System.out.println("hashData" + " :" + hashData);
%>
<html>
<head>
<title>PayG Merchant Integration</title>  
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>
  <form class="form-horizontal" id="payg_payment_form" action="<%=payg_url%>" method="POST"> 
    
    <input type="hidden" class="form-control" name="MerchantKeyId" id="" value="<%=fields.get("MerchantKeyId").toString() %>"/><br/>
    
    <input type="hidden" class="form-control" name="AuthenticationKey" id="" value="<%=fields.get("AuthenticationKey").toString() %>" /><br/>
     
    <input type="hidden" class="form-control" name="AuthenticationToken" id="" value="<%=fields.get("AuthenticationToken").toString() %>"/><br/>
   
    <input type="hidden" class="form-control" name="RequestUniqueId" id="" value="<%=fields.get("RequestUniqueId").toString() %>" /><br/>
    
    <input type="hidden" class="form-control" name="PaymentType" id="" value="<%=fields.get("PaymentType").toString() %>" /><br/>
    
    <input type="hidden" class="form-control" name="Amount" id="" value="<%=fields.get("Amount").toString() %>" /><br/>
    
    <input type="hidden" class="form-control" name="ResponseRedirectUrl" id="" value="<%=fields.get("ResponseRedirectUrl").toString() %>" /><br/>
    
    <input type="hidden" class="form-control" name="CancelRedirectUrl" id="" value="<%=fields.get("CancelRedirectUrl").toString() %>" /> <br/>
     
    <input type="hidden" class="form-control" name="HashData" id="" value="<%=hashData %>" /><br/>
    
    <input type="hidden" class="form-control" name="RequestDateTime" value="<%=fields.get("RequestDateTime").toString() %>" /> <br/>
     
    <input type="hidden" class="form-control" name="UserName" value="<%=fields.get("UserName").toString() %>" />  <br/>
    
    <input type="hidden" class="form-control" name="OrderId" id="" value="<%=fields.get("OrderId").toString() %>" /><br/>
    
    <input type="hidden" class="form-control" name="CustomerEmail" id="" value="<%=fields.get("CustomerEmail").toString() %>" /> <br/>
    
    <input type="hidden" class="form-control" name="TransactionType" id="" value="<%=fields.get("TransactionType").toString() %>" /> <br/>
    
    <input type="hidden" class="form-control" name="IntegrationType" id="" value="0" /> <br/>
    <input type="hidden" class="form-control" name="RefTransactionId" id="" value="<%=fields.get("RefTransactionId").toString() %>" /> <br/> 
    </form>
    <div class="container cs-border-light-blue">

    <!-- first line -->
    <div class="row pad-top"></div>
    <!-- end first line -->

    <div class="equalheight row" style="padding-top: 10px;">
      <div id="cs-main-body" class="cs-text-size-default pad-bottom">
        <div class="col-sm-9  equalheight-col pad-top">
          <div style="padding-bottom: 50px;">
            <h1>Initiating your payment process</h1>
            <div class="row">
              <div class="col-sm-12">
                <legend>Your payment is being processed, Please wait for a moment.</legend>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

</BODY>
</HTML>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#payg_payment_form").submit();
});
</script>
</body>
</html>