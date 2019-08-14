<?php

class Magestore_Mageinstaller_Model_File extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('mageinstaller/file');
    }
	
	public function getTotalPath()
	{
		if(! $this->getPath())
			return 0;
		
		$collection = $this->getCollection()
							->addFieldToFilter('path',$this->getPath());
		
		return count($collection);
	}
}