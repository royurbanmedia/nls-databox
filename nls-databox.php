<?php
/*
  Plugin Name:  NLS-Databox Connector
  Description:  Sends NLS data to Databox
  Version:      1.0.0
  Author:       Urban Media
  Author URI:   https://urbanmedia.co.uk
 */

require 'vendor/autoload.php';
use Databox\Client;
require 'includes/class-nls-databox.php';

add_action('admin_menu', 'nls_databox_admin_menu');

function nls_databox_admin_menu(){
    add_menu_page( 'NLS-Databox Config', 'NLS-Databox Connector', 'manage_options', 'nls-databox', 'admin_panel' );
}

function admin_panel(){
    echo "<h1>Hello World!</h1>";
    $NLSDatabox = new NLSDatabox();
    //$clientToken = $NLSDatabox->testGetClient();
    //var_dump($clientToken);
}

function testPushStats() {
    $NLSDatabox = new NLSDatabox();
    return json_encode("Hello there");
}

function getRevenue(WP_REST_Request $request) {
    $type = $request['type'];
    $id = $request['id'];
    $period = $request['period'];
    $test = array('type' => $type, 'id' => $id, 'period' => $period);

    $NLSDatabox = new NLSDatabox();

    //$ok = $NLSDatabox->push('sales', 123000);

    return json_encode($test);
}

function push(WP_REST_Request $request) {
    $NLSDatabox = new NLSDatabox();
    $response = $NLSDatabox->push();
    return json_encode($response);
}

function pushAll(WP_REST_Request $request) {
    $NLSDatabox = new NLSDatabox();
    $response = $NLSDatabox->pushAll();
    return json_encode($response);
}

function getUsers(WP_REST_Request $request) {
  $NLSDatabox = new NLSDatabox();
  $response = $NLSDatabox->getUsers('all');
  return json_encode($response);
}

/*
 * API access end points
 */
add_action( 'rest_api_init', function () {
    register_rest_route( 'nls-databox/v1', '/getstats', array(
        'methods' => 'GET',
        'callback' => 'testPushStats',
    ) );

    register_rest_route( 'nls-databox/v1', '/getrevenue/(?P<type>(course|membership))/(?P<id>\d+)/(?P<period>(week|mtd))', array(
        'methods' => 'GET',
        'callback' => 'getRevenue',
    ) );

    register_rest_route( 'nls-databox/v1', '/push', array(
        'methods' => 'GET',
        'callback' => 'push',
    ) );

    register_rest_route( 'nls-databox/v1', '/pushAll', array(
        'methods' => 'GET',
        'callback' => 'pushAll',
    ) );

    register_rest_route( 'nls-databox/v1', '/getUsers', array(
        'methods' => 'GET',
        'callback' => 'getUsers',
    ) );
} );
