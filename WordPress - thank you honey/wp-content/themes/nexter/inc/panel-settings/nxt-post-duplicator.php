<?php

/*
 *	Nexter Duplicate Post/Page
 *	@since 1.1.0
**/
$extension_option = get_option( 'nexter_extra_ext_options' );

if(!empty($extension_option) && isset($extension_option['wp-duplicate-post']) && !empty($extension_option['wp-duplicate-post']['switch']) && !empty($extension_option['wp-duplicate-post']['values']) ){
	if ( ! function_exists( 'nxt_duplicate_post_action_link' ) ) {
		function nxt_duplicate_post_action_link( $post ) {

			$extension_option = get_option( 'nexter_extra_ext_options' );
			$wpDupPostSet = $extension_option['wp-duplicate-post']['values'];
			if(!empty($wpDupPostSet)){

				$duplicate_access = (!empty($wpDupPostSet['nxt-duppost-access'])) ? $wpDupPostSet['nxt-duppost-access'] : 'all_users';
				$duplicate_author = (!empty($wpDupPostSet['nxt-duppost-author'])) ? $wpDupPostSet['nxt-duppost-author'] : 'current_author';
				$duplicate_date = (!empty($wpDupPostSet['nxt-duppost-date'])) ? $wpDupPostSet['nxt-duppost-date'] : 'original_date';
				$duplicate_status = (!empty($wpDupPostSet['nxt-duppost-status'])) ? $wpDupPostSet['nxt-duppost-status'] : 'same';
				$duplicate_postfix = (!empty($wpDupPostSet['nxt-duplicate-postfix'])) ? $wpDupPostSet['nxt-duplicate-postfix'] : 'Copy';
				$duplicate_slug = (!empty($wpDupPostSet['nxt-duplicate-slug'])) ? $wpDupPostSet['nxt-duplicate-slug'] : 'copy';
			
				$settings = ['duplicate_access' => $duplicate_access,
							'post_author' => $duplicate_author,
							'timestamp' => $duplicate_date,
							'status' => $duplicate_status,
							'title' => $duplicate_postfix,
							'slug' => $duplicate_slug];
				
				// Hide on trash page
				$post_status = isset( $_GET['post_status'] ) ? sanitize_text_field( wp_unslash( $_GET['post_status']) ) : false;
				if ( $post_status=='trash' ) {
					return false;
				}
				
				
				if ( $settings['duplicate_access'] == 'original_user' ) {
					if ( $post->post_author!=get_current_user_id() ) {
						return false;
					}
				}

				// Get post type
				$post_type = get_post_type_object( $post->post_type );
				
				/* translators: %s: singular name */
				$label = sprintf( __( 'Duplicate %s', 'nexter' ), $post_type->labels->singular_name );
				
				// Create and Return Link
				return '<a class="nxt-post-duplicate" href="" data-postid="'.esc_attr( $post->ID ).'">'.wp_kses_post( $label ).'</a><div class="nxt-dp-post-modal"><div class="nxt-post-modal-inner"><div class="nxt-post-dp-input-wrap"><input class="nxt-dp-post-input" type="number" min="1" value="1"/><span class="nxt-dp-post-total-text">: '.wp_kses_post($post_type->labels->singular_name).'(s)</span></div><a class="nxt-dp-post-btn" href="">'.esc_html__('Duplicate','nexter').'</a></div></div>';

			}
		}
	}
	// Duplicate Post Link Action
	if ( ! function_exists( 'nxt_duplicator_post_action' ) ) {
		function nxt_duplicator_post_action( $actions, $post ){
			
			if( function_exists('nxt_duplicate_post_action_link') && current_user_can( 'edit_posts' ) ) {
				if ( $link = nxt_duplicate_post_action_link( $post ) ) {
					$actions['nexter_duplicate_post'] = $link;
				}	
			}
			return $actions;
		}
	}


	add_filter( 'post_row_actions', 'nxt_duplicator_post_action', 10, 2 );
	add_filter( 'page_row_actions', 'nxt_duplicator_post_action', 10, 2 );
	add_filter( 'cuar/core/admin/content-list-table/row-actions', 'nxt_duplicator_post_action', 10, 2 );


	/**********************************************************/
	/*
	 * Nexter Function For Ajax Call
	 */
	if ( ! function_exists( 'nxt_post_duplicate' ) ) {
		function nxt_post_duplicate( $original_id,$p) {
			$extension_option = get_option( 'nexter_extra_ext_options' );
			$wpDupPostSet = $extension_option['wp-duplicate-post']['values'];
			if(!empty($wpDupPostSet)){

				$args=array(); $do_action=true ;

				$duplicate_access = (!empty($wpDupPostSet['nxt-duppost-access'])) ? $wpDupPostSet['nxt-duppost-access'] : 'all_users';
				$duplicate_author = (!empty($wpDupPostSet['nxt-duppost-author'])) ? $wpDupPostSet['nxt-duppost-author'] : 'current_author';
				$duplicate_date = (!empty($wpDupPostSet['nxt-duppost-date'])) ? $wpDupPostSet['nxt-duppost-date'] : 'original_date';
				$duplicate_status = (!empty($wpDupPostSet['nxt-duppost-status'])) ? $wpDupPostSet['nxt-duppost-status'] : 'same';
				$duplicate_postfix = (!empty($wpDupPostSet['nxt-duplicate-postfix'])) ? $wpDupPostSet['nxt-duplicate-postfix'] : 'Copy';
				$duplicate_slug = (!empty($wpDupPostSet['nxt-duplicate-slug'])) ? $wpDupPostSet['nxt-duplicate-slug'] : 'copy';
			
				// Get global database
				global $wpdb;
				
				// Get post array
				$duplicate = get_post( $original_id, 'ARRAY_A' );
					
				$new_settings  = ['duplicate_access' => $duplicate_access,
					'post_author' => $duplicate_author,
					'timestamp' => $duplicate_date,
					'status' => $duplicate_status,
					'title' => $duplicate_postfix,
					'slug' => $duplicate_slug
				];
				$settings = wp_parse_args( $args, $new_settings );

				if ( $settings['duplicate_access'] == 'original_user' ) {
					if ( $duplicate['post_author']!=get_current_user_id() ) {
						return false;
					}
				}

				// Change elements
				$postfixText = isset( $settings['title'] ) ? sanitize_text_field( $settings['title'] ) : esc_html__( 'Copy', 'nexter' );
				$duplicate['post_title'] = wp_kses_post( $duplicate['post_title'] ).' '.wp_kses_post($postfixText).' #'.esc_html($p);
				$duplicate['post_name'] = sanitize_title( $duplicate['post_name'].'-'.$settings['slug'] ).'-'.esc_html($p);
				
				// Set the status
				if( $settings['status'] != 'same' ) {
					$duplicate['post_status'] = sanitize_text_field( $settings['status'] );
				}
				
				// Set the post date
				$timestamp = ( $settings['timestamp'] == 'original_date' ) ? strtotime($duplicate['post_date']) : current_time('timestamp',0);
				$timestamp_gmt = ( $settings['timestamp'] == 'original_date' ) ? strtotime($duplicate['post_date_gmt']) : current_time('timestamp',1);
				
				$duplicate['post_date'] = date('Y-m-d H:i:s', $timestamp);
				$duplicate['post_date_gmt'] = date('Y-m-d H:i:s', $timestamp_gmt);
				$duplicate['post_modified'] = date('Y-m-d H:i:s', current_time('timestamp',0));
				$duplicate['post_modified_gmt'] = date('Y-m-d H:i:s', current_time('timestamp',1));
				if ( $settings['post_author'] == 'current_author' ) {
					$duplicate['post_author'] = get_current_user_id();
				}

				// Remove keys
				unset( $duplicate['ID'] );
				unset( $duplicate['guid'] );
				unset( $duplicate['comment_count'] );

				$duplicate['post_content'] = str_replace( array( '\r\n', '\r', '\n' ), '<br />', wp_kses_post( $duplicate['post_content'] ) );
				
				// Set Post into Database
				$duplicate_id = wp_insert_post( $duplicate );
				
				// Duplicate all taxonomies and terms
				$taxonomies = get_object_taxonomies( $duplicate['post_type'] );
				foreach( $taxonomies as $taxonomy ) {
					$terms = wp_get_post_terms( $original_id, $taxonomy, array('fields' => 'names') );
					wp_set_object_terms( $duplicate_id, $terms, $taxonomy );
				}
				
				// Duplicate custom fields
				$custom_fields = get_post_custom( $original_id );
				foreach ( $custom_fields as $key => $value ) {
					if( is_array($value) && count($value) > 0 ) {
						foreach( $value as $i=>$v ) {
							$data = array(
								'post_id' 		=> intval( $duplicate_id ),
								'meta_key' 		=> sanitize_text_field( $key ),
								'meta_value' 	=> $v,
							);
							$formats = array(
								'%d',
								'%s',
								'%s',
							);
							$result = $wpdb->insert( $wpdb->prefix.'postmeta', $data, $formats );
						}
					}
				}
				
				// action for custom
				if( $do_action ) {
					do_action( 'nxt_post_duplicate_custom', $original_id, $duplicate_id, $settings );
				}
				return $duplicate_id;
			}
		}
	}
	/******
	Nexter Duplicate Ajax Function
	******/
	if ( ! function_exists( 'nxt_duplicate_post_ajax' ) ) {
		function nxt_duplicate_post_ajax() {
			check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
			
			if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
				wp_send_json_error( __('Insufficient permissions.','nexter') );
			}

			$original_id  = ( isset( $_POST['original_id'] ) ) ? sanitize_text_field( intval( $_POST['original_id'] ) ) : '';
			
			if ( ! current_user_can( 'edit_post', $original_id ) ) {
				wp_send_json_error( __('You do not have permission to duplicate this post.','nexter') );
			}

			$total  = ( isset( $_POST['total'] ) ) ? sanitize_text_field( intval( $_POST['total'] ) ) : '';
			
			for($p=1; $p<=$total;$p++){
				nxt_post_duplicate( $original_id,$p );
			}

			wp_send_json_success();
		}
		add_action( 'wp_ajax_nxt_duplicate_post', 'nxt_duplicate_post_ajax' );
	}
}

?>