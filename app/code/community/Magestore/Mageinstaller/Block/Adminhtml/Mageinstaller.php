<?php
class Magestore_Mageinstaller_Block_Adminhtml_Mageinstaller extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_mageinstaller';
    $this->_blockGroup = 'mageinstaller';
    $this->_headerText = Mage::helper('mageinstaller')->__('Package Manager');
	
    parent::__construct();
    
	$this->_updateButton('add', 'label', Mage::helper('mageinstaller')->__('New Install'));
       	
  }
}