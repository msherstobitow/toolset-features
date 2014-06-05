<?php
	$field_name = self::$textdomain . '[custom-header][enabled]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
	$checked = $options['enabled'] ? 'checked="checked" ' : '' ;
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php echo $checked; ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Enabled', self::$textdomain); ?></label>
</div>
<h5><?php _e('Background Image', self::$textdomain); ?></h5>
<?php
	$field_name = self::$textdomain . '[custom-header][default-image]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option <?php echo self::$textdomain; ?>_custom_header_image_wrapper">
	<div class="<?php echo self::$textdomain; ?>_custom_header_example" style="background-image: url(<?php echo $options['default-image']; ?>);"></div>
	<input type="hidden" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="<?php echo $options['default-image']; ?>">
	<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_add_new" class="button-primary"><?php _e('Choose Image', self::$textdomain); ?></a>
	<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_delete" class="button-secondary"><?php _e('Delete Image', self::$textdomain); ?></a>
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][random-default]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['random-default'] ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Random', self::$textdomain); ?></label>
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][width]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain;?>_text_input_wrapper">
	<label for="<?php echo $field_id; ?>"><?php _e('Width', self::$textdomain); ?></label>
	<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $options['width']; ?>" />
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][height]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain;?>_text_input_wrapper">
	<label for="<?php echo $field_id; ?>"><?php _e('Height', self::$textdomain); ?></label>
	<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $options['height']; ?>" />
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][flex-width]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['flex-width'] ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Flex Width', self::$textdomain); ?></label>
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][flex-height]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['flex-height'] ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Flex Height', self::$textdomain); ?></label>
</div>
<?php
	// Background color
	$field_name = self::$textdomain . '[custom-header][default-text-color]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option <?php echo self::$textdomain; ?>_color">
	<label for="<?php echo $field_id; ?>"><?php _e('Default Text Color', self::$textdomain); ?></label>
	<input autocomplete="off" id="custom-header-text-color" type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo isset($options['default-text-color']) ? $options['default-text-color'] : '' ; ?>" />
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][header-text]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['header-text'] ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Header Text', self::$textdomain); ?></label>
</div>
<?php
	$field_name = self::$textdomain . '[custom-header][uploads]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_custom_header_option">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options['uploads'] ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Uploads', self::$textdomain); ?></label>
</div>
<?php
	// WP Head Callback function
	$field_name = self::$textdomain . '[custom-header][wp-head-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Head Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['wp-head-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>

<?php
	// Admin Head Callback function
	$field_name = self::$textdomain . '[custom-header][admin-head-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Admin Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['admin-head-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>

<?php
	// Admin Preview Callback function
	$field_name = self::$textdomain . '[custom-header][admin-preview-callback]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<div class="<?php echo self::$textdomain; ?>_code_wrapper">
	<h5><?php _e('Admin Preview Callback Function', self::$textdomain); ?></h5>
	<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options['admin-preview-callback']; ?></textarea>
	<div class="<?php echo self::$textdomain; ?>_note"><?php _e('ATTENTION! Write function body only. Check your code twice, it can break your site!', self::$textdomain); ?></div>
</div>
