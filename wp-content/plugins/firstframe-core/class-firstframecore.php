<?php
/*
Plugin Name: FirstFrame Core
Plugin URI: https://qodeinteractive.com
Description: Plugin that adds portfolio post type, shortcodes and other modules
Author: Qode Interactive
Author URI: https://qodeinteractive.com
Version: 1.0
Text Domain: firstframe-core
*/
if ( ! class_exists( 'FirstFrameCore' ) ) {
	class FirstFrameCore {
		private static $instance;

		public function __construct() {
			$this->require_core();

			add_filter( 'qode_framework_filter_register_admin_options', array( $this, 'create_core_options' ) );

			add_action( 'qode_framework_action_before_options_init_' . FIRSTFRAME_CORE_OPTIONS_NAME, array( $this, 'init_core_options' ) );

			add_action( 'qode_framework_action_populate_meta_box', array( $this, 'init_core_meta_boxes' ) );

			// Register plugin assets
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

			// Include plugin assets
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

			// Make plugin available for translation
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 15 ); // permission 15 is set in order to be after the qode-framework initialization

			// Add plugin's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Hook to include additional modules when plugin loaded
			do_action( 'firstframe_core_action_plugin_loaded' );
		}

		/**
		 * @return FirstFrameCore
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function require_core() {
			require_once dirname( __FILE__ ) . '/constants.php';
			require_once FIRSTFRAME_CORE_ABS_PATH . '/helpers/helper.php';

			// Hook to include additional files before modules inclusion
			do_action( 'firstframe_core_action_before_include_modules' );

			foreach ( glob( FIRSTFRAME_CORE_INC_PATH . '/*/include.php' ) as $module ) {
				include_once $module;
			}

			// Hook to include additional files after modules inclusion
			do_action( 'firstframe_core_action_after_include_modules' );
		}

		function create_core_options( $options ) {
			$firstframe_core_options_admin = new QodeFrameworkOptionsAdmin(
				FIRSTFRAME_CORE_MENU_NAME,
				FIRSTFRAME_CORE_OPTIONS_NAME,
				array(
					'label' => esc_html__( 'FirstFrame Core Options', 'firstframe-core' ),
					'code'  => FirstFrameCore_Dashboard::get_instance()->get_code(),
				)
			);

			$options[] = $firstframe_core_options_admin;

			return $options;
		}

		function init_core_options() {
			$qode_framework = qode_framework_get_framework_root();

			if ( ! empty( $qode_framework ) ) {
				$page = $qode_framework->add_options_page(
					array(
						'scope'       => FIRSTFRAME_CORE_OPTIONS_NAME,
						'type'        => 'admin',
						'slug'        => 'general',
						'title'       => esc_html__( 'General', 'firstframe-core' ),
						'description' => esc_html__( 'Global Theme Options', 'firstframe-core' ),
						'icon'        => 'fa fa-cog',
					)
				);

				// Hook to include additional options after default options
				do_action( 'firstframe_core_action_default_options_init', $page );
			}
		}

		function init_core_meta_boxes() {
			do_action( 'firstframe_core_action_default_meta_boxes_init' );
		}

		function register_scripts() {

			// Register 3rd party plugins style
			wp_register_style( 'magnific-popup', FIRSTFRAME_CORE_URL_PATH . 'assets/plugins/magnific-popup/magnific-popup.css' );

			// Register 3rd party plugins script
			wp_register_script( 'jquery-magnific-popup', FIRSTFRAME_CORE_URL_PATH . 'assets/plugins/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );

			// Hook to include additional registered scripts
			do_action( 'firstframe_core_action_registered_scripts' );
		}

		function enqueue_assets() {
			// CSS and JS dependency variables
			$style_dependency_array  = apply_filters( 'firstframe_core_filter_style_dependencies', array( 'firstframe-main' ) );
			$script_dependency_array = apply_filters( 'firstframe_core_filter_script_dependencies', array( 'firstframe-main-js' ) );

			// Hook to include additional scripts before plugin's main style
			do_action( 'firstframe_core_action_before_main_css' );

			// Enqueue plugin's main style
			wp_enqueue_style( 'firstframe-core-style', FIRSTFRAME_CORE_URL_PATH . 'assets/css/firstframe-core.min.css', $style_dependency_array );

			// Enqueue plugin's 3rd party scripts
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'gsap', FIRSTFRAME_CORE_URL_PATH . 'assets/plugins/gsap/gsap.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'modernizr', FIRSTFRAME_CORE_URL_PATH . 'assets/plugins/modernizr/modernizr.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'parallax-scroll', FIRSTFRAME_CORE_URL_PATH . 'assets/plugins/parallax-scroll/jquery.parallax-scroll.js', array( 'jquery' ), false, true );

			// Hook to include additional scripts before plugin's main script
			do_action( 'firstframe_core_action_before_main_js' );

			// Enqueue plugin's main script
			wp_enqueue_script( 'firstframe-core-script', FIRSTFRAME_CORE_URL_PATH . 'assets/js/firstframe-core.min.js', $script_dependency_array, false, true );
		}

		function load_plugin_textdomain() {
			load_plugin_textdomain( 'firstframe-core', false, FIRSTFRAME_CORE_REL_PATH . '/languages' );
		}

		function add_body_classes( $classes ) {
			$classes[] = 'firstframe-core-' . FIRSTFRAME_CORE_VERSION;

			return $classes;
		}
	}
}

if ( ! function_exists( 'firstframe_core_instantiate_plugin' ) ) {
	/**
	 * Function that initialize plugin
	 */
	function firstframe_core_instantiate_plugin() {
		FirstFrameCore::get_instance();
	}

	add_action( 'qode_framework_action_load_dependent_plugins', 'firstframe_core_instantiate_plugin' );
}

if ( ! function_exists( 'firstframe_core_activation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin activation
	 */
	function firstframe_core_activation_trigger() {
		// Set global plugin option when plugin is activated
		add_option( 'firstframe_core_activated_first_time', 'yes' );

		// Hook to add additional code on plugin activation
		do_action( 'firstframe_core_action_on_activation' );
	}

	register_activation_hook( __FILE__, 'firstframe_core_activation_trigger' );
}

if ( ! function_exists( 'firstframe_core_deactivation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin deactivation
	 */
	function firstframe_core_deactivation_trigger() {
		// Remove global plugin option during deactivation
		delete_option( 'firstframe_core_activated_first_time' );

		// Hook to add additional code on plugin deactivation
		do_action( 'firstframe_core_action_on_deactivation' );
	}

	register_deactivation_hook( __FILE__, 'firstframe_core_deactivation_trigger' );
}

if ( ! function_exists( 'firstframe_core_plugins_loaded_option' ) ) {
	/**
	 * Function that update global option that plugin is activated first time
	 */
	function firstframe_core_plugins_loaded_option() {
		if ( 'yes' === get_option( 'firstframe_core_activated_first_time' ) ) {
			update_option( 'firstframe_core_activated_first_time', 'no' );
		}
	}

	add_action( 'plugins_loaded', 'firstframe_core_plugins_loaded_option', 1000 ); //needs to be last, so option can be changed after all actions
}

if ( ! function_exists( 'firstframe_core_check_requirements' ) ) {
	/**
	 * Function that check plugin requirements
	 */
	function firstframe_core_check_requirements() {
		if ( ! defined( 'QODE_FRAMEWORK_VERSION' ) ) {
			add_action( 'admin_notices', 'firstframe_core_admin_notice_content' );
		}
	}

	add_action( 'plugins_loaded', 'firstframe_core_check_requirements' );
}

if ( ! function_exists( 'firstframe_core_admin_notice_content' ) ) {
	/**
	 * Function that display the error message if the requirements are not met
	 */
	function firstframe_core_admin_notice_content() {
		echo sprintf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'Qode Framework plugin is required for FirstFrame Core plugin to work properly. Please install/activate it first.', 'firstframe-core' ) );

		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	}
}
