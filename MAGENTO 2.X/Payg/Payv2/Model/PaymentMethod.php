<?php
/** 
 *
 * @copyright  Payg
 */

namespace Payg\Payv2\Model;

use Magento\Sales\Model\Order\Payment;
use Magento\Sales\Model\Order\Payment\Transaction;

class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod
{
    protected $_code = 'Payg';
    protected $_isInitializeNeeded = true;

    /**
    * @var \Magento\Framework\Exception\LocalizedExceptionFactory
    */
    protected $_exception;

    /**
    * @var \Magento\Sales\Api\TransactionRepositoryInterface
    */
    protected $_transactionRepository;

    /**
    * @var Transaction\BuilderInterface
    */
    protected $_transactionBuilder;

    /**
    * @var \Magento\Framework\UrlInterface
    */
    protected $_urlBuilder;

    /**
    * @var \Magento\Sales\Model\OrderFactory
    */
    protected $_orderFactory;

    /**
    * @var \Magento\Store\Model\StoreManagerInterface
    */
    protected $_storeManager;

    /**
    * @param \Magento\Framework\UrlInterface $urlBuilder
    * @param \Magento\Framework\Exception\LocalizedExceptionFactory $exception
    * @param \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepository
    * @param Transaction\BuilderInterface $transactionBuilder
    * @param \Magento\Sales\Model\OrderFactory $orderFactory
    * @param \Magento\Store\Model\StoreManagerInterface $storeManager
    * @param \Magento\Framework\Model\Context $context
    * @param \Magento\Framework\Registry $registry
    * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
    * @param \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory
    * @param \Magento\Payment\Helper\Data $paymentData
    * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    * @param \Magento\Payment\Model\Method\Logger $logger
    * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
    * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
    * @param array $data
    */
    public function __construct(
      \Magento\Framework\UrlInterface $urlBuilder,
      \Magento\Framework\Exception\LocalizedExceptionFactory $exception,
      \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepository,
      \Magento\Sales\Model\Order\Payment\Transaction\BuilderInterface $transactionBuilder,
      \Magento\Sales\Model\OrderFactory $orderFactory,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      \Magento\Framework\Model\Context $context,
      \Magento\Framework\Registry $registry,
      \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
      \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
      \Magento\Payment\Helper\Data $paymentData,
      \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      \Magento\Payment\Model\Method\Logger $logger,
      \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
      \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
      array $data = []
    ) {
      $this->_urlBuilder = $urlBuilder;
      $this->_exception = $exception;
      $this->_transactionRepository = $transactionRepository;
      $this->_transactionBuilder = $transactionBuilder;
      $this->_orderFactory = $orderFactory;
      $this->_storeManager = $storeManager;

      parent::__construct(
          $context,
          $registry,
          $extensionFactory,
          $customAttributeFactory,
          $paymentData,
          $scopeConfig,
          $logger,
          $resource,
          $resourceCollection,
          $data
      );
    }

    /**
     * Instantiate state and set it to state object.
     *
     * @param string                        $paymentAction
     * @param \Magento\Framework\DataObject $stateObject
     */
    public function initialize($paymentAction, $stateObject)
    {
        $payment = $this->getInfoInstance();
        $order = $payment->getOrder();
        $order->setCanSendNewEmailFlag(false);

        $stateObject->setState(\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT);
        $stateObject->setStatus('pending_payment');
        $stateObject->setIsNotified(false);
    }

	
	public function encrypt($text)
	{
	    return hash("sha256",$text);
	}
	
 

	
	public function getPostHTML($order, $storeId = null)
    {
		
		//$this->_logger->addError("Generate HTML");
        $SecureKey = $this->getConfigData('SecureKey');
        $Paygpayment_domain_url = $this->getConfigData('paygurl'); 
		$returnUrl = self::getReturnUrl();
		$notifyUrl = self::getNotifyUrl(); 
		$txnid = $order->getIncrementId();	
		
		$currency = $order->getOrderCurrencyCode();
		$shippingAddress = $order->getShippingAddress();
		$firstName = $shippingAddress->getFirstname();
		$lastName = $shippingAddress->getLastname();
		$email = $shippingAddress->getEmail();
		$street = '';
		$starr = $shippingAddress->getStreet();
		if (isset($starr[0]))
		{
			$street = $starr[0];
		}
		$city = $shippingAddress->getCity();
		$postcode = $shippingAddress->getPostcode();
		$region = $shippingAddress->getRegion();
		$country = $shippingAddress->getCountry();
        $telephone = $shippingAddress->getTelephone(); 
        
        $data['MerchantKeyId'] = $this->getConfigData('MerchantKeyId');
		$data['AuthenticationKey'] = $this->getConfigData('AuthenticationKey');
        $data['AuthenticationToken'] = $this->getConfigData('AuthenticationToken');        
        //$TransactionType = ($this->getConfigData('TransactionType') == 'Charge') ? 'Charge' : 'Refund'; 
        $data['TransactionType'] = 'Charge';
        $data['Amount'] = $order->getGrandTotal();	
         $txn_details=$SecureKey.'|'.$data["MerchantKeyId"] . '|' . $txnid . '|' . $data['AuthenticationKey'] . '|' . $data['AuthenticationToken'] . '|' . $data['Amount'] ;
        $data['HashData']=hash("sha256",$txn_details); 
        $data["RequestUniqueId"] 		= $txnid; 
        $data["PaymentType"] 		= 'CC'; 
        $data["CancelRedirectUrl"] = $returnUrl;
        $data["ResponseRedirectUrl"] = $returnUrl;
        $data["UserName"]=$firstName." ".$lastName;
        $data["OrderId"]=$txnid;
        $data['CustomerEmail']=$email;
        $data["IntegrationType"] = "0";
        $data["RequestDateTime"]=date("Y-m-d H:i:s");
        
		$form = "<form id='PGForm' name='Payg_checkout' method='POST' class='Payg_checkout' action='".$Paygpayment_domain_url."'>";
		foreach($data as $key => $val)
		{
			$form.= $this->addHiddenField(array('name'=>$key, 'value'=>$val));
		}
		$form.= '</form>';
		
		$html = '<html><body>';
		$html.= $form;
		$html.=  "<script type='text/javascript'>document.getElementById('PGForm').submit();</script>";
		$html.= '</body></html>'; 
		$this->_logger->addError(" Generated HTML ".$html);
		
		$this->_logger->addError("Generated  checkout for order $txnid");
		
		return $html;
    }

    public function getOrderPlaceRedirectUrl($storeId = null)
    {
        return $this->_getUrl('Payg/start', $storeId);
    }

	protected function addHiddenField($arr)
	{
		$nm = $arr['name'];
		$vl = $arr['value'];	
		$input = "<input name='".$nm."' type='hidden' value='".$vl."' />";	
		
		return $input;
	}
	
    /**
     * Get return URL.
     *
     * @param int|null $storeId
     *
     * @return string
     */
	 //AA may not be required
    public function getSuccessUrl($storeId = null)
    {
        return $this->_getUrl('Payg/checkout/success', $storeId);
    }

	/**
     * Get notify (IPN) URL.
     *
     * @param int|null $storeId
     *
     * @return string
     */
	 //AA Done
    public function getReturnUrl($storeId = null)
    {
        return $this->_getUrl('Payg/ipn/callback', $storeId, false);
    }
	
    /**
     * Get notify (IPN) URL.
     *
     * @param int|null $storeId
     *
     * @return string
     */
	 //AA Done
    public function getNotifyUrl($storeId = null)
    {
        return $this->_getUrl('Payg/ipn/callback', $storeId, false);
    }

    /**
     * Get cancel URL.
     *
     * @param int|null $storeId
     *
     * @return string
     */
	 //AA Not required
    public function getCancelUrl($storeId = null)
    {
        return $this->_getUrl('Payg/onepage/failure', $storeId);
    }

	/**
     * Get cancel URL.
     *
     * @param int|null $storeId
     *
     * @return string
     */
	 //AA Done
    public function getEnquirylUrl($txnid, $storeId = null)
    {
        return $this->_getUrl('Payg/checkout/enquiry', $storeId).'/txnid/'.$txnid;
    }
	
    /**
     * Build URL for store.
     *
     * @param string    $path
     * @param int       $storeId
     * @param bool|null $secure
     *
     * @return string
     */
	 //AA Done
    protected function _getUrl($path, $storeId, $secure = null)
    {
        $store = $this->_storeManager->getStore($storeId);

        return $this->_urlBuilder->getUrl(
            $path,
            ['_store' => $store, '_secure' => $secure === null ? $store->isCurrentlySecure() : $secure]
        );
    }
}
