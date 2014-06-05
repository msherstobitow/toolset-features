
if ( is_admin() ) {
<?php
	if ( count( $this->option( 'post-formats' ) ) ) {
		$post_formats = $this->option( 'post-formats' );
			if (count($post_formats)) {
				foreach ( $post_formats as $post => $formats ) {
					$formats = array_keys( array_filter( $formats ) );
					if ($formats)
						$post_formats[$post] = $formats;
					else
						unset($post_formats[$post]);
				}
				if ( count( $post_formats ) ) { ?>

	// Add post formats support
	add_action( 'load-post.php', '<?php echo self::$textdomain . '_separate_post_formats'; ?>');
	add_action( 'load-post-new.php', '<?php echo self::$textdomain . '_separate_post_formats'; ?>');

	function <?php echo self::$textdomain; ?>_separate_post_formats() {
		global $typenow;
		if ( !$typenow )
			return;
		$toolset_features_post_formats = <?php echo $this->format_var_export( $post_formats ); ?>;
		if ( isset( $toolset_features_post_formats[$typenow] ) ) {
			add_theme_support( 'post-formats', $toolset_features_post_formats[$typenow] );
			add_post_type_support( $typenow, 'post-formats' );
		}
	};
		<?php } }; ?>


	if ( file_exists( __DIR__ . '/editor-style.css' ) )
		add_editor_style( 'toolset/theme-features/editor-style.css' );
		<?php
			if ( $this->option( 'post-thumbnails' ) ) {
				if ($post_thumbnails = array_keys( array_filter( $this->option( 'post-thumbnails' ) ) ) ) { ?>
	// Add post thumbnails support
	add_theme_support( 'post-thumbnails',  <?php echo $this->format_var_export( $post_thumbnails ); ?> );
				<?php }
			}
			if ( $this->option( 'menus' ) )
				foreach ( $this->option( 'menus' ) as $menu ) { ?>

	// Add navigation menus support
	register_nav_menu( ' <?php echo $menu['location']; ?>', __( '<?php echo $menu['description']; ?>' ) );
		<?php } ?>

} else {

	<?php if ( $this->option( 'automatic-feed-links' ) ) { ?>
	// Add automatic feed links support
	global $wp_version;

	if ( version_compare( $wp_version, '3.0', '>=' ) )
		add_theme_support( 'automatic-feed-links' );
	else
		automatic_feed_links();
	<?php }
		if ( $html5_supports = array_keys( array_filter( $this->option( 'html5' ) ) ) ) { ?>

	// Add semantic markup support
	add_theme_support( 'html5', <?php echo $this->format_var_export( $html5_supports ); ?> );
			<?php } ?>

}

	<?php if ( $custom_background_options = $this->option( 'custom-background' ) ) {
		if ( $custom_background_options['enabled'] ) { ?>
// Add custom background support
			<?php if ( isset( $custom_background_options['default-color'] ) )
				$custom_background_options['default-color'] = str_replace( '#', '', $custom_background_options['default-color'] );
			if ( $custom_background_options['wp-head-callback'] ) { ?>

function  <?php echo self::$textdomain; ?>_background_wp_head_callback() {
	<?php $custom_background_options['wp-head-callback']; ?>
}
				<?php $custom_background_options['wp-head-callback'] = self::$textdomain . '_background_wp_head_callback';
			}
			else
				unset( $custom_background_options['wp-head-callback'] );
			if ( $custom_background_options['admin-head-callback'] ) { ?>

function <?php echo self::$textdomain; ?>_background_admin_head_callback() {
	<?php echo $custom_background_options['admin-head-callback']; ?>

}
				<?php $custom_background_options['admin-head-callback'] = self::$textdomain . '_background_admin_head_callback';
			}
			else
				unset( $custom_background_options['admin-head-callback'] );
			if ( $custom_background_options['admin-preview-callback'] ) { ?>

function <?php echo self::$textdomain; ?>_background_admin_preview_callback() {
	<?php echo $custom_background_options['admin-preview-callback']; ?>
}
				<?php $custom_background_options['admin-preview-callback'] = self::$textdomain . '_background_admin_preview_callback';
			}
			else
				unset( $custom_background_options['admin-preview-callback'] ); ?>

add_theme_support( 'custom-background', <?php echo $this->format_var_export( $custom_background_options ); ?> );
		<?php }
	} ?>


	<?php if ( $custom_header_options = $this->option( 'custom-header' ) ) {
		if ( $custom_header_options['enabled'] ) { ?>
// Add custom header support
			<?php if ( isset( $custom_header_options['default-text-color'] ) )
				$custom_header_options['default-text-color'] = str_replace( '#', '', $custom_header_options['default-text-color'] );
			if ( $custom_header_options['wp-head-callback'] ) { ?>

function <?php echo self::$textdomain; ?>_header_wp_head_callback() {
	<?php echo $custom_header_options['wp-head-callback'];?>
}
				<?php $custom_header_options['wp-head-callback'] = self::$textdomain . '_header_wp_head_callback';
			}
			else
				unset( $custom_header_options['wp-head-callback'] );
			if ( $custom_header_options['admin-head-callback'] ) { ?>

function <?php echo self::$textdomain; ?>_header_admin_head_callback() {
	<?php echo $custom_header_options['admin-head-callback'];?>
}
				<?php $custom_header_options['admin-head-callback'] = self::$textdomain . '_header_admin_head_callback';
			}
			else
				unset( $custom_header_options['admin-head-callback'] );
			if ( $custom_header_options['admin-preview-callback'] ) { ?>

function <?php echo self::$textdomain; ?>_header_admin_preview_callback() {
	<?php echo $custom_header_options['admin-preview-callback'];?>
}
				<?php $custom_header_options['admin-preview-callback'] = self::$textdomain . '_header_admin_preview_callback';
			}
			else
				unset( $custom_header_options['admin-preview-callback'] ); ?>

add_theme_support( 'custom-header', <?php echo $this->format_var_export( $custom_header_options )?> );
		<?php }
	}
} 
if ( count( $this->option( 'sidebars' ) ) ) {
?>

/**
 * Init sidebars
 */
add_action( 'widgets_init', '<?php echo self::$textdomain; ?>_init_sidebars' );

function <?php echo self::$textdomain; ?>_init_sidebars() {
	<?php foreach ( $this->option( 'sidebars' ) as $sidebar ) { ?>
	register_sidebar( <?php echo $this->format_var_export( $sidebar ); ?> );
	<?php } ?>
}
<?php } ?>