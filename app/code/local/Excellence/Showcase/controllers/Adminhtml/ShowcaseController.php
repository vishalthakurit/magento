<?php

class Excellence_Showcase_Adminhtml_ShowcaseController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('showcase/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('showcase/showcase')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('showcase_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('showcase/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('showcase/adminhtml_showcase_edit'))
				->_addLeft($this->getLayout()->createBlock('showcase/adminhtml_showcase_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('showcase')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
//echo "<pre>"; print_r($data);die;

            $temp_img = unserialize(Mage::getModel('showcase/showcase')->load($this->getRequest()->getParam('id'))->getImageName());
            $temp_img_link = unserialize(Mage::getModel('showcase/showcase')->load($this->getRequest()->getParam('id'))->getTagLabel());
            //$temp_image_label = unserialize(Mage::getModel('showcase/showcase')->load($this->getRequest()->getParam('id'))->getImageLabel());
            //echo "<pre>"; print_r($temp_img_link);die;
            $image_label_valid = true;
            for ($i = 1; $i < 21; $i++) {
                if (isset($_FILES['image' . $i]['name']) && $_FILES['image' . $i]['name'] != '') {
                    try {
                        $uploader = new Varien_File_Uploader('image' . $i);
                        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'showcase' . DS;
                        $uploader->save($path, $_FILES['image' . $i]['name']);

                        $temp_img['image' . $i] = str_replace(' ', '_', $_FILES['image' . $i]['name']);
                        $size = getimagesize($path . $temp_img['image' . $i]);
                          // to check if image size is  960X360. 
                        if ($size[0] != '960' || $size[1] != '360') {
                            Mage::getSingleton('adminhtml/session')->addError('The image size should be exactly 960x360 pixels.');
                            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                            return;
                        }
                    } catch (Exception $e) {
                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                        return;
                    }
                } 
                else {
                    if (!isset($data['image_link' . $i])) {       //if row is deleted
                        $temp_img['image' . $i] = '';
                        $temp_image_label['image_label' . $i] = '';
                    }
                }

                // if ($temp_img['image' . $i]) {
                //     if (isset($data['image_label' . $i]) && $data['image_label' . $i] != '') {
                //         $temp_image_label['image_label' . $i] = $data['image_label' . $i];
                //     } else if (!isset($data['image_label' . $i]) && isset($data['image_link' . $i])) {
                //         $image_label_valid = false;
                //     }
                // }
                if (isset($data['image_link' . $i]) && $data['image_link' . $i] != '') {
                   $temp_img_link['image_link' . $i] = $data['image_link' . $i];
                } else {
                   //$temp_img_link['image_link' . $i] = '';
                }

                // if (isset($data['new_tab' . $i]) && $data['new_tab' . $i] != '') {
                //     $temp_imageNewTab['new_tab' . $i] = $data['new_tab' . $i];
                // } else {
                //     $temp_imageNewTab['new_tab' . $i] = '';
                // }
            }
//echo "<pre>"; print_r($data);die;
            $data['image_name'] = serialize($temp_img);
            $data['tag_label'] = serialize($temp_img_link);
            //$data['new_tab'] = serialize($temp_imageNewTab);
             //$data['image_label'] = serialize($temp_image_label);

            $model = Mage::getModel('showcase/showcase');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));
            Mage::register('showcase_data', $model);
//echo "<pre>"; print_r($data['tag_label']);die;
            // if (!$image_label_valid) {
            //     Mage::getSingleton('adminhtml/session')->addError('Select image label to save the changes.');
            //     Mage::register('showcase_data', $model);
            //     $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            //     return;
            // }

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                            ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }
                
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('showcase')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('showcase')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('showcase/showcase');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $showcaseIds = $this->getRequest()->getParam('showcase');
        if(!is_array($showcaseIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($showcaseIds as $showcaseId) {
                    $showcase = Mage::getModel('showcase/showcase')->load($showcaseId);
                    $showcase->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($showcaseIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $showcaseIds = $this->getRequest()->getParam('showcase');
        if(!is_array($showcaseIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($showcaseIds as $showcaseId) {
                    $showcase = Mage::getSingleton('showcase/showcase')
                        ->load($showcaseId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($showcaseIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'showcase.csv';
        $content    = $this->getLayout()->createBlock('showcase/adminhtml_showcase_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'showcase.xml';
        $content    = $this->getLayout()->createBlock('showcase/adminhtml_showcase_grid')
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