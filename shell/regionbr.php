<?php

require_once 'abstract.php';

/**
 * Magento Log Shell Script
 *
 * @category    Mage
 * @package     Mage_Shell
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Shell_Regionbr extends Mage_Shell_Abstract
{

  private $country_id = "BR";
  private $locale = "pt_BR";
  private $estado = array("Acre" => "AC",
    "Alagoas" => "AL",
    "Amapá" => "AP",
    "Amazonas" => "AM",
    "Bahia" => "BA",
    "Ceará" => "CE",
    "Distrito Federal" => "DF",
    "Espírito Santo" => "ES",
    "Goiás" => "GO",
    "Maranhão" => "MA",
    "Mato Grosso" => "MT",
    "Mato Grosso do Sul" => "MS",
    "Minas Gerais" => "MG",
    "Pará" => "PA",
    "Paraíba" => "PB",
    "Paraná" => "PR",
    "Pernambuco" => "PE",
    "Piauí" => "PI",
    "Roraima" => "RR",
    "Rondônia" => "RO",
    "Rio de Janeiro" => "RJ",
    "Rio Grande do Norte" => "RN",
    "Rio Grande do Sul" => "RS",
    "Santa Catarina" => "SC",
    "São Paulo" => "SP",
    "Sergipe" => "SE",
    "Tocantins" => "TO"
  );

  /**
   * Run script
   *
   */
  public function run()
  {

    if ($this->getArg('add')) {
      /* @var $resource Mage_Core_Model_Resource */
      $resource = Mage::getSingleton("core/resource");
      /* @var $write Varien_Db_Adapter_Pdo_Mysql */
      $write = $resource->getConnection("core_write");
      $tablename = $resource->getTableName('directory/country_region_name');
      foreach ($this->estado as $_stadosname => $_code) {
        $regionModel = Mage::getModel('directory/region')->loadByCode($_code, $this->country_id);
        if (!$regionModel->getId()) {
          $regionModel->setCountryId($this->country_id);
          $regionModel->setCode($_code);
          $regionModel->setDefaultName($_stadosname);
          $regionModel->save();
          $data['locale'] = $this->locale;
          $data['region_id'] = $regionModel->getId();
          $data['name'] = $_stadosname;
          $write->insert($tablename, $data);
        }
      }
    } elseif ($this->getArg('del')) {
      foreach ($this->estado as $_stadosname => $_code) {
        $regionModel = Mage::getModel('directory/region')->loadByCode($_code, $this->country_id);
        if ($regionModel->getRegionId()) {
          $regionModel->delete();
        }
      }
    } else {
      echo $this->usageHelp();
    }
  }

  /**
   * Retrieve Usage Help Message
   *
   */
  public function usageHelp()
  {
    return <<<USAGE
Usage:  php -f regionbr.php -- [options]
        php -f log.php -- clean --days 1

  add             add region

USAGE;
  }

}

$shell = new Mage_Shell_Regionbr();
$shell->run();