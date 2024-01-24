<?php
/**
 * Main Real Estate Management class
 */
class REM {

    /**
     * REM class constructor
     */
    function __construct() {
        $this->init();
    }

    /**
     * REM class initialization
     */
    private function init() {
        add_action( 'wp_enqueue_scripts', ['REM', 'load_scripts'] );
        add_action( 'init', ['REM', 'real_estate_init'] );
        add_action( 'init', ['REM', 'rem_area_taxonomy_init'] );
        add_action( 'widgets_init', ['REM', 'widgets_init'] );
        add_action( 'widgets_init', ['REM', 'register_widgets'] );
        add_shortcode('rem-filter', ['REM', 'rem_filter_shortcode']);
        add_action( 'wp_ajax_set_rem_filter', ['REM', 'set_rem_filter__ajax_callback'] );
        add_action( 'wp_ajax_nopriv_set_rem_filter', ['REM', 'set_rem_filter__ajax_callback'] );
    }

    public static function load_scripts() {
        wp_enqueue_style("rem_style", REM_ASSETS_URL . "/css/style.css", array(), true);
        wp_enqueue_script( 'jquery_script', REM_ASSETS_URL . "/js/jquery-3.7.0.min.js", null, time(), true);
        wp_enqueue_script( 'rem_script', REM_ASSETS_URL . "/js/rem.js", null, time(), true);
    }

    /**
     * Register a custom post type called "real_estate".
     *
     * @see get_post_type_labels() for label keys.
     */
    public static function real_estate_init() {
        $labels = array(
            'name'                  => 'Управление недвижимостью',
            'singular_name'         => 'Объект недвижимости',
            'menu_name'             => 'Недвижимость',
            'name_admin_bar'        => 'Недвижимость',
            'add_new'               => 'Добавить объект',
            'add_new_item'          => 'Добавить объект',
            'new_item'              => 'Создать',
            'edit_item'             => 'Редактировать',
            'view_item'             => 'Просмотр',
            'all_items'             => 'Все объекты',
            'search_items'          => 'Поиск объекта',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_icon'          => 'dashicons-admin-multisite',
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'real_estate', $args );
    }

    /**
     * Register custom taxonomy "rem_area"
     */
    public static function rem_area_taxonomy_init() {
        $labels = [
            'singular_name'      => 'Район',
            'all_items'          => 'Все районы',
            'edit_item'          => 'Редактировать',
            'view_item'          => 'Просмотр',
            'update_item'        => 'Обновить район',
            'add_new_item'       => 'Добавить район',
            'new_item_name'      => 'Новый район',
            'search_items'       => 'Поиск района',
            'popular_items'      => 'Популярные районы',
            'not_found'          => 'Район не найден',
        ];

        $args = [
            'label' => 'Районы',
            'hierarchical' => false,
            'rewrite' => ['slug' => 'rem-area'],
            'show_admin_column' => true,
            'show_in_rest' => true,
            'labels' => $labels
        ];

        register_taxonomy('rem_area', ['REM', 'rem_area_taxonomy_init'], $args);
        register_taxonomy_for_object_type('rem_area', 'real_estate');
    }

    public static function register_widgets() {
        register_widget( 'REM_Widget' );
    }

    public static function rem_filter_shortcode() {
        ob_start();
        REMFilter::render($_REQUEST);
        $cnt = ob_get_contents();
        ob_end_clean();
        return $cnt;
    }

    public static function widgets_init() {
        register_sidebar( array(
            'name'          => 'Home right sidebar',
            'id'            => 'home_right_1',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="rounded">',
            'after_title'   => '</h2>',
        ) );
    }

    public static function set_rem_filter__ajax_callback() {
        REMFilter::renderAjax($_GET);
        exit;
    }

}