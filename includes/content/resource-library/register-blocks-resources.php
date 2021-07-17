<?php
add_action('acf/init', 'resources_acf_init_block_types');
function resources_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        //blocks for resource library
    		acf_register_block(array(
    			'name'				=> 'resources',
    			'title'				=> __('Resources'),
    			'description'		=> __('Resources block'),
    			'render_template'   => '/includes/content/resource-library/includes/blocks/content-resources.php',
    			'align' 			=> 'wide',
    			'category'			=> 'lpbuilder',
    			'icon'				=> 'block-default',
    			'keywords'			=> array( 'resource, library' ),
    			'supports'      => array(
    							'align' => array( 'full', 'wide' ),
    							'anchor' => true,
    			),
    			'mode' 				=> 'edit',
    	));
    		acf_register_block(array(
    			'name'				=> 'simple-resources',
    			'title'				=> __('Simple Resources'),
    			'description'		=> __('Simple Resources block'),
    			'render_template'   => '/includes/content/resource-library/includes/blocks/content-simple-resources.php',
    			'align' 			=> 'wide',
    			'category'			=> 'lpbuilder',
    			'icon'				=> 'block-default',
    			'keywords'			=> array( 'resource, librar' ),
    			'supports'      => array(
    							'align' => array( 'full', 'wide' ),
    							'anchor' => true,
    			),
    			'mode' 				=> 'edit',
    	));

    }
}
 ?>
