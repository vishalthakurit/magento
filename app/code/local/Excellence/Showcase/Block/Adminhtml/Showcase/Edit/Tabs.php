<?php

class Excellence_Showcase_Block_Adminhtml_Showcase_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('showcase_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('showcase')->__('Showcase Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('showcase')->__('Showcase Information'),
          'title'     => Mage::helper('showcase')->__('Showcase Information'),
          'content'   => $this->getLayout()->createBlock('showcase/adminhtml_showcase')->setTemplate('showcase/showcase.phtml')->toHtml(),
          // 'content'   => $this->getLayout()->createBlock('showcase/adminhtml_showcase_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}