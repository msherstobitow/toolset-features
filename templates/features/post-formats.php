<?php
	if (!count($this->post_types()))
		return;
	$default_post_formats = $this->features_config()['post-formats']['options'];
	foreach ($this->post_types() as $post_type) { ?>
	<div class="<?php echo self::$textdomain; ?>_post_type">
		<h5><?php echo ucfirst($post_type->labels->name); ?></h5>
		<?php foreach($default_post_formats as $name => $title) {
			$field_name = self::$textdomain . '[post-formats][' . $post_type->name . '][' . $name . ']';
			$field_id = str_replace(array('[', ']'), '_', $field_name);
		?>
			<div class="<?php echo self::$textdomain; ?>_post_format">
				<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
				<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options[$post_type->name][$name] ); ?> value="1" />
				<label for="<?php echo $field_id; ?>"><?php echo $title; ?></label>
			</div>
		<?php } ?>
	</div>
<?php } ?>
