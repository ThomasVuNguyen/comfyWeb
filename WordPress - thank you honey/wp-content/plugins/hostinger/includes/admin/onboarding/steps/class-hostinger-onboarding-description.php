<?php

class Hostinger_Onboarding_Description extends Hostinger_Onboarding_Step {
	private string $website_type;

	public function __construct() {
		$this->website_type = Hostinger_Settings::get_setting( 'survey.website.type' );
	}

	public function get_title(): string {
		return __( 'Edit post description', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Go to Posts', 'hostinger' ),
				'description' => __( 'In the left sidebar, find the Posts button. Click on the All Posts button and find the post for which you want to change the description.', 'hostinger' )
			],
			[
				'title'       => __( 'Edit post', 'hostinger' ),
				'description' => __( 'Hover over the chosen post to see the options menu. Click on the Edit button to open the post editor.', 'hostinger' ),
			],
			[
				'title'       => __( 'Edit description', 'hostinger' ),
				'description' => __( 'You can see the whole post in the editor. Find the description part and change it to your preferences.', 'hostinger' ),
			],
		];

	}

	public function step_identifier(): string {
		return 'edit_description';
	}

	public function get_redirect_link(): string {
		return admin_url( 'edit.php' );
	}
}
