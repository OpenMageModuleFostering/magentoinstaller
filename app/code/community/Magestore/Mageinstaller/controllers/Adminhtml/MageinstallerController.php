<?php

class Magestore_Mageinstaller_Adminhtml_MageinstallerController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('system/extensions')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Package Manager'), Mage::helper('adminhtml')->__('Package Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	
	public function newAction() {
		
		$this->loadLayout();
		$this->_setActiveMenu('system/extensions');
		
		$this->_addBreadcrumb(Mage::helper('adminhtml')->__('New Install'), Mage::helper('adminhtml')->__('New Install'));

		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

		$this->_addContent($this->getLayout()->createBlock('mageinstaller/adminhtml_mageinstaller_edit'))
				->_addLeft($this->getLayout()->createBlock('mageinstaller/adminhtml_mageinstaller_edit_tabs'));

		$this->renderLayout();
	}
	
	public function saveAction()
	{
		if(isset($_FILES['install_file']) && $_FILES['install_file']['name'])
		{
			$installer = Mage::getModel('mageinstaller/installer');
		
			$extract_info = $installer->install($_FILES['install_file']);
		
			if($extract_info)
			{
				Mage::getSingleton('core/session')->addSuccess('Installed Module Sucessful');
		
				$this->_redirect('*/*/index',array());
				
				return true;
		
			} else {
			
				Mage::getSingleton('core/session')->addError('Installed Module Faild');
				
				$this->_redirect('*/*/new',array());
				
				return false;
			}	
		}
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('mageinstaller/extension');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Package was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $mageinstallerIds = $this->getRequest()->getParam('mageinstaller');
        if(!is_array($mageinstallerIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Package(s)'));
        } else {
            try {
                foreach ($mageinstallerIds as $mageinstallerId) {
                    $mageinstaller = Mage::getModel('mageinstaller/extension')->load($mageinstallerId);
                    $mageinstaller->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($mageinstallerIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
  
    public function exportCsvAction()
    {
        $fileName   = 'package.csv';
        $content    = $this->getLayout()->createBlock('mageinstaller/adminhtml_mageinstaller_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'package.xml';
        $content    = $this->getLayout()->createBlock('mageinstaller/adminhtml_mageinstaller_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}