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
 * Whatsapp default helper
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * convert array to options
     *
     * @access public
     * @param $options
     * @return array
     * @author Ultimate Module Creator
     */

    const MODE_HIDE_BY_DEFAULT = 'hide';
    const MODE_SHOW_BY_DEFAULT = 'show';
    const USE_DEFAULT = -2;
    const USE_NONE = -1;
    const LABEL_DEFAULT = '[ USE DEFAULT ]';
    const LABEL_NONE = '[ NONE ]';
    
    protected $_groups;

    public function getGroups()
    {
        if (is_null($this->_groups)) {
            $this->_groups = Mage::getResourceModel('customer/group_collection')->load();
        }
        return $this->_groups;
    }

    public function convertOptions($options)
    {
        $converted = array();
        foreach ($options as $option) {
            if (isset($option['value']) && !is_array($option['value']) &&
                isset($option['label']) && !is_array($option['label'])) {
                $converted[$option['value']] = $option['label'];
            }
        }
        return $converted;
    }
}
