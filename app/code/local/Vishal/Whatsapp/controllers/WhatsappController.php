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
 * Whatsapp front contrller
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_WhatsappController extends Mage_Core_Controller_Front_Action
{

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
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('vishal_whatsapp/whatsapp')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('vishal_whatsapp')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'whatsapps',
                    array(
                        'label' => Mage::helper('vishal_whatsapp')->__('Whatsapps'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('vishal_whatsapp/whatsapp')->getWhatsappsUrl());
        }
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('vishal_whatsapp/whatsapp/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('vishal_whatsapp/whatsapp/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('vishal_whatsapp/whatsapp/meta_description'));
        }
        $this->renderLayout();
    }

    /**
     * init Whatsapp
     *
     * @access protected
     * @return Vishal_Whatsapp_Model_Whatsapp
     * @author Ultimate Module Creator
     */
    protected function _initWhatsapp()
    {
        $whatsappId   = $this->getRequest()->getParam('id', 0);
        $whatsapp     = Mage::getModel('vishal_whatsapp/whatsapp')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($whatsappId);
        if (!$whatsapp->getId()) {
            return false;
        } elseif (!$whatsapp->getStatus()) {
            return false;
        }
        return $whatsapp;
    }

    /**
     * view whatsapp action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $whatsapp = $this->_initWhatsapp();
        if (!$whatsapp) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_whatsapp', $whatsapp);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('whatsapp-whatsapp whatsapp-whatsapp' . $whatsapp->getId());
        }
        if (Mage::helper('vishal_whatsapp/whatsapp')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('vishal_whatsapp')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'whatsapps',
                    array(
                        'label' => Mage::helper('vishal_whatsapp')->__('Whatsapps'),
                        'link'  => Mage::helper('vishal_whatsapp/whatsapp')->getWhatsappsUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'whatsapp',
                    array(
                        'label' => $whatsapp->getMobilePhone(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $whatsapp->getWhatsappUrl());
        }
        if ($headBlock) {
            if ($whatsapp->getMetaTitle()) {
                $headBlock->setTitle($whatsapp->getMetaTitle());
            } else {
                $headBlock->setTitle($whatsapp->getMobilePhone());
            }
            $headBlock->setKeywords($whatsapp->getMetaKeywords());
            $headBlock->setDescription($whatsapp->getMetaDescription());
        }
        $this->renderLayout();
    }

    /**
     * whatsapps rss list action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function rssAction()
    {
        if (Mage::helper('vishal_whatsapp/whatsapp')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }

    /**
     * Submit new comment action
     * @access public
     * @author Ultimate Module Creator
     */
    public function commentpostAction()
    {
        $data   = $this->getRequest()->getPost();
        $whatsapp = $this->_initWhatsapp();
        $session    = Mage::getSingleton('core/session');
        if ($whatsapp) {
            if ($whatsapp->getAllowComments()) {
                if ((Mage::getSingleton('customer/session')->isLoggedIn() ||
                    Mage::getStoreConfigFlag('vishal_whatsapp/whatsapp/allow_guest_comment'))) {
                    $comment  = Mage::getModel('vishal_whatsapp/whatsapp_comment')->setData($data);
                    $validate = $comment->validate();
                    if ($validate === true) {
                        try {
                            $comment->setWhatsappId($whatsapp->getId())
                                ->setStatus(Vishal_Whatsapp_Model_Whatsapp_Comment::STATUS_PENDING)
                                ->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId())
                                ->setStores(array(Mage::app()->getStore()->getId()))
                                ->save();
                            $session->addSuccess($this->__('Your comment has been accepted for moderation.'));
                        } catch (Exception $e) {
                            $session->setWhatsappCommentData($data);
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    } else {
                        $session->setWhatsappCommentData($data);
                        if (is_array($validate)) {
                            foreach ($validate as $errorMessage) {
                                $session->addError($errorMessage);
                            }
                        } else {
                            $session->addError($this->__('Unable to post the comment.'));
                        }
                    }
                } else {
                    $session->addError($this->__('Guest comments are not allowed'));
                }
            } else {
                $session->addError($this->__('This whatsapp does not allow comments'));
            }
        }
        $this->_redirectReferer();
    }
}
