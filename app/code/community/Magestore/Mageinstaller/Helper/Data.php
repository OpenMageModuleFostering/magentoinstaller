<?php

Class Magestore_Mageinstaller_Helper_Data extends Mage_Core_Helper_Abstract{

	public function getListExtension()
	{
		$listExtension = array();
		
		$collection = Mage::getResourceModel('mageinstaller/extension_collection');
		
		if(count($collection))
		{
			foreach($collection as $item)
			{
				$listExtension[$item->getId()] = $item->getTitle();
			}
		}
		
		return $listExtension;
	}
}

?>