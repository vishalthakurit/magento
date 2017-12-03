<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('backgrounds')};
CREATE TABLE {$this->getTable('backgrounds')} (
  `backgrounds_id` int(11) unsigned NOT NULL auto_increment,
  `filename` varchar(255) NOT NULL default '',
   PRIMARY KEY (`backgrounds_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 