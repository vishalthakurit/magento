<?php

class Excellence_Backgrounds_Block_Adminhtml_Backgrounds_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('backgrounds_form', array('legend'=>Mage::helper('backgrounds')->__('Background Image')));
     
        $path = Mage::getBaseUrl('media') .  'backgroundimages' . DS;

    $pic_end='';
   if(Mage::registry('backgrounds_data')->getData('filename')){
   $pic_end='<div id="backgroundImage"></div> <style type="text/css"> #backgroundImage img{ width:700px;margin-top:10px  }</style><script type="text/javascript">  document.getElementById("backgroundImage").innerHTML ="<image src='.$path.Mage::registry('backgrounds_data')->getData('filename').' >"; </script>';
   }

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('backgrounds')->__('Background Image'),
          'required'  => false,
          'name'      => 'filename',
           'tabindex' => 1,
            'class'     => 'required-entry',
          'required'  => true,
             'after_element_html' => $pic_end,
	  ));
		
        
      if ( Mage::getSingleton('adminhtml/session')->getBackgroundsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getBackgroundsData());
          Mage::getSingleton('adminhtml/session')->setBackgroundsData(null);
      } elseif ( Mage::registry('backgrounds_data') ) {
          $form->setValues(Mage::registry('backgrounds_data')->getData());
      }
      return parent::_prepareForm();
  }
}