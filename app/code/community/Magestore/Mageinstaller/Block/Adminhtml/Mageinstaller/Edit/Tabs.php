<?php

class Magestore_Mageinstaller_Block_Adminhtml_Mageinstaller_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('mageinstaller_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('mageinstaller')->__('Install Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('mageinstaller')->__('Install Information'),
          'title'     => Mage::helper('mageinstaller')->__('Install Information'),
          'content'   => $this->getLayout()->createBlock('mageinstaller/adminhtml_mageinstaller_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}