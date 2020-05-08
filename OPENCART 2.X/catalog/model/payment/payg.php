<?php
class Modelpaymentpayg extends Model {
	public function getMethod($address, $total) {
		return array(
				'code'       => 'payg',
				'title'      => "PayG Payments",
				'terms'      => '',
				'sort_order' => $this->config->get('free_checkout_sort_order')
			);

	}
}
?>