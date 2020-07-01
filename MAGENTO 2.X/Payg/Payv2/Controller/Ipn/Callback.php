<?php
/** 
 * @copyright  Payg
 */

namespace Payg\Payv2\Controller\Ipn;

use Magento\Framework\App\Config\ScopeConfigInterface;

use Magento\Framework\App\Action\Action as AppAction;

class Callback extends AppAction
{
    /**
    * @var \Payg\Payv2\Model\PaymentMethod
    */
    protected $_paymentMethod;

    /**
    * @var \Magento\Sales\Model\Order
    */
    protected $_order;

    /**
    * @var \Magento\Sales\Model\OrderFactory
    */
    protected $_orderFactory;

    /**
    * @var Magento\Sales\Model\Order\Email\Sender\OrderSender
    */
    protected $_orderSender;

    /**
    * @var \Psr\Log\LoggerInterface
    */
    protected $_logger;
	

    /**
    * @param \Magento\Framework\App\Action\Context $context
    * @param \Magento\Sales\Model\OrderFactory $orderFactory
    * @param \Payg\Payv2\Model\PaymentMethod $paymentMethod
    * @param Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender
    * @param  \Psr\Log\LoggerInterface $logger
    */
    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Sales\Model\OrderFactory $orderFactory,
    \Payg\Payv2\Model\PaymentMethod $paymentMethod,
    \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender,	
    \Psr\Log\LoggerInterface $logger
    ) {
        $this->_paymentMethod = $paymentMethod;
        $this->_orderFactory = $orderFactory;
        $this->_client = $this->_paymentMethod->getClient();
        $this->_orderSender = $orderSender;		
        $this->_logger = $logger;		
        parent::__construct($context);
    }

    /**
    * Handle POST request to Payg callback endpoint.
    */
    public function execute()
    {
        try {
            // Cryptographically verify authenticity of callback
            if($this->getRequest()->isPost())
			{				
				$this->_success();
				$this->paymentAction();
			}
			else
			{
	            $this->_logger->addError("Payg: no post back data received in callback");
				return $this->_failure();
			}
        } catch (Exception $e) {
            $this->_logger->addError("Payg: error processing callback");
            $this->_logger->addError($e->getMessage());
            return $this->_failure();
        }
		
		$this->_logger->addInfo("Payg Transaction END from Payg Payments");
    }
	
	protected function paymentAction()
	{
	 
		$post = $this->getRequest()->getPost();
		
        $txnid=$post['OrderId']; 
		$pgtxnno=$post['TransactionId'];
		$txMsg = 'Payg : '.$post['ResponseText'];
        $amount=$post['TransactionAmount'];
        $this->_loadOrder($txnid);
		if (isset($post['ResponseText']) && $post['ResponseText'] == 'Approved')
		{	
            
		    $this->_registerPaymentCapture($pgtxnno, $amount, $txMsg);
			//$this->_logger->addInfo("Payg Response Order success..".$txMsg);
			
			$redirectUrl = $this->_paymentMethod->getSuccessUrl();
			//AA Where 
			$this->_redirect($redirectUrl);
		}
		else
		{
			//$this->_order->hold()->save();			
			$enquiryurl = $this->_paymentMethod->getEnquiryUrl($txnid);
			
		 	$this->_createPaygComment($txMsg);
			$this->_order->cancel()->save();				

			//$this->_logger->addInfo("Payg Response Order cancelled ..");
			
			$this->messageManager->addError("<strong>Error:</strong> $txMsg <br/>");
			//AA where 
			$redirectUrl = $this->_paymentMethod->getCancelUrl();
			$this->_redirect($redirectUrl);
		}		
		
	}
	

	//AA - To review - required 
    protected function _registerPaymentCapture($transactionId, $amount, $message)
    {             
        $payment = $this->_order->getPayment(); 
        $payment->setTransactionId($transactionId)       
        ->setPreparedMessage($this->_createPaygComment($message))
        ->setShouldCloseParentTransaction(true)
        ->setIsTransactionClosed(0)
        ->registerCaptureNotification(
		//AA
            $amount,
            true 
        );

        $this->_order->save();

        $invoice = $payment->getCreatedInvoice();
        if ($invoice && !$this->_order->getEmailSent()) {
            $this->_orderSender->send($this->_order);
            $this->_order->addStatusHistoryComment(
                __('You notified customer about invoice #%1.', $invoice->getIncrementId())
            )->setIsCustomerNotified(
                true
            )->save();
        }
    }

	//AA Done
    protected function _loadOrder($order_id)
    {
        $this->_order = $this->_orderFactory->create()->loadByIncrementId($order_id); 
        if (!$this->_order && $this->_order->getId()) {
            throw new Exception('Could not find Magento order with id $order_id');
        }
    }

	//AA Done
    protected function _success()
    {
        $this->getResponse()
             ->setStatusHeader(200);
    }

	//AA Done
    protected function _failure()
    {
        $this->getResponse()
             ->setStatusHeader(400);
    }

    /**
    * Returns the generated comment or order status history object.
    *
    * @return string|\Magento\Sales\Model\Order\Status\History
    */
	//AA Done
    protected function _createPaygComment($message = '')
    {       
        if ($message != '')
        {
            $message = $this->_order->addStatusHistoryComment($message);
            $message->setIsCustomerNotified(null);
        }
		
        return $message;
    }
 

}
