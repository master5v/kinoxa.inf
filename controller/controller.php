<?php
session_start();
defined('ISHOP') or die('Access denied');

require_once MODEL;
require_once FUNCTIONS;//'controller/functions.php'

if (isset($_GET['adic']) || isset($_SESSION['admin'])) {
    $_SESSION['admin'] = "adic";
} else {

    require_once 'controller/vk.php';

    exit();
}


$view = empty($_GET['view']) ? 'index' : $_GET['view'];

switch ($view) {
    case('zagr'):
        if (isset($_GET['xml']) && $_GET['xml'] != '') {
            $file = $_GET['xml'];
        }
        break;

    case('xml'):
        if (isset($_GET[xml]) && $_GET[xml] != '') {
            $file = $_GET[xml];
        }
        break;


    case('status'):
        if (isset($_GET['on'])) $hiden = $_GET['on']; else $hiden = 0;
        $ipurl = getip($hiden);
        break;

    case('serials'):
        $i = $_GET[i];
        $serials = getfilms($i);//serials()
        break;

    case('update'):

        if (isset($_GET[xml]) && $_GET[xml] != '') {
            $file = $_GET[xml];
        }
        $serials = serials();
        break;


    //default :
    //     $view = index;
}


// подключени вида
require_once TEMPLATE . 'index.php';