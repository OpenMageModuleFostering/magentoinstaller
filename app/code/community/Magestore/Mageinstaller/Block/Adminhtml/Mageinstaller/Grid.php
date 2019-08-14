<?php

class Magestore_Mageinstaller_Block_Adminhtml_Mageinstaller_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('extensionGrid');
      $this->setDefaultSort('extension_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('mageinstaller/extension')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('extension_id', array(
          'header'    => Mage::helper('mageinstaller')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'extension_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('mageinstaller')->__('Package'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  
      $this->addColumn('total_file', array(
          'header'    => Mage::helper('mageinstaller')->__('Total Files'),
          'align'     =>'left',
          'index'     => 'total_file',
      ));	  
	  
      $this->addColumn('added_date', array(
          'header'    => Mage::helper('mageinstaller')->__('Install Date'),
          'align'     =>'left',
          'index'     => 'added_date',
		  'type'      => 'date',
      ));	  
	  
	  
       $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('mageinstaller')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('mageinstaller')->__('Files'),
                        'url'       => array('base'=> '*/adminhtml_files/index'),
                        'field'     => 'extension_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('mageinstaller')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('mageinstaller')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('extenstion_id');
        $this->getMassactionBlock()->setFormFieldName('mageinstaller');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('mageinstaller')->__('Remove'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('mageinstaller')->__('Are you sure?')
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/adminhtml_files/index', array('extension_id' => $row->getId()));
  }

}