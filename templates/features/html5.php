<?php	
	$html5_supports = array(
		'comment-list' => __('Comment List', self::$textdomain),
		'comment-form' => __('Comment Form', self::$textdomain),
		'search-form' => __('Search Form', self::$textdomain)
	);
?>
<div class="<?php echo self::$textdomain; ?>_html5_wrapper">
	<?php foreach ($html5_supports as $html5_support => $title) {
			$field_name = self::$textdomain . '[html5][' . $html5_support . ']';
			$field_id = str_replace(array('[', ']'), '_', $field_name);
			?>
			<div class="<?php echo self::$textdomain; ?>_html5">
				<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
				<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $options[$html5_support] ); ?> value="1" />
				<label for="<?php echo $field_id; ?>"><?php echo $title; ?></label>
			</div>
	<?php } ?>
</div>
