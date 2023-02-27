<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Qg_Team_Slider_Modal_List_Config extends WP_List_Table
{

    public $qg_tsm_db_config;

    public function __construct()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'data/class-qg-team-slider-modal-db-config.php';
        $this->qg_tsm_db_config = new Qg_Team_Slider_Modal_Db_Config();

        parent::__construct([
            // singular name of the listed records
            'singular' => __('QG Team Member', 'sp'),

            // plural name of the listed records
            'plural' => __('QG Team Members', 'sp'),

            'ajax' => true // should this table support ajax?
        ]);
    }

    /**
     * Retrieve all team data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public function get_all_qg_team_members($per_page = 5, $page_number = 1)
    {
        global $wpdb;

        $sql = "SELECT * FROM {$this->qg_tsm_db_config->qg_table_name}";


        if (!empty($_REQUEST['s'])) {
            $search = esc_sql($_REQUEST['s']);
            $sql .= " WHERE full_name LIKE '%{$search}%'";
        }

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $sql .= " LIMIT $per_page";

        $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;

        return $wpdb->get_results($sql, 'ARRAY_A');
    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public function record_count()
    {
        global $wpdb;
        $sql = "SELECT COUNT(*) FROM {$this->qg_tsm_db_config->qg_table_name}";
        return $wpdb->get_var($sql);
    }

    /** Text displayed when no customer data is available */
    public function no_items()
    {
        _e('No team members avaliable.', 'sp');
    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_full_name($item)
    {

        // create a nonce
        $delete_nonce = wp_create_nonce('sp_delete_qg_tsm');

        $title = '<strong>' . $item['full_name'] . '</strong>';

        $actions = [
            'delete' => sprintf('<a href="?page=%s&action=%s&qg_tsm_delete=%s&_wpnonce=%s">Delete</a>', esc_attr($_REQUEST['page']), 'delete', absint($item['id']), $delete_nonce),
            'edit' => sprintf('<a href="?page=%s&qg_sf_edit=%s">Edit</a>', esc_attr('qg_station_finder_edit_station'), absint($item['id'])),
            
            // 'view' => sprintf('
            //     <a href="#TB_inline?&width=600&height=550&inlineId=qg-sf-map-preview-%s" class="thickbox">View</a>
            //     <div id="qg-sf-map-preview-%s" style="display:none;">
            //         <div id="map">
            //             <iframe width="600" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=' . $item['longitude'] . ',' . $item['latitude'] . ',' . $item['longitude'] . ',' . $item['latitude'] . '&amp;layer=mapnik&amp;marker=' . $item['latitude'] . ',' . $item['longitude'] . '" style="border: 1px solid black"></iframe>
            //         </div>
            //     </div>
            // ', absint($item['id']), absint($item['id'])),
        ];

        return $title . $this->row_actions($actions);
    }

    /**
     * Method for image url column
     * @since 1.0.0
    */
    function column_image_url($item)
    {
        return sprintf(
            '<v-img src="%s" width="60px" height="60px" cover :aspect-ratio="1"></v-img>',
            $item['image_url']
        );
    }

    /**
     * Render a column when no column specific method exists.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'full_name':
            case 'position':
            case 'image_url':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
        );
    }

    /**
     * Associative array of columns
     *
     * @return array
     */
    function get_columns()
    {
        return [
            'cb' => '<input type="checkbox" />',
            'full_name' => __('Name', 'sp'),
            'position' => __('Position', 'sp'),
            'image_url' => __('Image', 'sp'),
        ];
    }


    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        return [
            'bulk-delete' => 'Delete'
        ];
    }

    /**
     * Get sortable columns
     * @return array
     */
    function get_sortable_columns()
    {
        return array(
            'full_name' => ['full_name', true],
            'position' => ['position', true],
        );
    }

    /**
     * Get search box
     *
     *
     */
    public function search_box($text, $input_id)
    {
        if (empty($_REQUEST['s']) && !$this->has_items()) {
            return;
        }

        $input_id = $input_id . '-search-input';

        if (!empty($_REQUEST['orderby'])) {
            echo '<input type="hidden" name="orderby" value="' . esc_attr($_REQUEST['orderby']) . '" />';
        }
        if (!empty($_REQUEST['order'])) {
            echo '<input type="hidden" name="order" value="' . esc_attr($_REQUEST['order']) . '" />';
        }
        if (!empty($_REQUEST['post_mime_type'])) {
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr($_REQUEST['post_mime_type']) . '" />';
        }
        if (!empty($_REQUEST['detached'])) {
            echo '<input type="hidden" name="detached" value="' . esc_attr($_REQUEST['detached']) . '" />';
        }
        ?>
        <p class="search-box">
            <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo $text; ?>:</label>
            <input type="search" id="<?php echo esc_attr($input_id); ?>" name="s" value="<?php _admin_search_query(); ?>" />
            <?php submit_button($text, '', '', false, array('id' => 'search-submit')); ?>
        </p>
    <?php
    }


    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {

        $this->_column_headers = [
            $this->get_columns(),
            [], // hidden columns
            $this->get_sortable_columns(),
            $this->get_primary_column_name(),
        ];

        /** Process bulk action */
        $this->process_bulk_action();

        $per_page = $this->get_items_per_page('qg_tsm_per_page', 5);
        $current_page = $this->get_pagenum();
        $total_items = $this->record_count();

        $this->set_pagination_args([
            'total_items' => $total_items,
            //WE have to calculate the total number of items
            'per_page' => $per_page //WE have to determine how many items to show on a page
        ]);

        $this->items = $this->get_all_qg_team_members($per_page, $current_page);
    }


    public function process_bulk_action()
    {

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);

            if (!wp_verify_nonce($nonce, 'sp_delete_qg_tsm')) {
                die('Go get a life script kiddies');
            } else {
                $this->qg_tsm_db_config->qg_delete_member(absint($_GET['qg_tsm_delete']));

                wp_redirect(esc_url(add_query_arg(array('page' => 'qg_team_slider_modal'), admin_url('admin.php'))));
                exit;
            }

        }

        // If the delete bulk action is triggered
        if (
            (isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
            || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
        ) {

            $delete_ids = esc_sql($_POST['bulk-delete']);

            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $id) {
                $this->qg_tsm_db_config->qg_delete_member($id);

            }

            wp_redirect(esc_url(add_query_arg(array('page' => 'qg_team_slider_modal'), admin_url('admin.php'))));
            exit;
        }
    }
}