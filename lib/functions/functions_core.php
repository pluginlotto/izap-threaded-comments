<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version {version} $Revision: {revision}
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
*/

function func_get_threaded_comments_byizap ($provided) {
  $default = array(
          'type' => 'object',
          'subtype' => 'IzapThreadedComments', //TODO replace this with some global or function
          'limit' => 99999,
  );

  $working_array = func_get_working_array_byizap($default, $provided);

  return elgg_get_entities_from_metadata($working_array);
}