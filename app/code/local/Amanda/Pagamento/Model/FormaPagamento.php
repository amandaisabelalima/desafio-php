<?php

class Amanda_Pagamento_Model_FormaPagamento extends Mage_Payment_Model_Method_Abstract {
    protected $_code  = 'modulopagamento';
    protected $_formBlockType = 'modulopagamento/form_modulopagamento';
    protected $_infoBlockType = 'modulopagamento/info_modulopagamento';

    public function assignData($data) {
        $info = $this->getInfoInstance();

        if ($data->getCampoCpf()) {
            $info->setCampoCpf($data->getCampoCpf());
        }

        return $this;
    }

    public function validate(){
        parent::validate();
        $info = $this->getInfoInstance();

        if ($info->getCampoCpf() && !$this->validaCpf($info->getCampoCpf())){
            $errorMsg = $this->_getHelper()->__("CPF inválido!");
            Mage::throwException($errorMsg);
        }

        return $this;
    }

    public function getOrderPlaceRedirectUrl(){
        return Mage::getUrl('modulopagamento/formapagamento/redirecionarTelaSucesso', array('_secure' => false)); // ELE CGAMA O CONTROLLER??
    }

    public function validaCpf($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }


}