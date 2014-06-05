<h5><?php _e( 'Location', self::$textdomain ); ?></h5>
<h5><?php _e( 'Description', self::$textdomain ); ?></h5>
<div class="<?php echo self::$textdomain; ?>_<?php echo $name;?>_items">
	<?php
		$field_name = self::$textdomain . '[menus]';
		if ($options) {
			$current_menu_index = 1;
			foreach ($options as $menu_index => $menu) { ?>
				<div class="<?php echo self::$textdomain; ?>_<?php echo $name;?>_item">
					<input class="location" type="text" name="<?php echo $field_name; ?>[<?php echo $menu_index; ?>][location]" value="<?php echo $menu['location']; ?>" />
					<input class="description" type="text" name="<?php echo $field_name; ?>[<?php echo $menu_index; ?>][description]" value="<?php echo $menu['description']; ?>"/>
					<?php if ($current_menu_index != 1) { ?>
						<a href="#" class="<?php echo self::$textdomain; ?>_<?php echo $name;?>_delete button"><?php _e('Delete', self::$textdomain); ?></a>
					<?php } ?>
				</div>
			<?php $current_menu_index++; }
		} else {
			$menu_index = time();
	?>
		<div class="<?php echo self::$textdomain; ?>_<?php echo $name;?>_item">
			<input class="location" type="text" name="<?php echo $field_name; ?>[<?php echo $menu_index; ?>][location]" />
			<input class="description" type="text" name="<?php echo $field_name; ?>[<?php echo $menu_index; ?>][description]" />
		</div>
	<?php } ?>
</div>
<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_add_new" class="button-primary"><?php _e('Add new', self::$textdomain); ?></a>