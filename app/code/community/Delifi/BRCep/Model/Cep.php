<?php

class Delifi_BRCep_Model_Cep extends Mage_Core_Model_Abstract
{

  public function _construct()
  {
    parent::_construct();
    $this->_init('delifi_brcep/cep');
  }

}