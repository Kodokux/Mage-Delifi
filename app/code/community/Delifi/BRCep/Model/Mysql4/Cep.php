<?php

class Delifi_BRCep_Model_Mysql4_Cep extends Mage_Core_Model_Mysql4_Abstract
{

  public function _construct()
  {
    $this->_init('delifi_brcep/cep', 'cep');
  }

}