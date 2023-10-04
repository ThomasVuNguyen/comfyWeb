<?php

class Hostinger_Onboarding_Logo_Step extends Hostinger_Onboarding_Step {
	public function get_title(): string {
		return __( 'Upload your logo', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Create a logo', 'hostinger' ),
				'description' => __( 'Adding a logo is a great way to personalize a website or add branding information. You can use your existing logo or create a new one using the <a href="https://logo.hostinger.com/?ref=wordpress-onboarding" target="_blank">Ai Logo Maker</a>.', 'hostinger' ),
			],
			[
				'title'       => __( 'Go to the Customize page', 'hostinger' ),
				'description' => __( 'In the left sidebar, click Appearance to expand the menu. In the Appearance section, click Customize. The Customize page will open. ', 'hostinger' )
			],
			[
				'title'       => __( 'Upload your logo', 'hostinger' ),
				'description' => __( 'In the left sidebar, click Site Identity, then click on the Select Site Icon button. Here, you can upload your brand logo. ', 'hostinger' )
			],
		];
	}

	public function step_identifier(): string {
		return 'logo_upload';
	}

	public function get_redirect_link(): string {
		return admin_url( 'customize.php' );
	}
}
