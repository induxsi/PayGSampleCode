using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Web;

namespace TestApp.Models
{
    public class EcomRequest
    {
            [Required]
            public long MerchantKeyId { get; set; }
            [Required]
            public string AuthenticationKey { get; set; }
            [Required]
            public string AuthenticationToken { get; set; }
            [Required]
            public string RequestUniqueId { get; set; }
            [Required]
            public string PaymentType { get; set; } // Set to ALL
            [Required]
            public string TransactionType { get; set; }
            [Required]
            public Decimal Amount { get; set; }
            [Required]
            public string ResponseRedirectUrl { get; set; }
            [Required]
            public string CancelRedirectUrl { get; set; }
            [Required]
            public DateTime RequestDateTime { get; set; }
        
            public string CustomerName { get; set; }
            public string CustomerPhone { get; set; }
            public string CustomerEmail { get; set; }
            public bool EmailReceipt { get; set; }
            public string OrderId { get; set; }
            public string BillingAddress { get; set; }
            public string BillingCity { get; set; }
            public string BillingState { get; set; }
            public string BillingCountry { get; set; }
            public string BillingZipCode { get; set; }
            public string FirstName { get; set; }
            public string LastName { get; set; }

            public string ShippingAddress { get; set; }
            public string ShippingCity { get; set; }
            public string ShippingState { get; set; }
            public string ShippingCountry { get; set; }
            public string ShippingZipCode { get; set; }
                 
            public string CustomerId { get; set; }
            public string CustomerNotes { get; set; }                 
    
         
           public string HashData { get; set; }
           
            public string PlatformId { get; set; }
       
     

          

        }

}