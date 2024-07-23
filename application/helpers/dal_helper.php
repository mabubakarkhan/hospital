<?php
if (!function_exists('day_name')) {
	function day_name($index)
	{
		$days = array("","monday","tuesday","wednesday","thursday","friday","saturday","sunday");
		return $days[$index];
	}
}
if (!function_exists('redirect_back')) {
	function redirect_back()
	{
		$CI =& get_instance();
        $referrer = $CI->input->server('HTTP_REFERER');
        header('Location: ' . $referrer);
        exit;
	}
}