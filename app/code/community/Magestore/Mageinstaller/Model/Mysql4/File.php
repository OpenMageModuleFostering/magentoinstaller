<?php

class Magestore_Mageinstaller_Model_Mysql4_File extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the mageinstaller_id refers to the key field in your database table.
        $this->_init('mageinstaller/file', 'extensionfile_id');
    }
}