<?php
	$field_name = self::$textdomain . '[editor-style]';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
<textarea name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"><?php echo $options; ?></textarea>
<div class="<?php echo self::$textdomain; ?>_note"><?php _e('Please, use plain CSS.', self::$textdomain); ?></div>