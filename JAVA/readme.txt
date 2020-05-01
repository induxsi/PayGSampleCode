Steps to run Java Code
	-Download the Java code from repository
	-Create an Java Web Project
	-Copy this 4 files index.jsp,sendRequest.jsp,MerchantSuccess.jsp,MerchantFailure.jsp from src to Java src\WebContent Directory
	-run the application 
	
To make the payment request secure, we have  included the following parameters:
 
1.	MerchantKeyId
2.	AuthenticationKey
3.	AuthenticationToken
4.  EncryptionKey
5.  SecureHashKey
	
PayG 
index.jsp -- PayG request form with all request Parameters
sendRequest.jsp --  it will collect the posted request parameters from index.jsp and Has the data using SHA256 and auto post values to PayG Gateway.
```java

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

This above code is used for hash data 

MerchantSuccess.jsp -- Once the Transaction is success it will redirect to MerchantSuccess.jsp( This parameter is part of the request form i.e index.jsp) and show the transaction details
MechantFailure.jsp -- if the Transaction fails it will redirect to MerchantFailure.jsp( This parameter is part of the request form i.e index.jsp) and show the transaction details


