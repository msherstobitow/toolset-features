<div class="wrap <?php echo self::$textdomain; ?>">
	<h2><?php _e( 'Toolset Features', self::$textdomain ); ?></h2>
	<?php $this->notice(); ?><br>
	<form action="" method="POST">
		<?php wp_nonce_field( self::$textdomain ); ?>
		<h3><?php _e( 'Basic', self::$textdomain ); ?></h3>
		<?php foreach($this->features_config() as $name => $feature) { ?>
			<div class="<?php echo self::$textdomain; ?>_options_wrapper <?php echo self::$textdomain; ?>_<?php echo $name;?>_wrapper closed">
				<h4><?php echo $feature['name']; ?></h4>
				<div class="<?php echo self::$textdomain; ?>_options_content">
					<?php echo $this->feature_markup($name, $feature); ?>
				</div>
			</div>
		<?php } ?>
		<h3 class="extra"><?php _e( 'Extra', self::$textdomain ); ?></h3>
		<?php foreach($this->features_config( 'extra' ) as $name => $feature) { ?>
			<div class="<?php echo self::$textdomain; ?>_options_wrapper <?php echo self::$textdomain; ?>_<?php echo $name;?>_wrapper closed">
				<h4><?php echo $feature['name']; ?></h4>
				<div class="<?php echo self::$textdomain; ?>_options_content">
					<?php echo $this->feature_markup($name, $feature); ?>
				</div>
			</div>
		<?php } ?>
		<?php submit_button(null, 'primary', self::$textdomain . '[submit]'); ?>
	</form>
</div>

<script>
	var toolset_features_delete_button_text = '<?php _e('Delete', self::$textdomain); ?>';
</script>