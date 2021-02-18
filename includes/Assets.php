<?php

namespace crud;

class Assets {
    function __construct() {
        $assets = '';

        $assets .= $this->link( $this->css( 'style' ) );
        $assets .= $this->script( $this->js( 'script' ) );
        $this->assets = $assets;
    }

    public function css( $file_name ) {
        return ASSETS_URL . "/css/{$file_name}.css";
    }

    public function js( $file_name ) {
        return ASSETS_URL . "/js/{$file_name}.js";
    }

    public function img_path( $file_name ) {
        return ASSETS_PATH . "/img/{$file_name}";
    }

    public function img_url( $file_name ) {
        return ASSETS_PATH . "/img/{$file_name}";
    }

    public function link( $url ) {
        return "<link rel='stylesheet' href='{$url}'></link>";
    }

    public function script( $url ) {
        return "<script src='{$url}'></script>";
    }

    public function load() {
        echo $this->assets;
    }

}