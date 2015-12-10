<?php

class Creare_CardOnly_Model_Observer
{
	public function cardOnly(Varien_Event_Observer $observer)
	{
		$event           = $observer->getEvent();
        $method          = $event->getMethodInstance();
        $result          = $event->getResult();
		$cardonly		 = false;
		$restrict		 = array('mobilpay_cc');
		
		foreach (Mage::getSingleton('checkout/cart')->getQuote()->getAllVisibleItems() as $item)
		{
			if($item->getProduct()->getCardOnly()){
				$cardonly = true;	
			}
		}

		if(in_array($method->getCode(), $restrict) && $cardonly){
			$result->isAvailable = false;
		}
		
	}
}