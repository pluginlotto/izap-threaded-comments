<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version 1.0
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
*/
define('GLOBAL_THREADED_COMMENTS_PLUGIN', 'izap-threaded-comments');
define('GLOBAL_THREADED_COMMENTS_PAGEHANDLER', 'threaded_comments');
function izap_threaded_init() {
  func_init_plugin_byizap(array('plugin' => array('name' => GLOBAL_THREADED_COMMENTS_PLUGIN)));
}register_elgg_event_handler('init', 'system', 'izap_threaded_init');