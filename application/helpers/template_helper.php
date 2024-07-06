<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function load_view($page, $data = false, $jsFile = false, $header = false, $footer = false) {
    // Get CodeIgniter instance
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->database();
    if ($CI->session->has_userdata('user')) {
        $q = $CI->session->userdata('user');
        $q = unserialize($q);
        $data['permissions'] = $q['permissions'];
    }
    //loading header
    if ($header) {
        $CI->load->view($header, $data);
    }
    else{
        $CI->load->view('home/header', $data);
        $CI->load->view('home/sideBar', $data);
    }
    //loading main view file
    $CI->load->view($page, $data);
    //loading footer
    if ($footer) {
        $CI->load->view($footer, $data);
    }
    else{
        $CI->load->view('home/footer', $data);
    }
    //loading js file
    if ($jsFile !== false && $jsFile !== true) {
        $CI->load->view('script/'.$jsFile, $data);
    }
    elseif ($jsFile == true) {
        $CI->load->view('script/'.$page, $data);
    }
}
function load_file($page) {
    // Get CodeIgniter instance
    $CI =& get_instance();
    
    //loading header
    if ($header) {
        $CI->load->view($header, $data);    
    }
    else{
        $CI->load->view('home/header', $data);
    }
    //loading main view file
    $CI->load->view($page, $data);
    //loading footer
    if ($footer) {
        $CI->load->view($footer, $data);
    }
    else{
        $CI->load->view('home/footer', $data);
    }
    //loading js file
    if ($jsFile) {
        $CI->load->view('script/'.$page, $data);
    }
}