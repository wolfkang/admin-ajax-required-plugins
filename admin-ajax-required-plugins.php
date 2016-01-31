<?php
class Admin_Ajax_Required_Plugins
{
    private $action_map; 
    
    function __construct()
    {
        if (is_admin() && defined('DOING_AJAX') && DOING_AJAX === TRUE && isset($_REQUEST['action'])) {
            /*
             * Edit like this.
             * 'action_name' => 'plugin_slug' or 'action_name' => array('plugin1_slug', 'plugin2_slug')
             */
            $this->action_map = array(
                'dbmembers_action' => 'danbi-members',
                'dbmembers_action2' => array('wp-members', 'danbi-members')
            );
            if (isset($this->action_map[$_REQUEST['action']])) {
                add_action('muplugins_loaded', array($this, 'muplugins_loaded'));
            }
        }
    }
    
    function muplugins_loaded()
    {
        add_filter('option_active_plugins', array($this, 'option_active_plugins'), 10, 2);
    }
    
    function option_active_plugins($values, $option = null)
    {
        $plugins = $this->action_map[$_REQUEST['action']];
        if (is_string($plugins))
            $plugins = array($plugins);
        $new_values = array();
        foreach ($values as $value) {
            foreach ($plugins as $plugin) {
                if (!empty($plugin) && $this->starts_with($value, $plugin . '/'))
                    $new_values[] = $value;
            }
        }
        return $new_values;
    }
    
    function starts_with($haystack, $needle)
    {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
}

new Admin_Ajax_Required_Plugins;
