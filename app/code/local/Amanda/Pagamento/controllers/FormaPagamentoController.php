<?php

class Amanda_Pagamento_FormaPagamentoController extends Mage_Core_Controller_Front_Action {
   
    public function redirecionarTelaSucessoAction() {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'modulopagamento', array('template' => 'modulopagamento/telaSucesso.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }


    public function gatewayPagamentoAction() {

        if ($this->getRequest()->get("orderId")) {
            $orderId = $this->getRequest()->get("orderId");
            $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
            $order->setState(Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW, true, 'Payment Success.');
            $order->save();

            Mage::getSingleton('checkout/session')->unsQuoteId();
            Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array('_secure'=> false));
        } else {
            Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/error', array('_secure'=> false));
        }
    }

}