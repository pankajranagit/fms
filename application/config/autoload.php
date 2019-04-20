<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'form_validation', 'database', 'encryption', 'Customlib');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'captcha', 'form', 'string');
$autoload['config'] = array();
$autoload['language'] = array('system_lang');
$autoload['model'] = array('Login_user', 'Userlog', 'Hierarchy', 'Project', 'Fund');
