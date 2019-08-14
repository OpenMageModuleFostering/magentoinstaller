<?php

class Magestore_Mageinstaller_Block_Adminhtml_Mageinstaller_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('mageinstaller_form', array('legend'=>Mage::helper('mageinstaller')->__('Install information')));
     

      $fieldset->addField('install_file', 'file', array(
          'label'     => Mage::helper('mageinstaller')->__('Install File'),
          'required'  => true,
          'name'      => 'install_file',
	  ));
		
      return parent::_prepareForm();
  }
}