<?php
class Magestore_Mageinstaller_Block_Adminhtml_Files extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_files';
    $this->_blockGroup = 'mageinstaller';
    $this->_headerText = Mage::helper('mageinstaller')->__('Files Information');
    parent::__construct();
	$this->_removeButton('add');
    
	$this->_addButton('back', array(
            'label'     => Mage::helper('adminhtml')->__('BACK'),
            'onclick'   => 'location.href=\''. $this->getUrl('mageinstaller/adminhtml_mageinstaller/index',array()) . "'",
            'class'     => 'back',
        ), -100);	
  }
}