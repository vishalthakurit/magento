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
 * Whatsapp admin edit form
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'vishal_whatsapp';
        $this->_controller = 'adminhtml_whatsapp';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('vishal_whatsapp')->__('Save Whatsapp')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('vishal_whatsapp')->__('Delete Whatsapp')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('vishal_whatsapp')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_whatsapp') && Mage::registry('current_whatsapp')->getId()) {
            return Mage::helper('vishal_whatsapp')->__(
                "Edit Whatsapp '%s'",
                $this->escapeHtml(Mage::registry('current_whatsapp')->getMobilePhone())
            );
        } else {
            return Mage::helper('vishal_whatsapp')->__('Add Whatsapp');
        }
    }
}
