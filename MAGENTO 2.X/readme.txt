PayG Payment Extension for Magento
This extension provides non seamless integration with Magento, allowing payments for merchants from their Customer.

Installation
 

Go to "app" folder
create code folder if does not exist
upload PayG  folder in app->code folder. 


Run from magento root folder. 

bin/magento module:enable Payg_Payv2
bin/magento setup:upgrade

You can check if the module has been installed using bin/magento module:status

You should be able to see Payg_Payv2 in the module list

Go to Admin -> Stores -> Configuration -> Payment Method -> PayG to configure PayG

If you do not see PayG in your gateway list, please clear your Magento Cache from your admin panel (System -> Cache Management).


Click on PayG and do the following:

Add your MerchantKey Id
Add your Authentication Key
Add your Authentication Token
Add Your SecureHashKey 
Save the plugin settings