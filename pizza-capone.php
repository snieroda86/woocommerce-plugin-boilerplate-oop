<?php
/**
 * Plugin Name:       Pizza capone
 * Plugin URI:        https://www.web4you.biz.pl
 * Description:       Rozszerzenie do woocommerce umożliwiające sprzedaz pizzy 
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Sebastian Nieroda
 * Author URI:        https://www.web4you.biz.pl
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pizza-capone
 * Domain Path:       /languages
 */

if(!defined('ABSPATH')){
	exit;
}

if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    exit;
}

if(!defined('PIZZA_CAPONE_PATH'))
{
    define('PIZZA_CAPONE_PATH' , plugin_dir_path(__FILE__));
}
if(!defined('PIZZA_CAPONE_DIR'))
{
    define('PIZZA_CAPONE_DIR' , __FILE__);
}
if(!defined('PIZZA_CAPONE_URL'))
{
    define('PIZZA_CAPONE_URL' , plugin_dir_url(__FILE__));
}

class Pizza_Capone_Install{

    protected static $instance=null;

    public static function getInstance(){
        if(  is_null(self::$instance)   ){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct(){
        $this->includes();
    }

    private function includes(){
        require_once PIZZA_CAPONE_PATH.'includes/pizza-capone.php';
        Pizza_Capone::getInstance();
    }

}

function init_pizza_capone_plugin(){
    Pizza_Capone_Install::getInstance();
}

add_action('plugins_loaded' , 'init_pizza_capone_plugin');