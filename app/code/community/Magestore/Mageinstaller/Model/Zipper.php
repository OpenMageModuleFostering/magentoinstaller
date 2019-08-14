<?php

class Magestore_Mageinstaller_Model_Zipper
{
	function advExtract($zipfile,$path) 
	{
		if(file_exists($zipfile)) 
		{
			$zip = new ZipArchive;
			
			if ($zip->open($zipfile) === true) 
			{
				$extract_info = array();
				
				for($i = 0; $i < $zip->numFiles; $i++) 
				{
					$extract_info[] = $zip->statIndex($i);
				}
				
				
				if ($zip->extractTo($path) == true) 
				{
					return $extract_info;
					
				} else {
				
					Mage::getSingleton('core/session')->addError('Could not extract archive');
				
					return false;
				}
				
				$zip->close();	
				
			} else {
			
				Mage::getSingleton('core/session')->addError('Could not open archive');
				
				return false;
			}
		} else {
			
			Mage::getSingleton('core/session')->addError('Not existed archive');
			
			return false;			
		}
	}

}