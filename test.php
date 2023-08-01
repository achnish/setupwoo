<?php
set_time_limit(0);

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}
use Automattic\WooCommerce\Client;
require 'class-database-connection.php';


class var_sub_pro
{
	public $woocommerce = '';
	public $init = '';
	public $product_detail = "wh_shirtee_import_products";
	function __construct(){

		$this->init();
	}
	public function init(){

		$servername = "localhost";
	    $username 	= "root";
	    $password 	= "";
	    $database 	= "woo_api";
	    
	    // Create a connection
	    $conn = new mysqli($servername, $username, $password, $database);
	    // Check connection
	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }
	    $sql = "SELECT * FROM wp_api_data WHERE status = 0 LIMIT 1";
	    $result = $conn->query($sql);
	    if ($result->num_rows > 0) 
	    {
	      while($row = $result->fetch_assoc()) 
	      {
	      	$woo_key 		= $row["woo_key"];
	      	$secret_key 	= $row["secret_key"];
	      	$url 			= $row["url"];
	      	$status 		= $row["status"];
	      	$get_db = $this->update_product_var_stock($woo_key, $secret_key, $url, $status);
	      	$updated_pro = "UPDATE wp_api_data SET status='1' where url = '$url'";

			if ($conn->query($updated_pro) === TRUE) 
			{
			  echo "Record updated successfully";
			} else {
			  echo "Error updating record: " . $conn->error;
			}
	      }
	    } 
	    else 
	    {
	      echo "All Record updated successfully";
	    }

	    $conn->close();
	}
	public function update_product_var_stock($woo_key, $secret_key, $url, $status){
		$this->woocommerce = new Client(
			$url,
			$woo_key,
			$secret_key,
			[
				'wp_api'  => true,
				'version' => 'wc/v3'
			]
		);
		$res_arr = [];
		$stock = '2';
		$find_sku = "BCTU004__S__16";
		$product = $this->woocommerce->get('products');
		$data = [
		    'stock_quantity' => $stock
		];
		foreach ($product as $pro) 
		{
			$pro_id = $pro->id;
			$pro_sku = $pro->sku;	
			$get_var_id = $this->woocommerce->get('products/'. $pro_id .'/variations');
			foreach ($get_var_id as $var_pro) 
			{
				$var_sku = $var_pro->sku;
				
				if( strpos( $var_sku, $find_sku ) !== false) {
					$var_id = $var_pro->id;
					$get_variation_data = $this->woocommerce->put('products/'.$pro_id.'/variations/'.$var_id, $data);
					echo "<pre>";
					print_r($get_variation_data);
				}
			}
		}
	}
}
$data = new var_sub_pro();
echo "<pre>";
?>