Pro update
<?php
set_time_limit(0);
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';
if (is_readable($autoloader)) {
    require_once $autoloader;
}
use Automattic\WooCommerce\Client;
require 'class-database-connection.php';
class var_pro_list {
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
    public function var_pro_update() {
        $stock_quantity = 80;
        $new_regular_price = '200.00'; 
        $name = 'test product test product';
        $slug = 'test-products';
        $description = 'it is a long established fact that a reader will be distracted by the readable content of a page';
        $short_description = 'vdvdsfvjfvsdvfghdsfgsvh';
        /*$regular_price = ₹10;*/
        $pro = $this->woocommerce->get('products/');
        $data = [
            'regular_price' => $new_regular_price,
            "stock_quantity" => $stock_quantity,
            "name" => $name,
            "description" => $description,
            "slug" => $slug,
            "short_description" => $short_description,  
        ];
        foreach ($pro as $pro_d) {
            $pro_id = $pro_d->id;
            
            $get_update_pro = $this->woocommerce->put('products/' . $pro_id, $data);
            
            echo "<pre>";
            print_r($get_update_pro);
        }
    }
    /*public function var_pro_delete(){
        $id = 161;
        $pro = $this->woocommerce->get('products/');
        $data = [
            "id" =>$id,
        ]
        foreach ($pro as $pro_d) {
            $pro_id = $pro_d->id;
            
            $get_update_pro = $this->woocommerce->delete('products/$data', ['force' => true];
            
            echo "<pre>";
            print_r($get_update_pro);
        }
    }*/
}
$data = new var_pro_list();
$data->var_pro_update();
?>
