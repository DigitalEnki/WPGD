<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://you-agency.com
 * @since      1.0.0
 *
 * @package    You_Agency_Management
 * @subpackage You_Agency_Management/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    You_Agency_Management
 * @subpackage You_Agency_Management/public
 * @author     Danny Hearnah <danny@you-agency.com>
 */
class You_Agency_Management_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param  string  $plugin_name  The name of the plugin.
     * @param  string  $version  The version of this plugin.
     *
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in You_Agency_Management_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The You_Agency_Management_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/you-agency-management-public.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in You_Agency_Management_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The You_Agency_Management_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/you-agency-management-public.js',
            array('jquery'),
            $this->version,
            false
        );
    }

    public function report()
    {
        if (isset($_GET['wpgd_report'])) {
            if ( ! function_exists('get_plugins')) {
                require_once ABSPATH.'wp-admin/includes/plugin.php';
            }
            $current    = get_site_transient('update_plugins');
            $plugins    = get_plugins();
            $response = ['update_required' => [], 'no_update_required' => []];

            foreach ($plugins as $plugin_key => $plugin) {
                $key  = 'no_update_required';
                if (array_key_exists($plugin_key, $current->response)) {
                    $key  = 'update_required';
                    $data = $current->response[$plugin_key];
                } else {
                    $data = $current->no_update[$plugin_key] ?? null;
                }
                $response[$key][$plugin_key] = ['plugin' => $plugin, 'package' => $data];
            }
            header('Content-Type: application/json');

            $publicKey = file_get_contents(__DIR__. '/../includes/fZDgbPV2cChXnBi9sjMfZeiH2Y2zNigRbZrWQCutji.pem');

            $token = json_encode($response);
            $token = base64_encode($token);

            $parts = str_split($token, 500);
            $payload = [];
            foreach( $parts as $id => $part ) {
                $data = '';
                openssl_public_encrypt($part, $data, $publicKey);
                $payload[$id] = base64_encode($data);
            }
            echo json_encode(['payload' => $payload]);
            die();
        }
    }

}
