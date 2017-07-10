Multiadd
=====
Плагин для Shop-Script. Позволяет добавить сразу несколько товаров в корзину.

Примеры
-----
Ссылка в PHP

    $domain = 'yourdomain.com'; // необходимо указать для CLI-скриптов
    
    $absolute = true; // необходимо указать для CLI-скриптов
    
    $url = wa()->getRouteUrl('shop/cart/add', array('plugin' => 'multiadd'), $absolute, $domain);
    
Ссылка в Smarty
   
    {$wa->getUrl('shop/cart/add', ['plugin' => 'multiadd'])}
    
Отправка запроса

    <script>
    var items = [
        {
            product_id : 1,
            sku_id : 1,
            quantity : 2,
        },
        {
            product_id : 2,
            sku_id : 2,
            quantity : 1,
        },
    ],
        url = '{$wa->getUrl('shop/cart/add', ['plugin' => 'multiadd'])}';
    /**
    send request
    **/
    $.post(url, { items: items }, function(resp) {
        if(resp.status == 'ok') {
            alert('ok');
        } else {
            alert('fail');
        }
    }, 'json').fail(function(){
        alert('fail');
    });
    
    </script>