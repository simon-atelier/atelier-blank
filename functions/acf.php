<?php
function block_append($block_name) {
	$filename = get_template_directory() . '/acf/acf_blocks.php';
	$append_content = "
			acf_register_block_type( build_acf_block( 
	            '" . $block_name . "',
	            '" . str_replace("-", " ", ucfirst($block_name)) . "',
	            '" . str_replace("-", " ", ucfirst($block_name)) . "',
	        ));
		} 
	}";

	// Get list of currently registered blocks to filter
	$key_exists = false;
	$current_acf_blocks = acf_get_block_types();
	foreach ($current_acf_blocks as $block_key => $block_val) {
		if(strpos($block_key, $block_name) !== false ) $key_exists = true;
	}

	if (!$key_exists) {
		// Declare block in acf_blocks.php
		$file = fopen($filename, "c");
		fseek($file, -5, SEEK_END);
		fwrite($file, $append_content);
		fclose($file);
	}
}


function build_acf_block($id, $title, $description, $icon = "welcome-widgets-menus"){
    $keywords = str_replace("-", " ", $id);
    return array(
        'name'              => $id,
        'title'             => __($title),
        'description'       => __($description),
        'render_template'   => get_template_directory() . '/acf/blocks/' . $id . '/' . $id . '-block.php',
        'category'          => 'flexi-blocks',
        'icon'              => $icon,
        'keywords'          => array( $keywords ),
        'enqueue_style'     => get_template_directory_uri() . '/acf/blocks/' . $id . '/' . $id . '.css',
        'enqueue_script'    => get_template_directory_uri() . '/acf/blocks/' . $id . '/' . $id . '.js',
    );
}



/* 
	Functions to import field JSON in editable format
*/
function flexi_default_acf_fields($field_group) {
	$acf_json_data = file_get_contents( get_stylesheet_directory() . '/acf/load-points/' . $field_group . '.json' );
	if ( $acf_json_data && $custom_fields = json_decode( $acf_json_data, true ) ) {

		$field_groups = acf_get_field_groups();
		
		$group_exists = false;
		if($field_groups) {
			foreach ($field_groups as $field_group) {
				if( $field_group['key'] == $custom_fields[0]['key'] ) $group_exists = true;
			}	
		}
			
		if (!$group_exists) {
			foreach ( $custom_fields as $custom_field ) {
				acf_import_field_group( $custom_field ); // editable
				// acf_add_local_field_group( $custom_field ); // not editable
			}
		}
	}
}
// add_action( 'acf/init', 'flexi_default_acf_fields' );

// Register Admin menu item
function flexi_admin_menu() {
	add_menu_page(
		__( 'Field imports', 'atelier' ),
		__( 'Field imports', 'atelier' ),
		'manage_options',
		'flexi-import',
		'flexi_admin_page_contents',
		'dashicons-database-import',
		100
	);
}
add_action( 'admin_menu', 'flexi_admin_menu' );


// Flexi Admin page content
function flexi_admin_page_contents() {
	?>
		<h1><?php esc_html_e( 'Import standard flexi field groups', 'atelier' ); ?></h1>
		<form action="?page=flexi-import">
			<div class="admin-flexi__checkboxes">
				
				<?php  
					$import_options = [
						"button" => "Button",
						"hero" => "Hero slider",
						"page-banner" => "Page banner",
						"contact-form" => "Contact form",
						"cta-strip" => "CTA strip",
						"image-gallery" => "Image gallery",
						"latest-news" => "Latest news",
						"social-share" => "Social share",
						"text-image" => "Half text/ Half image",
						"related-posts" => "Related posts",
						"accordion" => "Accordion",
						"content-panel" => "Content panels"
					];
					$dir_fix = getcwd();
					$dir_fix = str_replace("wp-admin", "", $dir_fix);
					$dirs = scandir(get_template_directory() . '/acf/blocks');
					$i = 1;
					foreach ($import_options as $key => $import_option) {
						$disabled = in_array($key, $dirs) ? ' disabled' : "" ;
						echo '<div class="admin-flexi__checkbox">
								<input 
									type="checkbox" 
									name="flexi_import[]" 
									id="flexi_import' . $i . '" 
									value="' . $key . '"
									' . $disabled . '
								>
								<label for="flexi_import' . $i . '" class="'. $disabled .'">' . $import_option . '</label>
							</div>';
						$i++;
					}
				?>
			</div>

			<div class="admin-flexi__controls">
				<button type="button" class="importBtn button">
					<span class="importText">Import</span>
					<span class="spinner"></span>
				</button>
			</div>
		</form>

		<style>
			.admin-flexi__controls {
				margin-top: 20px;
			}
			.admin-flexi__checkbox {
				margin-bottom: 10px;
			}
			.admin-flexi__checkbox label.disabled {
				opacity: 0.7;
			}
			.admin-flexi__checkboxes {
				margin-bottom: 20px;
			}
			.importBtn .spinner {
				margin: 4px 0 0 10px;
				visibility: visible;
				display: none;
			}
		</style>
		<script>
			// AJAX call to start import
			jQuery('.importBtn').on('click', function(el){
				jQuery('.importBtn .spinner').show()
				jQuery(this).addClass('disabled')
				let importValues = jQuery('input[name="flexi_import[]"]:checked')
				let importArray = []
				importValues.each(function(){
					importArray.push(jQuery(this).val())
				})
				
				jQuery.ajax({
					url : '<?php echo admin_url('admin-ajax.php'); ?>',
					type : 'post',
					data : {
						action : 'flexi_import_update',
						importArray : importArray
					},
					success : function(response) {
						console.log(response)
						jQuery('.importBtn .spinner').hide()
						jQuery('.importBtn').removeClass('disabled')
						location.reload();
					}
				});
			})
		</script>
	<?php
}

// AJAX response to run import 
function flexi_import_update() {
	$dir_fix = getcwd();
	$dir_fix = str_replace("wp-admin", "", $dir_fix);
	$import_keys = $_REQUEST['importArray'];
	foreach ($import_keys as $import_key) {
		flexi_default_acf_fields($import_key);
		block_append($import_key);	
		rename(get_template_directory() . "/acf/load-points/blocks/" . $import_key, get_template_directory() . "/acf/blocks/" . $import_key);
	}
	exit('Fields imported');
}
add_action('wp_ajax_flexi_import_update', 'flexi_import_update');
add_action('wp_ajax_nopriv_flexi_import_update', 'flexi_import_update');






function acf_load_post_type_field_choices( $field ) {
    $field['choices'] = array();
    $choices = get_post_types();
    foreach( $choices as $choice ) $field['choices'][ $choice ] = $choice;
    return $field;
}
add_filter('acf/load_field/name=ln_post_type', 'acf_load_post_type_field_choices');



function add_acf_options_fields() {
	// Add theme options
	if(function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title' 	=> 'Theme Settings',
			'menu_title'	=> 'Theme Options',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}
	if( function_exists('acf_add_local_field_group') ):
		acf_add_local_field_group(array(
			'key' => 'group_61d9aa4952af2',
			'title' => 'Theme options',
			'fields' => array(
				array(
					'key' => 'field_61d9aa57b26bb',
					'label' => 'Enable testimonials',
					'name' => 'enable_testimonials',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '33',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				array(
					'key' => 'field_61daad16b7111',
					'label' => 'Enable search bar',
					'name' => 'enable_search_bar',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '33',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 1,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'theme-general-settings',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));

		acf_add_local_field_group(array(
			'key' => 'group_6278429424c3d',
			'title' => '[Block] Content Container',
			'fields' => array(
				array(
					'key' => 'field_6278429c88c04',
					'label' => 'Container width',
					'name' => 'cc_container_width',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'small' => 'Small',
						'medium' => 'Medium',
						'large' => 'Large',
						'fullwidth' => 'Full Width',
					),
					'default_value' => 'small',
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/content-container',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 0,
		));

	endif;	
}
add_action('acf/init', 'add_acf_options_fields');
