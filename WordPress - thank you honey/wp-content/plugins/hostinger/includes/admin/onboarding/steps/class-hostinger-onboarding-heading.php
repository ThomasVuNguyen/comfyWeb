<?php

class Hostinger_Onboarding_Heading extends Hostinger_Onboarding_Step {
	public function get_title(): string {
		return __( 'Edit site title', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Go to the Customize page', 'hostinger' ),
				'description' => __( 'In the left sidebar, click Appearance to expand the menu. In the Appearance section, click Customize. The Customize page will open.', 'hostinger' )
			],
			[
				'title'       => __( 'Access the Site identity and edit title', 'hostinger' ),
				'description' => __( 'In the left sidebar, click Site Identity and edit your site title.', 'hostinger' ),
			],
		];
	}

	public function step_identifier(): string {
		return 'edit_site_title';
	}

	public function get_redirect_link(): string {
		return admin_url( 'customize.php' );
	}
}
