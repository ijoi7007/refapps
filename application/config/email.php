<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/

/*$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
*/

$config['protocol'] = 'smtp';
//$config['apikey'] = '5f80bcdb-4cd7-4cb9-b2a9-222e5a2fa913';
//$config['smtp_url'] = 'https://api.elasticemail.com/v2/email/send';
$config['smtp_host'] = 'smtp.elasticemail.com'; //change this
$config['smtp_port'] = '2525';
$config['smtp_user'] = 'ijoi7007@gmail.com'; //change this
$config['smtp_pass'] = '5f80bcdb-4cd7-4cb9-b2a9-222e5a2fa913'; //change this
$config['mailtype'] = 'html';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard

/* End of file email.php */
/* Location: ./application/config/email.php */