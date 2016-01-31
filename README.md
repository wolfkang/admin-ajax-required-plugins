# admin-ajax-required-plugins

The Ajax in WordPress is slower than expected because all the activated plugins are loaded regardless of the action to be executed. This plugin enables that the necessary plugins would be loaded only in the Ajax execution.

# How to use

1. Copy the adamin-ajax-required-plugins.php into the wp-content/mu-plugins directory. If the directory doesn't exist, you shoud make it.
2. Edit the action_map variable as you want to activate the plugins in the Ajax actions. 
