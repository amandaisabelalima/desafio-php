<?php

class Amanda_Pagamento_Block_Form_ModuloPagamento extends Mage_Payment_Block_Form {

    protected function _construct(){
        parent::_construct();
        $this->setTemplate('modulopagamento/form/modulopagamento.phtml');
    }

}