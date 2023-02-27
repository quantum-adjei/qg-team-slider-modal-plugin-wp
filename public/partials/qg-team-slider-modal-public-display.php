<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://dannysunday.vercel.app
 * @since      1.0.0
 *
 * @package    Qg_Team_Slider_Modal
 * @subpackage Qg_Team_Slider_Modal/public/partials
 */

require_once plugin_dir_path(dirname(dirname(__FILE__))) . 'data/class-qg-team-slider-modal-db-config.php';
$qg_tsm_table_instance = new Qg_Team_Slider_Modal_Db_Config();

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="qg_team_slider_modal_public">
    <div class="swiper qg-tsm-swiper">
        <div class="swiper-wrapper">
            <?php

            $results = $qg_tsm_table_instance->qg_get_all_team_members();

            foreach ($results as $key => $value) {
                ?>
                <div class="swiper-slide">
                    <Team-View-Popup full_name="<?= $value['full_name'] ?>" image_url="<?= $value['image_url'] ?>"
                        position="<?= $value['position'] ?>" bio="<?= $value['bio'] ?>" />
                </div>
            <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<style>
    .swiper {
        width: 100%;
        height: 100%;
        min-height: 300px;
    }

    .swiper-slide {
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    .dialog-bottom-transition-enter-active,
    .dialog-bottom-transition-leave-active {
        transition: transform .2s ease-in-out;
    }
</style>
<?php include_once dirname(__FILE__) . '/components/qg-tsm-profile-modal.php'; ?>
<?php wp_footer(); ?>