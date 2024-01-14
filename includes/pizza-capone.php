<?php 

class Pizza_Capone{

	protected static $instance=null;

    public static function getInstance(){
        if(  is_null(self::$instance)   ){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct(){

        
        // Custom tab in woocomerce settings section
        add_filter('woocommerce_settings_tabs_array' , array($this , 'custom_woocommerce_settings_tab' ) , 50 );
        add_action('woocommerce_settings_tabs_pizza_capone', array($this , 'custom_woocommerce_settings_content'));
        add_action('woocommerce_update_options_pizza_capone', array( $this , 'save_custom_woocommerce_settings' ) );

    }

    // Add a custom tab to the WooCommerce settings
	public function custom_woocommerce_settings_tab($settings_tabs) {

	    $settings_tabs['pizza_capone'] = 'Pizza Capone';
	    return $settings_tabs;
	}

	public function custom_woocommerce_settings_content(){
		require_once PIZZA_CAPONE_PATH.'templates/admin/pizza-capone-settings.php';
	}

	public function save_custom_woocommerce_settings() {
	    
	    if (!isset($_POST['pizza_capone_nonce']) || !wp_verify_nonce($_POST['pizza_capone_nonce'], 'pizza_capone_nonce')) {
            return;
        }

        update_option('pizza_capone_data' , $_POST['pizza_capone_data']);
	}
}

