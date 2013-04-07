<?php

class Delifi_BRCep_IndexController extends Mage_Core_Controller_Front_Action
{

  protected function _ajaxRedirectResponse()
  {
    $this->getResponse()
      ->setHeader('HTTP/1.1', '403 Session Expired')
      ->setHeader('Login-Required', 'true')
      ->sendResponse();
    return $this;
  }

  protected function _setAjaxResponse($data)
  {
    $this->getResponse()->setHeader('Content-type', 'application/x-json');
    $this->getResponse()->setBody(json_encode($data));
  }

  function loadAction()
  {
    $cep = $this->getRequest()->getQuery('cep');
    if (!empty($cep)) {
      $cepModel = Mage::getModel('delifi_brcep/cep')->load($cep);
      $this->_setAjaxResponse($cepModel->toArray());
    }
  }

}