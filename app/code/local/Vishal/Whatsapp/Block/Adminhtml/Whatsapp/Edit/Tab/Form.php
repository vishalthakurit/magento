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
 * Whatsapp edit form tab
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('whatsapp_');
        $form->setFieldNameSuffix('whatsapp');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'whatsapp_form',
            array('legend' => Mage::helper('vishal_whatsapp')->__('Whatsapp'))
        );

        $fieldset->addField(
            'mobile_phone',
            'text',
            array(
                'label' => Mage::helper('vishal_whatsapp')->__('Mobile phone'),
                'name'  => 'mobile_phone',
                'note'	=> $this->__('Introduce mobile phone number with the international country code.'),

           )
        );
        $fieldset->addField(
            'url_key',
            'text',
            array(
                'label' => Mage::helper('vishal_whatsapp')->__('Url key'),
                'name'  => 'url_key',
                'note'  => Mage::helper('vishal_whatsapp')->__('Relative to Website Base URL')
            )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('vishal_whatsapp')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('vishal_whatsapp')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('vishal_whatsapp')->__('Disabled'),
                    ),
                ),
            )
        );
        $fieldset->addField(
            'in_rss',
            'select',
            array(
                'label'  => Mage::helper('vishal_whatsapp')->__('Show in rss'),
                'name'   => 'in_rss',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('vishal_whatsapp')->__('Yes'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('vishal_whatsapp')->__('No'),
                    ),
                ),
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
            Mage::registry('current_whatsapp')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $fieldset->addField(
            'allow_comment',
            'select',
            array(
                'label' => Mage::helper('vishal_whatsapp')->__('Allow Comments'),
                'name'  => 'allow_comment',
                'values'=> Mage::getModel('vishal_whatsapp/adminhtml_source_yesnodefault')->toOptionArray()
            )
        );
        $formValues = Mage::registry('current_whatsapp')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getWhatsappData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getWhatsappData());
            Mage::getSingleton('adminhtml/session')->setWhatsappData(null);
        } elseif (Mage::registry('current_whatsapp')) {
            $formValues = array_merge($formValues, Mage::registry('current_whatsapp')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
