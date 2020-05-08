<?php

namespace Payg\Payv2\Model\Adminhtml\Source;

use Magento\Payment\Model\Method\AbstractMethod;

class Txntype implements \Magento\Framework\Option\ArrayInterface
{
	public function toOptionArray()
	{
		return array(
				array('value' => 'Charge','label' => 'Charge'),
				array('value' => 'Refund','label' => 'Refund')
				);
	}
}