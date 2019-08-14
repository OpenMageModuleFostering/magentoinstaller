<?php
class Magestore_Mageinstaller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/mageinstaller?id=15 
    	 *  or
    	 * http://site.com/mageinstaller/id/15 	
    	 */
    	/* 
		$mageinstaller_id = $this->getRequest()->getParam('id');

  		if($mageinstaller_id != null && $mageinstaller_id != '')	{
			$mageinstaller = Mage::getModel('mageinstaller/mageinstaller')->load($mageinstaller_id)->getData();
		} else {
			$mageinstaller = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($mageinstaller == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$mageinstallerTable = $resource->getTableName('mageinstaller');
			
			$select = $read->select()
			   ->from($mageinstallerTable,array('mageinstaller_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$mageinstaller = $read->fetchRow($select);
		}
		Mage::register('mageinstaller', $mageinstaller);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}