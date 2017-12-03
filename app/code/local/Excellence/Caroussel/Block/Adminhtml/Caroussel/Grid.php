<?php

class Excellence_Caroussel_Block_Adminhtml_Caroussel_Grid extends Mage_Adminhtml_Block_Widget_Grid
{    
  public function __construct()
  {
      parent::__construct();
      $this->setId('carousselGrid');
      $this->setDefaultSort('caroussel_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('caroussel/caroussel')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('brand_id', array(
          'header'    => Mage::helper('caroussel')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'brand_id',
      ));

      $this->addColumn('brand_name', array(
          'header'    => Mage::helper('caroussel')->__('Flash Pages'),
          'align'     =>'left',
          'index'     => 'brand_name',
      ));

	 

       
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('caroussel')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('caroussel')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('caroussel')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('caroussel')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('caroussel_id');
        $this->getMassactionBlock()->setFormFieldName('caroussel');

       

        $statuses = Mage::getSingleton('caroussel/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('caroussel')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('caroussel')->__('Status'),
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
