<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*-- auth --*/
$route['login'] = 'AuthController/login';

/*-- components --*/
$route['settings/header'] = 'ComponentController/header';
$route['settings/footer'] = 'ComponentController/footer';
$route['settings/loket'] = 'ComponentController/loket';
$route['settings/parent'] = 'ComponentController/parent';

/*-- app routes --*/
$route['settings'] = 'AppController/settings';
$route['settings/colours'] = 'AppController/colours';
$route['settings/texts'] = 'AppController/texts';
$route['settings/audio'] = 'AppController/audio';
$route['settings/media'] = 'AppController/media';
$route['settings/print'] = 'AppController/prints';
$route['api/queue/antrian'] = 'ApiController/antrian';
$route['api/queue/call'] = 'ApiController/call';
$route['api/queue/recall'] = 'ApiController/recall';
$route['api/queue/layanan'] = 'ApiController/layanan';
$route['default_controller'] = 'AppController';
$route['mainpage'] = 'ResolutionController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

