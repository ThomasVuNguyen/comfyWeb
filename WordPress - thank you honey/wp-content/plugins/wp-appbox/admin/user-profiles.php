<?php function wpAppbox_addCustomAffiliateID( $user ) { ?>

		<?php  
			if ( !get_option( 'wpAppbox_userAffiliate' ) ) return( false );
			$userID = $user->ID;
			if( !current_user_can( 'edit_user', $userID ) ) return( false );
		?>
		
		<h2><?php esc_html_e('WP-Appbox', 'wpappbox'); ?></h2>
		
		<style>
			.wpappbox-affiliates-table {
				background-color: #FFF;
				border: 1px solid #E5E5E5;
				border-spacing: 0;
				width: 100%;
			}
			.wpappbox-affiliates-table th {
				background-color: #F9F9F9;
				border-bottom: 1px solid #e1e1e1;
				text-align: left !important;
				font-size: 1.05em;
			}
			.wpappbox-affiliates-table th,
			.wpappbox-affiliates-table td {
				border-bottom: 1px solid #e1e1e1;
				padding: 1em;
			}
			.wpappbox-affiliates-table p {
				margin-bottom: 2px;
				margin-left: 26px;
			}
			.wpappbox-affiliates-table th {
				text-align: center;
			}
		</style>
		
		<table class="wpappbox-affiliates-table">
				<th><?php esc_html_e('Amazon Apps: Amazon PartnerNet', 'wpappbox'); ?></th>
			</tr>
			<tr>
				<td>
					<label for="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateAmazon">
						<input type="checkbox" name="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateAmazon" id="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateAmazon" value="1" <?php checked( get_option('wpAppbox_user_' . $userID . '_ownAffiliateAmazon') ); ?> /> <?php esc_html_e( 'I have an ID at Amazon PartnetNet and want to use my own ID.', 'wp-appbox' ); ?>
					</label>
					<p class="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateAmazon" <?php if ( get_option( 'wpAppbox_user_' . $userID . '_ownAffiliateAmazon' ) != true ) echo( 'style="display:none;"' ); ?>>
						<b><?php esc_html_e( 'Amazon PartnerNet ID', 'wp-appbox' ); ?>:</b> 
						<input type="text" name="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateAmazon" id="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateAmazon" value="<?php esc_attr_e(get_option('wpAppbox_user_' . $userID . '_affiliateAmazon' ) ); ?>" class="regular-text" style="width: 200px;" /> 
					</p>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e('Windows Store: Microsoft Private Affiliate Program at Impact', 'wpappbox'); ?></th>
			</tr>
			<tr>
				<td>
					<label for="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateMicrosoft">
						<input type="checkbox" name="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateMicrosoft" id="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateMicrosoft" value="1" <?php checked( get_option('wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft') ); ?> /> <?php esc_html_e('I have an ID at the Microsoft Private Affiliate Program and want to use my own ID.', 'wp-appbox'); ?>
					</label>
					<p class="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoft" <?php if ( get_option( 'wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft' ) != true ) echo( 'style="display:none;"' ); ?>>
						<b><?php esc_html_e( 'Country/Program ID', 'wp-appbox' ); ?>:</b> 
						<select style="margin-right: 10px;" name="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoftProgram" id="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoftProgram" class="postform" style="min-width:220px;">
						   <?php
						   		global $wpAppbox_MicrosoftPrivateAffiliateProgramm;
						   		print_r( $wpAppbox_MicrosoftPrivateAffiliateProgramm );
							 	foreach ( $wpAppbox_MicrosoftPrivateAffiliateProgramm as $country => $programid ):
									esc_attr_e( "<option class=\"level-0\" value=\"$programid[0]\" " . selected( get_option('wpAppbox_user_' . $userID . '_affiliateMicrosoftProgram'), $programid[0] ) . ">$country (ID: $programid[0])</option>" );
								endforeach;
							?>
						</select>
						<b><?php esc_html_e( 'Your Site ID', 'wp-appbox' ); ?>:</b> 
						<input type="text" name="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoft" id="wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoft" value="<?php esc_attr_e( get_option( 'wpAppbox_user_' . $userID . '_affiliateMicrosoft' ) ); ?>" class="regular-text" style="width: 200px;" /> 
					</p>
				</td>
			</tr>
		</table>
		
		
		<script>
		
			$j=jQuery.noConflict();
			
			$j("#wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateApple").click(function () {
				if ( $j(this).attr('checked') ) {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateApple').show();
				} else {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateApple').hide();
				}
			} );
			
			$j("#wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateAmazon").click(function () {
				if ( $j(this).attr('checked') ) {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateAmazon').show();
				} else {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateAmazon').hide();
				}
			} );
			
			$j("#wpAppbox_user_<?php esc_attr_e( $userID ); ?>_ownAffiliateMicrosoft").click(function () {
				if ( $j(this).attr('checked') ) {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoft').show();
				} else {
					$j('.wpAppbox_user_<?php esc_attr_e( $userID ); ?>_affiliateMicrosoft').hide();
				}
			} );
				
		</script>

<?php
}


function wpAppbox_saveCustomAffiliateID( $userID ) {

	if ( !current_user_can( 'edit_user', $userID ) ) return( false );
		
	if ( ( isset( $_POST['wpAppbox_user_' . $userID . '_ownAffiliateAmazon'] ) ) && ( true == $_POST['wpAppbox_user_' . $userID . '_ownAffiliateAmazon'] ) && ( '' != Trim( $_POST['wpAppbox_user_' . $userID . '_affiliateAmazon'] ) ) ):
		update_option( 'wpAppbox_user_' . $userID . '_ownAffiliateAmazon', true, 'no' );
		update_option( 'wpAppbox_user_' . $userID . '_affiliateAmazon', sanitize_text_field( Trim( $_POST['wpAppbox_user_' . $userID . '_affiliateAmazon'] ) ), 'no' );	
	else:
		delete_option( 'wpAppbox_user_' . $userID . '_ownAffiliateAmazon' );
	endif;
			
	if ( ( isset( $_POST['wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft'] ) ) && ( true == $_POST['wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft'] ) && ( '' != Trim( $_POST['wpAppbox_user_' . $userID . '_affiliateMicrosoft'] ) ) ):
		update_option( 'wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft', true, 'no' );
		update_option( 'wpAppbox_user_' . $userID . '_affiliateMicrosoft', sanitize_text_field( Trim( $_POST['wpAppbox_user_' . $userID . '_affiliateMicrosoft'] ) ), 'no' );	
		update_option( 'wpAppbox_user_' . $userID . '_affiliateMicrosoftProgram', sanitize_text_field( $_POST['wpAppbox_user_' . $userID . '_affiliateMicrosoftProgram'] ), 'no' );	
	else:
		delete_option( 'wpAppbox_user_' . $userID . '_ownAffiliateMicrosoft' );
	endif;
}


add_action( 'show_user_profile', 'wpAppbox_addCustomAffiliateID' );
add_action( 'edit_user_profile', 'wpAppbox_addCustomAffiliateID' );
add_action( 'personal_options_update', 'wpAppbox_saveCustomAffiliateID' );
add_action( 'edit_user_profile_update', 'wpAppbox_saveCustomAffiliateID' );

?>