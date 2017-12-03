<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('banner')};
CREATE TABLE {$this->getTable('banner')} (
  `banner_id` int(11) unsigned NOT NULL auto_increment,
  `filename` varchar(255) NOT NULL default '',
  `banner_url` varchar(255) NOT NULL default '',
  `sort` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 