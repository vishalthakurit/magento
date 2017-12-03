<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('caroussel')};
CREATE TABLE {$this->getTable('caroussel')} (
  `caroussel_id` int(11) unsigned NOT NULL auto_increment,
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL default '',
  `image_name` text NOT NULL default '',
  `image_url` text NOT NULL default '',
   PRIMARY KEY (`caroussel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
   
$brands= array('1'=>'Zarpo Hotéis','2'=>'Zarpo Pacotes','3'=>'Zarpo Já','4'=>'Vale Presentes');
foreach ($brands as $key=>$val) {

        $images=array('image1'=>'','image2'=>'','image3'=>'','image4'=>'','image5'=>'');
        $image_url=array('image_link1'=>'','image_link2'=>'','image_link3'=>'','image_link4'=>'','image_link5'=>'');
	$data = array();
	$data['brand_id'] = $key;
	$data['brand_name'] = $val;
	$data['image_name'] = serialize($images);
	$data['image_url'] = serialize($image_url);

	$table = Mage::getSingleton('core/resource')->getTableName('caroussel');   
	$writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
	$readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
	$query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
	$results = $readAdapter->fetchAll($query);

    if (!$results) {              
        $writeAdapter->insert($table, $data);
    }
}
$installer->endSetup();        //end setup