<?php
use Databox\Client;
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       urbanmedia.co.uk
 * @since      1.0.0
 *
 * @package    NLSDatabox
 * @subpackage NLSDatabox/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    NLSDatabox
 * @subpackage NLSDatabox/includes
 * @author     Urban Media <roy@urbanmedia.co.uk>
 */
class NLSDatabox {

	/**
	 * Client and Client Token from Databox
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $clientToken    Auth token used by Databox.
     * @var      object    $client         Client resource consumed by Databox
	 */
	private $clientToken, $client;

    public $version, $plugin_name;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'nls-databox';

		$this->load_dependencies();
		//$this->define_admin_hooks();
		//$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Sets up Composer and gets Client
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	 private function load_dependencies() {
         return $this->getClient($this->getClientToken());
	 }

    private function getClientToken() {
        $filepath = plugin_dir_path( dirname( __FILE__ ) ) . "token.txt";
        $handle = fopen($filepath, "rb");
        $clientToken = rtrim(fread($handle, filesize($filepath)));
        fclose($handle);

        $this->clientToken = $clientToken;
        return $this->clientToken;
    }

    private function getClient($clientToken) {
        $this->client = new Client($clientToken);
        return $this->client;
    }

    public function testGetClient() {
        return $this->clientToken;
    }

    public function push() {
        return $this->client->push('sales', 123000);
    }

    public function pushAll() {
        return $this->client->insertAll([
            ['sales', 203],
            ['sales', 103, '2018-01-05 14:25:00'],
            ['sales', 305, '2018-01-21 17:30:37']
        ]);
    }

    /**
     * Get the revenue for either a course or a membership
     *
     * @since   1.0.0
     * @access  public
     * @var     string   $type  Either 'course' or 'membership'
     * @var     int      $id    ID of course or membership
     *
     * @return  int     Revenue
     */
    public function getRevenue($type = 'course', $id) {
        return 1000;
    }

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		//$plugin_admin = new NLSDatabox_Admin( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		//$plugin_public = new NLSDatabox_Public( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

}
