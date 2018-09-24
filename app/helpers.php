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

if ( ! function_exists('myUrlEncode')){
		function myUrlEncode($string) {
    	$entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    	$replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	    return str_replace($entities, $replacements, $string);
		}
}

if ( !function_exists('randomize_css')){
		function randomize_css($arr_css,$chunk_size) {
				shuffle($arr_css);
				$arr_css = array_splice($arr_css,$chunk_size);
	    return $arr_css;
		}
	
}