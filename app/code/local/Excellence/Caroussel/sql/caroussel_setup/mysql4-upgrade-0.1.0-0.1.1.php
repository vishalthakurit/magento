<?php

$installer = $this;

$installer->startSetup();
    

$installer->getConnection()
        ->addColumn($installer->getTable('caroussel/caroussel'), 'new_tab', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'open link in new tab.'

        ));

  
$brands= array('1'=>'Zarpo Hotéis','2'=>'Zarpo Pacotes','3'=>'Zarpo Já','4'=>'Vale Presentes');
foreach ($brands as $key=>$val) {

        $images=serialize(array('new_tab1'=>'','new_tab2'=>'','new_tab3'=>'','new_tab4'=>'','new_tab5'=>''));
 
	$table = Mage::getSingleton('core/resource')->getTableName('caroussel');   
	$writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
	$readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
	$query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
	$results = $readAdapter->fetchAll($query);

    if ($results) {              
         $writeAdapter->update($table,array("new_tab" => $images),"brand_id=$key");
    }
}
$installer->endSetup();        //end setup