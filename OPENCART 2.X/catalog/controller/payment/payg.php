<?php
/* Moneybrace online payment
 *
 * @version 1.1
 * @date 30/June/2016
 * @author Nagaraju Bandi <nagaraju.bandi@inducosolutions.com>
 */
class ControllerPaymentPayg extends Controller {
	
 
	
	public function index() {
		$this->language->load('payment/payg');
		$data['button_confirm'] = $this->language->get('button_confirm');
		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		if ($order_info) {
			$this->load->model('setting/setting');
			$settings= $this->model_setting_setting->getSetting('payg');
			
			if( isset($settings["paygpayment_authentication_token"]) )
			{
			
				$orderid = $this->session->data['order_id'];
				$cancelUrl = $this->url->link('payment/payg/callback');
				$successUrl = $this->url->link('payment/payg/callback');
				$islogin=($this->customer->isLogged()) ? "Y" : "N";	
				$customer_id= ($order_info['customer_id']	== 0) ? "" : $order_info['customer_id'];		
                $amount = round($order_info['total'],2); 
                $data['Amount']=$amount;
                $data["MerchantKeyId"] = trim($settings["paygpayment_merchant_id"]);
				$data['AuthenticationKey'] = trim($settings["paygpayment_authentication_key"]);
				$data['AuthenticationToken'] = trim($settings["paygpayment_authentication_token"]);
                $data['TransactionType'] =  "Charge"; 	 
                $secure_key= trim($settings["paygpayment_secure_key"]);
				$paygpayment_url = trim($settings["paygpayment_url"]); 
                $txn_details=$secure_key.'|'.$data["MerchantKeyId"] . '|' . $orderid . '|' . $data['AuthenticationKey'] . '|' . $data['AuthenticationToken'] . '|' . $data['Amount'] ;
                $data['txn_details']=hash("sha256",$txn_details);
                $data["action"] 		= $paygpayment_url; 
                $data["RequestUniqueId"] 		= $orderid; 
                $data["PaymentType"] 		= 'CC'; 
                $data["CancelRedirectUrl"] = $this->url->link('payment/payg/callback');
                $data["ResponseRedirectUrl"] = $this->url->link('payment/payg/callback');
                $data["UserName"]="";
                $data["OrderId"]=$orderid;
                $data['CustomerEmail']="rajeshm@inducsolutions.com";
                $data["error"] = "";
                    
			}else{
				$data["error"] = "Invalid Configuration";
			}
			return $this->load->view('payment/paygpayment.tpl', $data);
			//var_dump($settings);die;
		}
		
	}
	
	private function encrypt($text, $key, $type)
	{
		 
		return base64_encode($crypt);
	}
	
 
	public function callback() {
		
		$post = $this->request->post;
		
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		
		$this->load->model('setting/setting');
		$settings= $this->model_setting_setting->getSetting('avantgardepayment');
		
	 
		
		//echo "<pre>"; print_r($return_elements); exit;

		if (isset($post['OrderId'])) {
			//$order_id = trim(substr(($return_elements['txn_response']['order_no']), 6));
			$order_id = $post['OrderId'];
		} else {
			die('Illegal Access');
		}

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($order_id);

		if ($order_info) {
		    $data = array_merge($this->request->post,$this->request->get);
			foreach ($data as $key => $value) {
				${$key} = $value;
            } 
			//Payment failure
			if (!empty($post['ResponseText']) && ($post['ResponseText'] != 'Approved')) {
			    $order_status_id = $this->config->get('moneybrace_pending_status_id');
			    $this->model_checkout_order->addOrderHistory($order_id, 10, $post['ResponseText'], true);
			    //die($return_elements['txn_response']['res_message']);
				$success_url = $this->url->link('checkout/failure');
				header('Location: '.$success_url);
				exit;
			}
			//Payment success
			$status = $post['ResponseText'];
			if ($status == 'Approved' || $status == 'Approved') {
			    $order_status_id = 5;
				if (!$order_info['order_status_id'] || $order_info['order_status_id'] != $order_status_id) {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id,$post['ResponseText']);
				} else {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $post['ResponseText']);
				}
				$success_url = $this->url->link('checkout/success');
				header('Location: '.$success_url);
				exit;
			}
			
		}
		
	}
}
 

?>