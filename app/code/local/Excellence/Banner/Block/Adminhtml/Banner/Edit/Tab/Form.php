<?php

class Excellence_Banner_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('banner_form', array('legend'=>Mage::helper('banner')->__('Banner information')));
     
      

      $fieldset->addField('filename', 'image', array(
          'label'     => Mage::helper('banner')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('banner_url', 'text', array(
          'label'     => Mage::helper('banner')->__('Banner Url'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'banner_url',
      ));
      
     $fieldset->addField('alt', 'text', array(
          'label'     => Mage::helper('banner')->__('Image Alt'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'alt',
      ));
       
     $fieldset->addField('sort', 'text', array(
          'label'     => Mage::helper('banner')->__('Sort'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'sort',
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getBannerData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getBannerData());
          Mage::getSingleton('adminhtml/session')->setBannerData(null);
      } elseif ( Mage::registry('banner_data') ) {
          $form->setValues(Mage::registry('banner_data')->getData());
      }
      return parent::_prepareForm();
  }
}