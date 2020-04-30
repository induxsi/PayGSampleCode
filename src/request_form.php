<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
        label { font-size: 12px; font-weight: 400; }
    </style>
</head>
<body><?$random_id=rand(10,100);?>
    <div class="container">
        <h2>EcomPay Request:</h2><hr>
        <form id="payg_request_form" method="post" action="send_data.php">
            <div class="row one">
                <div class="col-sm-12 bg-default">
                    <h4>Transaction Details</h4>
                </div>
               
                <div class="col-sm-3 form-group">
                    <label for="MerchantKeyId">Merchant Key ID :</label>
                    <input type="number" class="form-control" id="MerchantKeyId" name="MerchantKeyId" value="292" required />
                </div>
                <div class="col-sm-3 form-group">
                    <label for="AuthenticationKey">Authentication Key :</label>
                    <input type="text" class="form-control" id="AuthenticationKey" name="AuthenticationKey" value="12959e563133424a9576e541c2670a83" />
                </div>
                <div class="col-sm-3 form-group">
                    <label for="AuthenticationToken">Authentication Token :</label>
                    <input type="text" class="form-control" id="AuthenticationToken" name="AuthenticationToken" value="ca66b41b8e4f4187819d559a591ccfb7" />
                </div>
                <div class="col-sm-3 form-group">
                    <label for="RequestUniqueId">Request Unique ID :</label>
                    <input type="number" class="form-control" id="RequestUniqueId" name="RequestUniqueId"  value="<?=$random_id;?>"/>
                </div>

                <div class="col-sm-3 form-group">
                    <label for="PaymentType">Payment Type :</label>
                    <select class="form-control" id="PaymentType" name="PaymentType">
                        <option value="">Select Paymode</option>
                        <option value="NetBanking">Net Banking</option>
                        <option value="CreditCard" selected>Credit Card</option>
                        <option value="DB">Debit Card</option>
                        <option value="PP">Prepaid Card</option>
                        <option value="WA">Wallet</option>
                        <option value="CE">Credit Card EMI</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="TransactionType">Transaction Type :</label>
                    <select class="form-control" id="TransactionType" name="TransactionType">
                        <option value="">Select Transaction Type</option>
                        <option value="Charge" selected>Charge</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Amount">Amount :</label>
                    <input type="text" class="form-control" id="Amount" name="Amount"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ResponseRedirectUrl">Response Redirect Url :</label>
                    <input type="text" class="form-control" id="ResponseRedirectUrl" name="ResponseRedirectUrl" value="http://hostinghunk.com/raj/payg/php/response.php" />
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CancelRedirectUrl">Cancel Redirect Url :</label>
                    <input type="text" class="form-control" id="CancelRedirectUrl" name="CancelRedirectUrl" value="http://hostinghunk.com/raj/payg/php/response.php" />
                </div>

                <!-- <div class="col-sm-3 form-group">
                    <label for="HashData">Hash Data :</label>
                    <textarea class="form-control" id="HashData" style="min-width:260px;max-width:260px;height:34px;" name="HashData" placeholder="Enter Hash Data">1e612caab7194578bdb821d72ae7512e</textarea>
                </div> -->
                <div class="col-sm-3 form-group">
                    <label for="RequestDateTime">Request Date Time :</label>
                    <input type="text" class="form-control" id="RequestDateTime" name="RequestDateTime" value="2020-04-08T08:53:25.53"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="UserName">User Name :</label>
                    <input type="text" class="form-control" id="UserName" name="UserName"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CurrencyCode">Currency Code :</label>
                    <select class="form-control" id="CurrencyCode" name="CurrencyCode">
                        <option value="INR" selected>Indian Rupee</option>
                        <option value="USD">US Dollar</option>
                        <option value="GBR">British Pound</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="RefTransactionId">Ref Transaction ID :</label>
                    <input type="text" class="form-control" id="RefTransactionId" name="RefTransactionId"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="IndustrySpecicationCode">Industry Specication Code :</label>
                    <input type="text" class="form-control" id="IndustrySpecicationCode" name="IndustrySpecicationCode" value="D" />
                </div>

                <div class="col-sm-3 form-group">
                    <label for="EmailReceipt">Email Receipt :</label>
                    <input type="text" class="form-control" id="EmailReceipt" name="EmailReceipt"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="OrderId">Order ID :</label>
                    <input type="text" class="form-control" id="OrderId" name="OrderId" value="<?=$random_id;?>"/>
                </div>
            </div>

            <div class="row four">
                <div class="col-sm-12 bg-default">
                    <h4>Customer Details</h4>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CustomerName">Customer Name :</label>
                    <input type="text" class="form-control" id="CustomerName" name="CustomerName"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CustomerPhone">Customer Phone :</label>
                    <input type="text" class="form-control" id="CustomerPhone" name="CustomerPhone"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CustomerEmail">Customer Email :</label>
                    <input type="text" class="form-control" id="CustomerEmail" name="CustomerEmail"/>
                </div>
            </div>

            <div class="row six">
                <div class="col-sm-12 bg-default">
                    <h4>Billing Details </h4>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BillingAddress">Billing Address :</label>
                    <input type="text" class="form-control" id="BillingAddress" name="BillingAddress"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BillingCity">Billing City :</label>
                    <input type="text" class="form-control" id="BillingCity" name="BillingCity"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BillingState">Billing State :</label>
                    <input type="text" class="form-control" id="BillingState" name="BillingState"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BillingCountry">Billing Country :</label>
                    <input type="text" class="form-control" id="BillingCountry" name="BillingCountry"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BillingZipCode">Billing Zip Code :</label>
                    <input type="text" class="form-control" id="BillingZipCode" name="BillingZipCode"/>
                </div>
            </div>

            <div class="row six">
                <div class="col-sm-12 bg-default">
                    <h4>Shipping Details </h4>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ShippingAddress">Shipping Address :</label>
                    <input type="text" class="form-control" id="ShippingAddress" name="ShippingAddress"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ShippingCity">Shipping City :</label>
                    <input type="text" class="form-control" id="ShippingCity" name="ShippingCity"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ShippingState">Shipping State :</label>
                    <input type="text" class="form-control" id="ShippingState" name="ShippingState"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ShippingCountry">Shipping Country :</label>
                    <input type="text" class="form-control" id="ShippingCountry" name="ShippingCountry"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ShippingZipCode">Shipping Zip Code :</label>
                    <input type="text" class="form-control" id="ShippingZipCode" name="ShippingZipCode"/>
                </div>
            </div>

            <div class="row seven">
                <div class="col-sm-3 form-group">
                    <label for="Level2">Level2 :</label>
                    <input type="text" class="form-control" id="Level2" name="Level2"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CustomerId">Customer ID :</label>
                    <input type="text" class="form-control" id="CustomerId" name="CustomerId"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="CustomerNotes">CustomerNotes :</label>
                    <textarea class="form-control" id="CustomerNotes" style="min-width:260px;max-width:260px;height:34px;" name="CustomerNotes"></textarea>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="UserName">User Name :</label>
                    <input type="text" class="form-control" id="UserName" name="UserName"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="UserId">User ID :</label>
                    <input type="text" class="form-control" id="UserId" name="UserId"/>
                </div>
            </div>

            <div class="row eight">
                <div class="col-sm-3 form-group">
                    <label for="MarketSpecificCode">Market Specific Code :</label>
                    <input type="text" class="form-control" id="MarketSpecificCode" name="MarketSpecificCode"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="EchoData">Echo Data :</label>
                    <input type="text" class="form-control" id="EchoData" name="EchoData"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Source">Source :</label>
                    <input type="text" class="form-control" id="Source" name="Source"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="ViewType">View Type :</label>
                    <input type="text" class="form-control" id="ViewType" name="ViewType"/>
                </div>
            </div>

            <div class="row nine">
                <div class="col-sm-3 form-group">
                    <label for="PlatformId">Platform Id :</label>
                    <input type="text" class="form-control" id="PlatformId" name="PlatformId"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="IntegrationType">Integration Type :</label>
                    <input type="text" class="form-control" id="IntegrationType" name="IntegrationType" value="0" />
                </div>
                <div class="col-sm-3 form-group">
                    <label for="SurchargeType">Surcharge Type :</label>
                    <input type="text" class="form-control" id="SurchargeType" name="SurchargeType"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="SurchargeValue">Surcharge Value :</label>
                    <input type="text" class="form-control" id="SurchargeValue" name="SurchargeValue"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Vpa">Vpa :</label>
                    <input type="text" class="form-control" id="Vpa" name="Vpa"/>
                </div>
            </div>

            <div class="row ten">
                <div class="col-sm-3 form-group">
                    <label for="AccountNumber">Account Number :</label>
                    <input type="text" class="form-control" id="AccountNumber" name="AccountNumber"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Ifsc">IFSC :</label>
                    <input type="text" class="form-control" id="Ifsc" name="Ifsc"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="AdhaadhaarNo">Adhaar No :</label>
                    <input type="text" class="form-control" id="AdhaadhaarNo" name="AdhaadhaarNo"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BarQrCode">Bar QR Code :</label>
                    <input type="text" class="form-control" id="BarQrCode" name="BarQrCode"/>
                </div>
            </div>

            <div class="row twovelve">
                <div class="col-sm-3 form-group">
                    <label for="WalletType">Wallet Type :</label>
                    <input type="text" class="form-control" id="WalletType" name="WalletType"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="phoneNumber">Phone Number :</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="Email">Email :</label>
                    <input type="text" class="form-control" id="Email" name="Email"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="FirstName">First Name :</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName"/>
                </div>

                <div class="col-sm-3 form-group">
                    <label for="LastName">Last Name :</label>
                    <input type="text" class="form-control" id="LastName" name="LastName"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="AccountNumber">Account Number :</label>
                    <input type="text" class="form-control" id="AccountNumber" name="AccountNumber"/>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="BankNameCode">Bank Name Code :</label>
                    <input type="text" class="form-control" id="BankNameCode" name="BankNameCode"/>
                </div>
            </div>

            <div class="row eleven">
                <div class="col-sm-3 form-group">
                    <label for="UseMerchantLogo">Use Merchant Logo :</label><br/>
                    <input type="radio" id="yes" name="UseMerchantLogo" value="yes">
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="UseMerchantLogo" value="no" checked="">
                    <label for="no">No</label>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="SendMailsToMerchant">Send Mails To Merchant :</label><br/>
                    <input type="radio" id="yes" name="SendMailsToMerchant" value="yes" >
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="SendMailsToMerchant" value="no" checked="">
                    <label for="no">No</label>
                </div>
                <div class="col-sm-3 ">
                    <label for="SendApproveMailToCustomer">Send Approve Mail To Customer :</label><br/>
                    <input type="radio" id="yes" name="SendApproveMailToCustomer" value="yes" >
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="SendApproveMailToCustomer" value="no" checked="">
                    <label for="no">No</label>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="SendDeclineMailToMercchant">Send Decline Mail To Mercchant :</label><br/>
                    <input type="radio" id="yes" name="SendDeclineMailToMercchant" value="yes" >
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="SendDeclineMailToMercchant" value="no" checked="">
                    <label for="no">No</label>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-primary form-control" value="Submit" />
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript">
     $(function() {
        $('#payg_request_form').validate({
                rules: {
                    MerchantKeyId: 'required',
                    AuthenticationKey: 'required',
                    AuthenticationToken: 'required',
                    RequestUniqueId: 'required',
                    PaymentType: 'required',
                    TransactionType: 'required',
                    Amount: 'required',
                    RefTransactionId: 'required',
                    HashData: 'required',
                    RequestDateTime: 'required',
                    UserName: 'required',
                    OrderId: 'required',
                    CustomerEmail: 'required',
                    CurrencyCode: 'required'
                },
                messages: {
                    MerchantKeyId: 'This field is required',
                    AuthenticationKey: 'This field is required',
                    AuthenticationToken: 'This field is required',
                    RequestUniqueId: 'This field is required',
                    PaymentType: 'This field is required',
                    TransactionType: 'This field is required',
                    Amount: 'This field is required',
                    RefTransactionId: 'This field is required',
                    HashData: 'This field is required',
                    RequestDateTime: 'This field is required',
                    UserName: 'This field is required',
                    OrderId: 'This field is required',
                    CustomerEmail: 'This field is required',
                    CurrencyCode: 'This field is required'
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>