<?php

class Excellence_Backgrounds_Block_Adminhtml_Backgrounds_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'backgrounds';
        $this->_controller = 'adminhtml_backgrounds';
        $this->removeButton('back');

        $this->_updateButton('save', 'label', Mage::helper('backgrounds')->__('Save Background Image'));
        $this->_updateButton('delete', 'label', Mage::helper('backgrounds')->__('Remove Background Image'));
        if (!Mage::registry('backgrounds_data')->getData('filename')) {
            $this->removeButton('delete');
        }
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('backgrounds_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'backgrounds_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'backgrounds_content');
                }
            }
          ";
    }

    public function getHeaderText() {
        if (Mage::registry('backgrounds_data') && Mage::registry('backgrounds_data')->getId()) {
            return Mage::helper('backgrounds')->__("Change Background Image");
        }
    }

}
