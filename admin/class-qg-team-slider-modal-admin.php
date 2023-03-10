<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/admin
 * @author     Quantum Devs <dadjei@quantumgroupgh.com>
 */
class Qg_Team_Slider_Modal_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Qg_Team_Slider_Modal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qg_Team_Slider_Modal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/qg-team-slider-modal-admin.css', array(), $this->version, 'all');

		// robotoFont cdn
		wp_enqueue_style($this->plugin_name . '-robotoFont', "https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900", array(), $this->version, 'all');

		// material icon cdn
		wp_enqueue_style($this->plugin_name . '-material_icon', "https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css", array(), $this->version, 'all');

		// vuetify css cdn
		wp_enqueue_style($this->plugin_name . '-vuetifyCSS', "https://cdn.jsdelivr.net/npm/vuetify@3.0.5/dist/vuetify.min.css", array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Qg_Team_Slider_Modal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qg_Team_Slider_Modal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// enqueue scripts if admin page = qg_team_slider_modal
		if ($_REQUEST['page'] == 'qg_team_slider_modal') {
			// Vue js cdn
			wp_enqueue_script($this->plugin_name . '-vue', "https://unpkg.com/vue/dist/vue.global.prod.js", array(), $this->version, true);

			// vuetify js cdn
			wp_enqueue_script($this->plugin_name . '-vuetifyJS', "https://cdn.jsdelivr.net/npm/vuetify@3.0.5/dist/vuetify.min.js", array(), $this->version, true);

			//axios js cdn
			wp_enqueue_script($this->plugin_name . '-axois', "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js", array(), $this->version, true);

			// Custom plugin js file
			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/qg-team-slider-modal-admin.js', array(), $this->version, false);
		}

	}

	// register admin menus
	public function register_admin_menus()
	{
		add_menu_page(
			__('QG Team Slider Modal', 'qg-team-slider-modal'),
			__('QG-TSM', 'qg-tsm'),
			'manage_options',
			'qg_team_slider_modal',
			array(&$this, 'qg_team_slider_admin_view'),
			plugin_dir_url(__FILE__) . 'images/qg_team_slider_plugin_logo.svg',
			7
		);
	}


	// Prevent header issues on redirections
	public function app_output_buffer()
	{
		ob_start();
	}


	/**
	 * Function to include the admin page of the plugin
	 * @since 1.0.0
	 */
	public function qg_team_slider_admin_view()
	{
		if (is_admin()) {
			include_once 'partials/qg-team-slider-modal-admin-display.php';
		}
	}

}