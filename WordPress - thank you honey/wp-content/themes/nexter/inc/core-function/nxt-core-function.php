<?php
/**
 * Nexter Core Function 
 *
 * @package	Nexter
 * @since	1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fixed Body Frame
 * @since 1.0.0
 */
if ( ! function_exists( 'nxt_fixed_body_frame' ) ) {

	function nxt_fixed_body_frame() {

		$fixed_body_frame = nexter_get_option( 'fixed-body-frame' );
		if( $fixed_body_frame == 'on' ){
		?>		
			<div class="nxt-body-frame frame-top"></div>
			<div class="nxt-body-frame frame-left"></div>		
			<div class="nxt-body-frame frame-bottom"></div>
			<div class="nxt-body-frame frame-right"></div>
		<?php
		}
	}
}
add_action( 'nxt_body_frame', 'nxt_fixed_body_frame' );

if ( ! function_exists( 'nexter_content_layout_container' ) ) {

	function nexter_content_layout_container() {
		
		$layout_container = '';
		$current_pagenow = '';
		if ( is_singular() ) {
		
			if ( is_page() ) {
				$layout_container = nexter_get_option( 'site-page-container' );
				$current_pagenow = (!empty($layout_container)) ? ' nxt-page-cont' : '';
			}
			if ( is_single() ) {
				$layout_container = nexter_get_option( 'site-posts-container' );
				$current_pagenow = (!empty($layout_container)) ? ' nxt-post-cont' : '';
			}
			
			if ( empty( $layout_container ) || $layout_container == 'default' ) {
				$layout_container = nexter_get_option( 'site-layout-container' );
				$current_pagenow = '';
			}
			
		}else if((is_home() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page))){
				$layout_container = nexter_get_option( 'site-archive-container' );
				$current_pagenow = (!empty($layout_container)) ? ' nxt-archive-cont' : '';
				if ( empty( $layout_container ) || $layout_container == 'default' ) {
					$layout_container = nexter_get_option( 'site-layout-container' );
					$current_pagenow = '';
				}
				if((function_exists( 'is_shop' ) && is_shop()) || (function_exists( 'is_woocommerce' ) && is_woocommerce())){
					$layout_container ='';
				}
		}
		$layout_container = $layout_container.$current_pagenow;
		return apply_filters( 'nexter_container_layout', $layout_container );
	}
}

/**
 * Nexter Header Template
 *
 * @since 1.0.10
 */
if( ! function_exists('nexter_header_template') ){
	
	function nexter_header_template(){
		$sections	= [];
		$sections	= apply_filters( 'nexter_header_sections_ids', $sections );
		$header_disable = nexter_get_option( 'nxt-header-disable-opt' );
		if($header_disable!='on' || !empty($sections)){
			echo '<header itemscope="itemscope" id="nxt-header" class="'.esc_attr(nexter_header_classes()).'" role="banner">'; ?>
				<a class="nexter-skip-link screen-reader-text" href="#content" tabindex="0">
				<?php echo __( 'Skip to content', 'nexter' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
				<?php
				if(!empty($sections)){
					$normal_header = false;
					$sticky_header = false;
					foreach ( $sections as $post_id) {
						$header_type = get_post_meta( $post_id, 'nxt-normal-sticky-header', true );
						if(!empty($header_type)){
							if( $header_type== 'both' ){
								$sticky_header = 'combine';
								$normal_header = true;
							}else if( $header_type== 'sticky'){
								$sticky_header = true;
							}else if( $header_type== 'normal'){
								$normal_header = true;
							}
						}else{
							$normal_header = true;
						}
					}
					
					//Normal Header
					if( !empty($normal_header) ){
						if( !empty( $sticky_header ) && $sticky_header === 'combine' ){
							echo '<div class="nxt-stick-header-height"></div>';
						}
						do_action( 'nexter_normal_header' );
					}
					
					//Sticky Header
					if( !empty($sticky_header) && $sticky_header !== 'combine' ){
						do_action( 'nexter_sticky_header' );
					}
					
				}else{
					$site_name = get_bloginfo( 'name' );
					$tagline   = get_bloginfo( 'description', 'display' );
					$header_container = nexter_get_option( 'site-header-container' );
					$header_container = (!empty($header_container)) ? 'nxt-'.esc_attr($header_container) : 'nxt-container-block-editor';
					echo '<div class="'.esc_attr($header_container).' p-15">';
						echo '<div class="nxt-header-wrap alignwide nxt-flex nxt-flex-wrap align-items-center">';
							echo '<div class="site-branding">';
							if ( has_custom_logo() ) {
								the_custom_logo();
							} elseif ( $site_name ) {
								echo '<h1 class="site-title m-0">';
									echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr__( 'Home', 'nexter' ).'" rel="home">';
									echo esc_html( $site_name );
									echo '</a>';
								echo '</h1>';
								echo '<p class="site-description m-0">';
									if ( $tagline ) {
										echo esc_html( $tagline );
									}
								echo '</p>';
							}
							echo '</div>';
							if ( has_nav_menu( 'menu-1' ) ) {
								echo '<nav class="site-navigation nxt-flex justify-content-end" role="navigation">';
									wp_nav_menu( array( 'menu_class' => 'menu nxt-primary-menu', 'theme_location' => 'menu-1' ) );
								echo '</nav>';
							}
							echo '</div>';
					echo '</div>';
				}
			echo '</header>';
		}
	}
	add_action( 'nexter_header', 'nexter_header_template' );
}

/**
 * Normal Header template
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'nexter_normal_header_template' ) ) {

	function nexter_normal_header_template() {
		get_template_part( 'template-parts/header/normal-header' );
	}
	add_action( 'nexter_normal_header', 'nexter_normal_header_template' );
}

/**
 * Sticky Header template
 * 
 * @since 1.0.10
 */
if ( ! function_exists( 'nexter_sticky_header_template' ) ) {

	function nexter_sticky_header_template() {
		get_template_part( 'template-parts/header/sticky-header' );
	}
	add_action( 'nexter_sticky_header', 'nexter_sticky_header_template' );
}

/*
 * Nexter Header Classes
 *
 * @since 1.0.0
 */
if( ! function_exists( 'nexter_header_classes' ) ){
	
	function nexter_header_classes() {
		
		$classes	= array( 'site-header' );
		
		$classes	= array_unique( apply_filters( 'nexter_header_class', $classes ) );
		$classes	= array_map( 'sanitize_html_class', $classes );

		return esc_attr( join( ' ', $classes ) );
	}
	
}

/*
 * Nexter Breadcrumb Template 
 *
 * @since 1.0.0
 */
if( ! function_exists( 'nexter_breadcrumb_template' ) ) {

	function nexter_breadcrumb_template() {
	
		$sections	= [];
		$sections	= apply_filters( 'nexter_breadcrumb_sections_ids', $sections );
		
		if(!empty($sections)){
			get_template_part( 'template-parts/header/breadcrumb-content' );
		}
		
	}
	
	add_action( 'nexter_breadcrumb', 'nexter_breadcrumb_template' );
}

/**
 * Nexter Footer Template
 * 
 * @since 1.0.0
 */
if( ! function_exists('nexter_footer_template') ) {
	
	function nexter_footer_template( $post_id ) {
		$sections	= [];
		$sections	= apply_filters( 'nexter_footer_sections_ids', $sections );

		$footer_disable = nexter_get_option( 'nxt-footer-disable-opt' );
		if($footer_disable!='on' || !empty($sections)){
			echo '<footer id="nxt-footer" class="'.esc_attr(nexter_footer_classes()).'">';
			
				if(!empty($sections)){
					get_template_part( 'template-parts/footer/footer-content' );
				}else{
					$footer_container = nexter_get_option( 'site-footer-container' );
					$footer_container = (!empty($footer_container)) ? 'nxt-'.esc_attr($footer_container) : 'nxt-container-block-editor';
					echo '<div class="nxt-footer-copyright '.esc_attr($footer_container).' p-15 ">';
						echo '<div class="nxt-flex align-items-center alignwide justify-content-center">';
							printf(
								/* translators: copyright: Made By Nexter */
								esc_html__( '%1$s Made by&nbsp;%2$s&nbsp;WP Theme', 'nexter' ),
								sprintf( '©%s',	esc_html(date("Y")) ),
								/* translators: copyright: Made By Nexter */
								sprintf(
									'<a href="%s" target="_blank" rel="noopener noreferrer" >%s</a>',
									'https://nexterwp.com/',
									esc_html__( 'Nexter', 'nexter' )
								)
							);
						echo '</div>';
					echo '</div>';
				}
				
			echo '</footer>';
		}
	}
	
	add_action( 'nexter_footer', 'nexter_footer_template' );
}

if ( ! function_exists( 'nexter_footer_classes' ) ) {

	function nexter_footer_classes() {
		
		$classes	= array( 'site-footer' );
		
		$classes	= array_unique( apply_filters( 'nexter_footer_class', $classes ) );

		$classes	= array_map( 'sanitize_html_class', $classes );

		return esc_attr( join( ' ', $classes ) );
	}
}

/**
 * Nexter 404 Page Template
 */
if( ! function_exists( 'nexter_404_page_template_load' ) ) {
	function nexter_404_page_template_load() {
			get_template_part( 'template-parts/content-404' );
	}
	add_action( 'nexter_404_page_template', 'nexter_404_page_template_load' );	
}

/**
 * Nexter 404 Page Content Load
 */
if ( ! function_exists( 'nexter_404_page_content_load' ) && !defined('NEXTER_EXT_VER')) {

	function nexter_404_page_content_load() {
			get_template_part( 'template-parts/404-page/404-page' );
	}
	add_action( 'nexter_404_page_content', 'nexter_404_page_content_load' );
}

/*
 * Post Content Excerpt By Limit
 */
function nexter_excerpt( $limit ) {
	if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
		WPBMap::addAllMappedShortcodes();
	}
	global $post;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
		
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	
	return $excerpt;
}

/*
 * Get BreadCrumb Content
 */
function nexter_breadcrumbs() {
    $breadArr['home']     = esc_html__('Home', 'nexter'); 
	/* translators: %s: Archive */
    $breadArr['category'] = esc_html__('Archive by "%s"', 'nexter');
	/* translators: %s: Search term */
    $breadArr['search']   = esc_html__('Search Results for "%s"', 'nexter');
	/* translators: %s: Posts Tagged */
    $breadArr['tag']      = esc_html__('Posts Tagged "%s"', 'nexter');
	/* translators: %s: Articles Posted */
    $breadArr['author']   = esc_html__('Articles Posted by %s', 'nexter');
    $breadArr['404']      = esc_html__('Error 404', 'nexter');

	$showCurrent = 1; 
    $showOnHome  = 1; 
    $delimiter   = ' <span class="del"></span> '; 
    $before      = '<span class="current">';
    $after       = '</span>';
    
    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<span>';
    $linkAfter = '</span>';
    $link = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1) $crumbs_output = '<nav id="nxt-crumbs"><a href="' . esc_url(home_url()) . '">' . esc_html($breadArr['home']) . '</a></nav>';

    } else {

        $crumbs_output ='<nav id="nxt-crumbs">' . sprintf($link, $homeLink, $breadArr['home']) . $delimiter;

        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a', $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                $crumbs_output .= $cats;
            }
            $crumbs_output .= $before . sprintf($breadArr['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            $crumbs_output .= $before . sprintf($breadArr['search'], get_search_query()) . $after;
        }
        elseif (is_singular('topic') ){
            $post_type = get_post_type_object(get_post_type());
            printf('<span><a href="%1$s">%2$s</a></span>', esc_url($homeLink) . '/forums/', esc_html($post_type->labels->singular_name));	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        /* in forum, add link to support forum page template */
        elseif (is_singular('forum')){
            $post_type = get_post_type_object(get_post_type());
            printf('<span><a href="%1$s">%2$s</a></span>', esc_url($homeLink) . '/forums/',  esc_html($post_type->labels->singular_name));	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        elseif (is_tax('topic-tag')){
            $post_type = get_post_type_object(get_post_type());
            printf('<span><a href="%1$s">%2$s</a></span>', esc_url($homeLink) . '/forums/',  esc_html($post_type->labels->singular_name));	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        elseif ( is_day() ) {
            $crumbs_output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            $crumbs_output .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            $crumbs_output .= $before . esc_html(get_the_time('d')) . $after;

        } elseif ( is_month() ) {
            $crumbs_output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            $crumbs_output .= $before . esc_html(get_the_time('F')) . $after;

        } elseif ( is_year() ) {
            $crumbs_output .= $before . esc_html(get_the_time('Y')) . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                 $crumbs_output .= $linkBefore . '<a href="'.esc_url($homeLink). '/' . esc_attr($slug["slug"]) . '/">'.esc_html($post_type->labels->singular_name).'</a>' . $linkAfter;
                if ($showCurrent == 1) $crumbs_output .= $delimiter . $before . esc_html(get_the_title()) . $after;
            } else {
                $cat = get_the_category();
				if(isset($cat[0])) {
					$cat =  $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a', $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$crumbs_output .= $cats;
					if ($showCurrent == 1) $crumbs_output .= $before . esc_html(get_the_title()) . $after;
				}
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            $crumbs_output .= $before . esc_html($post_type->labels->singular_name) . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
			if($cat) {
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a', $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				$crumbs_output .= $cats;
				printf('<span><a href="%1$s">%2$s</a></span>', esc_url(get_permalink($parent)), esc_html($parent->post_title));	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				if ($showCurrent == 1) $crumbs_output .= $delimiter . $before . esc_html(get_the_title()) . $after;
			}
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) $crumbs_output .= $before . esc_html(get_the_title()) . $after;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                $crumbs_output .= $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) $crumbs_output .= $delimiter;
            }
            if ($showCurrent == 1) $crumbs_output .= $delimiter . $before . esc_html(get_the_title()) . $after;

        } elseif ( is_tag() ) {
            $crumbs_output .= $before . sprintf($breadArr['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            $crumbs_output .= $before . sprintf($breadArr['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            $crumbs_output .= $before . $breadArr['404'] . $after;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $crumbs_output .= ' (';
            $crumbs_output .= '<span class="del"></span>'.esc_html__('Page', 'nexter') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $crumbs_output .= ')';
        }

        $crumbs_output .= '</nav>';

    }
	
	return $crumbs_output;
}

/*
 * Nexter Post Pagination
 */
function nexter_pagination($pages = '', $range = 4){  
	$showitems = ($range * 2)+1;  
	
	global $paged;
	if(empty($paged)) $paged = 1; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	
	if( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages)
		{
			$pages = 1;
		}
	}
	
	if( 1 != $pages ) {
		$paginate ="<div class=\"nxt-paginate nxt-flex align-items-center nxt-flex-wrap justify-content-center\">";
		
		if ($paged > 1) $paginate .= "<a class='prev' href='".get_pagenum_link($paged - 1)."'>".esc_html__('PREV','nexter')."</a>";
		if ( get_previous_posts_link() ){
			get_previous_posts_link('Prev');
		}
		for ( $i=1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ) {
				$paginate .= ($paged == $i)? "<span class=\"current\">".esc_html($i)."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".esc_html($i)."</a>";
			}
		}
		if ( get_next_posts_link() ) {
			get_next_posts_link('Next',1);
		}
		if ( $paged < $pages ) $paginate .= "<a class='next' href='".get_pagenum_link($paged + 1)."'>".esc_html__('NEXT','nexter')."</a>";
		$paginate .="</div>\n";
		return $paginate;
	}
}

/**
 * Display Site Sidebar
 */
if ( ! function_exists( 'nexter_site_sidebar_layout' ) ) {
	function nexter_site_sidebar_layout() {
		$get_sidebar =array();
		if ( is_singular() ) {

			// If post meta value is empty			
			$get_sidebar['layout'] = nexter_get_option_meta( 'nxt-post-page-sidebar', '', true );

			if ( empty( $get_sidebar['layout'] ) || $get_sidebar['layout'] =='default' ) {

				$post_type = get_post_type();
				
				//Posts,Pages,Product
				if ( 'post' === $post_type || 'page' === $post_type || 'product' === $post_type ) {
					$get_sidebar['layout'] = nexter_get_option( 'single-' . get_post_type() . '-sidebar', 'default' );
					$get_sidebar['sidebar'] = nexter_get_option( 'single-' . get_post_type() . '-display-sidebar', 'sidebar-1' );
					if( ($get_sidebar['layout'] != 'default' && $get_sidebar['layout'] != 'no-sidebar') && $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'single-' . get_post_type() . '-custom-sidebar', 'none' );
					}
				}
				
				//Default
				if ( 'default' == $get_sidebar['layout'] || empty( $get_sidebar['layout'] ) ) {
					$get_sidebar['layout'] = nexter_get_option( 'whole-site-sidebar', 'no-sidebar' );
					$get_sidebar['sidebar'] = nexter_get_option( 'whole-site-display-sidebar','sidebar-1' );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'whole-site-custom-sidebar', 'none' );
					}
				}
			}else if(!empty($get_sidebar['layout']) && ($get_sidebar['layout'] != 'default' || $get_sidebar['layout'] != 'no-sidebar') ){
				$post_type = get_post_type();
				if ( 'post' === $post_type || 'page' === $post_type || 'product' === $post_type ) {
					$get_sidebar['sidebar'] = nexter_get_option_meta( 'nxt-post-page-display-sidebar', '', true );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option_meta( 'nxt-post-page-custom-sidebar', 'none', true  );
					}
				}
			}
		} else {

			if ( is_search() ) {

				//Archive Post
				$get_sidebar['layout'] = nexter_get_option( 'archive-post-sidebar', 'default' );
				$get_sidebar['sidebar'] = nexter_get_option( 'archive-post-display-sidebar','sidebar-1' );
				if( $get_sidebar['sidebar'] === 'custom' ){
					$get_sidebar['custom'] = nexter_get_option( 'archive-post-custom-sidebar', 'none' );
				}
				
				if ( 'default' == $get_sidebar['layout'] || empty( $get_sidebar['layout'] ) ) {
					//Default
					$get_sidebar['layout'] = nexter_get_option( 'whole-site-sidebar', 'no-sidebar' );
					$get_sidebar['sidebar'] = nexter_get_option( 'whole-site-display-sidebar','sidebar-1' );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'whole-site-custom-sidebar', 'none' );
					}
				}
			} else {

				$post_type = get_post_type();
				$get_sidebar['layout']    = '';
				//Archive Post
				if ( 'post' === $post_type ) {
					$get_sidebar['layout'] = nexter_get_option( 'archive-' . get_post_type() . '-sidebar', 'default' );
					$get_sidebar['sidebar'] = nexter_get_option( 'archive-' . get_post_type() . '-display-sidebar','sidebar-1' );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'archive-post-custom-sidebar', 'none' );
					}
				}

				if ( 'default' == $get_sidebar['layout'] || empty( $get_sidebar['layout'] ) ) {
					//Default
					$get_sidebar['layout'] = nexter_get_option( 'whole-site-sidebar', 'no-sidebar' );
					$get_sidebar['sidebar'] = nexter_get_option( 'whole-site-display-sidebar','sidebar-1' );
					if( $get_sidebar['sidebar'] === 'custom' ){
						$get_sidebar['custom'] = nexter_get_option( 'whole-site-custom-sidebar', 'none' );
					}
				}
			}
		}
		return apply_filters( 'nexter_sidebar_layout', $get_sidebar );
	}
}

/*
 * Custom Sidebar Nexter Builder
 */
if( ! function_exists( 'nexter_custom_sidebar_template' ) ) {
	function nexter_custom_sidebar_template(){
		$display_sidebar = nexter_site_sidebar_layout();
		if(!empty($display_sidebar) && $display_sidebar['sidebar'] == 'custom' ){
			nexter_content_load( $display_sidebar['custom'] );
		}
	}
	add_action( 'nexter_custom_sidebar', 'nexter_custom_sidebar_template' );
}
