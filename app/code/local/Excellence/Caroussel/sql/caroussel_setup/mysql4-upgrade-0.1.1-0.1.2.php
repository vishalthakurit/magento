<?php

$installer = $this;

$installer->startSetup();
    

$installer->getConnection()
        ->addColumn($installer->getTable('caroussel/caroussel'), 'image_label', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => ' different label image option to any carousel picture.'

        ));

  
$brands= array('1'=>'Zarpo Hotéis','2'=>'Zarpo Pacotes','3'=>'Zarpo Já','4'=>'Vale Presentes');
foreach ($brands as $key=>$val) {

        $images=serialize(array('image_label1'=>'','image_label2'=>'','image_label3'=>'','image_label4'=>'','image_label5'=>''));
 
	$table = Mage::getSingleton('core/resource')->getTableName('caroussel');   
	$writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
	$readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
	$query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
	$results = $readAdapter->fetchAll($query);

    if ($results) {              
         $writeAdapter->update($table,array("image_label" => $images),"brand_id=$key");
    }
}
$installer->endSetup();        //end setup