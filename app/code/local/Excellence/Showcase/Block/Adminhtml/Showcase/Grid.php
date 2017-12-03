<?php

class Excellence_Showcase_Block_Adminhtml_Showcase_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('showcaseGrid');
      $this->setDefaultSort('showcase_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('showcase/showcase')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('showcase_id', array(
          'header'    => Mage::helper('showcase')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'brand_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('showcase')->__('Flash Pages'),
          'align'     =>'left',
          'index'     => 'brand_name',
      ));

   

       
    
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('showcase')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('showcase')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
    
    $this->addExportType('*/*/exportCsv', Mage::helper('showcase')->__('CSV'));
    $this->addExportType('*/*/exportXml', Mage::helper('showcase')->__('XML'));
    
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('showcase_id');
        $this->getMassactionBlock()->setFormFieldName('showcase');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('showcase')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('showcase')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('showcase/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('showcase')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('showcase')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}