<?php

class Amanda_Pagamento_Block_Info_ModuloPagamento extends Mage_Payment_Block_Info {

    protected function _prepareSpecificInformation($transport = null) {

        if (null !== $this->_paymentSpecificInformation) {
          return $this->_paymentSpecificInformation;
        }

        $data = array();

        if ($this->getInfo()->getCampoCpf()) {
          $data[Mage::helper('payment')->__('CPF')] = $this->getInfo()->getCampoCpf();
        }

        $transport = parent::_prepareSpecificInformation($transport);

        return $transport->setData(array_merge($data, $transport->getData()));
    }

}