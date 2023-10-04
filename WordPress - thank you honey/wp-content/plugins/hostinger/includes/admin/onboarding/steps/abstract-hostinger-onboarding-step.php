<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Hostinger_Onboarding_Step {
	public abstract function get_title(): string;

	public abstract function get_body(): array;

	public abstract function step_identifier(): string;

	public abstract function get_redirect_link(): string;

	public function completed(): bool {
		return in_array( $this->step_identifier(), array_column($this->get_completed_steps(), 'action'), true );
	}

	public function get_completed_steps(): array {
		return get_option( 'hostinger_onboarding_steps', [] );
	}
}
