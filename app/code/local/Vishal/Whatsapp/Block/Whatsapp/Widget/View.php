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
 * Whatsapp widget block
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Whatsapp_Widget_View extends Mage_Core_Block_Template implements
    Mage_Widget_Block_Interface
{
    protected $_htmlTemplate = 'vishal_whatsapp/whatsapp/widget/view.phtml';

    /**
     * Prepare a for widget
     *
     * @access protected
     * @return Vishal_Whatsapp_Block_Whatsapp_Widget_View
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        $whatsappId = $this->getData('whatsapp_id');
        if ($whatsappId) {
            $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($whatsappId);
            if ($whatsapp->getStatus()) {
                $this->setCurrentWhatsapp($whatsapp);
                $this->setTemplate($this->_htmlTemplate);
            }
        }
        return $this;
    }
}
