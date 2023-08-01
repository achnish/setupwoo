<?php 

set_time_limit(0);


$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}
use Automattic\WooCommerce\Client;
require 'class-database-connection.php';
/*
*******  Variation Attribute product *********
*/
class var_sub_pro
{
	
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
	public function update_product_stock(){
		$attr_slug = $attr_term_arr = null;
		$size = 'S';
		$color_code = '16';
		$find_sku = "BCTU004";
		$attr = $this->get_attribute();

		$attr_term_arr = $this->get_attribute_term($attr['id'], $size);

		if(!empty($attr) && !empty($attr_term_arr)){
			$data = [
	            'attribute_term' => $attr_term_arr['term_id'],
	    		'attribute' => $attr['slug'],
	        ];
			$get_products = $this->woocommerce->get('products',$data); 

			if(!empty($get_products)){
				$res_arr = array();
				foreach ($get_products as $pro_d) {
					$pro_sku = $pro_d->sku;
					if( strpos( $pro_sku, $find_sku ) !== false ) {
						$response = $this->update_variation_data($pro_d->id, $attr_term_arr['term_name'], $color_code);
						
						if(!empty($response)): array_push($res_arr, $response); endif;
					}
				}
				if(!empty($res_arr)):
					$result = array('status'=>200, 'msg' => 'Products updated successfully.', 'response' => $res_arr);
				else:
					$result = array('status'=>400, 'msg' => 'Oops..! something went wrong.', 'response' => $res_arr);
				endif;
			}
		}
		echo "<pre>";
		print_r($result);
	}

	public function update_variation_data($product_id, $size, $color_code){
		$result = null;
		$get_variation_data = $this->woocommerce->get('products/'.$product_id.'/variations');
		return $get_variation_data;
	}

	public function get_attribute(){
		$result = [];
		$get_all_attribute = $this->woocommerce->get('products/attributes');
		
		foreach ($get_all_attribute as $d_val) {
			if($d_val->slug == 'pa_size'){
				$attr_slug = $d_val->slug;
				$attr_id = $d_val->id;
				$result = array('slug' => $attr_slug, 'id' => $attr_id);
			}
		}
		return $result;
	}
	public function get_attribute_term($attrid, $term){
		$attr_term_id = [];
		$get_attribute_term = $this->woocommerce->get('products/attributes/'.$attrid.'/terms',['slug'=>$term]);
		
		if(count($get_attribute_term)>0){
			$attr_term_id['term_id'] = $get_attribute_term[0]->id;
			$attr_term_id['term_name'] = $get_attribute_term[0]->name;
		}
		return $attr_term_id;
	}
	
}
$data = new var_sub_pro();
$data->update_product_stock();
?>
