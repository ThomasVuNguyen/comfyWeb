<?php

class Hostinger_Onboarding_Add_Product_Step extends Hostinger_Onboarding_Step {
	public function get_title(): string {
		return __( 'Add your first product', 'hostinger' );
	}

	public function get_body(): array {
		return [
			[
				'title'       => __( 'Add your product', 'hostinger' ),
				'description' => __( 'Go to Products → Add New or Create Product and enter your product name and description.', 'hostinger' )
			],
			[
				'title'       => __( 'Add products image and price', 'hostinger' ),
				'description' => __( 'To make the product stand out, upload a picture of it. During the setup of your wanted item, be sure to add its price and any other relevant information. Product categories and tags to help organize your products.', 'hostinger' ),
			],
			[
				'title'       => __( 'Publish the setup', 'hostinger' ),
				'description' => __( 'Once fields are filled, and your item has an image, description, and price, it’s time to publish it online. You will find the “publish” button at the top of the page, near the description field.', 'hostinger' ),
			],
		];
	}

	public function step_identifier(): string {
		return 'add_product';
	}

	public function get_redirect_link(): string {
		return admin_url( 'edit.php?post_type=product' );
	}
}
