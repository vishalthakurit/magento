<?php
class Excellence_Caroussel_Block_Adminhtml_Caroussel extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_caroussel';
    $this->_blockGroup = 'caroussel';
    $this->_headerText = Mage::helper('caroussel')->__('Caroussel Manager');
     parent::__construct();
     	$this->_removeButton('add');
  }
}
