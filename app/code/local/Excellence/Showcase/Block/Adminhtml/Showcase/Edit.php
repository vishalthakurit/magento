<?php

class Excellence_Showcase_Block_Adminhtml_Showcase_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'showcase';
        $this->_controller = 'adminhtml_showcase';
        
        $this->_updateButton('save', 'label', Mage::helper('showcase')->__('Save Showcase'));
        // $this->_updateButton('delete', 'label', Mage::helper('showcase')->__('Delete Showcase'));
        $this->_updateButton('save', 'onclick','saveAndEdit()');
        $this->removeButton('delete');
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('showcase_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'showcase_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'showcase_content');
                }
            }

            function saveAndContinueEdit(){
               
               editForm.submit();return;
               
                radioSelected=true;
                for(i=1;i<21;i++){
                if($('image'+i)){
                    if($('image'+i).value || $('image'+i).up('div').down('img')){
                           if(typeof $$(('.location_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.thematic_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.pension_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.thematic2_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.price_tags'+i+':selected')[0] === 'undefined' )){
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

                editForm.submit();return;
                
                radioSelected=true;
                for(i=1;i<21;i++){
                if($('image'+i)){
                    if($('image'+i).value || $('image'+i).up('div').down('img')){
                           if(typeof $$(('.location_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.thematic_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.pension_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.thematic2_tags'+i+':selected')[0] === 'undefined' || 
                                        ('.price_tags'+i+':selected')[0] === 'undefined' )){
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
        if( Mage::registry('showcase_data') && Mage::registry('showcase_data')->getId() ) {
            return Mage::helper('showcase')->__("Edit Showcase");
        } else {
            return Mage::helper('showcase')->__('Add Showcase');
        }
    }
}