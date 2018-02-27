<?php
/*
  Plugin Name:  NLS-Databox Connector
  Description:  Sends NLS data to Databox
  Version:      1.0.0
  Author:       Roy - Urban Media
  Author URI:   https://urbanmedia.co.uk
 */

 /*
 * This plugin requires a token.txt file in the root directory containing only
 * your Database token and nothing more.
 */

require 'vendor/autoload.php';
use Databox\Client;

$clientToken = file_get_contents("token.txt");

echo $clientToken;
