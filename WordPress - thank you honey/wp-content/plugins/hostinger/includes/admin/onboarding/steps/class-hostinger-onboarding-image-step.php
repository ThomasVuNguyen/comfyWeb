<?php

class Hostinger_Onboarding_Image_Step extends Hostinger_Onboarding_Step {
	public function get_title(): string {
		return __( 'Upload an image', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Find the Media page', 'hostinger' ),
				'description' => __( 'In the left sidebar, find the Media button. The Media Library page allows you to edit, view, and delete media previously uploaded to your website.', 'hostinger' )
			],
			[
				'title'       => __( 'Upload an image', 'hostinger' ),
				'description' => __( 'To upload a new image, click on Add New button on the Media Library page and select files.', 'hostinger' ),
			],
			[
				'title'       => __( 'Edit an image', 'hostinger' ),
				'description' => __( 'If you wish to edit the image, click on the chosen image and click the Edit Image button. You can now crop, rotate, flip or scale the selected image.', 'hostinger' ),
			],
		];
	}

	public function step_identifier(): string {
		return 'image_upload';
	}

	public function get_redirect_link(): string {
		return admin_url( 'media-new.php' );
	}
}
