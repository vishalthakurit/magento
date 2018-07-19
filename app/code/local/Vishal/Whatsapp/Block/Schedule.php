<?php

class Vishal_Whatsapp_Block_Schedule extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $magentoOptions;

    public function __construct()
    {
        //create columns
        $this->addColumn('magento', array(
            'label' => Mage::helper('adminhtml')->__('Magento colour attribute'),
            'size' => 28,
        ));
        // $this->addColumn('hex', array(
        //     'label' => Mage::helper('adminhtml')->__('Hex code'),
        //     'size' => 28
        // ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add linked attribute');

        parent::__construct();
        $this->setTemplate('vishal/whatsapp/schedule.phtml');

        // custom options, from 'color' attribute
        // $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'color');
        // if ($attribute->usesSource()) {
        //     $magentoAttributes = $attribute->getSource()->getAllOptions(false);
        // }

        // $this->magentoOptions = array();
        // foreach ($magentoAttributes as $att => $innerArray) {
        //     $this->magentoOptions[$innerArray['value']] = $innerArray['label'];
        // }
         //asort($this->magentoOptions); // sort labels alphabetically
    }

    // protected function _renderCellTemplate($columnName)
    // {
    //     if (empty($this->_columns[$columnName])) {
    //         throw new Exception('Wrong column name specified.');
    //     }
    //     $column = $this->_columns[$columnName];
    //     $inputName = $this->getElement()->getName() . '[#{_id}][' . $columnName . ']';

    //     if ($columnName == 'magento') {
    //         $rendered = '<select name="' . $inputName . '">';
    //         foreach ($this->magentoOptions as $att => $name) {
    //             $rendered .= '<option value="' . $att . '">' . $name . '</option>';
    //         }
    //         $rendered .= '</select>';
    //     } else {
    //         return '<input type="text" name="' . $inputName . '" value="#{' . $columnName . '}" ' . ($column['size'] ? 'size="' . $column['size'] . '"' : '') . '/>';
    //     }

    //     return $rendered;
    // }
}