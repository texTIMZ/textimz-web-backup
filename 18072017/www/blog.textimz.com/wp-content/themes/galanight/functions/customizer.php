<?php
/**
 * GalaNight Theme Customizer.
 * @package GalaNight
 * @since GalaNight 2.0.0
*/

/**
 * Default values - backwards compatibility for older GalaNight versions.
 *  
*/ 
function galanight_default_options($key) {

$galanight_theme_options = get_option('galanight_options');

/* Define the array of defaults */ 
$galanight_defaults = array(
			'galanight_css' => 'Turquoise (default)',
			'galanight_layout_width' => 'Wide',
			'galanight_display_breadcrumb' => 'Display',
      'galanight_display_scroll_top' => 'Display',
      'galanight_display_background_pattern' => 'Display',
      'galanight_background_pattern_opacity' => 'Default',
			'galanight_display_sidebar' => 'Display',
			'galanight_display_sidebar_archives' => 'Display',
			'galanight_header_layout' => 'Wide',
			'galanight_display_header_image' => 'Everywhere',
			'galanight_page_title_width' => '50',
			'galanight_header_menu_width' => '50',
			'galanight_logo_url' => '',
			'galanight_header_address' => '',
			'galanight_header_email' => '',
			'galanight_header_phone' => '',
			'galanight_header_skype' => '',
			'galanight_header_image_headline' => '',
			'galanight_header_image_link_url' => '',
			'galanight_header_image_link_text' => '',
			'galanight_display_image_post' => 'Display',
			'galanight_display_meta_post' => 'Display',
			'galanight_next_preview_post' => 'Display',
			'galanight_display_image_page' => 'Display',
			'galanight_infinite_scroll' => 'Enable',
			'galanight_display_meta_post_entry' => 'Display',
      'galanight_featured_image_size' => 'Small',
			'galanight_content_archives' => 'Excerpt',
      'galanight_excerpt_length' => '40',
			'galanight_display_site_description' => 'Display',
			'galanight_body_google_fonts' => 'default',
			'galanight_headings_google_fonts' => 'default',
			'galanight_headline_google_fonts' => 'default',
			'galanight_postentry_google_fonts' => 'default',
			'galanight_sidebar_google_fonts' => 'default',
			'galanight_menu_google_fonts' => 'default',
			'galanight_own_css' => '' );

$galanight_theme_options = wp_parse_args( $galanight_theme_options, $galanight_defaults );

if ( isset($galanight_theme_options[$key]) ) {
return $galanight_theme_options[$key]; } else {
return false;
}}

/**
 * Register Customizer sections and options.
 *  
*/
function galanight_customize_register($wp_customize){

$galanight_fonts = array(
			'default' => 'default',	
			'Abel' => 'Abel',			
			'Aclonica' => 'Aclonica',
			'Actor' => 'Actor',
			'Adamina' => 'Adamina',
			'Aldrich' => 'Aldrich',
			'Alice' => 'Alice',
			'Alike' => 'Alike',
			'Allan' => 'Allan',
			'Allerta' => 'Allerta',
      'Amarante' => 'Amarante',
			'Amaranth' => 'Amaranth',
      'Andika' => 'Andika',
			'Antic' => 'Antic',
			'Arimo' => 'Arimo',	
			'Artifika' => 'Artifika',
			'Arvo' => 'Arvo',
			'Brawler' => 'Brawler',
			'Buda' => 'Buda',	
      'Butcherman' => 'Butcherman',	
			'Cantarell' => 'Cantarell',	
      'Cherry Swash' => 'Cherry Swash',				
			'Chivo' => 'Chivo',			
			'Coda' => 'Coda',	
      'Concert One' => 'Concert One',		
			'Copse' => 'Copse',
			'Corben' => 'Corben',
			'Cousine' => 'Cousine',			
			'Coustard' => 'Coustard',
			'Covered By Your Grace' => 'Covered By Your Grace',
			'Crafty Girls' => 'Crafty Girls',
			'Crimson Text' => 'Crimson Text',
			'Crushed' => 'Crushed',
			'Cuprum' => 'Cuprum',
			'Damion' => 'Damion',
			'Dancing Script' => 'Dancing Script',
			'Dawning of a New Day' => 'Dawning of a New Day',
			'Days One' => 'Days One',
			'Delius' => 'Delius',
			'Delius Swash Caps' => 'Delius Swash Caps',
			'Delius Unicase' => 'Delius Unicase',
			'Didact Gothic' => 'Didact Gothic',
			'Dorsa' => 'Dorsa',
			'Droid Sans' => 'Droid Sans',
			'Droid Sans Mono' => 'Droid Sans Mono',
      'Droid Serif' => 'Droid Serif',
			'EB Garamond' => 'EB Garamond',
			'Expletus Sans' => 'Expletus Sans',
			'Fanwood Text' => 'Fanwood Text',
			'Federo' => 'Federo',
			'Fontdiner Swanky' => 'Fontdiner Swanky',
			'Forum' => 'Forum',
			'Francois One' => 'Francois One',
			'Gentium Basic' => 'Gentium Basic',
			'Gentium Book Basic' => 'Gentium Book Basic',
			'Geo' => 'Geo',
			'Geostar' => 'Geostar',
			'Geostar Fill' => 'Geostar Fill',
      'Gilda Display' => 'Gilda Display',
			'Give You Glory' => 'Give You Glory',
			'Gloria Hallelujah' => 'Gloria Hallelujah',
			'Goblin One' => 'Goblin One',
			'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
			'Gravitas One' => 'Gravitas One',
			'Gruppo' => 'Gruppo',
			'Hammersmith One' => 'Hammersmith One',
			'Holtwood One SC' => 'Holtwood One SC',
			'Homemade Apple' => 'Homemade Apple',
			'Inconsolata' => 'Inconsolata',
			'Indie Flower' => 'Indie Flower',
      'IM Fell English' => 'IM Fell English',
			'Irish Grover' => 'Irish Grover',
			'Irish Growler' => 'Irish Growler',
			'Istok Web' => 'Istok Web',
			'Judson' => 'Judson',
			'Julee' => 'Julee',
			'Just Another Hand' => 'Just Another Hand',
			'Just Me Again Down Here' => 'Just Me Again Down Here',
			'Kameron' => 'Kameron',
			'Kelly Slab' => 'Kelly Slab',
			'Kenia' => 'Kenia',
			'Kranky' => 'Kranky',
			'Kreon' => 'Kreon',
			'Kristi' => 'Kristi',
			'La Belle Aurore' => 'La Belle Aurore',
      'Lato' => 'Lato',
			'League Script' => 'League Script',
			'Leckerli One' => 'Leckerli One',
			'Lekton' => 'Lekton',
      'Lily Script One' => 'Lily Script One',
			'Limelight' => 'Limelight',
			'Lobster' => 'Lobster',
			'Lobster Two' => 'Lobster Two',
			'Lora' => 'Lora',
			'Love Ya Like A Sister' => 'Love Ya Like A Sister',
			'Loved by the King' => 'Loved by the King',
      'Lovers Quarrel' => 'Lovers Quarrel',
			'Luckiest Guy' => 'Luckiest Guy',
			'Maiden Orange' => 'Maiden Orange',
			'Mako' => 'Mako',
			'Marvel' => 'Marvel',
			'Maven Pro' => 'Maven Pro',
			'Meddon' => 'Meddon',
			'MedievalSharp' => 'MedievalSharp',
      'Medula One' => 'Medula One',
			'Megrim' => 'Megrim',
			'Merienda One' => 'Merienda One',
			'Merriweather' => 'Merriweather',
			'Metrophobic' => 'Metrophobic',
			'Michroma' => 'Michroma',
			'Miltonian Tattoo' => 'Miltonian Tattoo',
			'Miltonian' => 'Miltonian',
			'Modern Antiqua' => 'Modern Antiqua',
			'Molengo' => 'Molengo',
      'Monofett' => 'Monofett',
			'Monoton' => 'Monoton',
      'Montaga' => 'Montaga',
			'Montez' => 'Montez',
      'Montserrat' => 'Montserrat',
			'Mountains of Christmas' => 'Mountains of Christmas',
			'Muli' => 'Muli',
			'Neucha' => 'Neucha',
			'Neuton' => 'Neuton',
			'News Cycle' => 'News Cycle',
			'Nixie One' => 'Nixie One',
			'Nobile' => 'Nobile',
			'Nova Cut' => 'Nova Cut',
			'Nova Flat' => 'Nova Flat',
			'Nova Mono' => 'Nova Mono',
			'Nova Oval' => 'Nova Oval',
			'Nova Round' => 'Nova Round',
			'Nova Script' => 'Nova Script',
			'Nova Slim' => 'Nova Slim',
			'Nova Square' => 'Nova Square',
			'Numans' => 'Numans',
			'Nunito' => 'Nunito',
      'Open Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Over the Rainbow' => 'Over the Rainbow',
			'Ovo' => 'Ovo',
			'Pacifico' => 'Pacifico',
			'Passero One' => 'Passero One',
			'Patrick Hand' => 'Patrick Hand',
			'Paytone One' => 'Paytone One',
			'Permanent Marker' => 'Permanent Marker',
			'Philosopher' => 'Philosopher',
			'Play' => 'Play',
			'Playfair Display' => 'Playfair Display',
			'Podkova' => 'Podkova',
			'Poller One' => 'Poller One',
			'Pompiere' => 'Pompiere',
			'Prata' => 'Prata',
			'Prociono' => 'Prociono',
			'PT Sans' => 'PT Sans',
			'PT Sans Caption' => 'PT Sans Caption',
			'PT Sans Narrow' => 'PT Sans Narrow',
			'PT Serif' => 'PT Serif',
			'PT Serif Caption' => 'PT Serif Caption',
			'Puritan' => 'Puritan',
			'Quattrocento' => 'Quattrocento',
			'Quattrocento Sans' => 'Quattrocento Sans',
			'Questrial' => 'Questrial',
			'Radley' => 'Radley',
			'Raleway' => 'Raleway', 
      'Rationale' => 'Rationale',
			'Redressed' => 'Redressed',
      'Reenie Beanie' => 'Reenie Beanie', 
      'Roboto' => 'Roboto',
      'Roboto Condensed' => 'Roboto Condensed',
			'Rock Salt' => 'Rock Salt',
			'Rochester' => 'Rochester',
			'Rokkitt' => 'Rokkitt',
			'Rosario' => 'Rosario',
			'Ruslan Display' => 'Ruslan Display',
      'Sancreek' => 'Sancreek',
			'Sansita One' => 'Sansita One',
			'Schoolbell' => 'Schoolbell',
			'Shadows Into Light' => 'Shadows Into Light',
			'Shanti' => 'Shanti',
			'Short Stack' => 'Short Stack',
			'Sigmar One' => 'Sigmar One',
			'Six Caps' => 'Six Caps',
			'Slackey' => 'Slackey',
			'Smokum' => 'Smokum',
			'Smythe' => 'Smythe',
			'Sniglet' => 'Sniglet',
			'Snippet' => 'Snippet',
			'Sorts Mill Goudy' => 'Sorts Mill Goudy',
			'Special Elite' => 'Special Elite',
			'Spinnaker' => 'Spinnaker',
			'Stardos Stencil' => 'Stardos Stencil',
			'Sue Ellen Francisco' => 'Sue Ellen Francisco',
			'Sunshiney' => 'Sunshiney',
			'Swanky and Moo Moo' => 'Swanky and Moo Moo',
			'Syncopate' => 'Syncopate',
			'Tangerine' => 'Tangerine',
			'Tenor Sans' => 'Tenor Sans',
			'Terminal Dosis Light' => 'Terminal Dosis Light',
			'Tinos' => 'Tinos',
			'Tulpen One' => 'Tulpen One',
			'Ubuntu' => 'Ubuntu',
			'Ultra' => 'Ultra',
      'UnifrakturCook' => 'UnifrakturCook',
			'UnifrakturMaguntia' => 'UnifrakturMaguntia',
      'Unkempt' => 'Unkempt',
			'Unna' => 'Unna',
			'Varela' => 'Varela',
			'Varela Round' => 'Varela Round',
			'Vibur' => 'Vibur',
			'Vidaloka' => 'Vidaloka',
			'Volkhov' => 'Volkhov',
			'Vollkorn' => 'Vollkorn',
			'Voltaire' => 'Voltaire',
			'VT323' => 'VT323',
			'Waiting for the Sunrise' => 'Waiting for the Sunrise',
			'Wallpoet' => 'Wallpoet',
			'Walter Turncoat' => 'Walter Turncoat',
			'Wire One' => 'Wire One',
			'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
			'Yellowtail' => 'Yellowtail',
			'Yeseva One' => 'Yeseva One',
			'Zeyada' => 'Zeyada');
      
/**
 * Textarea custom control.
 *  
*/ 
class galanight_customize_textarea_control extends WP_Customize_Control {
    public $type = 'textarea'; 
    public function render_content() { ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
<?php }}

/**
 * Sections and Options.
 *  
*/     
    $wp_customize->add_section('galanight_general_settings', array(
        'title'    => __('GalaNight General Settings', 'galanight'),
        'description' => '',
        'priority' => 120,
    ));
    $wp_customize->add_section('galanight_header_settings', array(
        'title'    => __('GalaNight Header Settings', 'galanight'),
        'description' => '',
        'priority' => 130,
    ));
    $wp_customize->add_section('galanight_posts_settings', array(
        'title'    => __('GalaNight Posts/Pages Settings', 'galanight'),
        'description' => '',
        'priority' => 140,
    ));
    $wp_customize->add_section('galanight_post_entries_settings', array(
        'title'    => __('GalaNight Post Entries Settings', 'galanight'),
        'description' => '',
        'priority' => 150,
    ));
    $wp_customize->add_section('galanight_font_settings', array(
        'title'    => __('GalaNight Font Settings', 'galanight'),
        'description' => '',
        'priority' => 160,
    ));
 
    //  =============================
    //  = Color Scheme              =
    //  =============================
    $wp_customize->add_setting('galanight_css', array(
        'default'        => galanight_default_options('galanight_css'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_css_control', array(
        'label'      => __('Color Scheme', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_css',
        'type'       => 'radio',
        'choices'    => array(
            'Turquoise (default)' => __( 'Turquoise (default)' , 'galanight' ),
            'Blue' => __( 'Blue' , 'galanight' ),
            'Red' => __( 'Red' , 'galanight' ),
        ),
    ));
    
    //  =============================
    //  = Layout Style              =
    //  =============================
    $wp_customize->add_setting('galanight_layout_width', array(
        'default'        => galanight_default_options('galanight_layout_width'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_layout_width_control', array(
        'label'      => __('Layout Style', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_layout_width',
        'type'       => 'radio',
        'choices'    => array(
            'Wide' => __( 'Wide' , 'galanight' ),
            'Boxed' => __( 'Boxed' , 'galanight' ),
        ),
    ));
    
    //  =================================
    //  = Display Breadcrumb Navigation =
    //  =================================
    $wp_customize->add_setting('galanight_display_breadcrumb', array(
        'default'        => galanight_default_options('galanight_display_breadcrumb'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_breadcrumb_control', array(
        'label'      => __('Display Breadcrumb Navigation', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_display_breadcrumb',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  =================================
    //  = Display Scroll-top Button     =
    //  =================================
    $wp_customize->add_setting('galanight_display_scroll_top', array(
        'default'        => galanight_default_options('galanight_display_scroll_top'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_scroll_top_control', array(
        'label'      => __('Display Scroll-top Button', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_display_scroll_top',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==================================
    //  = Display Background Pattern     =
    //  ==================================
    $wp_customize->add_setting('galanight_display_background_pattern', array(
        'default'        => galanight_default_options('galanight_display_background_pattern'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_background_pattern_control', array(
        'label'      => __('Background Pattern', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_display_background_pattern',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  =================================
    //  = Background Pattern Opacity    =
    //  =================================
    $wp_customize->add_setting('galanight_background_pattern_opacity', array(
        'default'        => galanight_default_options('galanight_background_pattern_opacity'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_background_pattern_opacity_control', array(
        'label'      => __('Background Pattern Opacity', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_background_pattern_opacity',
        'type'       => 'radio',
        'choices'    => array(
            'Default' => __( 'Default' , 'galanight' ),
            '100' => '100',
            '90' => '90',
            '80' => '80',
            '70' => '70',
            '60' => '60',
            '50' => '50',
            '40' => '40',
            '30' => '30',
            '20' => '20',
            '10' => '10',
        ),
    ));
    
    //  ==================================
    //  = Display Sidebar on Posts/Pages =
    //  ==================================
    $wp_customize->add_setting('galanight_display_sidebar', array(
        'default'        => galanight_default_options('galanight_display_sidebar'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_sidebar_control', array(
        'label'      => __('Display Sidebar on Posts/Pages', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_display_sidebar',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==================================
    //  = Display Sidebar on Archives    =
    //  ==================================
    $wp_customize->add_setting('galanight_display_sidebar_archives', array(
        'default'        => galanight_default_options('galanight_display_sidebar_archives'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_sidebar_archives_control', array(
        'label'      => __('Display Sidebar on Archives', 'galanight'),
        'section'    => 'galanight_general_settings',
        'settings'   => 'galanight_display_sidebar_archives',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==================================
    //  = Header Layout                  =
    //  ==================================
    $wp_customize->add_setting('galanight_header_layout', array(
        'default'        => galanight_default_options('galanight_header_layout'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_layout_control', array(
        'label'      => __('Header Layout', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_layout',
        'type'       => 'radio',
        'choices'    => array(
            'Wide' => __( 'Wide' , 'galanight' ),
            'Centered' => __( 'Centered' , 'galanight' ),
        ),
    ));
    
    //  ==================================
    //  = Display Header Image           =
    //  ==================================
    $wp_customize->add_setting('galanight_display_header_image', array(
        'default'        => galanight_default_options('galanight_display_header_image'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_header_image_control', array(
        'label'      => __('Display Header Image', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_display_header_image',
        'type'       => 'radio',
        'choices'    => array(
            'Everywhere' => __( 'Everywhere' , 'galanight' ),
            'Only on Homepage' => __( 'Only on Homepage' , 'galanight' ),
            'Everywhere except Homepage' => __( 'Everywhere except Homepage' , 'galanight' ),
        ),
    ));
    
    //  =================================
    //  = Title Box/Logo width          =
    //  =================================
    $wp_customize->add_setting('galanight_page_title_width', array(
        'default'        => galanight_default_options('galanight_page_title_width'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_page_title_width_control', array(
        'label'      => __('Title Box/Logo width (in Wide Header Layout)', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_page_title_width',
        'type'       => 'radio',
        'choices'    => array(
            '100' => '100%',
            '90' => '90%',
            '80' => '80%',
            '70' => '70%',
            '60' => '60%',
            '50' => '50%',
            '40' => '40%',
            '30' => '30%',
            '20' => '20%',
            '10' => '10%',
            '0' => '0%',
        ),
    ));
    
    //  =================================
    //  = Menu Box width                =
    //  =================================
    $wp_customize->add_setting('galanight_header_menu_width', array(
        'default'        => galanight_default_options('galanight_header_menu_width'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_menu_width_control', array(
        'label'      => __('Menu Box width (in Wide Header Layout)', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_menu_width',
        'type'       => 'radio',
        'choices'    => array(
            '100' => '100%',
            '90' => '90%',
            '80' => '80%',
            '70' => '70%',
            '60' => '60%',
            '50' => '50%',
            '40' => '40%',
            '30' => '30%',
            '20' => '20%',
            '10' => '10%',
            '0' => '0%',
        ),
    ));
    
    //  =============================
    //  = Header Logo               =
    //  =============================
    $wp_customize->add_setting('galanight_logo_url', array(
        'default'        => galanight_default_options('galanight_logo_url'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_uri',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'galanight_logo_url_control', array(
        'label'    => __('Header Logo', 'galanight'),
        'section'  => 'galanight_header_settings',
        'settings' => 'galanight_logo_url',
    )));
    
    //  =============================
    //  = Postal Address            =
    //  =============================
    $wp_customize->add_setting('galanight_header_address', array(
        'default'        => galanight_default_options('galanight_header_address'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_address_control', array(
        'label'      => __('Postal Address', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_address',
    ));
    
    //  =============================
    //  = Email Address             =
    //  =============================
    $wp_customize->add_setting('galanight_header_email', array(
        'default'        => galanight_default_options('galanight_header_email'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_email_control', array(
        'label'      => __('Email Address', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_email',
    ));
    
    //  =============================
    //  = Phone Number              =
    //  =============================
    $wp_customize->add_setting('galanight_header_phone', array(
        'default'        => galanight_default_options('galanight_header_phone'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_phone_control', array(
        'label'      => __('Phone Number', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_phone',
    ));
    
    //  =============================
    //  = Skype Name                =
    //  =============================
    $wp_customize->add_setting('galanight_header_skype', array(
        'default'        => galanight_default_options('galanight_header_skype'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_skype_control', array(
        'label'      => __('Skype Name', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_skype',
    ));
    
    //  =============================
    //  = Header Image Headline     =
    //  =============================
    $wp_customize->add_setting('galanight_header_image_headline', array(
        'default'        => galanight_default_options('galanight_header_image_headline'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_image_headline_control', array(
        'label'      => __('Homepage Header Image Headline', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_image_headline',
    ));
    
    //  =============================
    //  = Header Image Link URL     =
    //  =============================
    $wp_customize->add_setting('galanight_header_image_link_url', array(
        'default'        => galanight_default_options('galanight_header_image_link_url'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_uri',
    ));
 
    $wp_customize->add_control('galanight_header_image_link_url_control', array(
        'label'      => __('Homepage Header Image Link URL', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_image_link_url',
    ));
    
    //  =============================
    //  = Header Image Link Text    =
    //  =============================
    $wp_customize->add_setting('galanight_header_image_link_text', array(
        'default'        => galanight_default_options('galanight_header_image_link_text'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_header_image_link_text_control', array(
        'label'      => __('Homepage Header Image Link Text', 'galanight'),
        'section'    => 'galanight_header_settings',
        'settings'   => 'galanight_header_image_link_text',
    ));
    
    //  ==========================================
    //  = Display Featured Image on single posts =
    //  ==========================================
    $wp_customize->add_setting('galanight_display_image_post', array(
        'default'        => galanight_default_options('galanight_display_image_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_image_post_control', array(
        'label'      => __('Display Featured Image on single posts', 'galanight'),
        'section'    => 'galanight_posts_settings',
        'settings'   => 'galanight_display_image_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on single posts =
    //  ====================================
    $wp_customize->add_setting('galanight_display_meta_post', array(
        'default'        => galanight_default_options('galanight_display_meta_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_meta_post_control', array(
        'label'      => __('Display Meta Box on single posts', 'galanight'),
        'section'    => 'galanight_posts_settings',
        'settings'   => 'galanight_display_meta_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  =================================
    //  = Next/Previous Post Navigation =
    //  =================================
    $wp_customize->add_setting('galanight_next_preview_post', array(
        'default'        => galanight_default_options('galanight_next_preview_post'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_next_preview_post_control', array(
        'label'      => __('Display Next/Previous Post Navigation on single posts', 'galanight'),
        'section'    => 'galanight_posts_settings',
        'settings'   => 'galanight_next_preview_post',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==========================================
    //  = Display Featured Image on pages        =
    //  ==========================================
    $wp_customize->add_setting('galanight_display_image_page', array(
        'default'        => galanight_default_options('galanight_display_image_page'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_image_page_control', array(
        'label'      => __('Display Featured Image on pages', 'galanight'),
        'section'    => 'galanight_posts_settings',
        'settings'   => 'galanight_display_image_page',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==================================
    //  = Infinite Scroll                =
    //  ==================================
    $wp_customize->add_setting('galanight_infinite_scroll', array(
        'default'        => galanight_default_options('galanight_infinite_scroll'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_infinite_scroll_control', array(
        'label'      => __('Infinite Scroll', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_infinite_scroll',
        'type'       => 'radio',
        'choices'    => array(
            'Enable' => __( 'Enable' , 'galanight' ),
            'Disable' => __( 'Disable' , 'galanight' ),
        ),
    ));
    
    //  ====================================
    //  = Display Meta Box on Post Entries =
    //  ====================================
    $wp_customize->add_setting('galanight_display_meta_post_entry', array(
        'default'        => galanight_default_options('galanight_display_meta_post_entry'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_meta_post_entry_control', array(
        'label'      => __('Display Meta Box on Post Entries', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_display_meta_post_entry',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ====================================
    //  = Featured Images Size             =
    //  ====================================
    $wp_customize->add_setting('galanight_featured_image_size', array(
        'default'        => galanight_default_options('galanight_featured_image_size'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_featured_image_size_control', array(
        'label'      => __('Featured Images Size', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_featured_image_size',
        'type'       => 'radio',
        'choices'    => array(
            'Small' => __( 'Small' , 'galanight' ),
            'Large' => __( 'Large' , 'galanight' ),
        ),
    ));
    
    //  ===============================
    //  = Content/Excerpt Displaying  =
    //  ===============================
    $wp_customize->add_setting('galanight_content_archives', array(
        'default'        => galanight_default_options('galanight_content_archives'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_content_archives_control', array(
        'label'      => __('Content/Excerpt Displaying', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_content_archives',
        'type'       => 'radio',
        'choices'    => array(
            'Excerpt' => __( 'Excerpt' , 'galanight' ),
            'Content' => __( 'Content' , 'galanight' ),
        ),
    ));
    
    //  =============================
    //  = Excerpt Length            =
    //  =============================
    $wp_customize->add_setting('galanight_excerpt_length', array(
        'default'        => galanight_default_options('galanight_excerpt_length'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_excerpt_length_control', array(
        'label'      => __('Excerpt Length (number of words)', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_excerpt_length',
    ));
    
    //  ====================================
    //  = Display Site Description         =
    //  ====================================
    $wp_customize->add_setting('galanight_display_site_description', array(
        'default'        => galanight_default_options('galanight_display_site_description'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_display_site_description_control', array(
        'label'      => __('Display Site Description on Latest Posts (Blog) page', 'galanight'),
        'section'    => 'galanight_post_entries_settings',
        'settings'   => 'galanight_display_site_description',
        'type'       => 'radio',
        'choices'    => array(
            'Display' => __( 'Display' , 'galanight' ),
            'Hide' => __( 'Hide' , 'galanight' ),
        ),
    ));
    
    //  ==============================
    //  = Character Set              =
    //  ==============================
    $wp_customize->add_setting('galanight_character_set', array(
        'default'        => 'latin',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
    ));
 
    $wp_customize->add_control('galanight_character_set_control', array(
        'label'      => __('Character Set', 'galanight'),
        'section'    => 'galanight_font_settings',
        'settings'   => 'galanight_character_set',
        'type'       => 'radio',
        'choices'    => array(
            'latin' => __( 'Latin' , 'galanight' ),
            'latin-ext' => __( 'Latin Extended' , 'galanight' ),
            'cyrillic' => __( 'Cyrillic' , 'galanight' ),
            'cyrillic-ext' => __( 'Cyrillic Extended' , 'galanight' ),
            'greek' => __( 'Greek' , 'galanight' ),
            'greek-ext' => __( 'Greek Extended' , 'galanight' ),
            'vietnamese' => __( 'Vietnamese' , 'galanight' ),
        ),
    ));
    
    //  =============================
    //  = Body font                 =
    //  =============================
     $wp_customize->add_setting('galanight_body_google_fonts', array(
        'default'        => galanight_default_options('galanight_body_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_body_google_fonts_control', array(
        'settings' => 'galanight_body_google_fonts',
        'label'   => __('Body font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  =============================
    //  = Site Title font           =
    //  =============================
     $wp_customize->add_setting('galanight_headings_google_fonts', array(
        'default'        => galanight_default_options('galanight_headings_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_headings_google_fonts_control', array(
        'settings' => 'galanight_headings_google_fonts',
        'label'   => __('Site Title font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  =============================
    //  = Page/Post Headlines font  =
    //  =============================
     $wp_customize->add_setting('galanight_headline_google_fonts', array(
        'default'        => galanight_default_options('galanight_headline_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_headline_google_fonts_control', array(
        'settings' => 'galanight_headline_google_fonts',
        'label'   => __('Page/Post Headlines (h1 - h6) font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  =============================
    //  = Post Entry Headline font  =
    //  =============================
     $wp_customize->add_setting('galanight_postentry_google_fonts', array(
        'default'        => galanight_default_options('galanight_postentry_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_postentry_google_fonts_control', array(
        'settings' => 'galanight_postentry_google_fonts',
        'label'   => __('Post Entry Headline font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  ========================================
    //  = Sidebar/Footer Widget Headlines font =
    //  ========================================
     $wp_customize->add_setting('galanight_sidebar_google_fonts', array(
        'default'        => galanight_default_options('galanight_sidebar_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_sidebar_google_fonts_control', array(
        'settings' => 'galanight_sidebar_google_fonts',
        'label'   => __('Sidebar/Footer Widget Headlines font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  =============================
    //  = Main Header Menu font     =
    //  =============================
     $wp_customize->add_setting('galanight_menu_google_fonts', array(
        'default'        => galanight_default_options('galanight_menu_google_fonts'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'galanight_sanitize_text',
 
    ));
    $wp_customize->add_control( 'galanight_menu_google_fonts_control', array(
        'settings' => 'galanight_menu_google_fonts',
        'label'   => __('Main Header Menu font', 'galanight'),
        'section' => 'galanight_font_settings',
        'type'    => 'select',
        'choices'    => $galanight_fonts,
    ));
    
    //  =============================
    //  = Custom CSS                =
    //  =============================
    $wp_customize->add_setting('galanight_own_css', array(
        'default'        => galanight_default_options('galanight_own_css'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));
 
    $wp_customize->add_control( new galanight_customize_textarea_control($wp_customize, 'galanight_own_css_control', array(
        'label'    => __('Custom CSS', 'galanight'),
        'section'  => 'galanight_general_settings',
        'settings' => 'galanight_own_css',
    )));
}

add_action('customize_register', 'galanight_customize_register');

/**
 * Sanitize URIs
*/
function galanight_sanitize_uri($uri) {
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);
}

/**
 * Sanitize Texts
*/
function galanight_sanitize_text($str) {
	if('' === $str){
		return '';
	}
	return sanitize_text_field( $str);
} ?>