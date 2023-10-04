<?php
/**
 * WPPB Widget
 * allows the progress bar to be added to a configurable widget
 *
 * @package WP_Progress_Bar
 */

/**
 * Register the widget.
 *
 * @author Chris Reynolds
 * @since 2.0.1
 * @uses WP_Widget
 */
function wppb_register_widget() {
	register_widget( 'WPPB_Widget' );
}
add_action( 'widgets_init', 'wppb_register_widget' );

/**
 * Widget class for the Progress Bar.
 *
 * @since 2.0.1
 */
class WPPB_Widget extends WP_Widget {
	/**
	 * Widget constructor.
	 *
	 * @since 2.0.1
	 */
	public function __construct() {
		$widget_options = [
			'classname' => 'wppb-widget',
			'description' => __( 'Allows you to add a progress bar to your sidebar.', 'wp-progress-bar' ),
		];
		$control_options = [ 'id_base' => 'wppb-widget' ];
		parent::__construct( 'wppb-widget', __( 'Progress Bar', 'wp-progress-bar' ), $widget_options, $control_options );
	}

	/**
	 * Outputs the content of the widget.
	 *
	 * @since 2.0.1
	 *
	 * @param array $args      Widget arguments.
	 * @param array $instance  Saved values from the database.
	 */
	public function widget( $args, $instance ) {
		$title = '';
		$progress = '';
		$color = '';
		$candystripe = false;
		$location = '';
		$text = '';
		$description = '';

		if ( isset( $instance['title'] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
		}

		if ( isset( $instance['progress'] ) ) {
			$progress = $instance['progress'];
		}

		if ( isset( $instance['color'] ) ) {
			$color = $instance['color'];
		}

		if ( isset( $instance['candystripe'] ) ) {
			$candystripe = $instance['candystripe'];
		}

		if ( isset( $instance['location'] ) ) {
			$location = $instance['location'];
		}

		if ( isset( $instance['text'] ) ) {
			$text = $instance['text'];
		}

		if ( isset( $instance['description'] ) ) {
			$description = $instance['description'];
		}

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $title ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_attr( $title ) . wp_kses_post( $args['after_title'] );
		}

		$wppb_check_results = wppb_check_pos( $progress ); // check the progress for a slash, indicating a fraction instead of a percent.
		$percent = $wppb_check_results[0];
		$width = $wppb_check_results[1];

		if ( 'none' === $location ) {
			$location = null;
		}

		$option = null;
		if ( $color ) {
			$option .= $color;
		}
		if ( $candystripe ) {
			$option .= ' ' . $candystripe;
		}

		echo wp_kses_post( wppb_get_progress_bar( $location, $text, $percent, $option, $width, 'true' ) );
		echo wp_kses_post( wpautop( $description ) );
		echo wp_kses_post( $args['after_widget'] );

	}

	/**
	 * Outputs the options form on admin.
	 *
	 * @since 2.0.1
	 *
	 * @param array $instance  Previously saved values from the database.
	 */
	public function form( $instance ) {
		$defaults = [
			'title' => '',
			'progress' => '',
			'color' => 'blue',
			'candystripe' => 'none',
			'location' => 'none',
			'text' => '',
			'description' => '',
		];
		$instance = wp_parse_args( (array) $instance, $defaults );

		if ( isset( $instance['title'] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
		} else {
			$title = ''; }
		if ( isset( $instance['progress'] ) ) {
			$progress = $instance['progress'];
		} else {
			$progress = ''; }
		if ( isset( $instance['color'] ) ) {
			$color = $instance['color'];
		} else {
			$color = ''; } // a dropdown
		if ( isset( $instance['candystripe'] ) ) {
			$candystripe = $instance['candystripe'];
		} else {
			$candystripe = false; } // a radio button
		if ( isset( $instance['location'] ) ) {
			$location = $instance['location'];
		} else {
			$location = ''; } // a dropdown
		if ( isset( $instance['text'] ) ) {
			$text = $instance['text'];
		} else {
			$text = ''; }
		if ( isset( $instance['description'] ) ) {
			$description = $instance['description'];
		} else {
			$description = ''; }
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title', 'wp-progress-bar' ); ?></strong></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /><br />
			<span class="description"><?php esc_html_e( 'The widget title (optional).', 'wp-progress-bar' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'progress' ) ); ?>"><strong><?php esc_html_e( 'Progress', 'wp-progress-bar' ); ?></strong></label>
			<input size="4" id="<?php echo esc_attr( $this->get_field_id( 'progress' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'progress' ) ); ?>" type="text" value="<?php echo esc_attr( $progress ); ?>" /><br />
			<span class="description"><?php esc_html_e( 'Can be a numeric value or a fraction (like 5/6). (required)', 'wp-progress-bar' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>"><strong><?php esc_html_e( 'Color', 'wp-progress-bar' ); ?></strong></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>" class="widefat">
				<?php
				$colors = [
					'red' => [
						'name' => __( 'Red', 'wp-progress-bar' ),
						'value' => 'red',
					],
					'blue' => [
						'name' => __( 'Blue', 'wp-progress-bar' ),
						'value' => '',
					],
					'green' => [
						'name' => __( 'Green', 'wp-progress-bar' ),
						'value' => 'green',
					],
					'orange' => [
						'name' => __( 'Orange', 'wp-progress-bar' ),
						'value' => 'orange',
					],
					'yellow' => [
						'name' => __( 'Yellow', 'wp-progress-bar' ),
						'value' => 'yellow',
					],
				];
				foreach ( $colors as $hue ) {
					?>
					<option value="<?php echo esc_attr( $hue['value'] ); ?>" id="<?php echo esc_attr( $hue['value'] ); ?>"<?php selected( $color, $hue['value'] ); ?>><?php echo wp_kses_post( $hue['name'] ); ?></option>
					<?php
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'candystripe' ) ); ?>"><strong><?php esc_html_e( 'Candystripe', 'wp-progress-bar' ); ?></strong></label>
			<fieldset>
			<label for="<?php echo esc_attr( $this->get_field_name( 'candystripe' ) ); ?>"><input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'candystripe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'candystripe' ) ); ?>" value="candystripe" <?php checked( 'candystripe', $candystripe ); ?> /> <?php esc_html_e( 'Candystripe', 'wp-progress-bar' ); ?></label><br />
			<label for="<?php echo esc_attr( $this->get_field_name( 'animated-candystripe' ) ); ?>"><input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'candystripe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'candystripe' ) ); ?>" value="animated-candystripe" <?php checked( 'animated-candystripe', $candystripe ); ?> /> <?php esc_html_e( 'Animated Candystripe', 'wp-progress-bar' ); ?></label><br />
			<label for="<?php echo esc_attr( $this->get_field_name( 'none' ) ); ?>"><input type="radio" id="<?php echo esc_attr( $this->get_field_id( 'candystripe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'candystripe' ) ); ?>" value="none" <?php checked( 'none', $candystripe ); ?> /> <?php esc_html_e( 'None', 'wp-progress-bar' ); ?></label><br />
			</fieldset><br />
			<span class="description"><?php esc_html_e( 'Whether the progress bar should have a candystripe.', 'wp-progress-bar' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>"><strong><?php esc_html_e( 'Location', 'wp-progress-bar' ); ?></strong></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>" class="widefat">
				<?php
					$locations = [
						'inside' => [
							'name' => __( 'Inside', 'wp-progress-bar' ),
							'value' => 'inside',
						],
						'outside' => [
							'name' => __( 'Outside', 'wp-progress-bar' ),
							'value' => 'outside',
						],
						'none' => [
							'name' => __( 'None', 'wp-progress-bar' ),
							'value' => 'none',
						],
					];
					foreach ( $locations as $place ) {
						?>
						<option value="<?php echo esc_attr( $place['value'] ); ?>" id="<?php echo esc_attr( $place['value'] ); ?>"<?php selected( $location, $place['value'] ); ?>><?php echo wp_kses_post( $place['name'] ); ?></option>
						<?php
					}
					?>
			</select>
			<span class="description"><?php esc_html_e( 'Displays the progress either inside or outside the progress bar or not at all if "None" is selected.', 'wp-progress-bar' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><strong><?php esc_html_e( 'Text', 'wp-progress-bar' ); ?></strong></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php wp_kses_post( $text ); ?>" /><br />
			<span class="description"><?php esc_html_e( 'Custom text to display (instead of the progress value). (optional).', 'wp-progress-bar' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><strong><?php esc_html_e( 'Description', 'wp-progress-bar' ); ?></strong></label>
			<textarea
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>">
					<?php echo wp_kses_post( $description ); ?>
			</textarea><br />
			<span class="description"><?php esc_html_e( 'A block of text that displays under the progress bar to describe what the progress bar is for. (optional).', 'wp-progress-bar' ); ?></span>
		</p>
		<?php
	}

	/**
	 * Updates the progress bar widget instance settings
	 *
	 * @since 2.0.1
	 * @param array $new_instance The new instance of settings
	 * @param array $old_instance The old instance of settings
	 * @return array The updated instance of settings
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['progress'] = ( ! empty( $new_instance['progress'] ) ) ? esc_html( $new_instance['progress'] ) : '';
		$instance['color'] = ( ! empty( $new_instance['color'] ) ) ? wp_strip_all_tags( $new_instance['color'] ) : '';
		$instance['candystripe'] = ( ! empty( $new_instance['candystripe'] ) ) ? wp_strip_all_tags( $new_instance['candystripe'] ) : '';
		$instance['location'] = ( ! empty( $new_instance['location'] ) ) ? wp_strip_all_tags( $new_instance['location'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? wp_kses_post( $new_instance['text'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';

		return $instance;
	}
}
