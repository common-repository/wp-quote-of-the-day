<?php


class QuoteApiHelper {

	public $id;
	public $author;
	public $quote;
	public $category;

	protected $user_id;
	protected $token;
	protected $envato_code;

	protected $headers;

	public static $api_url = 'http://api.wpquoteoftheday.com/';

	public function __construct( $user_id, $token, $envato_code = '' ) {
		$this->user_id = $user_id;
		$this->token   = $token;

		$this->headers = [
			'user-id'     => trim( $user_id ),
			'token'       => trim( $token ),
			'envato-code' => trim( $envato_code ),
		];
	}

	public function get( $category ) {

		$today_quote = json_decode(
			get_option(
				'quote_today',
				json_encode(
					[
						'time'     => date( 'Ymd' ),
						'category' => '1'
					]
				)
			)
		);

		if(!isset( $today_quote->category)){
			$today_quote->category = '1';
		}

		if ( date( 'Ymd' ) != date( 'Ymd', $today_quote->time ) and $today_quote->category == $category ) {
			$args     = array(
				'timeout'     => 25,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => $this->headers,
			);
			$response = wp_remote_get( self::$api_url . 'quote/' . $category, $args );
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				throw new Exception( $error_message );
			} else {
				$response = json_decode( $response['body'] );
				if ( isset( $response->Error ) ) {
					throw new Exception( $response->Error );
				}
				if ( is_null( $response ) ) {
					throw new Exception( "Can't get a quote" );
				}
			}
			$response->time = strtotime( date( 'Ymd' ) );
			update_option( 'quote_today', json_encode( $response ) );
		} else {
			return $today_quote;
		}


		return $response;
	}

	public function getNew( $category ) {
		$args     = array(
			'timeout'     => 25,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => $this->headers,
		);
		$response = wp_remote_get( self::$api_url . 'quote/' . $category, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			throw new Exception( $error_message );
		} else {
			$response = json_decode( $response['body'] );
			if ( isset( $response->Error ) ) {
				throw new Exception( $response->Error);
			}
			if ( is_null( $response ) ) {
				throw new Exception( "Can't get a quote" );
			}
		}
		$response->time = strtotime( date( 'Ymd' ) );
		update_option( 'quote_today', json_encode( $response ) );
	}

	public static function getCategories() {

		$response = wp_remote_get( self::$api_url . 'category');

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			throw new Exception( $error_message );
		} else {
			$response = json_decode( $response['body'] );
			if ( isset( $response->Error ) ) {
				throw new Exception( $response->Error );
			}
			if ( is_null( $response ) ) {
				throw new Exception( "Can't get categories" );
			}
		}


		return $response;
	}

	public function getUserInfo() {
		$args = array(
			'timeout'     => 25,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => $this->headers,
		);

		$response = wp_remote_get( self::$api_url . 'user_data', $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			throw new Exception( $error_message );
		}
		if ( isset( $response->Error ) ) {
			throw new Exception( $response->Error );
		}
		if ( is_null( $response ) ) {
			throw new Exception( "Can't get a quote" );
		}

		return json_decode( $response['body'] );
	}

	public static function getFreeQuote($category) {
		$args     = array(
			'timeout'     => 25,
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => [],
		);

		$response = wp_remote_get( self::$api_url . 'free_quote/' . $category, $args);
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			throw new Exception( $error_message );
		}
		$response = json_decode( $response['body'] );
		if ( isset( $response->Error ) ) {
			throw new Exception( $response->Error);
		}
		if ( is_null( $response ) ) {
			throw new Exception( "Can't get a quote" );
		}

		return $response;

	}

}