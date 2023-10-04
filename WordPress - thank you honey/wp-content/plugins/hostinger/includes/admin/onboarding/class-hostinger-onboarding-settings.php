<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Onboarding_Settings {
	public static function all_steps_completed(): bool {
		$actions               = Hostinger_Admin_Actions::ACTIONS_LIST;
		$completed_steps       = get_option( 'hostinger_onboarding_steps', [] );
		$completed_step_actions = array_column($completed_steps, 'action');
		$completed_steps_count = count(array_intersect($completed_step_actions, $actions));

		return $completed_steps_count === count($actions);
	}
}

new Hostinger_Onboarding_Settings();
