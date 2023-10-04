<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Affiliates {
	public const AFFILIATE_ID = '3107422';

	public function astra_pro_affiliate_link( string $url ): string {
		return add_query_arg( 'bsf', '5643', $url );
	}

	public function affiliate_monsterinsights( $id ): string {
		return self::AFFILIATE_ID;
	}

	public function wpforms_upgrade_link( string $link ): string {
		return 'https://shareasale.com/r.cfm?b=834775&u=3107422&m=64312&urllink=' . rawurlencode( $link );
	}

	public function aioseo_upgrade_link( string $link ): string {
		return 'https://shareasale.com/r.cfm?b=1491200&u=3107422&m=94778&urllink=' . rawurlencode( $link );
	}
}
