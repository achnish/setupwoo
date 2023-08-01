


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
        // $this->woocommerce = new Client(
        //     'http://192.168.0.18/acf',
        //     'ck_f46e213f8ec8e163551f5d9d33c311c1e10859eb',
        //     'cs_396bceaedfeb49a90e8a267e8ebaaa8c76180cfa',
        //     [
        //         'wp_api' => true,
        //         'version' => 'wc/v3',
        //         'query_string_auth' => true


        //     ]
        // );
        $this->init();

    }
 function init()
 {

     $servername = "localhost";
        $username   = "root";
        $password   = "";
        $database   = "woo_api";
        
        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // echo "<pre>";
        // print_r($conn);
        // exit;
 if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM woo_product_create";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc()) 
          {
            $woo_key        = $row["woo_key"];
            $secret_key     = $row["woo_secret"];
            $url            = $row["url"];
            $get_db = $this->var_pro_create($woo_key, $secret_key, $url);
            $updated_pro = "UPDATE wp_api_data where url = '$url'";

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



    public function var_pro_create($woo_key, $secret_key, $url) {
        $this->woocommerce = new Client(
            $url,
            $woo_key,
            $secret_key,
            [
                'wp_api'  => true,
                'version' => 'wc/v3'
            ]
        );
        $products_data = array(
            array(
                'name' => 'T-shirt',
                'type' => 'simple',
                'regular_price' => '2000',
                'description' => 'This is the description for Product 1.',
                'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
                // Add more data for Product 1 as needed
                'images' => [
                    [
                        'src' => 'http://192.168.0.18/acf/wp-content/uploads/2023/06/homebanner.jpg'
                    ],
                    
                ],
            ),
            array(
                'name' => 'Shirt',
                'type' => 'simple',
                'regular_price' => '1000',
                'description' => 'This is the description for Product 2.',
                'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
                'images' => [
                    [
                        'src' => 'http://192.168.0.18/acf/wp-content/uploads/2023/06/blackshirt.jpg'
                    ],
                    
                ],
                // Add more data for Product 2 as needed
            ),
            // Add more products as needed
        );

        foreach ($products_data as $product_data) {
            $create_pro = $this->woocommerce->post('products', $product_data);
        }

        echo "Products created successfully.";
    }
}

$data = new Var_Pro_List();
$data->var_pro_create();
?>

