<?php 
/**
 * Library of Theme options functions.
 * @package GalaNight
 * @since GalaNight 1.0.0
*/

// Display Breadcrumb navigation
function galanight_get_breadcrumb() { 
		if (get_theme_mod('galanight_display_breadcrumb', galanight_default_options('galanight_display_breadcrumb')) != 'Hide') { ?>
		<?php if (function_exists( 'bcn_display' ) && !is_front_page()) { echo '<p class="breadcrumb-navigation">'; ?><?php bcn_display(); ?><?php echo '</p>'; } ?>
<?php } 
} 

// Display featured images on single posts
function galanight_get_display_image_post() { 
		if (get_theme_mod('galanight_display_image_post', galanight_default_options('galanight_display_image_post')) == '' || get_theme_mod('galanight_display_image_post', galanight_default_options('galanight_display_image_post')) == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
}

// Display featured images on pages
function galanight_get_display_image_page() { 
		if (get_theme_mod('galanight_display_image_page', galanight_default_options('galanight_display_image_page')) == '' || get_theme_mod('galanight_display_image_page', galanight_default_options('galanight_display_image_page')) == 'Display') { ?>
		<?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php } 
} ?>