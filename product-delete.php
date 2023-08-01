pro delete
<?php
set_time_limit(0);
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';
if (is_readable($autoloader)) {
    require_once $autoloader;
}
use Automattic\WooCommerce\Client;
class Var_Pro_List {
    public $woocommerce = '';
    function __construct() {
        $this->woocommerce = new Client(
            'http://192.168.0.39/wordpress/',
            'ck_0b6c4e5a6a2cab3c8d79e2481f94652d7266cde1',
            'cs_919853aaa1df1b44b6b38a7783eb2392e4f26a2a',
            [
                'wp_api' => true,
                'version' => 'wc/v3'
            ]
        );
    }
    public function var_pro_delete() {
                global $product;
//        $id = 167;
        $products_to_delete = array(170, 171, 789);
        
        $pro = $this->woocommerce->get('products');
                $id = $pro->id;
        // echo $id;die();
        foreach ($pro as $pro_d) {
            $pro_id = $pro_d->id;
            
            
            
                $get_update_pro = $this->woocommerce->delete("products/$pro_id", ['force' => true]);
                echo 'Products deleted';
                
        }
    }
}
$data = new Var_Pro_List();
$data->var_pro_delete();
/opt/lampp/htdocs/woo_api/pro-delete.php