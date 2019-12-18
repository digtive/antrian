<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/*-- app routes --*/
	$route['settings'] = 'AppController/settings';
	$route['settings/loket'] = 'AppController/loket';
	$route['settings/colours'] = 'AppController/colours';
	$route['settings/texts'] = 'AppController/texts';
	$route['settings/audio'] = 'AppController/audio';
	$route['settings/media'] = 'AppController/media';
	$route['settings/print'] = 'AppController/prints';

	/*-- components --*/
	$route['settings/header'] = 'ComponentController/header';
	$route['settings/footer'] = 'ComponentController/footer';

	$route['default_controller'] = 'AppController';
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;

