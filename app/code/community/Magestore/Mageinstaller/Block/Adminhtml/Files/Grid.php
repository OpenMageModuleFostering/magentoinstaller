<?php

class Magestore_Mageinstaller_Block_Adminhtml_Files_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('filesGrid');
      $this->setDefaultSort('extensionfile_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('mageinstaller/file')->getCollection()
					->addFieldToFilter('extension_id',$this->getRequest()->getParam('extension_id'));
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('extensionfile_id', array(
          'header'    => Mage::helper('mageinstaller')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'extensionfile_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('mageinstaller')->__('Name'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  
      $this->addColumn('extension_id', array(
          'header'    => Mage::helper('mageinstaller')->__('Package'),
          'align'     =>'left',
          'index'     => 'extension_id',
		  'type'      => 'options',
		  'options'    => Mage::helper('mageinstaller')->getListExtension(),
      ));	  
	  
      $this->addColumn('size', array(
          'header'    => Mage::helper('mageinstaller')->__('Size'),
          'align'     =>'left',
          'index'     => 'size',
      ));		  
	  
      $this->addColumn('path', array(
          'header'    => Mage::helper('mageinstaller')->__('Path'),
          'align'     =>'left',
          'index'     => 'path',
      ));	  
	  
		$this->addExportType('*/*/exportCsv', Mage::helper('mageinstaller')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('mageinstaller')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        return $this;
    }

  public function getRowUrl($row)
  {
      return null;
  }

}