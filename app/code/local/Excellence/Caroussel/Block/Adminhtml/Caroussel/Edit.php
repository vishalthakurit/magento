<?php

class Excellence_Caroussel_Block_Adminhtml_Caroussel_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'caroussel';
        $this->_controller = 'adminhtml_caroussel';
        
        $this->_updateButton('save', 'label', Mage::helper('caroussel')->__('Save Caroussel'));
        $this->_updateButton('save', 'onclick','saveAndEdit()');
        $this->removeButton('delete');		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('caroussel_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'caroussel_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'caroussel_content');
                }
            }

            function saveAndContinueEdit(){
               
                radioSelected=true;
                for(i=1;i<6;i++){
                if($('image'+i)){
                    if($('image'+i).value || $('image'+i).up('div').down('img')){
                           if(typeof $$('.image_label'+i+':checked')[0] === 'undefined'){
                             radioSelected=false;
                        }
                    }
                }
                }
                if(radioSelected){
                     editForm.submit($('edit_form').action+'back/edit/');
                }else{
                    if($('messages').down('.error-msg')){
                    $('messages').down('.error-msg').down('ul').insert('<li><span>Select image label before saving the changes.</span></li>');
                    }else{
                    $('messages').insert({ 'after' :'<div id=".'messages'."><ul class=".'messages'."><li class=".'error-msg'."> <span>Select image label before saving the changes.</span></li> </ul></div>'});

                    }
                }
            }
            
            function saveAndEdit(){
                radioSelected=true;
                for(i=1;i<6;i++){
                if($('image'+i)){
                    if($('image'+i).value || $('image'+i).up('div').down('img')){
                           if(typeof $$('.image_label'+i+':checked')[0] === 'undefined'){
                             radioSelected=false;
                        }
                    }
                }
                }
                if(radioSelected){
                    editForm.submit();
                }else{
                    if($('messages').down('.error-msg')){
                    $('messages').down('.error-msg').down('ul').insert('<li><span>Select image label before saving the changes.</span></li>');
                    }else{
                    $('messages').insert({ 'after' :'<div id=".'messages'."><ul class=".'messages'."><li class=".'error-msg'."> <span>Select image label before saving the changes.</span></li> </ul></div>'});

                    }
                }
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('caroussel_data') && Mage::registry('caroussel_data')->getId() ) {
            return Mage::helper('caroussel')->__("Edit Caroussel '%s'", $this->htmlEscape(Mage::registry('caroussel_data')->getBrandName()));
        } else {
            return Mage::helper('caroussel')->__('Add Item');
        }
    }
}
