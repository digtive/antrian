<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/*-- app routes --*/
	$route['settings'] = 'AppController/settings';
	$route['settings/colours'] = 'AppController/colours';
	$route['settings/texts'] = 'AppController/texts';
	$route['settings/audio'] = 'AppController/audio';
	$route['settings/media'] = 'AppController/media';
	$route['settings/print'] = 'AppController/prints';

	$route['default_controller'] = 'AppController';
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;

