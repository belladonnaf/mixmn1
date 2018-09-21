<?php 

if ( ! function_exists('esc_sql'))
{
    function esc_sql($string)
    {
        return app('db')->getPdo()->quote($string);
    }
}

if ( ! function_exists('get_css'))
{
		function get_css($asset_css) {
        echo "<link rel=\"stylesheet\" href=\"$asset_css\">\n";
    }
}

if ( ! function_exists('get_js'))
{
    function get_js($asset_js) {
        echo "<script src=\"$asset_js\"></script>\n";
    }
}
