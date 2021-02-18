<?php

namespace crud\Templates;

/**
 * Manage template functions and view
 *
 *
 * @author Nazmul Alam <nazmul199512@gmail.com>
 *
 * @since 1.0.0
 */
class Templates {
    function __construct() {

    }

    public function view( $template ) {
        return include __DIR__ . "./views/{$template}.php";
    }

    public function echo_view( $template ) {
        ob_start();
        $this->view( $template );
        echo ob_get_clean();
    }
}