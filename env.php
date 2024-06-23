<?php
defined('env') or exit('Akses langsung ke Skrip ini diblokir');

$setDb['db_host'] = '127.0.0.1';
$setDb['db_name'] = 'webgis_pangan';
$setDb['db_user'] = 'root';
$setDb['db_password'] = '';

// folder templates
$template = 'templates/AdminLTE-2.4.17/';

//session
$setSession['prefix'] = 'webgis_pangan';

//URI
$setUri['base'] = 'http://127.0.0.1/webGIS-APP/My-Project-SIG/WebGIS-pangan/';
$setUri['assets'] = 'assets/';