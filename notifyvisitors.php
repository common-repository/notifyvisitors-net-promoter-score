<?php
/*
    Plugin Name: NotifyVisitors for Wordpress
    Plugin URI: http://www.notifyvisitors.com
    Description: NotifyVisitors offers marketing automation software that involves email marketing, SMS marketing, WhatsApp, push notifications, popups, and signup forms. Easy-to-use interface with pre-built automations and ready-made email templates, allows you to build and run personalized campaigns without any effort. Our in-depth analytics help you track campaign performance, increase traffic, sales and revenue, and improve website conversion rate. Fast onboarding with our expert support team.
    Version: 1.0
    Author: NotifyVisitors
    Author URI: https://www.notifyvisitors.com
*/

// Version check
global $wp_version;
if(!version_compare($wp_version, '3.0', '>='))
{
    die("NotifyVisitors requires WordPress 3.0 or above. <a href='http://codex.wordpress.org/Upgrading_WordPress'>Please update!</a>");
}
// END - Version check


//this is to avoid getting in trouble because of the
//wordpress bug http://core.trac.wordpress.org/ticket/16953
$notifyvisitors_file = __FILE__; 

if ( isset( $mu_plugin ) ) { 
    $notifyvisitors_file = $mu_plugin; 
} 
if ( isset( $network_plugin ) ) { 
    $notifyvisitors_file = $network_plugin; 
} 
if ( isset( $plugin ) ) { 
    $notifyvisitors_file = $plugin; 
} 

$GLOBALS['notifyvisitors_file'] = $notifyvisitors_file;


// Make sure class does not exist already.
if(!class_exists('NotifyVisitors')) :

    class NotifyVisitorsWidget extends WP_Widget {
        function NotifyVisitorsWidget() {
            parent::WP_Widget(false, 'NotifyVisitors Widget', array('description' => 'Description'));
        }

        function widget($args, $instance) {
            echo '<div id="notifyvisitors_widget"></div>';
        }

        function update( $new_instance, $old_instance ) {
            // Save widget options
            return parent::update($new_instance, $old_instance);
        }

        function form( $instance ) {
            // Output admin widget options form
            return parent::form($instance);
        }
    }

    function notifyvisitors_widget_register_widgets() {
        register_widget('NotifyVisitorsWidget');
    }

    // Declare and define the plugin class.
    class NotifyVisitors
    {
        // will contain id of plugin
        private $plugin_id;
        // will contain option info
        private $options;

        /** function/method
        * Usage: defining the constructor
        * Arg(1): string(alphanumeric, underscore, hyphen)
        * Return: void
        */
        public function __construct($id)
        {
            // set id
            $this->plugin_id = $id;
            // create array of options
            $this->options = array();
            // set default options
            $this->options['secretkey'] = '';           
            $this->options['brandID'] = '';
            $this->options['enable'] = 'on';

            /*
            * Add Hooks
            */
            // register the script files into the footer section
            add_action('wp_footer', array(&$this, 'notifyvisitors_scripts'));
            // initialize the plugin (saving default options)
            register_activation_hook(__FILE__, array(&$this, 'install'));
            // triggered when plugin is initialized (used for updating options)
            add_action('admin_init', array(&$this, 'init'));
            // register the menu under settings
            add_action('admin_menu', array(&$this, 'menu'));
           
        }

        /** function/method
        * Usage: return plugin options
        * Arg(0): null
        * Return: array
        */
        private function get_options()
        {
            // return saved options
            $options = get_option($this->plugin_id);
            return $options;
        }
        /** function/method
        * Usage: update plugin options
        * Arg(0): null
        * Return: void
        */
        private function update_options($options=array())
        {
            // update options
            update_option($this->plugin_id, $options);
        }

        /** function/method
        * Usage: helper for loading notifyvisitors
        * Arg(0): null
        * Return: void
        */
        public function NotifyVisitors_scripts()
        {
            if (!is_admin()) {
                $options = $this->get_options();
                $secretkey = trim($options['secretkey']);
                $brandID = trim($options['brandID']);

                if ($options['enable']) {
                    $this->show_NotifyVisitors_js($brandID,$secretkey);
                }
            }
        }
        
        public function show_NotifyVisitors_js($brandID="",$secretkey="")
        {        	
            $current_user = wp_get_current_user(); //display_name, user_email, ID
			$t = time(); 
			$bid = $brandID; 
            $secretkey = $secretkey; 
            echo '<script>var nv=nv||function(){(window.nv.q=window.nv.q||[]).push(arguments)};nv.l=new Date;var notify_visitors=notify_visitors||function(){var t={initialize:!1,ab_overlay:!1,async:!0,on_load:!1,auth:{bid_e:"'.$secretkey.'",bid:"'.$bid.'",t:"420"}};return t.data={bid_e:t.auth.bid_e,bid:t.auth.bid,t:t.auth.t,iFrame:window!==window.parent,trafficSource:document.referrer,link_referrer:document.referrer,pageUrl:document.location,path:location.pathname,domain:location.origin,gmOffset:60*(new Date).getTimezoneOffset()*-1,screenWidth:screen.width,screenHeight:screen.height,isPwa:window.matchMedia&&window.matchMedia("(display-mode: standalone)").matches?1:0},t.options=function(e){if(t._option={ab_overlay:!1,async:!0,on_load:!1,cookie_domain:null},e&&"object"==typeof e)for(var n in t._option)void 0!==e[n]&&(t[n]=e[n]);else console.log("Not a valid option")},t.tokens=function(e){t.data.tokens=e&&"object"==typeof e?JSON.stringify(e):""},t.ruleData=function(e){t.data.ruleData=e&&"object"==typeof e?JSON.stringify(e):""},t.cookies=function(e){t.data.cookies=e&&(Array.isArray(e)||"all"===e)?e:[]},t.getParams=function(e){var url=window.location.href.toLowerCase(),e=e.replace(/[\[\]]/g,"\\$&").toLowerCase();var t=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(url);return t&&t[2]?decodeURIComponent(t[2].replace(/\+/g," ")):""},t.init=function(){if("complete"!=document.readyState&&t.on_load){if(window.addEventListener)window.addEventListener("load",t._init);else if(window.attachEvent)return window.attachEvent("onload",t._init)}else t._init()},t._init=function(){if(t.auth&&!t.initialize&&(t.data.storage=t.browserStorage(),t.data.cookieData=t.filterCookies(t.data.cookies),t.cookie_domain&&(t.data.cookieDomain=t.cookie_domain),t.js_callback="nv_json1",!t.data.iFrame&&"noapi"!==t.getParams("nvcheck"))){var n="?";if(t.ab_overlay){var o=document.createElement("style"),i="body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}",a=document.getElementsByTagName("head")[0];o.setAttribute("id","_nv_hm_hidden_element"),o.setAttribute("type","text/css"),o.styleSheet?o.styleSheet.cssText=i:o.appendChild(document.createTextNode(i)),a.appendChild(o),setTimeout(function(){var t=this.document.getElementById("_nv_hm_hidden_element");if(t)try{t.parentNode.removeChild(e)}catch(e){t.remove()}},2e3)}for(var r in t.data)t.data.hasOwnProperty(r)&&(n+=encodeURIComponent(r)+"="+encodeURIComponent(t.data[r])+"&");t.load("https://www.notifyvisitors.com/ext/v1/settings"+n),t.initialize=!0}},t.browserStorage=function(){var e={session:t.storage("sessionStorage"),local:t.storage("localStorage")};return JSON.stringify(e)},t.storage=function(e){var t={};return window[e]&&window[e].length>0&&Object.keys(window[e]).forEach(function(n){-1!==n.indexOf("_nv_")&&(t[n]=window[e][n])}),t},t.filterCookies=function(e){e=e||[];var t=[];if(document&&document.cookie){var n=document.cookie.split(";");"all"===e&&(t=n),Array.isArray(e)&&n&&n.length>0&&(t=n.filter(function(t){var n=t.trim().split("=")[0];return-1!==e.indexOf(n)||0===n.indexOf("_nv_")}))}return t.join(";")},t.load=function(e){var n=document,o=n.createElement("script");o.type="text/javascript",o.async=t.async,o.src=e,n.body?n.body.appendChild(o):n.head.appendChild(o)},t}();    notify_visitors.options({      ab_overlay: false,    on_load: false   });notify_visitors.init();</script>';
        }

        /** function/method
        * Usage: helper for hooking activation (creating the option fields)
        * Arg(0): null
        * Return: void
        */
        public function install()
        {
            $this->update_options($this->options);
        }
        
        /** function/method
        * Usage: helper for hooking (registering) options
        * Arg(0): null
        * Return: void
        */
        public function init()
        {
            register_setting($this->plugin_id.'_options', $this->plugin_id);
        }
                
        /** function/method
        * Usage: show options/settings form page
        * Arg(0): null
        * Return: void
        */
        public function options_page()
        {
            if (!current_user_can('manage_options'))
            {
                wp_die( __('You can manage options from the Settings->NotifyVisitors Options menu.') );
            }

            // get saved options
            $options = $this->get_options();
            $updated = false;

            if (!isset($options['enable'])) {
                $options['enable'] = 1;
                $updated = true;
            }

            if ($updated) {
                $this->update_options($options);
            }
            include('notifyvisitors_options_form.php');
        }
        /** function/method
        * Usage: helper for hooking (registering) the plugin menu under settings
        * Arg(0): null
        * Return: void
        */
        public function menu()
        {
            add_options_page('NotifyVisitors Options', 'NotifyVisitors', 'manage_options', $this->plugin_id.'-plugin', array(&$this, 'options_page'));
        }
    }

    // Instantiate the plugin
    $NotifyVisitors = new NotifyVisitors('notifyvisitors');

// END - class exists
endif;
?>
