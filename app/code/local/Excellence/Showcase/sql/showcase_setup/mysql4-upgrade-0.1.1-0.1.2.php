<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('showcase')};
CREATE TABLE {$this->getTable('showcase')} (
  `showcase_id` int(11) unsigned NOT NULL auto_increment,
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL default '',
  `image_name` text NOT NULL default '',
  `tag_label` text NOT NULL default '',
   PRIMARY KEY (`showcase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
   
$brands= array('1'=>'Zarpo Showcase');
foreach ($brands as $key=>$val) {

        $images=array('image1'=>'','image2'=>'','image3'=>'','image4'=>'','image5'=>'','image6'=>'','image7'=>'','image8'=>'','image9'=>'','image10'=>'','image11'=>'','image12'=>'','image13'=>'','image14'=>'','image15'=>'','image16'=>'','image17'=>'','image18'=>'','image19'=>'','image20'=>'');
        $tag_label=array('image_link1'=>'','image_link2'=>'','image_link3'=>'','image_link4'=>'','image_link5'=>'','image_link6'=>'','image_link7'=>'','image_link8'=>'','image_link9'=>'','image_link10'=>'','image_link11'=>'','image_link12'=>'','image_link13'=>'','image_link14'=>'','image_link15'=>'','image_link16'=>'','image_link17'=>'','image_link18'=>'','image_link19'=>'','image_link20'=>'');
  $data = array();
  $data['brand_id'] = $key;
  $data['brand_name'] = $val;
  $data['image_name'] = serialize($images);
  $data['tag_label'] = serialize($tag_label);

  $table = Mage::getSingleton('core/resource')->getTableName('showcase');   
  $writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
  $readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
  $query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
  $results = $readAdapter->fetchAll($query);

    if (!$results) {              
        $writeAdapter->insert($table, $data);
    }
}
$installer->endSetup();        //end setup
?>

