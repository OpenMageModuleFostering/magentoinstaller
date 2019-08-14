<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('mageinstaller_extension')};
CREATE TABLE {$this->getTable('mageinstaller_extension')} (
  `extension_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `total_file` smallint(6) NOT NULL default '0',
  `added_date` datetime NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('mageinstaller_extension_file')};
CREATE TABLE {$this->getTable('mageinstaller_extension_file')} (
  `extensionfile_id` int(11) unsigned NOT NULL auto_increment,
  `extension_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `path` varchar(255) NOT NULL default '',
  `size` int(11) unsigned,
  PRIMARY KEY (`extensionfile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 