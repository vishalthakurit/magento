<?php

class Excellence_Backgrounds_Adminhtml_BackgroundsController extends Mage_Adminhtml_Controller_action
{

	 
	public function editAction() {
            
            if (!$this->getRequest()->getParam('id')) {
                    $this->_redirect('*/*/edit', array('id' => '1'));
                    return;
            }
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('backgrounds/backgrounds')->load($id);
  
		if (!$model->getId()) {
                    $model = Mage::getModel('backgrounds/backgrounds')->setData(array('filename'=>''))->save();
                }
               
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('backgrounds_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('backgrounds/items');
  
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('backgrounds/adminhtml_backgrounds_edit'))
				->_addLeft($this->getLayout()->createBlock('backgrounds/adminhtml_backgrounds_edit_tabs'));

			$this->renderLayout();
		 
	}
 
	
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			$data['filename'] = Mage::getModel('backgrounds/backgrounds')->load($this->getRequest()->getParam('id'))->getData('filename');
			if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('filename');
					
 	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					 $uploader->setFilesDispersion(false);
							
 					$path = Mage::getBaseDir('media') . DS. 'backgroundimages' ;
					$uploader->save($path, $_FILES['filename']['name'] );
					
				} catch (Exception $e) {
                                 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;   
 		        }
  	  			$data['filename'] = $_FILES['filename']['name'];
			}
	  		 
	  			
			$model = Mage::getModel('backgrounds/backgrounds');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				 $model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('backgrounds')->__('Background Image Changed Successfully.'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
 			 
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
 				 
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('backgrounds')->__('Unable to find background image to save.'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('backgrounds/backgrounds');
				$model->setData(array('filename'=>''))
				->setId($this->getRequest()->getParam('id'));
                                 $model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Background Image Removed Successfully.'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		 $this->_redirect('*/*/edit');

	}
 
}