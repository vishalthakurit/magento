<?php

class Excellence_Banner_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('bannerGrid');
      $this->setDefaultSort('banner_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('banner/banner')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('banner_id', array(
          'header'    => Mage::helper('banner')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'banner_id',
      ));

      $this->addColumn('banner_url', array(
          'header'    => Mage::helper('banner')->__('Banner Url'),
          'align'     =>'left',
      	  'width'     => '400px',
          'index'     => 'banner_url',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('banner')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */
		$this->addColumn('alt', array(
          'header'    => Mage::helper('banner')->__('Image Alt'),
          'align'     =>'left',
          'index'     => 'alt',
       	  'width'	  => '350px',
      	));	
       
       $this->addColumn('sort', array(
          'header'    => Mage::helper('banner')->__('Sort'),
          'align'     =>'left',
          'index'     => 'sort',
       	  'width'	  => '50px',
      ));
      
     /* $this->addColumn('status', array(
          'header'    => Mage::helper('banner')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
       
		
		$this->addExportType('*/*/exportCsv', Mage::helper('banner')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('banner')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('banner')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('banner')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('banner/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('banner')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('banner')->__('Status'),
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