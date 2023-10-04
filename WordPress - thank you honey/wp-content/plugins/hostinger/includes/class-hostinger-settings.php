<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hostinger_Settings {
	private const MYSELF = 'myself';
	private const FREELANCER = 'freelancer';
	private const DEVELOPER = 'developer';
	private const OTHER = 'other';
	public const BUSINESS_BEGINNER_SEGMENT = 'business_beginner';
	public const LEARNER_SEGMENT = 'learner';
	public const BUSINESS_OWNER_SEGMENT = 'business_owner';
	public const WEBSITE_TYPE_BUSINESS = 'business';
	public const WEBSITE_TYPE_PORTFOLIO = 'portfolio';
	public const WEBSITE_TYPE_STORE = 'online-store';
	public const WEBSITE_TYPE_BLOG = 'blog';
	public const SITE_TITLE_OPTION = 'blogname';

	public function __construct() {
		if ( ! $this->get_setting( 'user_segment' ) ) {
			$this->set_user_segment();
		}
	}

	public function set_user_segment(): void {
		$created_by  = self::get_setting( 'survey.website.created_by' );
		$created_for = self::get_setting( 'survey.website.for' );
		$need_help   = self::get_setting( 'survey.website.need_help' );
		$work_at     = self::get_setting( 'survey.work_at' );

		if ( $this->is_business_beginner( $created_by, $created_for, $need_help ) ) {
			self::update_setting( 'user_segment', self::BUSINESS_BEGINNER_SEGMENT );
		}

		if ( $this->is_learner( $work_at, $need_help ) ) {
			self::update_setting( 'user_segment', self::LEARNER_SEGMENT );
		}

		if ( $this->is_bussiness_owner( $created_for, $created_by ) ) {
			self::update_setting( 'user_segment', self::BUSINESS_OWNER_SEGMENT );
		}
	}

	private function is_business_beginner( string $created_by, string $created_for, bool $need_help ): bool {
		return $created_by === self::MYSELF && $created_for === self::MYSELF && $need_help;
	}

	private function is_learner( string $work_at, bool $need_help ): bool {
		return $work_at === self::FREELANCER && $need_help;
	}

	private function is_bussiness_owner( string $created_for, string $created_by ): bool {
		return $created_for === self::MYSELF && ( $created_by === self::DEVELOPER || $created_by === self::OTHER );
	}

	public static function get_setting( string $setting ): string {

		if ( $setting ) {
			return get_option( 'hostinger_' . $setting, '' );
		}

		return '';
	}

	public static function update_setting( string $setting, $value, $autoload = null ): void {

		if ( $setting ) {
			update_option( 'hostinger_' . $setting, $value, $autoload );
		}

	}
}

new Hostinger_Settings();
