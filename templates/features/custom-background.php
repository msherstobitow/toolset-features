<?php
	$field_name = self::$textdomain . '[custom-background][enabled]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['enabled'], 1 ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Enabled', self::$textdomain); ?></label>
</div>
<h5><?php _e('Background Image', self::$textdomain); ?></h5>
<?php
	$field_name = self::$textdomain . '[custom-background][default-image]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_custom_background_image_wrapper">
	<div class="<?php echo self::$textdomain; ?>_custom_background_example" style="background-color: <?php echo isset($options['default-color']) ? $options['default-color'] : 'transparent' ;?>; background-image: url(<?php echo $options['default-image']; ?>); background-position: <?php echo $options['default-position-x']; ?> 0; background-repeat: <?php echo $options['default-repeat']; ?>; background-attachment: <?php echo $options['default-attachment']; ?>; "></div>
	<input type="hidden" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="<?php echo $options['default-image']; ?>">
	<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_add_new" class="button-primary"><?php _e('Choose Image', self::$textdomain); ?></a>
	<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_delete" class="button-secondary"><?php _e('Delete Image', self::$textdomain); ?></a>
</div>
<h5><?php _e('Display Options', self::$textdomain); ?></h5>
<?php
	// Background position
	$field_name = self::$textdomain . '[custom-background][default-position-x]';
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios_wrapper <?php echo self::$textdomain; ?>_background_position">
	<label><?php _e('Position'); ?></label>
	<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios">
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'left'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-position-x'], 'left' ); ?> value="left" /> <?php _e('Left', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'center'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-position-x'], 'center' ); ?> value="center" /> <?php _e('Center', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'right'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-position-x'], 'right' ); ?> value="right" /> <?php _e('Right', self::$textdomain); ?>
		</label>
	</div>
</div>
<?php
	// Background repeat
	$field_name = self::$textdomain . '[custom-background][default-repeat]';
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios_wrapper <?php echo self::$textdomain; ?>_background_repeat">
	<label><?php _e('Repeat'); ?></label>
	<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios">
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no_repeat'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-repeat'], 'no-repeat' ); ?> value="no-repeat" /> <?php _e('No Repeat', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'repeat'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-repeat'], 'repeat' ); ?> value="repeat" /> <?php _e('Tile', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'repeat_x'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-repeat'], 'repeat-x' ); ?> value="repeat-x" /> <?php _e('Tile Horizontally', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'repeat_y'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-repeat'], 'repeat-y' ); ?> value="repeat-y" /> <?php _e('Tile Vertically', self::$textdomain); ?>
		</label>
	</div>
</div>
<?php
	// Background attachment
	$field_name = self::$textdomain . '[custom-background][default-attachment]';
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios_wrapper <?php echo self::$textdomain; ?>_background_attachment">
	<label><?php _e('Attachment'); ?></label>
	<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_radios">
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'scroll'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-attachment'], 'scroll' ); ?> value="scroll" /> <?php _e('Scroll', self::$textdomain); ?>
		</label>
		<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'fixed'; ?>
		<label for="<?php echo $field_id; ?>">
			<input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['default-attachment'], 'fixed' ); ?> value="fixed" /> <?php _e('Fixed', self::$textdomain); ?>
		</label>
	</div>
</div>
<?php
	// Background color
	$field_name = self::$textdomain . '[custom-background][default-color]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_background_option <?php echo self::$textdomain; ?>_color">
	<label for="<?php echo $field_id; ?>"><?php _e('Default Color', self::$textdomain); ?></label>
	<input autocomplete="off" id="custom-background-color" type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo isset($options['default-color']) ? $options['default-color'] : '' ; ?>" />
</div>
<?php
	// WP Head Callback function
	$field_name = self::$textdomain . '[custom-background][wp-head-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Head Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['wp-head-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>

<?php
	// Admin Head Callback function
	$field_name = self::$textdomain . '[custom-background][admin-head-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Admin Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['admin-head-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>

<?php
	// Admin Preview Callback function
	$field_name = self::$textdomain . '[custom-background][admin-preview-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Admin Preview Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['admin-preview-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>