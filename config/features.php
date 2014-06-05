<?php
return array(
	'basic' => array(
		'post-formats' => array(
			'name' => __('Post Formats'),
			'options' => array(
				'aside' => __('Aside'),
				'gallery' => __('Gallery'),
				'link' => __('Link'),
				'image' => __('Image'),
				'quote' => __('Quote'),
				'status' => __('Status'),
				'video' => __('Video'),
				'audio' => __('Audio'),
				'chat' => __('Chat')
			)
		),
		'post-thumbnails' => array(
			'name' => __('Post Thumbnails'),
		),
		'custom-background' => array(
			'name' => __('Custom Background'),
		),
		'custom-header' => array(
			'name' => __('Custom Header'),
		),
		'automatic-feed-links' => array(
			'name' => __('Automatic Feed Links'),
		),
		'html5'  => array(
			'name' => __('Semantic Markup'),
		)
	),
	'extra' => array(
		'sidebars' => array(
			'name' => __('Sidebars'),
			'fields' => array(
				'name'          => __('Name', self::$textdomain ),
				'id'            => __('ID', self::$textdomain ),
				'description'   => __('Description', self::$textdomain ),
				'class'         => __('Class', self::$textdomain ),
				'before_widget' => __('Before Widget', self::$textdomain ),
				'after_widget'  => __('After Widget', self::$textdomain ),
				'before_title'  => __('Before Title', self::$textdomain ),
				'after_title'   => __('After Title', self::$textdomain )
			)
		),
		'menus' => array(
			'name' => __('Navigation Menus'),
		),
		'editor-style' => array(
			'name' => __('Editor Style'),
		)
	)
);