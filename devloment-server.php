<?php 
set_time_limit(0);


$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}
use Automattic\WooCommerce\Client;
require 'class-database-connection.php';
class devloment_server
{
	public $woocommerce = '';
	public $get_products = '';
	function __construct()
	{
		
		require __DIR__ . '/vendor/autoload.php';

		$this->woocommerce = new Client(
		    'http://192.168.0.28/finbud/',
		    'ck_ffd58a87aad057fe37b29a59ecc196236d4ccf25',
		    'cs_2edc49fe30cc3693c6cde2f7054e8624965e9589', 
		    [
		        'wp_api' => true,
		        'version' => 'wc/v3'
		    ]
		);

	}
	public function get_product_list(){

		$find_sku = "BCTU004";
		$stock = 1;
		$size = 'S';
		$color_code = 16;	
		$get_products = $this->woocommerce->get('products');
		if(!empty($get_products)){
			$res_arr = array();
			foreach ($get_products as $pro_d) {
				$pro_sku = $pro_d->sku;
				if( strpos( $pro_sku, $find_sku ) !== false) { 
					$variation_sku = $pro_sku.'__'.$size.'__'.$color_code;
					$response = $this->update_variation_data($pro_d->id, $stock, $variation_sku);
					
					if(!empty($response)): array_push($res_arr, $response); endif;
				}
			}
			if(!empty($res_arr)):
				$result = array('status'=>200, 'msg' => 'Products updated successfully.', 'response' => $res_arr);
			else:
				$result = array('status'=>404, 'msg' => 'Oops..! something went wrong.', 'response' => $res_arr);
			endif;
		}else{
			$result = array('status'=>404, 'msg' => 'Oops..! products not found.', 'response' => [] );
		}
		echo json_encode($result);
	}
	public function update_variation_data($product_id, $stock, $variation_sku){

		$result = null;
		$get_variation_data = $this->woocommerce->get('products/'.$product_id.'/variations',['sku'=>$variation_sku]);
		$data = [
		    'stock_quantity' => $stock
		];
		if(count($get_variation_data)>0){
			$variation_id = $get_variation_data[0]->id;
			$result = $this->woocommerce->put('products/'.$product_id.'/variations/'.$variation_id, $data);
		}
		return $result;
	}
}
$data = new devloment_server();

$data->get_product_list();
?>