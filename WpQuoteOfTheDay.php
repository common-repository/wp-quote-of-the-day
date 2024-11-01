<?php

/*
Plugin Name: WP Quote Of The Day
Description: WP Quote Of The Day
Version: 1.1.2
Author: WPQuoteOfTheDay
Author URI: http://wpquoteoftheday.com
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include plugin_dir_path( __FILE__ ) . 'QuoteApiHelper.class.php';

if ( ! class_exists( 'WpQuoteOfTheDay' ) ) {
	class WpQuoteOfTheDay {

		public static $is_premium = null;
		public static $user_data = null;
		private $prefix = 'wp-quote-oftd';

		public function __construct() {
			$this->admin_init();
			$this->front_init();
		}

		public function front_includes() {
			try {
				if ( self::is_premium() ) {
					$quoteAPI       = new QuoteApiHelper(
						get_option( 'quote_user_id', '' ),
						get_option( 'quote_token', '' ),
						get_option( 'envato_id', '' )
					);
					$quote_response = $quoteAPI->get( get_option( 'quote_category', '1' ) );
				} else {
					$quote_response = QuoteApiHelper::getFreeQuote( get_option( 'quote_category', '1' ) );
				}

				$dataToBePassed = $this->front_params( $quote_response );
			} catch ( Exception $e ) {
				file_put_contents( plugin_dir_path( __FILE__ ) . 'log', $e->getMessage() . "\n", FILE_APPEND );

				return;
			}

			wp_enqueue_script( 'jquery' );
			wp_enqueue_style( $this->prefix . '_style', plugin_dir_url( __FILE__ ) . 'css/style.min.css' );
			wp_enqueue_script( $this->prefix . '_script', plugin_dir_url( __FILE__ ) . 'js/app.min.js' );
			wp_localize_script( $this->prefix . '_script', 'quote_vars', $dataToBePassed );
		}

		public function delete() {
			$options_array = [
				'quote_author_color',
				'quote_author_font',
				'quote_author_font_bold',
				'quote_author_font_italic',
				'quote_author_font_size',
				'quote_background_color',
				'quote_background_opacity',
				'quote_banner_img_url',
				'quote_banner_is_iframe',
				'quote_banner_redirect_url',
				'quote_category',
				'quote_circle_color',
				'quote_circle_enable',
				'quote_envato_id',
				'quote_font',
				'quote_font_bold',
				'quote_show_on',
				'quote_font_italic',
				'quote_font_size',
				'quote_force_redirect_delay',
				'quote_iframe_url',
				'quote_quote_color',
				'quote_redirect',
				'quote_redirect_delay',
				'quote_skip_background_color',
				'quote_skip_background_hover_color',
				'quote_skip_font_size',
				'quote_skip_text',
				'quote_token',
				'quote_user_id',
			];
			foreach ( $options_array as $option ) {
				delete_option( $option );
			}
		}

		public function settings() {
			add_menu_page(
				__( 'WP Quote Of The Day Settings', 'wordpress' ),
				'WP Quote Of The Day',
				'manage_options',
				$this->prefix,
				[ $this, 'settings_page' ],
				'dashicons-format-quote'

			);
		}

		public function settings_includes() {
			wp_enqueue_media();
			wp_enqueue_script( $this->prefix . 'admin_script', plugin_dir_url( __FILE__ ) . 'admin/js/app.min.js' );
			wp_enqueue_style( $this->prefix . 'admin_style', plugin_dir_url( __FILE__ ) . 'admin/css/style.min.css' );

			$adminDataTobePassed = [
				'quote_font'             => get_option( 'quote_font', '' ),
				'quote_redirect'         => get_option( 'quote_redirect', '' ),
				'quote_author_font'      => get_option( 'quote_author_font', '' ),
				'quote_category'         => get_option( 'quote_category', '' ),
				'quote_banner_is_iframe' => get_option( 'quote_banner_is_iframe', '' )
			];

			wp_localize_script( $this->prefix . 'admin_script', 'admin_quote_vars', $adminDataTobePassed );
		}

		public function settings_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}

			$this->update_settings();
			$this->get_new_quote();
			include plugin_dir_path( __FILE__ ) . 'admin.php';
		}

		private function admin_init() {
			add_action( 'admin_menu', [ $this, 'settings' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'settings_includes' ] );
			register_deactivation_hook( __FILE__, array( $this, 'delete' ) );
		}

		private function front_init() {
			if ( $this->is_first_time() and $this->is_appropriate_post() ) {
				add_action( 'wp_enqueue_scripts', [ $this, 'front_includes' ] );
			}
		}

		private function update_settings() {
			if ( isset( $_POST['save_quote'] ) ) {
				unset( $_POST['save_quote'] );

				foreach ( $_POST as $key => $value ) {
					if ( $key == 'iframe_url' ) {
						$value = str_replace( '\\', '', htmlspecialchars( $value ) );
						update_option( 'quote_' . $key, $value );
					} else {
						update_option( 'quote_' . $key, $value );
					}

				}

			}
		}

		private function get_new_quote() {
			if ( isset( $_GET['get_new_quote'] ) ) {
				try {
					$quoteAPI = new QuoteApiHelper(
						get_option( 'quote_user_id', '' ),
						get_option( 'quote_token', '' ),
						get_option( 'quote_envato_id', '' )
					);
					$quoteAPI->getNew( get_option( 'quote_category', '' ) );

				} catch ( Exception $e ) {
					$message = $e->getMessage();
					add_action( 'admin_notices', function () use ( $message ) {
						?>
						<div class="notice notice-error is-dismissible">
							<p><?= $message; ?></p>
						</div>
						<?php
					} );
				}

			}
		}

		private function front_params( $quote_response ) {
			$dataToBePassed = array(
				'quote'                       => $quote_response->quote,
				'author'                      => '-' . $quote_response->author,
				'redirect'                    => get_option( 'quote_redirect', '' ),
				'redirect_delay'              => get_option( 'quote_redirect_delay', '5' ),
				'force_redirect_delay'        => get_option( 'quote_force_redirect_delay', '15000' ) . '000',
				'banner_img_url'              => get_option( 'quote_banner_img_url', '' ),
				'banner_redirect_url'         => get_option( 'quote_banner_redirect_url', '/' ),
				'banner_is_iframe'            => get_option( 'quote_banner_is_iframe', '' ),
				'iframe_url'                  => str_replace( "\\", '', htmlspecialchars_decode( get_option( 'quote_iframe_url', '' ) ) ),
				'quote_color'                 => get_option( 'quote_quote_color', '#ffffff' ),
				'author_color'                => get_option( 'quote_author_color', '#ffffff' ),
				'background_color'            => get_option( 'quote_background_color', '#000000' ),
				'background_opacity'          => get_option( 'quote_background_opacity', '90' ),
				'circle_color'                => get_option( 'quote_circle_color', '#ffffff' ),
				'circle_enable'               => get_option( 'quote_circle_enable', '1' ),
				'skip_text'                   => get_option( 'quote_skip_text', 'Continue to website' ),
				'skip_font_size'              => get_option( 'quote_skip_font_size', '14' ),
				'skip_background_color'       => get_option( 'quote_skip_background_color', '#222' ),
				'skip_background_hover_color' => get_option( 'quote_skip_background_hover_color', '#767676' ),
				'font_family'                 => get_option( 'quote_font', 'inherit' ),
				'font_bold'                   => get_option( 'quote_font_bold', 'normal' ),
				'font_italic'                 => get_option( 'quote_font_italic', 'normal' ),
				'font_size'                   => get_option( 'quote_font_size', '18' ),
				'author_font_family'          => get_option( 'quote_author_font', 'inherit' ),
				'author_font_bold'            => get_option( 'quote_author_font_bold', 'normal' ),
				'author_font_italic'          => get_option( 'quote_author_font_italic', 'normal' ),
				'author_font_size'            => get_option( 'quote_author_font_size', '18' ),

			);
			$dataToBePassed = apply_filters( $this->prefix . '_script_data', $dataToBePassed );

			return $dataToBePassed;
		}

		private function is_first_time() {
			$domain = COOKIE_DOMAIN ? COOKIE_DOMAIN : $_SERVER['HTTP_HOST'];

			if ( isset( $_COOKIE['_wp_current_session'] ) and get_option( 'quote_period', 0 ) != 0 ) {
				return false;
			}

			if ( get_option( 'quote_period', 0 ) == 0 ) {
				return true;
			}

			if ( isset( $_COOKIE['_wp_first_time'] ) ) {
				return false;
			}


			setcookie( '_wp_current_session', '1' );
			setcookie( '_wp_first_time', '1', time() + ( get_option( 'quote_period', 0 ) * DAY_IN_SECONDS ), '/', $domain );

			return true;
		}

		private function is_appropriate_post() {
			$option = get_option( 'quote_show_on', [ ] );

			if ( empty( $option ) ) {
				return true;
			}

			if ( in_array( 'all', $option ) ) {
				return true;
			}

			if ( in_array( 'home', $option ) and is_home() ) {
				return true;
			}

			if ( in_array( 'page', $option ) and is_page() ) {
				return true;
			}

			if ( in_array( 'category', $option ) and is_category() ) {
				return true;
			}

			if ( in_array( 'blog', $option ) and is_front_page() && is_home() ) {
				return true;
			}

			if ( in_array( 'tag', $option ) and is_tag() ) {
				return true;
			}


			return false;
		}

		public static function is_premium() {

			if ( ! is_null( self::$is_premium ) ) {
				return self::$is_premium;
			}

			if ( get_option( 'quote_token' ) and get_option( 'quote_user_id' ) ) {
				$quoteAPI = new QuoteApiHelper( get_option( 'quote_user_id' ), get_option( 'quote_token' ) );
				try {
					$user_data = $quoteAPI->getUserInfo();

					if ( $user_data->expire > time() ) {
						self::$is_premium = true;
						self::$user_data  = $user_data;
						return true;
					}
					if(isset($user_data->annual) and $user_data->annual > time()){
						self::$is_premium = true;
						self::$user_data  = $user_data;
						return true;
					}
				} catch ( Exception $e ) {
					file_put_contents( plugin_dir_path( __FILE__ ) . 'log', $e->getMessage() . PHP_EOL, FILE_APPEND );
				}

			}
			self::$is_premium = false;

			return false;
		}

		public static function get_categories() {
			try {

				$quote_response = QuoteApiHelper::getCategories();

				return $quote_response;
			} catch ( Exception $e ) {
				return [ ];
			}
		}

	}
}

$WpQuoteOfTheDay = new WpQuoteOfTheDay();
unset( $WpQuoteOfTheDay );