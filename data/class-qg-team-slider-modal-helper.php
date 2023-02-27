<?php
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

class Qg_Team_Slider_Modal_Helpers
{

    /**
     * Function to save image programmatically
     * from a REST request.
     *
     * @since 1.0.0
     * @return string|WP_Error|WP_REST_response
    */
    public static function UploadImageFromRest()
    {
        $image_types = array("image/jpg", "image/jpeg", "image/png", "image/webp");

        // check if image field exists
        if (empty($_FILES['image'])) {
            return rest_ensure_response(
                new WP_REST_Response(
                    array('message' => 'Please upload member image'),
                    400
                )
            );
        }

        // it allows us to use wp_handle_upload() function
        require_once(ABSPATH . 'wp-admin/includes/file.php');

        $upload = wp_handle_upload(
            $_FILES['image'],
            array('test_form' => false)
        );

        // verify image mime type
        if(!in_array($upload['type'], $image_types)) {
            return rest_ensure_response(
                new WP_REST_Response(
                    array('message' => 'Invalid file type'),
                    400
                )
            );
        }

        $attachment_id = wp_insert_attachment(
            array(
                'guid' => $upload['url'],
                'post_mime_type' => $upload['type'],
                'post_title' => basename($upload['file']),
                'post_content' => '',
                'post_status' => 'inherit',
            ),
            $upload['file']
        );

        if (is_wp_error($attachment_id) || !$attachment_id) {
            return rest_ensure_response(
                new WP_REST_Response(
                    array('message' => 'Oops:( Error occured, Try again'),
                    500
                )
            );
        }

        // update medatata, regenerate image sizes
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        wp_update_attachment_metadata(
            $attachment_id,
            wp_generate_attachment_metadata($attachment_id, $upload['file'])
        );

        return wp_get_attachment_image_url($attachment_id);

    }
}