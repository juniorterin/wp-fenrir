<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wp_Fenrir
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_fenrir_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'wp_fenrir_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wp_fenrir_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wp_fenrir_pingback_header' );

// WP Fenrir plugins dependencies

add_action( 'admin_notices', 'wp_fenrir_plugin_dependencies' );

function wp_fenrir_plugin_dependencies() {

	function requireDependency($name, $path, $slug) {
		if( !is_plugin_active( $path ) ) { ?>
			<div class="error"><p>Você precisa  <a href="<?php echo get_admin_url(); ?>plugin-install.php?tab=plugin-information&plugin=<?php echo $slug; ?>&TB_iframe=true&width=600&height=550">instalar/ativar</a> o plugin <?php echo $name; ?></p></div>			
		<?php }
	};

	// ex: requireDependencie('FakerPress', 'fakerpress/fakerpress.ho', 'fakerpress')

};
