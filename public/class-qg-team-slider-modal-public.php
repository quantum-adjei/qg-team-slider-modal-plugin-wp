<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/public
 * @author     Quantum Devs <dadjei@quantumgroupgh.com>
 */
class Qg_Team_Slider_Modal_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/qg-team-slider-modal-public.css', array(), $this->version, 'all');

		// robotoFont cdn
		wp_enqueue_style($this->plugin_name . '-robotoFont', "https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900", array(), $this->version, 'all');

		// material icon cdn
		wp_enqueue_style($this->plugin_name . '-material_icon', "https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css", array(), $this->version, 'all');

		// vuetify css cdn
		wp_enqueue_style($this->plugin_name . '-vuetifyCSS', "https://cdn.jsdelivr.net/npm/vuetify@3.0.5/dist/vuetify.min.css", array(), $this->version, 'all');

		// swiperJS
		wp_enqueue_style($this->plugin_name . '-swiperCSS', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css", array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		// Vue js cdn
		wp_enqueue_script($this->plugin_name . '-vue', "https://unpkg.com/vue/dist/vue.global.prod.js", array(), $this->version, true);

		// vuetify js cdn
		wp_enqueue_script($this->plugin_name . '-vuetifyJS', "https://cdn.jsdelivr.net/npm/vuetify@3.0.5/dist/vuetify.min.js", array(), $this->version, true);

		//axios js cdn
		wp_enqueue_script($this->plugin_name . '-axois', "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js", array(), $this->version, true);

		// swiper js
		wp_enqueue_script($this->plugin_name . '-swiper', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js", array(), $this->version, true);

		// custom js
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/qg-team-slider-modal-public.js', array('jquery'), $this->version, false);

	}

	// Return ui template when shortcode is called
	public function qg_tsm_view()
	{
		include_once 'partials/qg-team-slider-modal-public-display.php';
	}
}