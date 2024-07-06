<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_login() {
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->database();

    if ($CI->session->has_userdata('user')) {
        $q = $CI->session->userdata('user');
        $q = unserialize($q);
        $resp = $CI->db
        ->where('user_id',$q['user_id'])
        ->get('user')
        ->row_array();
        if ($resp['type_zero'] != '1') {
            $permissions = $CI->db
            ->select('permissions')
            ->where('role_id',$resp['role_id'])
            ->get('role')
            ->row()
            ->permissions;
            $resp['permissions'] = explode(',', $permissions);
        }
        else{
            $resp['permissions'] = 'all';
        }
        $_SESSION['user'] = serialize($resp);
        return $resp;
    }
    else {
        redirect('login');exit;
    }
}