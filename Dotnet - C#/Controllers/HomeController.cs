using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Security.Cryptography;
using System.Text;
using System.Web;
using System.Web.Mvc;
using Common.Model.Processor;
using EcomPay.Model;
using EcomPay.Model.IsgPayment;

namespace TestApp.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }     
              

        [HttpPost]
        public void Index(EcomRequest request)
        {

            try
            {

                var transactionData = new System.Collections.SortedList();
                transactionData.Add("MerchantKeyId", request.MerchantKeyId);
                transactionData.Add("AuthenticationKey", request.AuthenticationKey);
                transactionData.Add("AuthenticationToken", request.AuthenticationToken);
                transactionData.Add("RequestUniqueId", request.RequestUniqueId);
                transactionData.Add("PaymentType", "ALL");
                transactionData.Add("TransactionType", "CHARGE");
                transactionData.Add("Amount", request.Amount);
                transactionData.Add("CustomerName", request.CustomerName);
                transactionData.Add("CustomerPhone", request.CustomerPhone);
                transactionData.Add("CustomerEmail", request.CustomerEmail);
                transactionData.Add("ResponseRedirectUrl", request.ResponseRedirectUrl);
                transactionData.Add("OrderId", request.OrderId);
                transactionData.Add("CancelRedirectUrl", request.CancelRedirectUrl);

                var secureHashKey = "8753e6da9b8f467e980f93b204d9c53d"; // Please get SecureHashKeyfrom payG portal
                var hashdataText = secureHashKey + "|" + request.MerchantKeyId + "|" + request.RequestUniqueId + "|" + request.AuthenticationKey + "|" + request.AuthenticationToken + "|" + request.Amount;


                var HashData = PerformDataHash(hashdataText, secureHashKey);

                transactionData.Add("HashData", HashData);

                
                var url = "https://uat.pay-g.in/ProcessPayment/EcomPayment/ProcessPayment";

                var sb = new System.Text.StringBuilder();
                sb.Append("<html>");
                sb.AppendFormat("<body onload='document.forms[0].submit()'>");
                sb.AppendFormat("<form action='{0}' method='post'>", url);
                foreach (System.Collections.DictionaryEntry item in transactionData)
                {
                    sb.AppendFormat("<input type='hidden'  name='{0}' value='{1}'>", item.Key, item.Value);
                }

                sb.Append("</form>");
                sb.Append("</body>");
                sb.Append("</html>");
                System.Web.HttpContext.Current.Response.Write(sb.ToString());
                System.Web.HttpContext.Current.Response.End();

            }
            catch (Exception e)
            {
                Console.WriteLine(e);
                throw;
            }

      
        }
             

        public string PerformDataHash(string rawData, string secureHashKey)
        {
          
            string data = rawData;
            var hasher = System.Security.Cryptography.SHA256.Create();
            var hashValue = hasher.ComputeHash(Encoding.ASCII.GetBytes(data));

            var strHex = hashValue.Aggregate("", (current, b) => current + b.ToString("x2"));
            return strHex.ToUpper();
        }

       

        public void ResponseFromPayG()
        {
            var encryData = Request.Form["EncData"];

        }
    }
}