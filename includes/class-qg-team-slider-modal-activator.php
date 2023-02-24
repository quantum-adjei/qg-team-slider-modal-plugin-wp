<?php

/**
 * Fired during plugin activation
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/includes
 * @author     Quantum Devs <dadjei@quantumgroupgh.com>
 */
class Qg_Team_Slider_Modal_Activator {

	public $tableLoader;

	/**
	 * Import database configuration and other dependances.
	 *
	 * @since 1.0.0
	*/
	public function __construct()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'data/class-qg-team-slider-modal-db-config.php';

		$this->tableLoader = new Qg_Team_Slider_Modal_Db_Config();
	}

	/**
	 * Run codes when plugin is activated.
	 *
	 * @since    1.0.0
	 */
	public function activate()
	{
		$this->tableLoader->qg_create_tables();
	}

}
