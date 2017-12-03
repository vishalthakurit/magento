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
  `image_url` text NOT NULL default '',
   PRIMARY KEY (`showcase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
   
$brands= array('1'=>'Zarpo Showcase');
foreach ($brands as $key=>$val) {

        $images=array('image1'=>'','image2'=>'','image3'=>'','image4'=>'','image5'=>'','image6'=>'','image7'=>'','image8'=>'','image9'=>'','image10'=>'','image11'=>'','image12'=>'','image13'=>'','image14'=>'','image15'=>'','image16'=>'','image17'=>'','image18'=>'','image19'=>'','image20'=>'');
        $image_url=array('image_link1'=>'','image_link2'=>'','image_link3'=>'','image_link4'=>'','image_link5'=>'','image_link6'=>'','image_link7'=>'','image_link8'=>'','image_link9'=>'','image_link10'=>'','image_link11'=>'','image_link12'=>'','image_link13'=>'','image_link14'=>'','image_link15'=>'','image_link16'=>'','image_link17'=>'','image_link18'=>'','image_link19'=>'','image_link20'=>'');
  $data = array();
  $data['brand_id'] = $key;
  $data['brand_name'] = $val;
  $data['image_name'] = serialize($images);
  $data['image_url'] = serialize($image_url);

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




// ********************



$installer = $this;

$installer->startSetup();
    

$installer->getConnection()
        ->addColumn($installer->getTable('showcase/showcase'), 'new_tab', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'open link in new tab.'

        ));

  
$brands= array('1'=>'Zarpo Showcase');
foreach ($brands as $key=>$val) {

        $images=serialize(array('new_tab1'=>'','new_tab2'=>'','new_tab3'=>'','new_tab4'=>'','new_tab5'=>'','new_tab6'=>'','new_tab7'=>'','new_tab8'=>'','new_tab9'=>'','new_tab10'=>'','new_tab11'=>'','new_tab12'=>'','new_tab13'=>'','new_tab14'=>'','new_tab15'=>'','new_tab16'=>'','new_tab17'=>'','new_tab18'=>'','new_tab19'=>'','new_tab20'=>''));
 
  $table = Mage::getSingleton('core/resource')->getTableName('showcase');   
  $writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
  $readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
  $query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
  $results = $readAdapter->fetchAll($query);

    if ($results) {              
         $writeAdapter->update($table,array("new_tab" => $images),"brand_id=$key");
    }
}
$installer->endSetup();        //end setup


// ******************************


$installer = $this;

$installer->startSetup();
    

$installer->getConnection()
        ->addColumn($installer->getTable('showcase/showcase'), 'image_label', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => ' different label image option to any carousel picture.'

        ));

  
$brands= array('1'=>'Zarpo Showcase');
foreach ($brands as $key=>$val) {

        $images=serialize(array('image_label1'=>'','image_label2'=>'','image_label3'=>'','image_label4'=>'','image_label5'=>'','image_label6'=>'','image_label7'=>'','image_label8'=>'','image_label9'=>'','image_label10'=>'','image_label11'=>'','image_label12'=>'','image_label13'=>'','image_label14'=>'','image_label15'=>'','image_label16'=>'','image_label17'=>'','image_label18'=>'','image_label19'=>'','image_label20'=>''));
 
  $table = Mage::getSingleton('core/resource')->getTableName('showcase');   
  $writeAdapter = Mage::getSingleton('core/resource')->getConnection('core_write');
  $readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
  $query = 'SELECT * FROM ' . $table . ' where brand_id = "' . $key . '"';
  $results = $readAdapter->fetchAll($query);

    if ($results) {              
         $writeAdapter->update($table,array("image_label" => $images),"brand_id=$key");
    }
}
$installer->endSetup();        //end setup