<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hostinger_Onboarding {
	private function load_steps(): array {
		$steps        = [];
		$path         = HOSTINGER_ABSPATH . 'includes/admin/onboarding/steps/';
		$website_type = Hostinger_Settings::get_setting( 'survey.website.type' );

		require_once $path . 'abstract-hostinger-onboarding-step.php';

		if ( get_theme_support( 'custom-logo' ) ) {
			require_once $path . 'class-hostinger-onboarding-logo-step.php';
			$steps[] = new Hostinger_Onboarding_Logo_Step();
		}

		require_once $path . 'class-hostinger-onboarding-logo-step.php';
		require_once $path . 'class-hostinger-onboarding-image-step.php';
		require_once $path . 'class-hostinger-onboarding-heading.php';
		require_once $path . 'class-hostinger-onboarding-add-page.php';

		if ( $website_type === Hostinger_Settings::WEBSITE_TYPE_BLOG ) {
			require_once $path . 'class-hostinger-onboarding-add-post.php';
			$steps[] = new Hostinger_Onboarding_Add_Post();
		} else {
			require_once $path . 'class-hostinger-onboarding-description.php';
			$steps[] = new Hostinger_Onboarding_Description();
		}

		if ( $website_type === Hostinger_Settings::WEBSITE_TYPE_STORE && class_exists( 'WooCommerce' ) ) {
			require_once $path . 'class-hostinger-onboarding-add-product.php';
			$steps[] = new Hostinger_Onboarding_Add_Product_Step();
		}

		$steps[] = new Hostinger_Onboarding_Image_Step();
		$steps[] = new Hostinger_Onboarding_Heading();
		$steps[] = new Hostinger_Onboarding_Add_Page();

		return $steps;
	}

	public function get_steps(): array {
		return $this->load_steps();
	}

	public function maintenance_mode_enabled(): bool {
		$published = get_option( 'hostinger_maintenance_mode' );

		return (bool) $published;
	}

	public function get_content(): array {
		if ( ! $this->maintenance_mode_enabled() ) {
			return [
				'title'       => __( 'Website is published', 'hostinger' ),
				'description' => __( 'You can access this guide material any time when updating your website', 'hostinger' ),
				'btn'         => [
					'text'  => __( 'Preview website', 'hostinger' ),
					'class' => 'hsr-btn hsr-primary-btn hsr-publish-btn',
					'url'   => home_url(),
				]
			];
		}

		return [
			'title'       => __( 'Set up your website', 'hostinger' ),
			'description' => __( 'Follow our guided checklist to setup your website', 'hostinger' ),
			'btn_text'    => __( 'Publish website', 'hostinger' ),
			'btn'         => [
				'text'  => __( 'Publish website', 'hostinger' ),
				'class' => 'hsr-btn hsr-primary-btn hsr-publish-btn',
				'url'   => '#',
			]
		];
	}
}
