<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Pasav
 * @subpackage Pasav/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pasav
 * @subpackage Pasav/admin
 * @author     Mauriac Azoua <azouamauriac@gmail.com>
 */
class Pasav_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pasav_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pasav_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pasav-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pasav_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pasav_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pasav-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register password saver cpt.
	 *
	 * @return void
	 */
	public function register_save_password_cpt() {
		$labels = array(
			'name'                  => _x( 'Password Saver', 'Post Type General Name', 'pasav' ),
			'singular_name'         => _x( 'Pssword Saver', 'Post Type Singular Name', 'pasav' ),
			'menu_name'             => __( 'pasav', 'pasav' ),
			'name_admin_bar'        => __( 'Pssword Saver', 'pasav' ),
			'archives'              => __( 'Our', 'pasav' ),
			'attributes'            => __( 'Attributes', 'pasav' ),
			'parent_item_colon'     => __( 'Parent :', 'pasav' ),
			'all_items'             => __( 'All Configurations', 'pasav' ),
			'add_new_item'          => __( 'Add New', 'pasav' ),
			'add_new'               => __( 'Add New', 'pasav' ),
			'new_item'              => __( 'New', 'pasav' ),
			'edit_item'             => __( 'Edit', 'pasav' ),
			'update_item'           => __( 'Update', 'pasav' ),
			'view_item'             => __( 'View ', 'pasav' ),
			'view_items'            => __( 'View', 'pasav' ),
			'search_items'          => __( 'Search', 'pasav' ),
			'not_found'             => __( 'Not found', 'pasav' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'pasav' ),
			'featured_image'        => __( ' Sketch', 'pasav' ),
			'set_featured_image'    => __( 'Set sketch', 'pasav' ),
			'remove_featured_image' => __( 'Remove sketch', 'pasav' ),
			'use_featured_image'    => __( 'Use as sketch', 'pasav' ),
			'insert_into_item'      => __( 'Insert into sheet', 'pasav' ),
			'uploaded_to_this_item' => __( 'Uploaded to this sheet', 'pasav' ),
			'items_list'            => __( 'list', 'pasav' ),
			'items_list_navigation' => __( 'list navigation', 'pasav' ),
			'filter_items_list'     => __( 'Filter  list', 'pasav' ),
		);

		$args = array(
			'label'                 => __( 'Pssword Saver', 'pasav' ),
			'description'           => __( 'Save your password from anywhere', 'pasav' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-hammer',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_base'             => 'pasav-api',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		);
		register_post_type( PASAV_CONFIG_CPT, $args );
	}

	/**
	 * Add meta box to configuration ctp with options page.
	 *
	 * @return void
	 */
	public function get_save_password_metabox() {
			add_meta_box(
				'wp-pasav-box',
				__( 'Save Password', 'wad' ),
				array( $this, 'save_pass_page' ),
				PASAV_CONFIG_CPT
			);
	}

	/**
	 * Get meta box options page.
	 *
	 * @return void
	 */
	public static function save_pass_page() {
		$post_id       = get_the_ID();
		$password_save = new Pasav_Password_Saver( $post_id );
		?>

		<form method="POST" >
			<table class="form-table">
				<tr>
					<td><label><?php esc_html_e( 'Password', 'pasav' ); ?></label></td>
					<td><input type="text" name="pasav-options[pasav_password]" value="<?php echo $password_save->get_settings( 'pasav_password' ); ?>"/></td>
				</tr>
				<tr>
					<td><label><?php esc_html_e( 'Website', 'pasav' ); ?></label></td>
					<td><input type="text" name="pasav-options[pasav_website]" value="<?php echo esc_attr( $password_save->get_settings( 'pasav_website' ) ); ?>"/></td>
				</tr>
				<tr>
					<td><label><?php esc_html_e( 'Description', 'pasav' ); ?></label></td>
					<td><textarea  name="pasav-options[pasav_description]"><?php echo esc_attr( $password_save->get_settings( 'pasav_description' ) ); ?> </textarea></td>
				</tr>
			</table>
			<input type="hidden" name="securite_nonce_pasav" value="<?php echo esc_html( wp_create_nonce( 'securite-nonce-pasav' ) ); ?>"/>
		</form>
		<?php
	}

	/**
	 * Save post meta.
	 *
	 * @param string $post_id comment.
	 * @return void
	 */
	public function save_pasav_config_cpt( $post_id ) {
		if ( isset( $_POST['securite_nonce_pasav'] ) && wp_verify_nonce( sanitize_key( $_POST['securite_nonce_pasav'] ), 'securite-nonce-pasav' ) ) {
			$to_save = array();
			if ( isset( $_POST['pasav-options'] ) ) {
				$to_save = array_map( 'sanitize_text_field', wp_unslash( $_POST['pasav-options'] ) );
			}
			update_post_meta( $post_id, 'pasav-options', $to_save );
		}
	}

}
