<?php 

if ( ! function_exists('esc_sql'))
{
    function esc_sql($string)
    {
        return app('db')->getPdo()->quote($string);
    }
}