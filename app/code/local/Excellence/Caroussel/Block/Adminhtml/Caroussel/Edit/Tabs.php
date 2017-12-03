<?php

class Excellence_Caroussel_Block_Adminhtml_Caroussel_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('caroussel_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('caroussel')->__('Caroussel Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('caroussel')->__('Caroussel Information'),
          'title'     => Mage::helper('caroussel')->__('Caroussel Information'),
          'content'   => $this->getLayout()->createBlock('caroussel/adminhtml_caroussel')->setTemplate('caroussel/caroussel.phtml')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
