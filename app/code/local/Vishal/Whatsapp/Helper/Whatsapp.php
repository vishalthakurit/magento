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
 * Whatsapp helper
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Helper_Whatsapp extends Mage_Core_Helper_Abstract
{

    /**
     * get the url to the whatsapps list page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getWhatsappsUrl()
    {
        if ($listKey = Mage::getStoreConfig('vishal_whatsapp/whatsapp/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('vishal_whatsapp/whatsapp/index');
    }

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('vishal_whatsapp/whatsapp/breadcrumbs');
    }

    /**
     * check if the rss for whatsapp is enabled
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function isRssEnabled()
    {
        return  Mage::getStoreConfigFlag('rss/config/active') &&
            Mage::getStoreConfigFlag('vishal_whatsapp/whatsapp/rss');
    }

    /**
     * get the link to the whatsapp rss list
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRssUrl()
    {
        return Mage::getUrl('vishal_whatsapp/whatsapp/rss');
    }
}
