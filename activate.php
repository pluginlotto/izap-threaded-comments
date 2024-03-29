<?php

/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

// adds subtype and class to subtype table on plugin activation

if (get_subtype_id('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE)) {
  update_subtype('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE, GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE);
} else {
  add_subtype('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE, GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE);
}