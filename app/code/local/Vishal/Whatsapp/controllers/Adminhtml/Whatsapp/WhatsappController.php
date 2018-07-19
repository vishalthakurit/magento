<?php
/**
 * Vishal_Whatsapp extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Vishal
 * @package        Vishal_Whatsapp
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Whatsapp admin controller
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Adminhtml_Whatsapp_WhatsappController extends Vishal_Whatsapp_Controller_Adminhtml_Whatsapp
{
    /**
     * init the whatsapp
     *
     * @access protected
     * @return Vishal_Whatsapp_Model_Whatsapp
     */
    protected function _initWhatsapp()
    {
        $whatsappId  = (int) $this->getRequest()->getParam('id');
        $whatsapp    = Mage::getModel('vishal_whatsapp/whatsapp');
        if ($whatsappId) {
            $whatsapp->load($whatsappId);
        }
        Mage::register('current_whatsapp', $whatsapp);
        return $whatsapp;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('vishal_whatsapp')->__('Whatsapp'))
             ->_title(Mage::helper('vishal_whatsapp')->__('Whatsapps'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    // public function saveScheduleAction()
    // {
    //     $data = $this->getRequest()->getParam('schedule_time');
    //     if($data){
    //         Mage::getConfig()->saveConfig('vishal_whatsapp/whatsapp_dispaly_config/vishal', $data, 'default', 0);
    //         Mage::app()->getResponse()->setBody('success');
    //     }else{
    //         Mage::app()->getResponse()->setBody('failed');    
    //     }
        
    // }

    /**
     * edit whatsapp - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $whatsappId    = $this->getRequest()->getParam('id');
        $whatsapp      = $this->_initWhatsapp();
        if ($whatsappId && !$whatsapp->getId()) {
            $this->_getSession()->addError(
                Mage::helper('vishal_whatsapp')->__('This whatsapp no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getWhatsappData(true);
        if (!empty($data)) {
            $whatsapp->setData($data);
        }
        Mage::register('whatsapp_data', $whatsapp);
        $this->loadLayout();
        $this->_title(Mage::helper('vishal_whatsapp')->__('Whatsapp'))
             ->_title(Mage::helper('vishal_whatsapp')->__('Whatsapps'));
        if ($whatsapp->getId()) {
            $this->_title($whatsapp->getMobilePhone());
        } else {
            $this->_title(Mage::helper('vishal_whatsapp')->__('Add whatsapp'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new whatsapp action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save whatsapp - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('whatsapp')) {
            try {
                $whatsapp = $this->_initWhatsapp();
                $whatsapp->addData($data);
                $whatsapp->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vishal_whatsapp')->__('Whatsapp was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $whatsapp->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setWhatsappData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vishal_whatsapp')->__('There was a problem saving the whatsapp.')
                );
                Mage::getSingleton('adminhtml/session')->setWhatsappData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vishal_whatsapp')->__('Unable to find whatsapp to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete whatsapp - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp');
                $whatsapp->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vishal_whatsapp')->__('Whatsapp was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vishal_whatsapp')->__('There was an error deleting whatsapp.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vishal_whatsapp')->__('Could not find whatsapp to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete whatsapp - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $whatsappIds = $this->getRequest()->getParam('whatsapp');
        if (!is_array($whatsappIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vishal_whatsapp')->__('Please select whatsapps to delete.')
            );
        } else {
            try {
                foreach ($whatsappIds as $whatsappId) {
                    $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp');
                    $whatsapp->setId($whatsappId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vishal_whatsapp')->__('Total of %d whatsapps were successfully deleted.', count($whatsappIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vishal_whatsapp')->__('There was an error deleting whatsapps.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $whatsappIds = $this->getRequest()->getParam('whatsapp');
        if (!is_array($whatsappIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vishal_whatsapp')->__('Please select whatsapps.')
            );
        } else {
            try {
                foreach ($whatsappIds as $whatsappId) {
                $whatsapp = Mage::getSingleton('vishal_whatsapp/whatsapp')->load($whatsappId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d whatsapps were successfully updated.', count($whatsappIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vishal_whatsapp')->__('There was an error updating whatsapps.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'whatsapp.csv';
        $content    = $this->getLayout()->createBlock('vishal_whatsapp/adminhtml_whatsapp_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'whatsapp.xls';
        $content    = $this->getLayout()->createBlock('vishal_whatsapp/adminhtml_whatsapp_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'whatsapp.xml';
        $content    = $this->getLayout()->createBlock('vishal_whatsapp/adminhtml_whatsapp_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('vishal_whatsapp/whatsapp');
    }
}
