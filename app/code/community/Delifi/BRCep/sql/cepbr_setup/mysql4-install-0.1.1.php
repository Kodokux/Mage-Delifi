<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
//"cep","cidade","logradouro","bairro","tipo","uf"

//$shell_dir = Mage::getBaseDir('var') . DS . 'cep';
//$filename = $shell_dir . DS . 'cep_br.csv';
$filename = "/tmp/cep_br.csv";

$installer->run(
  "
DROP TABLE IF EXISTS `{$installer->getTable('delifi_brcep/cep')}`;
CREATE TABLE `{$installer->getTable('delifi_brcep/cep')}` (
  `cep` char(9) NOT NULL,
  `region_id` int(10) NOT NULL,
  `cidade` char(50) DEFAULT NULL,
  `logradouro` char(70) DEFAULT NULL,
  `bairro` char(72) DEFAULT NULL,
  `tipo` char(20) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  PRIMARY KEY (`cep`),
  KEY `regionIdIdx` (`region_id`),
  KEY `cidadeIdx` (`cidade`),
  KEY `bairroIdx` (`bairro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
");
//echo "LOAD DATA INFILE \"{$filename}\" INTO TABLE {$this->getTable('delifi_brcep/cep')} FIELDS TERMINATED BY ',' ENCLOSED BY '\"' IGNORE 1 LINES (cep,cidade,logradouro,bairro,tipo,uf);";
//if (is_file($filename)) {
//
//  try {
//    $installer->run("
//      LOAD DATA INFILE \"{$filename}\" INTO TABLE {$this->getTable('delifi_brcep/cep')} FIELDS TERMINATED BY ',' ENCLOSED BY '\"' IGNORE 1 LINES (cep,cidade,logradouro,bairro,tipo,uf);");
//  } catch (Exception $e) {
//    echo 'johna : ' . $e->getMessage();
//  }
//
////  if (($handle = fopen($filename, "r")) !== FALSE) {
////    $line = 0;
////    while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
////      $num = count($data);
////      if ($num == 6) {
////        //"cep","cidade","logradouro","bairro","tipo","uf"
////        $regionModel = Mage::getModel('directory/region')->loadByCode($data[5], 'BR');
////        if ($regionModel->getId()) {
////          $insertData['cep'] = $data[0];
////          $insertData['cidade'] = $data[1];
////          $insertData['logradouro'] = $data[2];
////          $insertData['bairro'] = $data[3];
////          $insertData['tipo'] = $data[4];
////          $insertData['uf'] = $data[5];
////          $insertData['region_id'] = $regionModel->getId();
////          $cepModel = Mage::getModel('delifi_brcep/cep');
////          $cepModel->setData($insertData);
////          $cepModel->save();
////
////        }
////      }
////      $line++;
////      if ($line == 100)
////        break;
////    }
////    fclose($handle);
////  }
//}
//die;
$installer->endSetup();