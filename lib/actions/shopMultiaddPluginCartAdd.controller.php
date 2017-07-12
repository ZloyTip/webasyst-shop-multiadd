<?php


class shopMultiaddPluginCartAddController extends waJsonController
{

    public function execute()
    {
        $cartAdd = new shopFrontendCartAddController();

        $items = waRequest::post('items', array(), waRequest::TYPE_ARRAY);

        foreach ($items as $i) {
            $_POST = $i;
            $cartAdd->execute();
        }
        $cart = new shopCart();
        $this->response = array(
            'total' => $cart->total(),
            'count' => $cart->count(),
        );
    }
}