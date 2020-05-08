<?php
class ControllerPaymentPayg extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/payg');
		$this->load->model('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			// var_dump($this->request->post);die;
			$this->model_setting_setting->editSetting('payg', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->cache->delete('payg');
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$settings= $this->model_setting_setting->getSetting('payg'); 
	//	echo "<pre>";print_r($settings);exit;
		$data['paygpayment_merchant_id'] = 
					isset($settings["paygpayment_merchant_id"])?$settings["paygpayment_merchant_id"]:'';
		$data['paygpayment_secure_key'] = 
					isset($settings["paygpayment_secure_key"])?$settings["paygpayment_secure_key"]:'';
		$data['paygpayment_authentication_key'] = 
					isset($settings["paygpayment_authentication_key"])?$settings["paygpayment_authentication_key"]:'';
		 
		$data['paygpayment_authentication_token'] = 
					isset($settings["paygpayment_authentication_token"])?$settings["paygpayment_authentication_token"]:'';
		$data['payg_status'] = 
					isset($settings["payg_status"])?$settings["payg_status"]:'';

		$data['paygpayment_url'] = 
					isset($settings["paygpayment_url"])?$settings["paygpayment_url"]:'';
		$data['paygpayment_environment'] = 
					isset($settings["paygpayment_environment"])?$settings["paygpayment_environment"]:'';
						
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_module'] = $this->language->get('text_module');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['merchant_id_title'] = $this->language->get('merchant_id_title');
		$data['merchant_secureHashKey_title'] = 'SecureHash Key'; 
		$data['authentication_key_title'] = $this->language->get('authentication_key_title');
		$data['text_paygdepayment'] = $this->language->get('text_paygdepayment');
		$data['authentication_token_title'] = $this->language->get('authentication_token_title');
		$data['paygpayment_url_title'] = $this->language->get('paygpayment_url_title');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['pg_mode'] = $this->language->get('pg_mode');
		$data['pg_enabled'] = $this->language->get('pg_enabled');
		$data['pg_disabled'] = $this->language->get('pg_disabled');
		
		/* Loading up some URLS. */
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['form_action'] = $this->url->link('payment/payg', 'token=' . $this->session->data['token'], 'SSL');

		/* Present error messages to users. */
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
					
					
		if (isset($this->request->post['paygpayment_merchant_id']))
			$data['paygpayment_merchant_id'] = $this->request->post['paygpayment_merchant_id'];
		
		if (isset($this->request->post['paygpayment_secure_key']))
			$data['paygpayment_secure_key'] = $this->request->post['paygpayment_secure_key'];
		
		if (isset($this->request->post['paygpayment_authentication_key']))
			$data['paygpayment_authentication_key'] = $this->request->post['paygpayment_authentication_key'];
		
		if (isset($this->request->post['paygpayment_authentication_token']))
			$data['paygpayment_authentication_token'] = $this->request->post['paygpayment_authentication_token'];
		
			if (isset($this->request->post['paygpayment_url']))
			$data['paygpayment_url'] = $this->request->post['paygpayment_url'];
		if (isset($this->request->post['payg_status']))
			$data['payg_status'] = $this->request->post['payg_status'];
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
	 	
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('Payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/payg', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');		
		$this->response->setOutput($this->load->view('payment/payg.tpl', $data));
		
		 
	}
	private function validate() {
		
		if (!$this->user->hasPermission('modify', 'payment/payg')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (strlen($this->request->post['paygpayment_merchant_id']) <= 1) 
			$this->error['warning'] = $this->language->get('error_merchant_id');
		
		if (strlen($this->request->post['paygpayment_secure_key']) <= 1) 
			$this->error['warning'] = $this->language->get('error_paygpayment_secure_key_error');
		
		if (strlen($this->request->post['paygpayment_authentication_key']) <= 1) 
			$this->error['warning'] = $this->language->get('error_paygpayment_authentication_key_error');
		
		if (strlen($this->request->post['paygpayment_authentication_token']) <= 1) 
			$this->error['warning'] = $this->language->get('error_paygpayment_authentication_token_error');
		
		

		if ($this->error) {
			return false;
		} else {
			return true;
		}
	}
	public function install() {  
        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'paygpayment');
        $this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'paygpayment');
    }
}
?>