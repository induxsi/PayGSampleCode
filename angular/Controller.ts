import { environment } from './../../../../environments/environment';

// import { Validators, FormControl,FormBuilder, FormGroup } from '@angular/forms';
@Component({
  selector: 'ms-quickpay',
  templateUrl: './quickpay.component.html',
  styleUrls: ['./quickpay.component.scss']
})


export class QuickpayComponent implements OnInit {
  url: any;
  // CurrencyCode;
  // MerchantKeyId;
  PaymentModuleType;
  AuthenticationKey;
  AuthenticationToken;
  RequestUniqueId;
  PaymentType;
  // TransactionType;
  ResponseRedirectUrl;
  CancelRedirectUrl;
  RefTransactionId;
  IndustrySpecicationCode;
  // CustomerName;
  CustomerPhone;
  CustomerEmail;
  EmailReceipt;
  OrderId;
  BillingAddress;
  BillingCity;
  BillingState;
  BillingCountry;
  BillingZipCode;
  ShippingAddress;
  ShippingCity;
  ShippingState;
  ShippingCountry;
  ShippingZipCode;
  //CustomerId;
  CustomerNotes;
  UserName;
  RequestDateTime;
  MarketSpecificCode;
  EchoData;
  Level2;
  Source;
  TransactionId;
  UserId;
 
  

  constructor() { 
    });
 
    this.url = environment.EcomPaymentPageUrl;
    this.MerchantKeyId = this.commonfunction.GetPayGfundTransferMerchantId();
    this.AuthenticationKey = this.commonfunction.GetPayGWalletAuthenticationKey();
    this.AuthenticationToken = this.commonfunction.GetPayGWalletAuthenticationToken();
    let walletUserAddress: UserAddress = this.commonfunction.getUserAddress();
    this.loggedInUserAddress = walletUserAddress.Address;
    this.loggedInUserCity = walletUserAddress.City;
    this.loggedInUserState = walletUserAddress.State;
    this.loggedInUserCountry = walletUserAddress.Country;
    this.loggedInUserZip = walletUserAddress.Zip;
    this.loggedInUserMobileNo = walletUserAddress.MobileNo;
    this.PaymentType = 'All';
    this.TransactionType = 'Charge';
    this.CurrencyCode = 'INR';
    this.RefTransactionId = '';
    this.IndustrySpecicationCode = 'D';
    this.CustomerName = '';
    this.CustomerPhone = this.loggedInUserMobileNo;
    this.CustomerEmail = '';
    this.EmailReceipt = true;
    this.OrderId = this.commonfunction.getOrderId().toString();
    this.BillingAddress = this.loggedInUserAddress;
    this.BillingCity = this.loggedInUserCity;
    this.BillingState = this.loggedInUserState;
    this.BillingCountry = this.loggedInUserCountry;
    this.BillingZipCode = this.loggedInUserZip;
    this.ShippingAddress = this.loggedInUserAddress;
    this.ShippingCity = this.loggedInUserCity;
    this.ShippingState = this.loggedInUserState;
    this.ShippingCountry = this.loggedInUserCountry;
    this.ShippingZipCode = this.loggedInUserZip;
    this.CustomerId = '';
    this.CustomerNotes = '';
    this.UserName = this.commonfunction.getUserName();
    this.RequestDateTime = new Date();
    this.MarketSpecificCode = '';
    this.EchoData = null;
    this.Level2 = null;
    this.Source = "PayGWallet";
    this.PaymentModuleType="Collecting Order";
    this.TransactionId = this.commonfunction.getTransactionId()
    this.RequestUniqueId = this.commonfunction.NewUUID()
    this.ResponseRedirectUrl = this.commonfunction.GetPayGWalletResponseRedirectUrl() + this.RequestUniqueId;
    this.CancelRedirectUrl = this.commonfunction.GetPayGWalletCancelRedirectUrl() + this.RequestUniqueId;
    this.UserId=this.commonfunction.getUserId();
  }

  ngOnInit() {
    
  }



  QuickPayProcess(e) {

      this.CustomerPhone = this.mobileno.value;
      this.CustomerEmail = this.email.value;

  
     
      e.target.submit();
    });
  }



}
