<?php

class Magestore_Mageinstaller_Model_Extension extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('mageinstaller/extension');
    }
	
	public function delete()
	{
		$collection = Mage::getResourceModel('mageinstaller/file_collection')
						->addFieldToFilter('extension_id',$this->getId());
		
		if(count($collection))
		{
			$root_path = Mage::getBaseDir();
			
			foreach($collection as $exfile)
			{
				if($exfile->getTotalPath() == 1)
				{
					if(file_exists($root_path . DS . $exfile->getPath()))
					{
						unlink($exfile->getPath());
					}
				}
				
				$exfile->delete();
			}
		}
		
		return parent::delete();
	}
}