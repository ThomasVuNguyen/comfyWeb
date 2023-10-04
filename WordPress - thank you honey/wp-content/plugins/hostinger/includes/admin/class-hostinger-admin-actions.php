<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Admin_Actions {
	public const LOGO_UPLOAD = 'logo_upload';
	public const IMAGE_UPLOAD = 'image_upload';
	public const EDIT_DESCRIPTION = 'edit_description';
	public const EDIT_SITE_TITLE = 'edit_site_title';
	public const ADD_POST = 'add_post';
	public const ADD_PAGE = 'add_page';
	public const ADD_PRODUCT = 'add_product';
	public const ACTIONS_LIST = [
		self::LOGO_UPLOAD,
		self::IMAGE_UPLOAD,
		self::EDIT_DESCRIPTION,
		self::EDIT_SITE_TITLE,
		self::ADD_POST,
		self::ADD_PAGE,
		self::ADD_PRODUCT,
	];

}

new Hostinger_Admin_Actions();
