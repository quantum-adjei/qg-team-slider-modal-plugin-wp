<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/admin/partials
 */

require_once plugin_dir_path(dirname(dirname(__FILE__))) . 'data/class-qg-team-slider-modal-list-config.php';
$qg_tsm_table_instance = new Qg_Team_Slider_Modal_List_Config();
?>

<div id="qg_team_slider_modal_admin">
    <div class="px-5">
        <h1 class="text-h4">
            <span>
                QG Team Slider-Modal
            </span>
            <Team_Slider_Modal> </Team_Slider_Modal>
        </h1>
        <div class="meta-box-sortables ui-sortable">
            <form method="post">
                <?php
                $qg_tsm_table_instance->prepare_items();
                $qg_tsm_table_instance->search_box('Search', 'search_id');
                $qg_tsm_table_instance->display(); ?>
            </form>
        </div>
    </div>
</div>

<?php include_once dirname(__FILE__) . '/components/qg-tsm-new-member.php'; ?>
<?php wp_footer(); ?>