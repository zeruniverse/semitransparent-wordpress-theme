<?php
/**
 * Twenty Eleven Theme Options
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $hook_suffix An admin page's hook suffix.
 */
function SemiTransparent_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'SemiTransparent-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-04-28' );
	wp_enqueue_script( 'SemiTransparent-theme-options', get_template_directory_uri() . '/inc/theme-options.js', array( 'farbtastic' ), '2011-06-10' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'SemiTransparent_admin_enqueue_scripts' );

/**
 * Register the form setting for our SemiTransparent_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, SemiTransparent_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_theme_options_init() {

	register_setting(
		'SemiTransparent_options',       // Options group, see settings_fields() call in SemiTransparent_theme_options_render_page()
		'SemiTransparent_theme_options', // Database option, see SemiTransparent_get_theme_options()
		'SemiTransparent_theme_options_validate' // The sanitization callback, see SemiTransparent_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see SemiTransparent_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'color_scheme',                             // Unique identifier for the field for this section
		__( 'Color Scheme', 'SemiTransparent' ),       // Setting field label
		'SemiTransparent_settings_field_color_scheme', // Function that renders the settings field
		'theme_options',                            // Menu slug, used to uniquely identify the page; see SemiTransparent_theme_options_add_page()
		'general'                                   // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'link_color', __( 'Link Color',     'SemiTransparent' ), 'SemiTransparent_settings_field_link_color', 'theme_options', 'general' );
	add_settings_field( 'layout',     __( 'Default Layout', 'SemiTransparent' ), 'SemiTransparent_settings_field_layout',     'theme_options', 'general' );
}
add_action( 'admin_init', 'SemiTransparent_theme_options_init' );

/**
 * Change the capability required to save the 'SemiTransparent_options' options group.
 *
 * @see SemiTransparent_theme_options_init()     First parameter to register_setting() is the name of the options group.
 * @see SemiTransparent_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function SemiTransparent_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_SemiTransparent_options', 'SemiTransparent_option_page_capability' );

/**
 * Add a theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'SemiTransparent' ),   // Name of page
		__( 'Theme Options', 'SemiTransparent' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'SemiTransparent_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	add_action( "load-$theme_page", 'SemiTransparent_theme_options_help' );
}
add_action( 'admin_menu', 'SemiTransparent_theme_options_add_page' );

function SemiTransparent_theme_options_help() {

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Twenty Eleven, provides the following Theme Options:', 'SemiTransparent' ) . '</p>' .
			'<ol>' .
				'<li>' . __( '<strong>Link Color</strong>: You can choose the color used for text links on your site. You can enter the HTML color or hex code, or you can choose visually by clicking the "Select a Color" button to pick from a color wheel.', 'SemiTransparent' ) . '</li>' .
				'<li>' . __( '<strong>Default Layout</strong>: You can choose if you want your site&#8217;s default layout to have a sidebar on the left, the right, or not at all.', 'SemiTransparent' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'SemiTransparent' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 'SemiTransparent' ) . '</strong></p>' .
		'<p>' . __( '<a href="https://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'SemiTransparent' ) . '</p>' .
		'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'SemiTransparent' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) {
		// WordPress 3.3.0
		$screen->add_help_tab( array(
			'title' => __( 'Overview', 'SemiTransparent' ),
			'id' => 'theme-options-help',
			'content' => $help,
			)
		);

		$screen->set_help_sidebar( $sidebar );
	} else {
		// WordPress 3.2.0
		add_contextual_help( $screen, $help . $sidebar );
	}
}

/**
 * Return an array of color schemes registered for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_color_schemes() {
	$color_scheme_options = array(
		'light' => array(
			'value' => 'light',
			'label' => __( 'Light', 'SemiTransparent' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/light.png',
			'default_link_color' => '#1b8be0',
		),
		'dark' => array(
			'value' => 'dark',
			'label' => __( 'Dark', 'SemiTransparent' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/dark.png',
			'default_link_color' => '#e4741f',
		),
	);

	/**
	 * Filter the Twenty Eleven color scheme options.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param array $color_scheme_options An associative array of color scheme options.
	 */
	return apply_filters( 'SemiTransparent_color_schemes', $color_scheme_options );
}

/**
 * Return an array of layout options registered for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_layouts() {
	$layout_options = array(
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content on left', 'SemiTransparent' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content-sidebar.png',
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Content on right', 'SemiTransparent' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 'SemiTransparent' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content.png',
		),
	);

	/**
	 * Filter the Twenty Eleven layout options.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param array $layout_options An associative array of layout options.
	 */
	return apply_filters( 'SemiTransparent_layouts', $layout_options );
}

/**
 * Return the default options for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 *
 * @return array An array of default theme options.
 */
function SemiTransparent_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'light',
		'link_color'   => SemiTransparent_get_default_link_color( 'light' ),
		'theme_layout' => 'content-sidebar',
	);

	if ( is_rtl() )
		$default_theme_options['theme_layout'] = 'sidebar-content';

	/**
	 * Filter the Twenty Eleven default options.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param array $default_theme_options An array of default theme options.
	 */
	return apply_filters( 'SemiTransparent_default_theme_options', $default_theme_options );
}

/**
 * Return the default link color for Twenty Eleven, based on color scheme.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $color_scheme Optional. Color scheme.
 *                             Default null (or the active color scheme).
 * @return string The default link color.
*/
function SemiTransparent_get_default_link_color( $color_scheme = null ) {
	if ( null === $color_scheme ) {
		$options = SemiTransparent_get_theme_options();
		$color_scheme = $options['color_scheme'];
	}

	$color_schemes = SemiTransparent_color_schemes();
	if ( ! isset( $color_schemes[ $color_scheme ] ) )
		return false;

	return $color_schemes[ $color_scheme ]['default_link_color'];
}

/**
 * Return the options array for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_get_theme_options() {
	return get_option( 'SemiTransparent_theme_options', SemiTransparent_get_default_theme_options() );
}

/**
 * Render the Color Scheme setting field.
 *
 * @since Twenty Eleven 1.3
 */
function SemiTransparent_settings_field_color_scheme() {
	$options = SemiTransparent_get_theme_options();

	foreach ( SemiTransparent_color_schemes() as $scheme ) {
	?>
	<div class="layout image-radio-option color-scheme">
	<label class="description">
		<input type="radio" name="SemiTransparent_theme_options[color_scheme]" value="<?php echo esc_attr( $scheme['value'] ); ?>" <?php checked( $options['color_scheme'], $scheme['value'] ); ?> />
		<input type="hidden" id="default-color-<?php echo esc_attr( $scheme['value'] ); ?>" value="<?php echo esc_attr( $scheme['default_link_color'] ); ?>" />
		<span>
			<img src="<?php echo esc_url( $scheme['thumbnail'] ); ?>" width="136" height="122" alt="" />
			<?php echo esc_html( $scheme['label'] ); ?>
		</span>
	</label>
	</div>
	<?php
	}
}

/**
 * Render the Link Color setting field.
 *
 * @since Twenty Eleven 1.3
 */
function SemiTransparent_settings_field_link_color() {
	$options = SemiTransparent_get_theme_options();
	?>
	<input type="text" name="SemiTransparent_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
	<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
	<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'SemiTransparent' ); ?>" />
	<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
	<br />
	<span><?php printf( __( 'Default color: %s', 'SemiTransparent' ), '<span id="default-color">' . SemiTransparent_get_default_link_color( $options['color_scheme'] ) . '</span>' ); ?></span>
	<?php
}

/**
 * Render the Layout setting field.
 *
 * @since Twenty Eleven 1.3
 */
function SemiTransparent_settings_field_layout() {
	$options = SemiTransparent_get_theme_options();
	foreach ( SemiTransparent_layouts() as $layout ) {
		?>
		<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="SemiTransparent_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
			<span>
				<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
				<?php echo esc_html( $layout['label'] ); ?>
			</span>
		</label>
		</div>
		<?php
	}
}

/**
 * Render the theme options page for Twenty Eleven.
 *
 * @since Twenty Eleven 1.2
 */
function SemiTransparent_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'SemiTransparent' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'SemiTransparent_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input.
 *
 * Accepts an array, return a sanitized array.
 *
 * @see SemiTransparent_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since Twenty Eleven 1.0
 *
 * @param array $input An array of form input.
 */
function SemiTransparent_theme_options_validate( $input ) {
	$output = $defaults = SemiTransparent_get_default_theme_options();


	// Our defaults for the link color may have changed, based on the color scheme.
	$output['link_color'] = $defaults['link_color'] = SemiTransparent_get_default_link_color( $output['color_scheme'] );

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], SemiTransparent_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	/**
	 * Filter the Twenty Eleven sanitized form input array.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param array $output   An array of sanitized form output.
	 * @param array $input    An array of un-sanitized form input.
	 * @param array $defaults An array of default theme options.
	 */
	return apply_filters( 'SemiTransparent_theme_options_validate', $output, $input, $defaults );
}

/**
 * Enqueue the styles for the current color scheme.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_enqueue_color_scheme() {
	$options = SemiTransparent_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( 'dark' == $color_scheme )
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/colors/dark.css', array(), null );

	/**
	 * Fires after the styles for the Twenty Eleven color scheme are enqueued.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param string $color_scheme The color scheme.
	 */
	do_action( 'SemiTransparent_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'SemiTransparent_enqueue_color_scheme' );

/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the wp_head action hook.
 *
 * @since Twenty Eleven 1.0
 */
function SemiTransparent_print_link_color_style() {
	$options = SemiTransparent_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = SemiTransparent_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
	<style>
		/* Link color */
		a,
		#site-title a:focus,
		#site-title a:hover,
		#site-title a:active,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-title a:active,
		.widget_SemiTransparent_ephemera .comments-link a:hover,
		section.recent-posts .other-recent-posts a[rel="bookmark"]:hover,
		section.recent-posts .other-recent-posts .comments-link a:hover,
		.format-image footer.entry-meta a:hover,
		#site-generator a:hover {
			color: <?php echo $link_color; ?>;
		}
		section.recent-posts .other-recent-posts .comments-link a:hover {
			border-color: <?php echo $link_color; ?>;
		}
		article.feature-image.small .entry-summary p a:hover,
		.entry-header .comments-link a:hover,
		.entry-header .comments-link a:focus,
		.entry-header .comments-link a:active,
		.feature-slider a.active {
			background-color: <?php echo $link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'SemiTransparent_print_link_color_style' );

/**
 * Add Twenty Eleven layout classes to the array of body classes.
 *
 * @since Twenty Eleven 1.0
 *
 * @param array $existing_classes An array of existing body classes.
 */
function SemiTransparent_layout_classes( $existing_classes ) {
	$options = SemiTransparent_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	if ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';
	else
		$classes[] = $current_layout;

	/**
	 * Filter the Twenty Eleven layout body classes.
	 *
	 * @since Twenty Eleven 1.0
	 *
	 * @param array  $classes        An array of body classes.
	 * @param string $current_layout The current theme layout.
	 */
	$classes = apply_filters( 'SemiTransparent_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'SemiTransparent_layout_classes' );

/**
 * Implements Twenty Eleven theme options into Customizer
 *
 * @since Twenty Eleven 1.3
 *
 * @param object $wp_customize Customizer object.
 */
function SemiTransparent_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$options  = SemiTransparent_get_theme_options();
	$defaults = SemiTransparent_get_default_theme_options();

	$wp_customize->add_setting( 'SemiTransparent_theme_options[color_scheme]', array(
		'default'    => $defaults['color_scheme'],
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$schemes = SemiTransparent_color_schemes();
	$choices = array();
	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_section( 'SemiTransparent_layout', array(
		'title'    => __( 'Layout', 'SemiTransparent' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'SemiTransparent_theme_options[theme_layout]', array(
		'type'              => 'option',
		'default'           => $defaults['theme_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = SemiTransparent_layouts();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'SemiTransparent_theme_options[theme_layout]', array(
		'section'    => 'SemiTransparent_layout',
		'type'       => 'radio',
		'choices'    => $choices,
	) );
}
add_action( 'customize_register', 'SemiTransparent_customize_register' );

/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * Used with blogname and blogdescription.
 *
 * @since Twenty Eleven 1.3
 */
function SemiTransparent_customize_preview_js() {
	wp_enqueue_script( 'SemiTransparent-customizer', get_template_directory_uri() . '/inc/theme-customizer.js', array( 'customize-preview' ), '20150401', true );
}
add_action( 'customize_preview_init', 'SemiTransparent_customize_preview_js' );
