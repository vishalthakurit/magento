<?php

$installer = $this;

$installer->startSetup();

$installer->run("
		ALTER TABLE {$this->getTable('banner')} add  alt varchar(255);
		
		");

$installer->endSetup();