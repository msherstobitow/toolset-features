<?php
	if (!count($this->post_types()))
		return;	
	foreach ($this->post_types() as $post_type) {		
	$field_name = self::$textdomain . '[post-thumbnails][' . $post_type->name . ']';
	$field_id = str_replace(array('[', ']'), '_', $field_name);
?>
	<div class="<?php echo self::$textdomain; ?>_post_thumbnails">
		<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
		<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked($options[$post_type->name], 1); ?> value="1" />
		<label for="<?php echo $field_id; ?>"><?php echo $post_type->labels->name; ?></label>
	</div>
<?php } ?>
