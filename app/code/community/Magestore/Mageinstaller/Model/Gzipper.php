<?php

include(Mage::getBaseDir('lib') . DS .'PEAR'. DS .'Archive_Tar.php');

class Magestore_Mageinstaller_Model_Gzipper
{
	function advExtract($install_file,$path)
	{
		if(file_exists($install_file)) 
		{
			$gzip = new Archive_Tar($install_file,'gz');

			$gzip->extract($path);
			
			return $gzip->listContent();
	
		} else {
			
			Mage::getSingleton('core/session')->addError('Not existed archive');
			
			return false;			
		}		
	}

}