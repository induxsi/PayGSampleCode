using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TestApp.Models
{
    public class EcomResponse
    {
        public long MerchantKeyId { get; set; }
        public string PaymentType { get; set; }
        public string TransactionType { get; set; }
        public string RequestUniqueId { get; set; }
        public long TransactionId { get; set; }
        public decimal AuthorizedAmount { get; set; }
        public decimal TransactionAmount { get; set; }
        public int ResponseCode { get; set; }
        public string ReasonCode { get; set; }
        public string ResponseText { get; set; }
        public string ApprovalCode { get; set; }
        public string TransactionApprover { get; set; }
        public string First6Digit { get; set; }
        public string Last4Digit { get; set; }
        public string CardType { get; set; }

        public string SystemTraceNo { get; set; }
        public string TransactionReferenceNo { get; set; }
        public string Datetime { get; set; }
        public string CustomerId { get; set; }
     
        public string CustomerEmail { get; set; }
        public string CustomerMobile { get; set; }
        public string upiVpa { get; set; }
        public string BankName { get; set; }
        public string WalletType { get; set; }

        public string SurchargeType { get; set; }
        public decimal SurchargeValue { get; set; }
        public decimal SurchargeAmount { get; set; }
        public string CustomerName { get; set; }
        public string BillingAddress { get; set; }
        public string BillingCity { get; set; }
        public string BillingState { get; set; }
        public string BillingCountry { get; set; }
        public string BillingZipCode { get; set; }
        public string FirstName { get; set; }
        public string LastName { get; set; }
    }
}