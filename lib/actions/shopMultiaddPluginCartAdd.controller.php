<?php


class shopMultiaddPluginCartAddController extends waJsonController
{

    public function execute()
    {

        $code = waRequest::cookie('shop_cart');
        if (!$code) {
            $code = md5(uniqid(time(), true));
            // header for IE
            wa()->getResponse()->addHeader('P3P', 'CP="NOI ADM DEV COM NAV OUR STP"');
            // set cart cookie
            wa()->getResponse()->setCookie('shop_cart', $code, time() + 30 * 86400, null, '', false, true);
        }
        $cart = new shopCart($code);
        $product_sku_model = new shopProductSkusModel();

        $items = waRequest::post('items', array(), waRequest::TYPE_ARRAY);

        foreach ($items as $i) {

            $sku = $product_sku_model
                ->where('id=? AND product_id=?', ifempty($i['sku_id']), ifempty($i['product_id']))
                ->fetch();

            if(!$sku) {
                continue;
            }
            $item = array(
                'type' => 'product',
                'product_id' => $i['product_id'],
                'sku_id' => $i['sku_id'],
                'quantity' => ifempty($i['quantity'], 1),
            );
            $cart->addItem($item);
        }
        $this->response = array(
            'total' => $cart->total(),
            'count' => $cart->count(),
        );
    }
}