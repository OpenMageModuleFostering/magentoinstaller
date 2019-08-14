<?php

class Magestore_Mageinstaller_Model_Installer {

		// File Object
	var $_file;
		//file name
	var $_filename;
		//ext file
	var $_extfile;
		//path to zipfile
	var $_filePath;
	
	public function install($install_file)
	{
			//upload file
		$this->uploadZipFile($install_file);
		
			//check file
		if(is_null($this->_file)|| is_null($this->_filePath))
		{
			Mage::getSingleton('core/session')->addError('Could not found zip/gz file');			
			
			return;
		}
			//extract file
		$extract_path = Mage::getBaseDir();
		
		switch($this->_extfile)
		{
			case 'zip':
				$zip = Mage::getModel('mageinstaller/zipper') ;
				$extract_info = $zip->advExtract($this->_filePath,$extract_path);			
				break;
				
			case 'gz':
				$gzip = Mage::getModel('mageinstaller/gzipper') ;
				$extract_info = $gzip->advExtract($this->_filePath,$extract_path);				
				break;
		}
		
		if(isset($extract_info) && count($extract_info))
		{
			$extension = Mage::getModel('mageinstaller/extension');
			$exfile = Mage::getModel('mageinstaller/file');
			
			$timestamp = Mage::getModel('core/date')->timestamp(time());
			$date = date('Y-m-d H:i:s',$timestamp);
			
			$extension->setData('title',$this->_filename);
			$extension->setData('added_date',$date);
		
		try{
			$extension->save();
			
			$total_files = 0;
			foreach($extract_info as $file_info)
			{
				if($file_info['size'] > 0)
				{		
						//save file info
					switch($this->_extfile)
					{
						case 'zip':
							$filename = $file_info['name'];			
							break;
				
						case 'gz':
							$filename = $file_info['filename'];					
							break;
					}				
					$exfile->setData('title',$this->getFileName($filename));
					$exfile->setData('path',$filename);
					$exfile->setData('size',$file_info['size']);
					$exfile->setData('extension_id',$extension->getId());
					$exfile->save();
					$exfile->setId(null);
					
					$total_files++;
				}
			}
			
			$extension->setTotalFile($total_files);
			$extension->save();
			
			return true;
			
			} catch(Exception $e) {
				Mage::getSingleton('core/session')->addError($e->getMessage());
				return false;
			}
		}
		
		return false;
	}
	
	public function uploadZipFile($zip_file)
	{	
		$path = $this->createFolder();
		
		if(! $path)
			return false;
		
		if(isset($zip_file['name']) && ($zip_file['name'] != '')) 
		{
			try {	
				$file_name = $zip_file['name'];
				
				$this->_filename = $file_name;
				
				$oFile = new Varien_File_Object($zip_file['tmp_name']);
				
				$this->_file = $oFile;
				$this->_extfile = $oFile->getExt($zip_file['name']);
				
				if($this->_extfile != 'zip' && $this->_extfile != 'gz')
				{
					Mage::getSingleton('core/session')->addError('Not zip/gz file');
					return;
				}
				
				/* Starting upload */	
				move_uploaded_file($zip_file['tmp_name'],$path . DS . $zip_file['name']);
				
				$this->_filePath = $path .DS . $file_name;
				
				return $this->_filePath;
				
			} catch(Exception $e){
			
				Mage::getSingleton('core/session')->addError($e->getMessage());
				
				return false;
			}
		}	
	}
	
	private function createFolder()
	{
		$path = Mage::getBaseDir('media') . DS . 'Mageinstaller';
		
		if(! is_dir($path))
		{
			try{
				chmod(Mage::getBaseDir('media'),755);
				
				mkdir($path);
				
				chmod($path,755);
				return $path;
				
			} catch(Exception $e){
				Mage::getSingleton('core/session')->addError($e->getMessage());
				return false;								
			}
		}
		
		return $path;
	}
	
	public function getFileName($path)
	{
		$pos = strrpos($path,'/');
		
		return substr($path,$pos+1,strlen($path));
	}
}

?>