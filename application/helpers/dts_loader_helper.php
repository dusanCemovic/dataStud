<?php

/**
 * This helper is used to help template loading
 */

if (!function_exists('load_template_view')) {
    /**
     * just doing echo. Later we can add some check
     * @param $template string which has to be included
     */
    function load_template_view($template = '') {

        if($template !== '') {
            echo $template;
        }
    }
}

if (!function_exists('get_meta_parts')) {
    /**
     * @return array of meta parts
     */
    function get_meta_parts() {
        return array('doctype', 'js', 'css', 'fcss');

    }
}

if (!function_exists('get_header_parts')) {
    /**
     * @param array $arg_modals
     * @return array of header parts
     */
    function get_header_parts($arg_modals) {

        $returing_array = array('menu', 'modallogin');
        if(count($arg_modals) > 0) {
            $returing_array = array_merge($returing_array, $arg_modals);
        }

        return $returing_array;

    }
}

if (!function_exists('get_footer_parts')) {
    /**
     * @return array of footer parts
     */
    function get_footer_parts() {
        return array();

    }
}