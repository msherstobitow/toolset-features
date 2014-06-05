<?php
/**
 * Plugin Name: Toolset Features
 * Plugin URI: http://makss.ca/plugins/toolset-features
 * Description: GUI for features settings
 * Author: Maks Sherstobitow
 * Version: 0.1
 * Author URI: http://makss.ca
 */

class Toolset_Features_Plugin {
	private static $instance = null;
	private $admin_page_name = 'toolset-features';
	private $admin_page_fullname = null;
	private $option = null;
	private $toolset = null;
	private $toolset_plugin_path = 'toolset/toolset.php';
	private $post_types = null;
	private $url = null;
	private $features = null;
	public static $textdomain = 'toolset_features';
	private $theme_path = null;

	/**
	 * Init class instance
	 */
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'current_screen', array( $this, 'current_screen' ) );
		}
		add_action( 'init', array( $this, 'after_setup_theme' ) );
	}

	/**
	 * Set default option value
	 */
	public static function activation_hook() {
		if ( !get_option( self::$textdomain ) )
			update_option( self::$textdomain, require 'config/default.php' );
	}

	/**
	 * Gets Toolset_Plugin instance
	 *
	 * Return Toolset_Plugin instance if Toolset plugin is exist and activated
	 *
	 * @return Toolset_Plugin
	 */
	private function toolset() {
		if ( $this->toolset != null )
			return $this->toolset;
		if ( is_plugin_active( $this->toolset_plugin_path ) )
			$this->toolset = Toolset_Plugin::instance();
		return $this->toolset;
	}

	/**
	 * Inits settings for admin area
	 *
	 * Inits settings for admin area only, enqueues scripts and styles
	 */
	public function admin_init() {
		$this->theme_path = get_stylesheet_directory();
		$this->save_post_data();
		$this->url = plugins_url( basename( __DIR__ ) );
		// Enqueue scripts and styles
		if ( isset( $_GET['page'] ) && $_GET['page'] == $this->admin_page_name ) {
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_style( self::$textdomain . '_css', $this->url . '/assets/css/production.min.css', array( 'wp-admin' ) );
			wp_enqueue_script( self::$textdomain . '_js', $this->url . '/assets/js/production.min.js', array( 'jquery', 'media-upload', 'thickbox', 'wp-color-picker' ), null, true );
		}
	}

	/**
	 * Adds menu item for plugin page
	 *
	 * Adds menu item for plugin page. If Toolset plugin is available the menu item will be displayed under "Toolset" menu item else under "Settings" menu item.
	 */
	public function admin_menu() {
		if ( !$this->toolset() )
			add_options_page( __( 'Toolset Features', self::$textdomain ), __( 'Toolset Features', self::$textdomain ), 'manage_options', $this->admin_page_name, array( $this, 'admin_page' ) );
		else
			$this->admin_page_fullname = $this->toolset()->add_toolset_page( __( 'Features', self::$textdomain ), __( 'Features', self::$textdomain ), 'manage_options', $this->admin_page_name, array( $this, 'admin_page' ) );
	}

	/**
	 * Renders admin page
	 */
	public function admin_page() {
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.', self::$textdomain ) );
		require 'templates/admin.php';
	}

	/**
	 * Get post types
	 *
	 * Get available post types except "attachment", "revision", "nav_menu_item"
	 */
	public function post_types() {
		if ( $this->post_types == null ) {
			$this->post_types = get_post_types( array(), 'objects' );
			unset( $this->post_types['attachment'] );
			unset( $this->post_types['revision'] );
			unset( $this->post_types['nav_menu_item'] );
		}
		return $this->post_types;
	}

	/**
	 * Gets saved option
	 *
	 * Gets saved option. If option is not exist return null
	 *
	 * @return mixed It may be array, scalar value or null
	 */
	public function option( $name = null, $reload = false ) {

		if ( $this->option == null || $reload ) {
			$this->option = get_option( self::$textdomain );
			if ( !$this->option ) {
				$this->option = require 'config/default.php';
			}
			// Post Formats and Post Thumbnails
			$posts_formats = array();
			$post_thumbnails = array();

			foreach ( $this->post_types() as $post_type_name => $post_type) {
				if (isset($this->option['post-formats'][$post_type_name])) {
					$posts_formats[$post_type_name] = $this->option['post-formats'][$post_type_name];
				} else {
					foreach ($this->features_config()['post-formats']['options'] as $post_format => $title) {
						$posts_formats[$post_type_name][$post_format] = 0;
					}
				}

				if (isset($this->option['post-thumbnails'][$post_type_name])) {
					$post_thumbnails[$post_type_name] = $this->option['post-thumbnails'][$post_type_name];
				} else {
					$post_thumbnails[$post_type_name] = 0;
				}
				
			}
			$this->option['post-formats'] = $posts_formats;
			$this->option['post-thumbnails'] = $post_thumbnails;
		}

		if ( $name ) {
			if ( isset( $this->option[$name] ) )
				return $this->option[$name];
			return null;
		}

		return $this->option;
	}

	/**
	 * Adds help tabs
	 *
	 * Adds help tabs to plugin admin screen
	 */
	public function current_screen( $current_screen ) {
		if ( $current_screen->base != $this->admin_page_fullname )
			return;
		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_post_formats',
				'title' => __( 'Post Formats', self::$textdomain ),
				'content' => '<p>' . __( 'If on post/page/custm-post-type edit screen a post you edit has already have any post format setted and post formats are enabled you will see this post format even if you did not set it checked on theme features screen.', self::$textdomain ) . '</p>'
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_post_thumbnails',
				'title' => __( 'Post Thumbnails', self::$textdomain ),
				'content' => '<p>' . __( 'Choose post type you want to have featured images.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_custom_background',
				'title' => __( 'Custom Background', self::$textdomain ),
				'content' => '<p>' . __( 'In this section you can add default values for custom background settings screen and set this feature enabled. Your theme should be prepared to use custom background feature.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_custom_header',
				'title' => __( 'Custom Header', self::$textdomain ),
				'content' => '<p>' . __( 'In this section you can add default values for custom header settings screen and set this feature enabled. Your theme should be prepared to use custom header feature.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_automatic_feed_links',
				'title' => __( 'Feed Links', self::$textdomain ),
				'content' => '<p>' . __( 'Your theme should be prepared to use automatic feed links.', self::$textdomain ) . '</p>',
			)
		);
		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_html5',
				'title' => __( 'Semantic Markup', self::$textdomain ),
				'content' => '<p>' . __( 'Your theme should be prepared to use semantic markup feature.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_sidebars',
				'title' => __( 'Sidebars', self::$textdomain ),
				'content' => '<p>' . __( 'Here you can register any count of sidebars. Your theme should be prepared to use this feature.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_menus',
				'title' => __( 'Menus Locations', self::$textdomain ),
				'content' => '<p>' . __( 'To see menus locations you should add at least one menu.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->add_help_tab(
			array(
				'id' => $this->admin_page_fullname . '_editor_style',
				'title' => __( 'Editor Style', self::$textdomain ),
				'content' => '<p>' . __( 'Add css code for Wordpress text editor.', self::$textdomain ) . '</p>',
			)
		);

		$current_screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', self::$textdomain ) . '</strong></p>' .
			'<a href="https://codex.wordpress.org/Theme_Features" target="_blank">Theme features</a><br>' .
			'<a href="https://codex.wordpress.org/Post_Formats" target="_blank">' . __( 'Post formats', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Post_Thumbnails" target="_blank">' . __( 'Post Thumbnails', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Custom_Backgrounds" target="_blank">' . __( 'CustomBackgrounds', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Custom_Headers" target="_blank">' . __( 'Custom Headers', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Automatic_Feed_Links" target="_blank">' . __( 'Automatic Feed Links', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Semantic_Markup">' . __( 'Semantic Markup', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Sidebars" target="_blank">' . __( 'Sidebars', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Navigation_Menus" target="_blank">' . __( 'Navigation Menus', self::$textdomain ) . '</a><br>' .
			'<a href="https://codex.wordpress.org/Editor_Style" target="_blank">' . __( 'Editor Style', self::$textdomain ) . '</a><br><br>'
		);
	}

	/**
	 * Add theme support and features to theme
	 */
	public function after_setup_theme() {
		$path = get_stylesheet_directory() . '/toolset/features/after-theme-setup.php';
		if (file_exists($path) && is_readable($path))
			require $path;
	}

	/**
	 * Save data from POST request
	 */
	public function save_post_data($data = null, $check_nonce = true) {
		if ( !( $data || $data = $this->is_post() ) )
			return;

		if ($check_nonce)
			check_admin_referer( self::$textdomain );

		if ( trim( $data['custom-background']['wp-head-callback'] ) )
			$data['custom-background']['wp-head-callback'] = stripslashes( $data['custom-background']['wp-head-callback'] );

		if ( trim( $data['custom-background']['admin-head-callback'] ) )
			$data['custom-background']['admin-head-callback'] = stripslashes( $data['custom-background']['admin-head-callback'] );

		if ( trim( $data['custom-background']['admin-preview-callback'] ) )
			$data['custom-background']['admin-preview-callback'] = stripslashes( $data['custom-background']['admin-preview-callback'] );

		if ( trim( $data['custom-header']['wp-head-callback'] ) )
			$data['custom-header']['wp-head-callback'] = stripslashes( $data['custom-header']['wp-head-callback'] );

		if ( trim( $data['custom-header']['admin-head-callback'] ) )
			$data['custom-header']['admin-head-callback'] = stripslashes( $data['custom-header']['admin-head-callback'] );

		if ( trim( $data['custom-header']['admin-preview-callback'] ) )
			$data['custom-header']['admin-preview-callback'] = stripslashes( $data['custom-header']['admin-preview-callback'] );

		if ( isset( $data['sidebars'] ) && count( $data['sidebars'] ) ) {
			foreach ( $data['sidebars'] as $index => $sidebar ) {
				if ( !trim( $sidebar['name'] ) || !trim( $sidebar['id'] ) ) {
					unset( $data['sidebars'][$index] );
					continue;
				}
				$data['sidebars'][$index]['before_widget'] = stripslashes( htmlspecialchars_decode( $data['sidebars'][$index]['before_widget'] ) );
				$data['sidebars'][$index]['after_widget'] = stripslashes( htmlspecialchars_decode( $data['sidebars'][$index]['after_widget'] ) );
				$data['sidebars'][$index]['before_title'] = stripslashes( htmlspecialchars_decode( $data['sidebars'][$index]['before_title'] ) );
				$data['sidebars'][$index]['after_title'] = stripslashes( htmlspecialchars_decode( $data['sidebars'][$index]['after_title'] ) );
				$data['sidebars'][$index]['id'] = strtolower( str_replace( ' ', '-', $data['sidebars'][$index]['id'] ) );
			}
		}

		$data['custom-header']['width'] = (int)$data['custom-header']['width'];
		if ( !$data['custom-header']['width'] )
			$data['custom-header']['width'] = '';
		$data['custom-header']['height'] = (int)$data['custom-header']['height'];
		if ( !$data['custom-header']['height'] )
		$data['custom-header']['height'] = '';

		if ( count( $data['menus'] ) ) {
			foreach ( $data['menus'] as $index => $menu ) {
				if ( !trim( $menu['location'] ) || !trim( $menu['description'] ) ) {
					unset( $data['menus'][$index] );
					continue;
				}
				$data['menus'][$index]['location'] = strtolower( str_replace( ' ', '-', $data['menus'][$index]['location'] ) );
			}
		}
		if ( trim( $data['editor-style'] ) ) {
			$editor_style_path = $this->theme_path . '/toolset/features/editor-style.css';
			if ( !file_exists( dirname( $editor_style_path ) ) )
				mkdir( dirname( $editor_style_path ), 0777, true );
			file_put_contents( $editor_style_path, $data['editor-style'] );
		}

		update_option( self::$textdomain, $data );
		// Update option cache
		$this->option( null, true );
		$this->create_file_cache();
	}

	/**
	 * Creates file to save scriptt to register custo post types
	 */
	private function create_file_cache() {
		$this->option();
		ob_start();
		require 'config/cache.php';
		$cache = preg_replace('/\n(\s*\n){2,}/', "\n\n", '<?php ' . ob_get_clean());

		// Create file with custom post types registering
		$url = wp_nonce_url( '/wp-admin/admin.php?page=toolset-features', self::$textdomain );

		if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) ) ) {
			wp_die( __( 'Sorry, the plugin can not write data to your server filesystem. ', self::$textdomain) );
		}
		if ( !WP_Filesystem($creds) ) {
			request_filesystem_credentials($url, '', true, false, null);
			return;
		}

		global $wp_filesystem;
		$directory_path = get_stylesheet_directory() . '/toolset/features';

		if ( !is_dir( $directory_path) ) 
			mkdir($directory_path, 0777, true);

		$wp_filesystem->put_contents(
		  $directory_path . '/after-theme-setup.php',
		  $cache,
		  FS_CHMOD_FILE // predefined mode settings for WP files
		);
	}


	/**
	 * Check if POST for plugin exists
	 *
	 * @return bool
	 */
	private function is_post() {
		return count( $_POST ) && isset( $_POST[self::$textdomain] ) && is_array( $_POST[self::$textdomain] ) && count( $_POST[self::$textdomain] ) ? $_POST[self::$textdomain] : array() ;
	}

	/**
	 * Gets theme features config
	 *
	 * @return array basic or extra features config array
	 */
	public function features_config( $section = 'basic' ) {
		$features = require 'config/features.php';
		return $features[$section];
	}

	/**
	 * Renders theme features template
	 */
	public function feature_markup( $name, $feature ) {
		$path = dirname( __FILE__ ) . '/templates/features/' . $name . '.php';
		if ( is_file( $path ) && is_readable( $path ) ) {
			$options = $this->option( $name );
			require $path;
		}
		return '';
	}

	/**
	 * Gets saved feature option
	 *
	 * @return array array of saved feature config
	 */
	public function get_feature( $feature ) {
		if ( $this->features == null )
			$this->features = get_option( 'toolset-features' );
		if ( !isset( $this->features[$feature] ) )
			return array();
		return $this->features[$feature];
	}

	/**
	 * Notice plugin's data updated
	 */
	public function notice() {
		if ( !$this->is_post() )
			return;
		echo '<div class="updated"><p>';
		echo __( 'Features updated', self::$textdomain );
		echo '</p></div>';
	}

	/**
	 * Generate sidebar's markup
	 */
	public function sidebar_markup( $sidebar = array(), $index = null, $is_first = false ) {
		$path =  dirname( __FILE__ ) . '/templates/features/sidebars/sidebar.php';
		if ( is_file( $path ) && is_readable( $path ) ) {
			if ( !$index )
				$index = time();
			if ( !$sidebar )
				$sidebar = array(
					'name'          => '',
					'id'            => '',
					'description'   => '',
					'class'         => '',
					'before_widget' => '',
					'after_widget'  => '',
					'before_title'  => '',
					'after_title'   => '',
				);
			$fields_titles = $this->features_config( 'extra' )['sidebars']['fields'];
			require $path;
		}
		return '';
	}

	/**
	 * Formats var export so things looks a little bit nicer
	 * @param  mixed $variable
	 * @return string           formatted string
	 */
	public function format_var_export( $variable ) {
		$variable = var_export( $variable, 1 );
		$variable = preg_replace('/[ ]{2}/', "\t", $variable);
		$variable = preg_replace("/\=\>[ \n\t]+array[ ]+\(/", '=> array(', $variable);
		return $variable = preg_replace("/\n/", "\n\t", $variable);
    }
}

/**
 * Inits plugin on all plugins loaded
 */
add_action('plugins_loaded', 'toolset_features_plugins_loaded');

function toolset_features_plugins_loaded() {
	new Toolset_Features_Plugin();
}

/**
 * Register activation hook
 */
if ( is_admin() ) {
	register_activation_hook( __FILE__, array( 'Toolset_Features_Plugin', 'activation_hook' ) );
}



