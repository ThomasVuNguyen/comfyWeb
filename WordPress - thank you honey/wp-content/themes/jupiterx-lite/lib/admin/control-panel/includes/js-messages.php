<?php
/**
 * List of all texts in control panel for translation
 *
 * @package Control Panel
 */

/**
 * This function will be hooked into wp_localize_script in admin/general/enqueue-assets.php
 *
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
function jupiterx_adminpanel_textdomain() {
	return array(
		'theme_update_success'                                             => __( 'Theme Updated successfully.', 'jupiterx-lite' ),
		'theme_update_failed'                                              => __( 'Theme update failed. Please try again.', 'jupiterx-lite' ),
		'theme_update_failed_due_to_permission'                            => __( 'Please check file or folder permissions on your server.', 'jupiterx-lite' ),
		'network_active'                                                   => __( 'Network Active', 'jupiterx-lite' ),
		'agree'                                                            => __( 'Agree', 'jupiterx-lite' ),
		'please_note'                                                      => __( 'Please Note:', 'jupiterx-lite' ),
		'any_customisation_you_have_made_to_theme_files_will_be_lost'      => sprintf( __( 'Any customisation you have made to theme files will be lost. <a href="%s" target="_blank">Read More</a>', 'jupiterx-lite' ), 'https://themes.artbees.net/docs/updating-jupiter-x-theme-automatically/' ),

		'restore_settings'                                                 => __( 'Restore Settings', 'jupiterx-lite' ),
		'you_are_trying_to_restore_your_theme_settings_to_this_date'       => __( 'You are trying to Restore your database to this date: ', 'jupiterx-lite' ),
		'yes_install'                                                      => __( 'Yes', 'jupiterx-lite' ),
		'restore'                                                          => __( 'Restore', 'jupiterx-lite' ),
		'reload_page'                                                      => __( 'Reload Page', 'jupiterx-lite' ),
		'uninstalling_template_will_remove_all_your_contents_and_settings' => __( 'Uninstalling template will remove all you current data and settings. Do you want to proceed?', 'jupiterx-lite' ),
		'yes_uninstall'                                                    => __( 'Yes, uninstall ', 'jupiterx-lite' ),
		'template_uninstalled'                                             => __( 'Template uninstalled.', 'jupiterx-lite' ),
		'hooray'                                                           => __( 'All Done!', 'jupiterx-lite' ),
		'template_installed_successfully'                                  => __( 'Template is successfully installed.', 'jupiterx-lite' ),

		'preview'                                                          => __( 'Preview', 'jupiterx-lite' ),
		'import'                                                           => __( 'Import', 'jupiterx-lite' ),
		'downloading_sample_package_data'                                  => __( 'Downloading package', 'jupiterx-lite' ),
		'backup_reset_database'                                            => __( 'Backup Database', 'jupiterx-lite' ),
		'install_required_plugins'                                         => __( 'Install required plugins', 'jupiterx-lite' ),
		'install_sample_data'                                              => __( 'Installing in progress...', 'jupiterx-lite' ),
		'installed'                                                        => __( 'Installed', 'jupiterx-lite' ),
		'include_images_and_videos'                                        => __( 'Include Images and Videos?', 'jupiterx-lite' ),
		'using_ie_edge_not_support'                                        => __( 'Your browser is not supported.', 'jupiterx-lite' ),
		'recommend_to_use_other_browsers'                                  => __( 'Jupiter X detected that you are using IE or EDGE browser that will prevent you from successfully importing media. Please use other modern browsers. {param}', 'jupiterx-lite' ),
		'insufficient_system_resource'                                     => __( 'Insufficient system resource', 'jupiterx-lite' ),
		'insufficient_system_resource_notes'                               => __( 'Your system resource is not enough. Please contact our support or {param} here.', 'jupiterx-lite' ),
		'continue_without_media'                                           => __( 'Continue without Media', 'jupiterx-lite' ),
		'do_not_include'                                                   => __( 'Do not Include', 'jupiterx-lite' ),
		'include'                                                          => __( 'Include', 'jupiterx-lite' ),
		'whoops'                                                           => __( 'Whoops!', 'jupiterx-lite' ),
		'dont_panic'                                                       => __( 'There seems to be an inconsistency in installing procedure. Don\'t panic though here we\'ve listed some possible solutions for you to get back on track.<br>( Warning number : {param}) {param} ', 'jupiterx-lite' ),
		'error_in_network_please_check_your_connection_and_try_again'      => __( 'Error in network , Please check your connection and try again', 'jupiterx-lite' ),
		'incorrect_credentials'                                            => __( 'There was an error connecting to the server, Please verify the settings are correct.', 'jupiterx-lite' ),
		'restore_from_last_backup'                                         => __( 'Restore from Last Backup', 'jupiterx-lite' ),
		'restore_theme_settings_to_this_version'                           => __( 'Restore theme settings to this version', 'jupiterx-lite' ),
		'are_you_sure'                                                     => __( 'Are you sure?', 'jupiterx-lite' ),
		'template_install_intro'                                           => __( 'Choose how you want to import this template:', 'jupiterx-lite' ),
		'template_install_partial_import_title'                            => __( 'Content import', 'jupiterx-lite' ),
		'template_install_partial_import_desc'                             => __( 'Keep your current content, settings, widgets, etc. Only the new page contents will be imported.', 'jupiterx-lite' ),
		'template_install_complete_import_title'                           => __( 'Full import ', 'jupiterx-lite' ),
		'template_install_complete_import_desc'                            => __( 'Your current content, settings, widgets, etc. will be removed and the database will be reset. New page contents and settings will be replaced.', 'jupiterx-lite' ),
		'template_install_complete_import_warning'                         => __( 'All your current content, settings, widgets, etc. will be removed and the new content will be replaced.', 'jupiterx-lite' ),
		'template_install_include_media'                                   => __( 'Include media (Copyrighted).', 'jupiterx-lite' ),
		'are_you_sure_to_continue'                                         => __( 'Are you sure to continue?', 'jupiterx-lite' ),

		'all_done'                                                         => __( 'All Done!', 'jupiterx-lite' ),
		'item_is_successfully_installed'                                   => __( '<strong>{param}</strong> Plugin is successfully installed.', 'jupiterx-lite' ),

		'are_you_sure_you_want_to_remove_plugin'                           => __( 'Are you sure you want to remove <strong>{param}</strong> Plugin? <br> Note that the plugin files will be removed from your server!', 'jupiterx-lite' ),




		'are_you_sure_you_want_to_remove_addon'                            => __( 'Are you sure you want to remove <strong>{param}</strong> Add-on? <br> Note that all any data regarding this add-on will be lost.', 'jupiterx-lite' ),
		'addon_deactivate_successfully'                                    => __( '<strong>{param}</strong> deactivated successfully.', 'jupiterx-lite' ),

		'product_registeration_required'                                   => __( 'Product registration required!', 'jupiterx-lite' ),
		'you_must_register_your_product'                                   => __( 'In order to use this feature you must register your product.', 'jupiterx-lite' ),
		'register_product'                                                 => __( 'Register Product', 'jupiterx-lite' ),
		'registering_theme'                                                => __( 'Registering Jupiter X', 'jupiterx-lite' ),
		'wait_for_api_key_registered'                                      => __( 'Please wait while your API key is being verified.', 'jupiterx-lite' ),
		'discard'                                                          => __( 'Discard', 'jupiterx-lite' ),
		'thanks_registering'                                               => __( 'Thanks for Registration!', 'jupiterx-lite' ),
		'registeration_unsuccessful'                                       => __( 'Oops! Registration was unsuccessful.', 'jupiterx-lite' ),
		'revoke_API_key'                                                   => __( 'Revoke API Key', 'jupiterx-lite' ),
		'you_are_about_to_remove_API_key'                                  => __( 'You are about to remove API key from this website?', 'jupiterx-lite' ),
		'ok'                                                               => __( 'Ok', 'jupiterx-lite' ),
		'cancel'                                                           => __( 'Cancel', 'jupiterx-lite' ),




		'uninstalling_Template'                                            => __( 'Uninstalling Template', 'jupiterx-lite' ),
		'please_wait_for_few_moments'                                      => __( 'Please wait for few moments...', 'jupiterx-lite' ),
		'restoring_database'                                               => __( 'Restoring Database', 'jupiterx-lite' ),
		'remove_image_size'                                                => __( 'Remove Image Size', 'jupiterx-lite' ),
		'are_you_sure_remove_image_size'                                   => __( 'Are you sure you want to remove this image size?', 'jupiterx-lite' ),
		'image_sizes_could_not_be_stored'                                  => __( 'Image sizes could not be stored. Please try again and if issue persists, contact our support.', 'jupiterx-lite' ),
		'download_psd_files'                                               => __( 'Download PSD files', 'jupiterx-lite' ),
		'exporting'                                                        => __( 'Exporting', 'jupiterx-lite' ),
		'export_waiting'                                                   => __( 'Please wait for the export to finish...', 'jupiterx-lite' ),
		'importing'                                                        => __( 'Importing', 'jupiterx-lite' ),
		'import_waiting'                                                   => __( 'Please wait for the import to finish...', 'jupiterx-lite' ),
		'import_select_options'                                            => __( 'Please select only the options which exist in the selected ZIP file.', 'jupiterx-lite' ),
		'site_content'                                                     => __( 'Site Content', 'jupiterx-lite' ),
		'widgets'                                                          => __( 'Widgets', 'jupiterx-lite' ),
		'settings'                                                         => __( 'Settings', 'jupiterx-lite' ),
		'download'                                                         => __( 'Download', 'jupiterx-lite' ),
		'close'                                                            => __( 'Close', 'jupiterx-lite' ),
		'done'                                                             => __( 'Done', 'jupiterx-lite' ),
		'error'                                                            => __( 'Error!', 'jupiterx-lite' ),
		'try_again'                                                        => __( 'Try again', 'jupiterx-lite' ),
		'select'                                                           => __( 'Select', 'jupiterx-lite' ),
		'select_zip_file'                                                  => __( 'Select ZIP file', 'jupiterx-lite' ),
		'successfully_finished'                                            => __( 'has been finished successfully.', 'jupiterx-lite' ),
		'issue_persists'                                                   => __( 'If the issue persists, please contact support.', 'jupiterx-lite' ),
		'template_backup_date'                                             => __( 'Restore database to a backup stored at: ', 'jupiterx-lite' ),
		'add_image_size'                                                   => __( 'Add New Image Size', 'jupiterx-lite' ),
		'image_size_name'                                                  => __( 'Size Name', 'jupiterx-lite' ),
		'image_size_width'                                                 => __( 'Image Width', 'jupiterx-lite' ),
		'image_size_height'                                                => __( 'Image Height', 'jupiterx-lite' ),
		'image_size_crop'                                                  => __( 'Hard Crop?', 'jupiterx-lite' ),
		'save'                                                             => __( 'Save', 'jupiterx-lite' ),
		'edit'                                                             => __( 'Edit', 'jupiterx-lite' ),
		'size_name'                                                        => __( 'Name', 'jupiterx-lite' ),
		'image_size'                                                       => __( 'Size', 'jupiterx-lite' ),
		'crop'                                                             => __( 'Crop', 'jupiterx-lite' ),
		'edit_image_size'                                                  => __( 'Edit Image Size', 'jupiterx-lite' ),
		'saving_image_size'                                                => __( 'Saving Image Sizes', 'jupiterx-lite' ),
		'wait_for_image_size_update'                                       => __( 'Please wait while updating image sizes.', 'jupiterx-lite' ),
		'required'                                                         => __( 'Required', 'jupiterx-lite' ),

		// Plugin manager buttons
		'add'                                                              => __( 'Add', 'jupiterx-lite' ),
		'remove'                                                           => __( 'Remove', 'jupiterx-lite' ),
		'delete'                                                           => __( 'Delete', 'jupiterx-lite' ),
		'install'                                                          => __( 'Install', 'jupiterx-lite' ),
		'activate'                                                         => __( 'Activate', 'jupiterx-lite' ),
		'deactivate'                                                       => __( 'Deactivate', 'jupiterx-lite' ),

		// Common in plugins.
		'continue'                                                         => __( 'Continue ', 'jupiterx-lite' ),
		'upgrade'                                                          => jupiterx_is_premium() ? __( 'Activate to Unlock', 'jupiterx-lite' ) : __( 'Upgrade to Unlock', 'jupiterx-lite' ),
		'upgrade_url'                                                      => jupiterx_is_premium() ? esc_url( admin_url( 'admin.php?page=' . JUPITERX_SLUG ) ) : esc_url( jupiterx_upgrade_link() ),
		'something_went_wrong'                                             => __( 'Something went wrong!', 'jupiterx-lite' ),
		'something_wierd_happened_please_try_again'                        => __( 'Something weird happened, please try again.', 'jupiterx-lite' ),

		// Updating a plugin.
		'update'                                                           => __( 'Update', 'jupiterx-lite' ),
		'plugins'                                                          => __( 'Plugins', 'jupiterx-lite' ),
		'themes'                                                           => __( 'Themes', 'jupiterx-lite' ),
		'update_plugin'                                                    => __( 'Update Plugin', 'jupiterx-lite' ),
		'you_are_about_to_update'                                          => __( 'You are about to update <strong>{param}</strong> plugin', 'jupiterx-lite' ),
		'updating_plugin'                                                  => __( 'Updating Plugin', 'jupiterx-lite' ),
		'wait_for_plugin_update'                                           => __( 'Please wait while updating the plugin...', 'jupiterx-lite' ),
		'plugin_is_successfully_updated'                                   => __( 'Plugin is successfully updated', 'jupiterx-lite' ),
		'plugin_updated_recent_version'                                    => __( '<strong>{param}</strong> is successfully updated to the latest version.', 'jupiterx-lite' ),
		'update_plugin_checker_title'                                      => __( 'Checking conflicts', 'jupiterx-lite' ),
		'update_plugin_checker_progress'                                   => __( 'Please wait, looking for possible conflicts with existing plugins & theme.', 'jupiterx-lite' ),
		'update_plugin_checker_warning'                                    => sprintf( __( '%1$s We have found conflicts on updating this plugin. Please resolve following issues before you continue otherwise it may cause unknown issues.', 'jupiterx-lite' ), '<b>' . __( 'Heads up!', 'jupiterx-lite' ). '</b>'),
		'update_plugin_checker_no_conflict'                                => __( 'No conflict found! Please continue to update the plugin.', 'jupiterx-lite' ),
		'upgrade_to_version'                                               => __( 'Upgrade to version', 'jupiterx-lite' ),

		// Installing a plugin.
		'install_plugin'                                                   => __( 'Install Plugin', 'jupiterx-lite' ),
		'you_are_about_to_install'                                         => __( 'You are about to install <strong>{param}</strong> plugin.', 'jupiterx-lite' ),
		'are_you_sure_you_want_to_install'                                 => __( 'Are you sure you want to install <strong>{param}</strong>?', 'jupiterx-lite' ),
		'installing_plugin'                                                => __( 'Installing Plugin...', 'jupiterx-lite' ),
		'wait_for_plugin_install'                                          => __( 'Please wait while the plugin is being installed.', 'jupiterx-lite' ),
		'plugin_is_successfully_installed'                                 => __( 'Plugin is installed successfully.', 'jupiterx-lite' ),
		'plugin_installed_successfully_message'                            => __( 'Latest version of <strong>{param}</strong> is installed successfully.', 'jupiterx-lite' ),

		// Activating a plugin.
		'activating_notice'                                                => __( 'Activating Notice', 'jupiterx-lite' ),
		'are_you_sure_you_want_to_activate'                                => __( 'Are you sure you want to activate <strong>{param}</strong>?', 'jupiterx-lite' ),
		'activating_plugin'                                                => __( 'Activating Plugin', 'jupiterx-lite' ),
		'wait_for_plugin_activation'                                       => __( 'Please wait while the plugin going to be activated...', 'jupiterx-lite' ),
		'item_is_successfully_activated'                                   => __( '<strong>{param}</strong> Plugin is successfully activated.', 'jupiterx-lite' ),

		// Deactivating a plugin
		'important_notice'                                                 => __( 'Important Notice', 'jupiterx-lite' ),
		'are_you_sure_you_want_to_deactivate'                              => __( 'Are you sure you want to deactivate <strong>{param}</strong> plugin?', 'jupiterx-lite' ),
		'deactivating_plugin'                                              => __( 'Deactivating Plugin', 'jupiterx-lite' ),
		'wait_for_plugin_deactivation'                                     => __( 'Please wait while the plugin going to be deactivated...', 'jupiterx-lite' ),
		'deactivating_notice'                                              => __( 'Deactivation Notice', 'jupiterx-lite' ),
		'plugin_deactivate_successfully'                                   => __( 'Plugin successfully deactivated.', 'jupiterx-lite' ),

		// Deleting a plugin.
		'delete_plugin'                                                    => __( 'Delete Plugin', 'jupiterx-lite' ),
		'deleting_plugin'                                                  => __( 'Deleting plugin...', 'jupiterx-lite' ),
		'you_are_about_to_delete'                                          => __( 'You are about to delete <strong>{param}</strong>', 'jupiterx-lite' ),
		'wait_for_plugin_delete'                                           => __( 'Please wait while the plugin is being deleted.', 'jupiterx-lite' ),
		'plugin_is_successfully_deleted'                                   => __( 'Plugin is deleted successfully.', 'jupiterx-lite' ),
		'plugin_deleted_successfully_message'                              => __( '<strong>{param}</strong> is deleted successfully.', 'jupiterx-lite' ),

		// Plugin activation limit warning.
		'plugin_limit_warning'                                             => __( 'Important Notification', 'jupiterx-lite' ),
		'plugin_limit_warning_message'                                     => __( 'Activating too many plugins can cause performance issues to your website. We highly recommend activating only those plugins you really need and deactivate unnecessary ones.', 'jupiterx-lite' ),
		'learn_more'                                                       => __( 'Learn More', 'jupiterx-lite' ),

		// Pro badge.
		'pro_badge_tooltip_title'                                          => jupiterx_is_premium() ? __( 'Activate to Unlock', 'jupiterx-lite' ) : __( 'Upgrade to Unlock', 'jupiterx-lite' ),

		// Theme version change
		'apikey_domain_match_error'                                        => __( 'API key and the domain are not matching', 'jupiterx-lite' ),

		// New Theme registration
		'license_manager_registration_title'                               => __( 'Register license', 'jupiterx-lite' ),
		'license_manager_email_address'                                    => __( 'Email Address', 'jupiterx-lite' ),
		'license_manager_add_purchase_code'                                => __( 'Add Envato license key', 'jupiterx-lite' ),
		'license_manager_insert_api'                                       => __( 'Insert Artbees API Key', 'jupiterx-lite' ),
		'license_manager_add_api'                                          => __( 'Add Artbees API key', 'jupiterx-lite' ),
		'submit'                                                           => __( 'Submit', 'jupiterx-lite' ),
		'license_manager_insert_purchase_code'                             => __( 'Insert Envato purchase code', 'jupiterx-lite' ),
		'license_manager_revoking_error'                                   => __( 'Deactivation error', 'jupiterx-lite' ),
		'wait_for_api_key_revoke'                                          => __( 'Please wait while your API key is being revoked.', 'jupiterx-lite' ),
		'license_manager_revoking_title'                                   => __( 'Deactivating license', 'jupiterx-lite' ),

		// DB Manager
		'restore_ok'                                                       => __( 'You have successfully restored your database.', 'jupiterx-lite' ),

		// Additional
		'all'                                                              => __( 'All', 'jupiterx-lite' ),
		'active'                                                           => __( 'Active', 'jupiterx-lite' ),
		'inactive'                                                         => __( 'Inactive', 'jupiterx-lite' ),
		'updates_available'                                                => __( 'Updates Available', 'jupiterx-lite' ),
		'optional'                                                         => __( 'Optional', 'jupiterx-lite' ),
		'recommended'                                                      => __( 'Recommended', 'jupiterx-lite' ),
		'completed'                                                        => __( 'Completed', 'jupiterx-lite' ),
		'installing_plugin_progress'                                       => __( 'Installing plugin..', 'jupiterx-lite' ),
		'activate_required_plugins'                                        => __( 'Activate Required Plugins', 'jupiterx-lite' ),
		'activate_error'                                                   => __( 'Activate Error', 'jupiterx-lite' ),
		'activating_plugins'                                               => __( 'Activating Plugins', 'jupiterx-lite' ),
		'activating_plugins_successful'                                    => __( 'Activating Plugins Successful', 'jupiterx-lite' ),
		'activating_plugin_progress'                                       => __( 'Activating plugin..', 'jupiterx-lite' ),
		'update_all_plugins'                                               => __( 'Update All Plugins', 'jupiterx-lite' ),
		'updating_plugins'                                                 => __( 'Updating Plugins', 'jupiterx-lite' ),
		'updating_plugins_successful'                                      => __( 'Updating Plugins Successful', 'jupiterx-lite' ),
		'updating_plugin_progress'                                         => __( 'Updating plugin..', 'jupiterx-lite' ),
		'plugins_notice'                                                   => __( 'Please activate only required plugins and keep the unneeded plugins deactivated. Too many active plugin may slow down your site as each adds more functionality to your website.', 'jupiterx-lite' ),
		'confirm_activate_plugins'                                         => __( 'Are you sure you want to activate required plugins?', 'jupiterx-lite' ),
		'confirm_update_plugins'                                           => __( 'Are you sure you want to update all plugins?', 'jupiterx-lite' ),
		'install_error'                                                    => __( 'Install Error', 'jupiterx-lite' ),
		'install_plugin_failed'                                            => __( 'Plugin installation failed, please refresh the page and try again.', 'jupiterx-lite' ),
		'update_error'                                                     => __( 'Update Error', 'jupiterx-lite' ),
		'update_plugin_failed'                                             => __( 'Plugin update failed, please refresh the page and try again.', 'jupiterx-lite' ),
		'api_request_error'                                                => __( 'Could not connect to Artbees server, please try again and if the issue persists contact support.', 'jupiterx-lite' ),
		'on'                                                               => __( 'On', 'jupiterx-lite' ),
		'off'                                                              => __( 'Off', 'jupiterx-lite' ),
	);
}
