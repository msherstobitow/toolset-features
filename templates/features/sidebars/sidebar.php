<div class="<?php echo self::$textdomain; ?>_sidebars_item">
	<div class="<?php echo self::$textdomain; ?>_sidebars_row">
		<?php
		$current_sidebar_field = 0;
		foreach($sidebar as $field => $value) {
			$field_name = self::$textdomain . '[sidebars][' . $index . '][' . $field . ']';
			$field_id = str_replace(array('[', ']'), '', $field_name);
		?>
			<div>
				<label for="<?php echo $field_id; ?>"><?php echo $fields_titles[$field]; ?></label>
				<input type="text" name="<?php echo $field_name; ?>" value="<?php echo htmlspecialchars($value); ?>" />
			</div>
			<?php if ($current_sidebar_field == 3) { ?>
				</div><div class="<?php echo self::$textdomain; ?>_sidebars_row">
			<?php } ?>
		<?php
			$current_sidebar_field++;
		} ?>
	</div>
	<?php if (!$is_first) { ?>
		<a href="#" class="<?php echo self::$textdomain; ?>_sidebars_delete button"><?php _e('Delete', self::$textdomain); ?></a>
	<?php } ?>
</div>