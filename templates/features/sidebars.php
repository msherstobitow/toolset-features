<div class="<?php echo self::$textdomain; ?>_<?php echo $name;?>_items">
	<?php
		$field_name = self::$textdomain . '[sidebars]';
		if ($options) {
			$is_first = true;
			foreach ($options as $sidebar_index => $sidebar) {
				$this->sidebar_markup($sidebar, $sidebar_index, $is_first);
				$is_first = false;
			}
		} ?>
</div>
<a href="#" id="<?php echo self::$textdomain; ?>_<?php echo $name;?>_add_new" class="button-primary"><?php _e('Add new', self::$textdomain); ?></a>

