<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://themeegg.com/
 * @since      1.0.0
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/public/partials
 */
?>
	<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

$afwp_args       	= array();
$afwp_templates  	= afwp_sanitize_accordion_templates();
$afwp_style      	= afwp_accordion_styles();
$afwp_active_item	= 1;
$afwp_content_type 	= afwp_sanitize_accordion_content_type();

$afwp_tab_icon = '';
$afwp_title_color = '';
$afwp_title_background = '';
$afwp_content_color = '';
$afwp_content_background = '';

$args       	= apply_filters( 'afwp_tab_args', $afwp_args );

$content_type   = apply_filters( 'afwp_tab_content_type', $afwp_content_type );

$templates  	= apply_filters( 'afwp_tab_templates', $afwp_templates );
$style      	= apply_filters( 'afwp_tab_styles', $afwp_style );
$active_item    = absint(apply_filters( 'afwp_tab_activeitem', $afwp_active_item ) );

$tab_icon		= apply_filters( 'afwp_tab_icon', $afwp_tab_icon);
$title_color	= apply_filters( 'afwp_title_color', $afwp_title_color);
$title_background	= apply_filters( 'afwp_title_background', $afwp_title_background);
$content_color	= apply_filters( 'afwp_content_color', $afwp_content_color);
$content_background	= apply_filters( 'afwp_content_background', $afwp_content_background);

$query      = new WP_Query( $args );
if ( $query->have_posts() ):
	?>
	<div class="afwp-tab-template afwp-tab-shortcode afwp-tab-<?php echo esc_attr($templates); ?>">
		<div class="afwp-tab <?php echo esc_attr($style); ?>">
			<ul class="afwp-tab-list">
				<?php 
				$current_item = 0;
				while ( $query->have_posts() ):$query->the_post(); 
					$current_item++;
					$tab_class = ($current_item==$active_item) ? ' current ' : '';
					?>
					<li class="afwp-tab-item-wrap">
						<div class="afwp-tab-title <?php echo esc_attr($tab_class); ?>" style="background:<?php echo sanitize_hex_color($title_background); ?>; color:<?php echo sanitize_hex_color($title_color); ?>;">
							<?php if(!empty($tab_icon)): ?>
								<i
									class="afwp-toggle-icon fa <?php echo esc_attr($tab_icon); ?>" 
									style="color:<?php echo sanitize_hex_color($title_color); ?>;"
								></i>
							<?php endif; ?>
							<a class="afwp-post-link" href="#post_tab_<?php echo get_the_ID(); ?>"><?php the_title(); ?></a>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
			<div class="afwp-tab-content-wraper">
				<?php 
				$current_item = 0;
				while ( $query->have_posts() ):$query->the_post(); 
					$current_item++;
					$tab_class = ($current_item==$active_item) ? ' current ' : '';
					?>
					<div class="afwp-tab-content <?php echo esc_attr($tab_class); ?>" id="post_tab_<?php echo get_the_ID(); ?>">
						<?php
							if($content_type=='content'){
								the_content();
							}else{
								the_excerpt();
							}
						?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php
endif;
wp_reset_query();
wp_reset_postdata();