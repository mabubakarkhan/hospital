<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_permissions($land) {
    $user = unserialize($_SESSION['user']);
    if ($user['permissions'] == 'all' || in_array($land, $user['permissions'])) {
    	return true;
    }
    else{
        die('else');
    	redirect('logout');
    }
}