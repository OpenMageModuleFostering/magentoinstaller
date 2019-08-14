<?php

class Magestore_Mageinstaller_Block_Adminhtml_Mageinstaller_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'mageinstaller';
        $this->_controller = 'adminhtml_mageinstaller';
        
        $this->_updateButton('save', 'label', Mage::helper('mageinstaller')->__('Install'));
       
		$this->_removeButton('delete');
		$this->_removeButton('reset');
		
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('mageinstaller_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'mageinstaller_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'mageinstaller_content');
                }
        ";
    }

    public function getHeaderText()
    {
        return Mage::helper('mageinstaller')->__('Mageinstaller');
    }
}