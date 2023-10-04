<?php
if( !function_exists('nxt_replace_url')){
	function nxt_replace_url() {
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );
		$user = wp_get_current_user();
		$allowed_roles = array( 'administrator' );
		if ( !empty($user) && isset($user->roles) && array_intersect( $allowed_roles, $user->roles ) ) {
			$from = ( isset($_POST['from']) && ! empty( $_POST['from'] ) ) ? esc_url($_POST['from']) : '';
			$to = ( isset($_POST['to']) && ! empty( $_POST['to'] ) ) ? esc_url($_POST['to']) : '';
			
			$case = ( isset($_POST['case']) && ! empty( $_POST['case'] ) ) ? sanitize_text_field( wp_unslash($_POST['case']) ) : '';

			$from = trim( $from ); $to = trim( $to );

			if ( $from === $to ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'The "OLD" and "NEW" URLs must be different', 'nexter' ),
					)
				);
			}
			
			/* Check Valid URL or Not*/
			
			global $wpdb;	
			$rows_affected = $post_Ser = $meta_Ser = 0;
			
			if($case=='yes'){
				$post_Ser = $wpdb->query($wpdb->prepare("SELECT ID, post_content FROM wp_posts WHERE (post_content LIKE BINARY '%".esc_sql($from)."%')"));
				$meta_Ser = $wpdb->query($wpdb->prepare("SELECT meta_value FROM wp_postmeta WHERE (meta_key='_tpgb_css' AND meta_value LIKE BINARY '%".esc_sql($from)."%')"));
			}else if($case=='no'){
				$post_Ser = $wpdb->query($wpdb->prepare("SELECT ID, post_content FROM wp_posts WHERE (post_content LIKE '%".esc_sql($from)."%')"));
				$meta_Ser = $wpdb->query($wpdb->prepare("SELECT meta_value FROM wp_postmeta WHERE (meta_key='_tpgb_css' AND meta_value LIKE '%".esc_sql($from)."%')"));
			}
			$rows_affected = $post_Ser + $meta_Ser;
			
			wp_send_json_success(
				array(
					'result' => $rows_affected,
				)
			);
		}else{
			wp_send_json_error(
				array(
					'success' => false,
					'message' => __( 'Only Admin can run this.', 'nexter' ),
				)
			);
		}
	}
	add_action( 'wp_ajax_nxt_replace_url', 'nxt_replace_url' );
	add_action('wp_ajax_nopriv_nxt_replace_url', 'nxt_replace_url' );
}

if( !function_exists('nxt_replace_confirm_url')){
	function nxt_replace_confirm_url() {
		check_ajax_referer( 'nexter_admin_nonce', 'nexter_nonce' );

		$user = wp_get_current_user();
		$allowed_roles = array( 'administrator' );
		if ( !empty($user) && isset($user->roles) && array_intersect( $allowed_roles, $user->roles ) ) {
			$from = ! empty( $_POST['from'] ) ? esc_url($_POST['from']) : '';
			$to = ! empty( $_POST['to'] ) ? esc_url($_POST['to']) : '';
			
			$case = ( isset($_POST['case']) && ! empty( $_POST['case'] ) ) ? sanitize_text_field( wp_unslash($_POST['case']) ) : '';
			
			$from = trim( $from ); $to = trim( $to );
			
			global $wpdb;	
			$rows_affected = $post_cnt = $meta_val = 0;
			
			if($case=='yes'){
				$post_cnt = $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content = REPLACE(post_content, '".esc_sql($from)."', '".esc_sql($to)."') WHERE (post_content LIKE BINARY '%".esc_sql($from)."%')"));
				$meta_val = $wpdb->query($wpdb->prepare("UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '".esc_sql($from)."', '".esc_sql($to)."') WHERE (meta_key='_tpgb_css' AND meta_value LIKE BINARY '%".esc_sql($from)."%')"));
			}else if($case=='no'){
				$post_cnt = $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content = REPLACE(post_content, '".esc_sql($from)."', '".esc_sql($to)."') WHERE (post_content LIKE '%".esc_sql($from)."%')"));
				$meta_val = $wpdb->query($wpdb->prepare("UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, '".esc_sql($from)."', '".esc_sql($to)."') WHERE (meta_key='_tpgb_css' AND meta_value LIKE '%".esc_sql($from)."%')"));
			}
			$rows_affected = $post_cnt + $meta_val;
			
			wp_send_json_success(
				array(
					'result' => $rows_affected,
				)
			);
		}else{
			wp_send_json_error(
				array(
					'success' => false,
					'message' => __( 'Only Admin can run this.', 'nexter' ),
				)
			);
		}
	}

	add_action( 'wp_ajax_nxt_replace_confirm_url', 'nxt_replace_confirm_url' );
	add_action('wp_ajax_nopriv_nxt_replace_confirm_url', 'nxt_replace_confirm_url' );
}












?>