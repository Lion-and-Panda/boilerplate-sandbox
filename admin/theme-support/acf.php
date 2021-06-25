<?php

//-----------------------------------  // create custom block category //-----------------------------------//

function my_mario_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'lpbuilder',
				'title' => __( 'Lion + Panda Blocks', 'lpbuilder' ),
				'icon'				=> 'schedule',
			),
		)
	);
}
add_filter( 'block_categories', 'my_mario_block_category', 10, 2);

//-----------------------------------  // add custom blocks //-----------------------------------//
add_action('acf/init', 'my_acf_init');
function my_acf_init() {

		if( function_exists('acf_register_block') ) {

		acf_register_block(array(
				'name'				=> 'hero',
				'title'				=> __('Hero'),
				'description'		=> __('A Hero Banner'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'hero, header' ),
				'supports'      => array(
                'align' => array( 'full', 'wide' ),
                'anchor' => true,
        ),
				'mode' 				=> 'edit',
		));

			acf_register_block(array(
				'name'				=> 'page-headline',
				'title'				=> __('Page Headline'),
				'description'		=> __('A Page Title or Large Headline'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'title, header' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));

			acf_register_block(array(
				'name'				=> 'content-block',
				'title'				=> __('Content Block'),
				'description'		=> __('Text Content Blocks'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'content, text' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));

		acf_register_block(array(
			'name'				=> 'popup',
			'title'				=> __('Popup'),
			'description'		=> __('A block with a button to trigger a popup'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'align' 			=> 'wide',
			'category'			=> 'lpbuilder',
			'icon'				=> 'block-default',
			'keywords'			=> array( 'popup, modal, columns' ),
			'supports'      => array(
							'align' => 'wide',
							'anchor' => true
			),
			'mode' 				=> 'edit',
	));

	acf_register_block(array(
		'name'				=> 'cta-popup',
		'title'				=> __('CTA Popup'),
		'description'		=> __('A CTA block with a button to trigger a popup'),
		'render_callback'	=> 'my_acf_block_render_callback',
		'align' 			=> 'wide',
		'category'			=> 'lpbuilder',
		'icon'				=> 'block-default',
		'keywords'			=> array( 'cta, all to action, popup, modal' ),
		'supports'      => array(
						'align' => 'wide',
						'anchor' => true
		),
		'mode' 				=> 'edit',
));
			acf_register_block(array(
				'name'				=> 'vi-copy',
				'title'				=> __('Video Or Image and Copy'),
				'description'		=> __('Video or image with copy block'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'video, image, copy, text, content' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'video-hero',
				'title'				=> __('Video Background Hero'),
				'description'		=> __('Hero With Video Background'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'hero, video, header' ),
				'supports'      => array(
								'align' => 'wide',
								'anchor' => true
				),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'video',
				'title'				=> __('Video'),
				'description'		=> __('Video Embed'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'video' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
acf_register_block(array(
	'name'				=> 'image-video-gallery',
	'title'				=> __('Image and Video Gallery'),
	'description'		=> __('Image and video gallery'),
	'render_callback'	=> 'my_acf_block_render_callback',
	'align' 			=> 'wide',
	'category'			=> 'lpbuilder',
	'icon'				=> 'block-default',
	'keywords'			=> array( 'video, gallery' ),
	'supports'      => array(
					'align' => 'wide',
					'anchor' => true
	),
	'mode' 				=> 'edit',
));
			acf_register_block(array(
				'name'				=> 'featured-columns',
				'title'				=> __('Featured Columns'),
				'description'		=> __('Featued Columns'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'columns, feature' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
		acf_register_block(array(
			'name'				=> 'testimonials',
			'title'				=> __('Testimonials'),
			'description'		=> __('Testimonial blocks'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'align' 			=> 'wide',
			'category'			=> 'lpbuilder',
			'icon'				=> 'block-default',
			'keywords'			=> array( 'testimonials' ),
			'supports'      => array(
							'align' => 'wide',
							'anchor' => true
			),
			'mode' 				=> 'edit',
	));
			acf_register_block(array(
				'name'				=> 'steps',
				'title'				=> __('Steps'),
				'description'		=> __('Steps Displayed In Columns'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'steps, columns' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'cta',
				'title'				=> __('Call To Action'),
				'description'		=> __('A Full Width Call To action'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'call to action, cta' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'cta2',
				'title'				=> __('Two Sided Call To Action'),
				'description'		=> __('A Two Sided Call To action'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'call to action, cta, columns' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'recent-posts',
				'title'				=> __('Recent Blog Posts'),
				'description'		=> __('Display Recent Blog Posts'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'recent posts, posts, blog' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'tabs',
				'title'				=> __('Tabs'),
				'description'		=> __('Expandable Tabs'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'tabs' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'Accordion',
				'title'				=> __('Accordion'),
				'description'		=> __('Expandable Accordion'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'accordion, tabs' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
			acf_register_block(array(
				'name'				=> 'slider',
				'title'				=> __('Slider'),
				'description'		=> __('Image Slider'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'slider' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
		acf_register_block(array(
			'name'				=> 'logo-slider',
			'title'				=> __('Logo Slider'),
			'description'		=> __('Slideshow of a series of logos'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'align' 			=> 'wide',
			'category'			=> 'lpbuilder',
			'icon'				=> 'block-default',
			'keywords'			=> array( 'slider, logos' ),
			'supports'      => array(
							'align' => 'wide',
							'anchor' => true
			),
			'mode' 				=> 'edit',
	));
			acf_register_block(array(
				'name'				=> 'button',
				'title'				=> __('Button'),
				'description'		=> __('A Button'),
				'render_callback'	=> 'my_acf_block_render_callback',
				'align' 			=> 'wide',
				'category'			=> 'lpbuilder',
				'icon'				=> 'block-default',
				'keywords'			=> array( 'button' ),
				'supports'      => array(
                'align' => 'wide',
                'anchor' => true
        ),
				'mode' 				=> 'edit',
		));
		}
}

// Save ACF Fields Constantly
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/admin/acffields';
    // return
    return $path;
}
// Sync ACF Fields on Live
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/admin/acffields';
    // return
    return $paths;
}
