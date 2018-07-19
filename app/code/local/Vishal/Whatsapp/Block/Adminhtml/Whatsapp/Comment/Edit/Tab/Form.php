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
 * Whatsapp comment edit form tab
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Comment_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Whatsapp_Whatsapp_Block_Adminhtml_Whatsapp_Comment_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $whatsapp = Mage::registry('current_whatsapp');
        $comment    = Mage::registry('current_comment');
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('comment_');
        $form->setFieldNameSuffix('comment');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'comment_form',
            array('legend'=>Mage::helper('vishal_whatsapp')->__('Comment'))
        );
        $fieldset->addField(
            'whatsapp_id',
            'hidden',
            array(
                'name'  => 'whatsapp_id',
                'after_element_html' => '<a href="'.
                    Mage::helper('adminhtml')->getUrl(
                        'adminhtml/whatsapp_whatsapp/edit',
                        array(
                            'id'=>$whatsapp->getId()
                        )
                    ).
                    '" target="_blank">'.
                    Mage::helper('vishal_whatsapp')->__('Whatsapp').
                    ' : '.$whatsapp->getMobilePhone().'</a>'
            )
        );
        $fieldset->addField(
            'title',
            'text',
            array(
                'label'    => Mage::helper('vishal_whatsapp')->__('Title'),
                'name'     => 'title',
                'required' => true,
                'class'    => 'required-entry',
            )
        );
        $fieldset->addField(
            'comment',
            'textarea',
            array(
                'label'    => Mage::helper('vishal_whatsapp')->__('Comment'),
                'name'     => 'comment',
                'required' => true,
                'class'    => 'required-entry',
            )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'    => Mage::helper('vishal_whatsapp')->__('Status'),
                'name'     => 'status',
                'required' => true,
                'class'    => 'required-entry',
                'values'   => array(
                    array(
                        'value' => Vishal_Whatsapp_Model_Whatsapp_Comment::STATUS_PENDING,
                        'label' => Mage::helper('vishal_whatsapp')->__('Pending'),
                    ),
                    array(
                        'value' => Vishal_Whatsapp_Model_Whatsapp_Comment::STATUS_APPROVED,
                        'label' => Mage::helper('vishal_whatsapp')->__('Approved'),
                    ),
                    array(
                        'value' => Vishal_Whatsapp_Model_Whatsapp_Comment::STATUS_REJECTED,
                        'label' => Mage::helper('vishal_whatsapp')->__('Rejected'),
                    ),
                ),
            )
        );
        $configuration = array(
             'label' => Mage::helper('vishal_whatsapp')->__('Poster name'),
             'name'  => 'name',
             'required'  => true,
             'class' => 'required-entry',
        );
        if ($comment->getCustomerId()) {
            $configuration['after_element_html'] = '<a href="'.
                Mage::helper('adminhtml')->getUrl(
                    'adminhtml/customer/edit',
                    array(
                        'id'=>$comment->getCustomerId()
                    )
                ).
                '" target="_blank">'.
                Mage::helper('vishal_whatsapp')->__('Customer profile').'</a>';
        }
        $fieldset->addField('name', 'text', $configuration);
        $fieldset->addField(
            'email',
            'text',
            array(
                'label' => Mage::helper('vishal_whatsapp')->__('Poster e-mail'),
                'name'  => 'email',
                'required'  => true,
                'class' => 'required-entry',
            )
        );
        $fieldset->addField(
            'customer_id',
            'hidden',
            array(
                'name'  => 'customer_id',
            )
        );
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'hidden',
                array(
                    'name'      => 'stores[]',
                    'value'     => Mage::app()->getStore(true)->getId()
                )
            );
            Mage::registry('current_comment')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $form->addValues($this->getComment()->getData());
        return parent::_prepareForm();
    }

    /**
     * get the current comment
     *
     * @access public
     * @return Vishal_Whatsapp_Model_Whatsapp_Comment
     */
    public function getComment()
    {
        return Mage::registry('current_comment');
    }
}
