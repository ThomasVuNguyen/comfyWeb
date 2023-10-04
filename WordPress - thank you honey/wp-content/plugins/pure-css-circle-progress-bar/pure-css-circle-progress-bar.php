<?php
/*
Plugin Name: Pure CSS Circle Progress bar
Plugin URI:  https://wordpress.org/plugins/pure-css-circle-progress-bar/
Description: Circle Progress bar.Built with CSS.Small(4KB) efficient.Show your skill level in a circle style.Add unlimited circle progess bar with unlimited colors.
Version: 1.2
Author: Shafayat Hossain
Author URI: http://shafayat.xyz
License:  GPLv2
License URI: 
Text Domain: pure-css-circle-progress-bar
*/
add_action('wp_enqueue_scripts', function(){
	wp_register_style('circle_css', plugins_url('css/circle.min.css', __FILE__));
	wp_enqueue_style('circle_css');
});
add_shortcode("circle_progress", "circle_progress_function");

function circle_progress_function( $atts, $text = null) {
	extract( shortcode_atts( array(
    'fill' => 0,
    'color' => '#28a745',
    'size'=>'medium'
    ), $atts ));
    $size=strtolower($size);
    if($text)
		return generate_progroessbar($fill,$color,$size,$text);
	return generate_progroessbar($fill,$color,$size);
}
function generate_progroessbar($fill=0,$color='#28a745',$size='',$text=''){
	if(!$text) $text=$fill.'%';
	$str='<div class="circle '.$size.'" data-fill="'.$fill.'"  style="--color:'.$color.'"><span>'.$text.'</span><div class="bar"></div></div>';
	return $str;
}
add_action( 'widgets_init', function(){
	register_widget( 'Css_circle' );
});
class Css_circle extends WP_Widget {
	public function __construct() {
	$widget_ops = array( 
		'classname' => 'css-progress-bar',
		'description' => __('Circle Progress bar.Built with CSS.Small(4KB) efficient.Show your skill level in a new style.', 'pure-css-circle-progress-bar'),
	);
	parent::__construct( 'progress_bar', __('Circle Progress Bar', 'pure-css-circle-progress-bar'), $widget_ops );
	}
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {
		extract($instance);
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) 
		{
			echo $args['before_title'];
			echo esc_html( $instance['title'] );
			echo $args['after_title'];
		}
		echo generate_progroessbar($fill,$color,$size,$text);
		echo $args['after_widget'];
	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
		if(!isset($instance))
		{
			$fill = 0;
			$color='#28a745';
			$size='';
			$text='';
			$title='';
		}
		else
		{
			extract($instance);
		}
	?>
	<p>
	<label>
	<?php esc_html_e( 'Title'); ?>:
	</label> 
	
	<input 
		class="widefat" 
		id="<?=esc_attr($this->get_field_id( 'title'))?>" 
		name="<?=esc_attr($this->get_field_name('title'))?>" 
		value="<?=esc_attr($title)?>" type='text'/>
	</p>
	<p>
	<label>
	<?php esc_html_e('Fill'); ?>(%):
	</label> 
	
	<input 
		class="widefat" 
		id="<?=esc_attr( $this->get_field_id( 'fill' ))?>" 
		name="<?=esc_attr($this->get_field_name('fill' ))?>" 
		type="number" min='0' max='100'
		value="<?=esc_attr( $fill )?>">
	</p>
	<p>
	<label>
	<?php esc_html_e( 'Size'); ?>:
	</label> 
	
	<select 
		class="widefat" 
		id="<?=esc_attr($this->get_field_id( 'size'))?>" 
		name="<?=esc_attr($this->get_field_name('size' ))?>" >
		<option value=''></option>
		<option value='big' <?=($size=='big'?'selected':'')?>><?php esc_html_e( 'Big'); ?></option>
		<option value='medium' <?=($size=='medium'?'selected':'')?>><?php esc_html_e( 'Medium'); ?></option>
		<option value='small' <?=($size=='small'?'selected':'')?>><?php esc_html_e( 'Small'); ?></option>
		<option value='x-small' <?=($size=='x-small'?'selected':'')?>><?php esc_html_e( 'X-Small'); ?></option>
	</select>
	</p>
	<p>
	<label>
	<?php esc_html_e( 'Color'); ?>:
	</label> 
	
	<input 
		class="widefat" 
		id="<?=esc_attr( $this->get_field_id('color'))?>" 
		name="<?=esc_attr( $this->get_field_name('color'))?>" 
		value="<?=esc_attr( $color )?>" type='color'/>
	</p>
	<p>
	<label>
	<?php esc_html_e( 'Text'); ?>:
	</label> 
	
	<input 
		class="widefat" 
		id="<?=esc_attr($this->get_field_id( 'text'))?>" 
		name="<?=esc_attr($this->get_field_name('text'))?>" 
		value="<?=esc_attr($text)?>" type='text'/>
	</p>
	<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance= $new_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['color'] = ( ! empty( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '#28a745';
		return $instance;
	}
}
?>