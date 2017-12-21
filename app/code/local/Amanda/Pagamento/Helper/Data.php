<?php

class Amanda_Pagamento_Helper_Data extends Mage_Payment_Helper_Data {

    function recuperarGatewayPagamentoUrl() {
        return Mage::getUrl('modulopagamento/formapagamento/gatewayPagamento', array('_secure' => false));
    }
    
}
