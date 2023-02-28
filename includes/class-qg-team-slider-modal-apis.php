<?php
/**
 * The file that defines all External api class
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/includes
 */

class Qg_Team_Slider_Modal_APIs
{
    public $qg_tsm_table_instance;

    public function __construct()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'data/class-qg-team-slider-modal-db-config.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'data/class-qg-team-slider-modal-helper.php';

        $this->qg_tsm_table_instance = new Qg_Team_Slider_Modal_Db_Config();
    }

    /**
     * API controller to create new team member
     *
     * @since 1.0.0
     * @return WP_Error|WP_REST_response
     */
    public function create_new_team_member($data)
    {
        $image_url = Qg_Team_Slider_Modal_Helpers::UploadImageFromRest();

        $this->qg_tsm_table_instance->full_name = $data['full_name'];
        $this->qg_tsm_table_instance->position = $data['position'];
        $this->qg_tsm_table_instance->bio = $data['bio'];
        $this->qg_tsm_table_instance->image_url = $image_url;

        $this->qg_tsm_table_instance->qg_new_team_member();

        return rest_ensure_response("success");
    }


    public function edit_team_member($data) {

        // if($_FILES['image']) {
        //     $image_url = Qg_Team_Slider_Modal_Helpers::UploadImageFromRest();
        // }

        // $this->qg_tsm_table_instance->full_name = $data['full_name'];
        // $this->qg_tsm_table_instance->position = $data['position'];
        // $this->qg_tsm_table_instance->bio = $data['bio'];
        // $this->qg_tsm_table_instance->image_url = $image_url;
        // $this->qg_tsm_table_instance->qg_update_team_member_info($data['id']);

        return rest_ensure_response("success");
    }


    /**
     * Register all API controllers
     *
     * @since 1.0.0
     */
    public function register_all_controllers()
    {
        register_rest_route("tsm/v1", "/new", array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array(&$this, 'create_new_team_member'),
            // 'permission_callback' => function() {
            //     return current_user_can('editor') || current_user_can('administrator');
            // },
            'args' => array(
                'full_name' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'The member\'s Full name',
                ),'position' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'Member\'s position'
                ), 'bio' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'Member\'s Information'
                )
            ),
        )
        );
    }
}