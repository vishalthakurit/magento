<?php

class Excellence_Backgrounds_Block_Adminhtml_Backgrounds_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('backgrounds_tabs');
      $this->setDestElementId('edit_form');
   }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('backgrounds')->__('Background Image'),
          'title'     => Mage::helper('backgrounds')->__('Background Image'),
          'content'   => $this->getLayout()->createBlock('backgrounds/adminhtml_backgrounds_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
