<?php

namespace crud;

use crud\Templates\Templates;

require_once "./vendor/autoload.php";

/**
 * Crud handler class
 *
 * Root of all classes 
 *
 * @author Namzul Alam <nazmul199512@gmail.com>
 *
 * @since 1.0.0
 */
class Main {
    const root = [
        'site_url' => 'http://localhost/crud',
        'title'   => 'CRUD',
        'version' => '1.0.0',
    ];

    function __construct() {
        $this->define_constants();
        $this->init();
        $this->a = 'a';
    }

    /**
     * Defines necessary contants
     *
     * @return void
     */
    public function define_constants() {
        // Root information
        define( 'SITE_URL', self::root['site_url'] );
        define( 'VERSION', self::root['version'] );
        define( 'TITLE', self::root['title'] );
        define( 'PATH', __DIR__ );
        define( 'URL', SITE_URL );

        // Useful information
        define( 'ASSETS_URL', SITE_URL . "/assets" );
        define( 'ASSETS_PATH', PATH . "/assets" );

        define( 'TEMPLATES_PATH', PATH . "/includes/Templates/views/" );
        define( 'TEMPLATES_URL', URL . "/includes/Templates/views/" );
    }

    /**
     * Initializes the included classes
     *
     * @return void
     */
    public function init() {
        $assets    = new Assets();
        $crud      = new Crud();
        $templates = new Templates();

        $this->assets    = $assets;
        $this->crud      = $crud;
        $this->templates = $templates;
    }

    /**
     * Creates instance of the class
     *
     * @return object
     */
    public static function instance() {
        $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}