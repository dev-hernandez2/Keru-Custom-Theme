<?php

class Functions
{
    public function __construct()
    {
        //theme set up
        $this->theme_setup();

        //add actions
        $this->add_actions();

    }

    /**
     * Implement the theme setup.
     */
    public function theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Keru Website, use a find and replace
         * to change 'keru-website' to the name of your theme in all the template files.
         */
        load_theme_textdomain('keru-website', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('keru_website_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */

        $GLOBALS['content_width'] = apply_filters('keru_website_content_width', 640);

    }

    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */

    public function register_sidebar()
    {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'keru-website'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'keru-website'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

    }

    public function register_menus()
    {

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'keru-website'),
        ));
    }

    /**
     * Enqueue scripts and styles.
     */
    public function load_scripts()
    {
        wp_enqueue_style('keru-website-style', get_stylesheet_uri());

        wp_enqueue_script('keru-website-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

        wp_enqueue_script('keru-website-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    /**
     * Add Diferent actions.
     */

    public function add_actions()
    {
        //Registr Sidebar
        add_action('widgets_init', array($this, 'register_sidebar'));

        //medu
        add_action('init', array($this, 'register_menus'));

        /**
         * Enqueue scripts and styles.
         */
        add_action('wp_enqueue_scripts', array($this, 'load_scripts'));

    }

}

$function = new Functions();
