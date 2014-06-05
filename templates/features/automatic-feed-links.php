<?php
	$field_name = self::$textdomain . '[automatic-feed-links]';
	$field_id = str_replace(array('[', ']'), '_', $field_name); 
?>
<div class="<?php echo self::$textdomain; ?>_automatic_feed_links">
	<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
	<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options ); ?> value="1" />
	<label for="<?php echo $field_id; ?>"><?php _e('Enabled', self::$textdomain); ?></label>
</div>

