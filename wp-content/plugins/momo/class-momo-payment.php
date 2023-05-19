<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              thuong@redweb.dk
 * @since             1.0.0
 * @package           Momo
 *
 * @wordpress-plugin
 * Plugin Name:       MOMO
 * Plugin URI:        thuong@redweb.dk
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Thuong Vu
 * Author URI:        thuong@redweb.dk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       momo
 * Domain Path:       /languages
 */
/*
 * This action hook registers our PHP class as a WooCommerce payment gateway
 */
add_filter( 'woocommerce_payment_gateways', 'momo_add_gateway_class' );
function momo_add_gateway_class( $gateways ) {
	$gateways[] = 'Momo_Payment';
	return $gateways;
}

add_action( 'woocommerce_before_cart',  'wc_before_cart' );
function wc_before_cart() {
	if ( isset( $_REQUEST['expired'] ) ) {
		wc_add_notice( __( "Momo's transaction is expired. Please try again."), 'error' );
	}
}

add_filter( 'woocommerce_thankyou_order_received_text', 'woocommerce_canceld_order_received_text', 20, 2 );
function woocommerce_canceld_order_received_text( ){
	return "Your order doesn't exist or transaction is canceled. Please try again.";
}

/*
 * The class itself, please note that it is inside plugins_loaded action hook
 */
add_action( 'plugins_loaded', 'momo_init_gateway_class' );
function momo_init_gateway_class() {
	
	class Momo_Payment extends WC_Payment_Gateway {
		
		/**
		 * Class constructor, more about it in Step 3
		 */
		public function __construct() {
			$this->id                   = 'momo'; // payment gateway plugin ID
			$this->icon                 = ''; // URL of the icon that will be displayed on checkout page near your gateway name
			$this->has_fields           = true; // in case you need a custom credit card form
			$this->method_title         = 'Momo Payment';
			$this->method_description   = 'Description of momo payment gateway'; // will be displayed on the options page
			
			// gateways can support subscriptions, refunds, saved payment methods,
			// but in this tutorial we begin with simple payments
			$this->supports = array(
				'products'
			);
			
			// Method with all the options fields
			$this->init_form_fields();
			
			// Load the settings.
			$this->init_settings();
			$this->title            = $this->get_option( 'title' );
			$this->description      = $this->get_option( 'description' );
			$this->partner_code     = $this->get_option( 'partner_code' );
			$this->access_key       = $this->get_option( 'access_key' );
			$this->secret_key       = $this->get_option( 'secret_key' );
			$this->testmode         = 'yes' === $this->get_option( 'testmode' );
			
			if ( $this->testmode ) {
				$this->url = 'https://test-payment.momo.vn';
			} else {
				$this->url = 'https://payment.momo.vn';
			}
			
			// This action hook saves the settings
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			
			// We need custom JavaScript to obtain a token
			add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
			
			// You can also register a webhook here
			add_action( 'woocommerce_api_momo', array( $this, 'webhook' ) );
			
			// When momo redirect to order received
			add_action( 'woocommerce_before_thankyou', array( $this, 'wc_thankyou_momo' ) );
		}
		
		/**
		 * Plugin options, we deal with it in Step 3 too
		 */
		public function init_form_fields(){
			
			$this->form_fields = array(
				'title' => array(
					'title'       => 'Title',
					'type'        => 'text',
					'description' => 'This controls the title which the user sees during checkout.',
					'default'     => 'Momo',
					'desc_tip'    => true,
				),
				'description' => array(
					'title'       => 'Description',
					'type'        => 'textarea',
					'description' => 'This controls the description which the user sees during checkout.',
					'default'     => 'Pay with MOMO - super-cool payment gateway.',
				),
				'testmode' => array(
					'title'       => 'Test mode',
					'label'       => 'Enable Test Mode',
					'type'        => 'checkbox',
					'description' => 'Place the payment gateway in test mode using test API keys.',
					'default'     => 'yes',
					'desc_tip'    => true,
				),
				'partner_code' => array(
					'title'       => 'Partner code',
					'type'        => 'text'
				),
				'access_key' => array(
					'title'       => 'Access key',
					'type'        => 'text',
				),
				'secret_key' => array(
					'title'       => 'Secret key',
					'type'        => 'text'
				),
			);
		}
		
		/**
		 * You will need it if you want your custom credit card form, Step 4 is about it
		 */
		public function payment_fields() {
			if ( $this->description ) {
				
				if ( $this->testmode ) {
					$this->description = ' TEST MODE ENABLED ';
				}
				
				echo wpautop( wp_kses_post( $this->description ) );
			}
		}
		
		/*
 		 * Process payment in order receive page
		 */
		public function wc_thankyou_momo() {
			if ($_GET['partnerCode'] == $this->partner_code )
			{
				// let's do something on order receive page
			}
		}
		
		/*
		 * We're processing the payments here, everything about it is in Step 5
		 */
		public function process_payment($order_id) {
			$order = new WC_Order($order_id);
		echo '<pre>';
		print_r($order);
		echo '</pre>';
		die('thuongtest');
			// Check expired payURL
			$payURL = $this->expired_payURL($order);

			if ($payURL)
			{
				wp_delete_post($order_id,true);
				
				$linkCart = add_query_arg( 'expired', 'true', wc_get_cart_url() );
				return [
					'result'    => 'success',
					'redirect'  => $linkCart,
				];
			}
			
			// Get user
			$userInfo   = $this->get_user_wc($order);
			
			// Get items
			$items      = $this->get_items_wc( $order);
			
			// Create signature
			$signature  = $this->create_signature($order);
			
			// Create body request
			$args = [
				"partnerCode"       => (string) $this->partner_code,
				"requestId"         => (string) $order_id,
				"amount"            => (int) $order->get_total(),
				"orderId"           => (string) $order_id,
				"orderInfo"         => (string) "Thanh toán qua ví MoMo",
				"requestType"       => (string) "captureWallet",
				"ipnUrl"            => (string) home_url('/wc-api/momo'),
				"redirectUrl"       => (string) $this->get_return_url($order),
				"lang"              => (string) "vi",
				"extraData"         => (string) $order_id,
				"signature"         => (string) $signature,
//				"items"             =>  $items,
				"userInfo"          =>  $userInfo,
			
			];
			
			// orderGroupId for production
			if ( !$this->testmode )
			{
				$orderGroupId   = $this->get_order_group_id($order);
				$args           = array_merge($args, ['orderGroupId' => $orderGroupId]);
			}

			$argsJs = json_encode($args);
			
			try {
				$response = $this->send( 'POST', '/v2/gateway/api/create', $argsJs);
				
				if ($response->getReasonPhrase() == 'OK' && $response->getStatusCode() == 200)
				{
					$content = json_decode($response->getBody()->getContents());
					$this->createLog('log_momo_getContents', json_encode($content) . ' Body: ' . $argsJs);
					if ($content->payUrl)
					{
						return [
							'result'    => 'success',
							'redirect'  => $content->payUrl,
						];
					}
				}
			} catch (\GuzzleHttp\Exception\RequestException $e) {
				if ($e->hasResponse())
				{
					$response = $e->getResponse();
					$this->createLog('log_momo_requestException', $response->getReasonPhrase() . ' Body: ' . $argsJs);
					wc_add_notice(  $response->getReasonPhrase(), 'error' );
				
				}
			} catch (Exception $e)
			{
				$this->createLog('log_momo_Exception', $e->getMessage() . ' Body: ' . $argsJs);
			}
		}
		
		/*
		 * In case you need a webhook, like PayPal IPN etc
		 */
		public function webhook() {
			$hookData   = file_get_contents("php://input");
			$data       = json_decode($hookData, true);
			
			if($hookData) {
				$this->createLog('log_momo_webhook', $hookData);
				
				if ($data['partnerCode'] == $this->partner_code  && $data['resultCode'] == 0)
				{
					global $woocommerce;
					$order = wc_get_order( $data['orderId'] );
					$order->payment_complete();
					$order->reduce_order_stock();
					$order->add_order_note( 'Your order is paid by Momo! Thank you!', true );
					$woocommerce->cart->empty_cart();
				} else {
					wp_delete_post($data['orderId'],true);
				}
			}
		}
		
		public function createLog($name, $content)
		{
			if (empty($name) || empty($content))
			{
				return false;
			}
			
			$log_speedPOS   = file_get_contents(dirname(__FILE__) . "/".$name.".txt");
			$log_speedPOS  .=  date('d-m-Y H:i:s') .'  '. $content;
			$file = fopen(dirname(__FILE__) . "/".$name.".txt","w");
			
			fwrite($file, $log_speedPOS);
			fwrite($file,"\n");
			fclose($file);
		}
		
		public function buildHeader($body)
		{
			return [
				RequestOptions::HEADERS => [
					'Content-Type'  => 'application/json',
					'Accept'        => 'application/json'
				],
				RequestOptions::BODY    => $body,
				RequestOptions::VERIFY  => false
			];
		}
		
		public function send($method='POST', $path='', $body='')
		{
			$client = new GuzzleHttp\Client(['base_uri' => $this->url]);
			
			return  $client->request($method, $path, $this->buildHeader($body));
		}
		
		public function get_user_wc($order)
		{
			$userInfo= [];
			if ($order->get_billing_first_name() || $order->get_billing_last_name())
			{
				$userInfo['name'] = $order->get_billing_first_name() . $order->get_billing_last_name();
			}else {
				$userInfo['name'] = $order->get_shipping_first_name() . $order->get_shipping_first_name();
			}
			
			$userInfo['phoneNumber'] = $order->get_billing_phone() ? $order->get_billing_phone() : $order->get_shipping_phone();
			$userInfo['email']       = $order->get_billing_email();
			return $userInfo;
		}
		
		public function get_items_wc($order)
		{
			$order_items = $order->get_items();
			$items       = [];
			$i           = 0;
			
			foreach ( $order_items as $item ) {
				$i++;
				$items[$i]['id']            = $item->get_product_id();
				$items[$i]['name']          = $item->get_name();
				$items[$i]['price']         = $item->get_total() /$item->get_quantity();
				$items[$i]['currency']      = $order->get_currency();
				$items[$i]['quantity']      = $item->get_quantity();
				$items[$i]['totalPrice']    = $item->get_total();
			}
			return $items;
		}
		
		public function get_order_group_id($order)
		{
			$locations      = get_terms( 'location' );
			$slug           = '';
			$orderGroupId   = 86500; // HCM
			
			foreach ($locations as $location)
			{
				if ($location->slug == $order->get_meta('order_store'))
				{
					$slug = get_term_by('term_taxonomy_id', $location->parent)->slug;
					break;
				}
			}
			
			if ($slug == 'hn')
			{
				$orderGroupId = 86501;
			}
			
			return $orderGroupId;
		}
		
		public function create_signature( $order, $path='')
		{
			$arr_signature = [
				"accessKey"         => (string) $this->access_key,
				"amount"            => (int) $order->get_total(),
				"extraData"         => (string) $order->get_id(),
				"ipnUrl"            => (string) home_url('/wc-api/momo'),
				"orderId"           => (string) $order->get_id(),
				"orderInfo"         => (string) "Thanh toán qua ví MoMo",
				"partnerCode"       => (string) $this->partner_code,
				"redirectUrl"       => (string) $this->get_return_url($order),
				"requestId"         => (string) $order->get_id(),
				"requestType"       => (string) "captureWallet",
			];
			
			if ($path == 'query')
			{
				$arr_signature = [
					"accessKey"         => (string) $this->access_key,
					"orderId"           => (string) $order->get_id(),
					"partnerCode"       => (string) $this->partner_code,
					"requestId"         => (string) $order->get_id(),
				];
			}
			
			$str_signature  = urldecode(http_build_query($arr_signature,'','&'));
			return hash_hmac('sha256', $str_signature, $this->secret_key);
		}
		
		public function expired_payURL($order)
		{
			$signature = $this->create_signature($order, 'query');
			$args = [
				"partnerCode"       => (string) $this->partner_code,
				"requestId"         => (string) $order->get_id(),
				"orderId"           => (string) $order->get_id(),
				"lang"              => (string) "vi",
				"signature"         => (string) $signature,
			];
			
			$argsJs = json_encode($args);
			
			try {
				$response = $this->send( 'POST', '/v2/gateway/api/query', $argsJs);
				$content = json_decode($response->getBody()->getContents());
				
				if ($content->resultCode != 1000)
				{
					return true;
				}
				
				return false;
				
			} catch (\GuzzleHttp\Exception\RequestException $e) {
				return false;
			}
		}
	}
}

