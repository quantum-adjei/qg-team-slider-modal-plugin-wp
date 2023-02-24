<?php

/**
 * Creates all database tables needed for the plugin.
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/data
 */

/**
 * Creates all database tables needed for the plugin.
 *
 * Creates and manage all tables for the plugin. Also contains
 * all functions or methods for making for perform db operations.
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/data
 * @author     Quantum Devs <dadjei@quantumgroupgh.com>
 */

class Qg_Team_Slider_Modal_Db_Config
{

    /**
     * The database table version of the plugin.
     * @since   1.0.0
     * @access  protected
     * @var     string      $qg_db_table_version  The database table version of the plugin
     */
    protected $qg_db_table_version;


    /**
     * The database table name of the plugin.
     * @since   1.0.0
     * @access  public
     * @var     string  $qg_table_name The database table name of the plugin
     */
    public $qg_table_name;


    // Table columns
    public $member_id;
    public $full_name;
    public $position;
    public $image_url;
    public $bio;



    /**
     * Configures the database table for the plugin.
     *
     * Sets the database table name and version number.
     *
     * @since   1.0.0
     */
    public function __construct()
    {
        global $wpdb;

        if (defined('QG_TEAM_SLIDER_MODAL_DB_VERSION')) {
            $this->qg_db_table_version = QG_TEAM_SLIDER_MODAL_DB_VERSION;
        } else {
            $this->qg_db_table_version = '1.0.0';
        }

        if (defined('QG_TEAM_SLIDER_MODAL_TABLE_NAME')) {
            $this->qg_table_name = $wpdb->prefix . QG_TEAM_SLIDER_MODAL_TABLE_NAME;
        } else {
            $this->qg_table_name = $wpdb->prefix . 'qg_team_slider_modal';
        }
    }


    /**
     * Function to re-create tables base on the plugin version
     *
     * @since   1.0.0
     */
    public function qg_create_tables()
    {
        if (get_option('qg_tsm_db_version') != $this->qg_db_table_version) {
            global $wpdb;

            $wpdb->query("DROP TABLE IF EXISTS {$this->qg_table_name}");

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $this->qg_table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                full_name varchar(50) NOT NULL UNIQUE,
                position varchar(50) NOT NULL,
                image_url text NOT NULL,
                bio text NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);

            return update_option('qg_tsm_db_version', $this->qg_db_table_version);
        }
    }

    /**
     * Function to drop all tables if plugin is uninstalled
     *
     * @since 1.0.0
     */
    public function qg_delete_tables()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$this->qg_table_name}");
        delete_option('qg_tsm_db_version');
    }

    /**
     * Function to get all team members
     *
     * @return array|object|null
     */
    public function qg_get_all_team_members()
    {
        global $wpdb;
        $sql = "SELECT * FROM {$this->qg_table_name}";
        return $wpdb->get_results($sql, 'ARRAY_A');
    }

    /**
     * Function to populate table with with data
     *
     * @since 1.0.0
     */
    public function qg_add_new_team_member()
    {
        global $wpdb;
        return $wpdb->insert("{$this->qg_table_name}", array(
            "full_name" => $this->full_name,
            "position" => $this->position,
            "image_url" => $this->image_url,
            "bio" => $this->bio,
        ));
    }

    /**
     * Function to get a team member by id
     *
     * @return  array|null|object
     */
    public function qg_get_team_member_by_id($id)
    {
        global $wpdb;
        $sql = "SELECT * FROM {$this->qg_table_name} WHERE id = {$id}";
        return $wpdb->get_row($sql);
    }

    /**
     * Function to update team member info
     *
     * @return bool|int
    */
    public function qg_update_team_member_info($id)
    {
        global $wpdb;
        return $wpdb->update(
            "{$this->qg_table_name}",
            array(
                "full_name" => $this->full_name,
                "position" => $this->position,
                "image_url" => $this->image_url,
                "bio" => $this->bio,
            ),
            array(
                "id" => $id
            )
        );
    }

    /**
     * Function to delete team member
     *
     * @return bool|int
    */
    public function qg_delete_member($id) {
        global $wpdb;
        return $wpdb->delete(
            "{$this->qg_table_name}",
            ['id' => $id],
            ['%d']
        );
    }
}