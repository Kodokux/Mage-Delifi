<?php

class Delifi_BRCep_Block_Bairro extends Mage_Core_Block_Template
{

  public function getBairroArray()
  {
    $collection = Mage::getModel('delifi_brcep/cep')->getCollection()->addFieldToFilter('cidade', array('eq' => 'Santos'));
    /* @var $select Varien_Db_Select */
    $select = $collection->getSelect()->group('bairro');
    $conn = $collection->getConnection();
    $datas = $conn->fetchAll($select);

    $returnData = array();
    foreach ($datas as $_data) {
      if (isset($_data['bairro']) && strlen($_data['bairro']) > 0) {
        $first = $_data['bairro'][0];
        if (!isset($returnData[$first])) {
          $returnData[$first] = array();
        }
        $returnData[$first][] = $_data;
      }
    }

    return $returnData;
  }

  function getRenreUrl(array $item)
  {
    return $this->getUrl('genre/index', array('bairro' => $item['bairro'], 'uf' => $item['uf']));
  }

}