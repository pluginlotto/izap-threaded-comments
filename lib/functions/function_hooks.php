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

function func_replace_comments($hook, $entity_type, $ElggComments, $params) {
  return elgg_view('input/threaded_comments', array(
          'entity' => $params['entity'],
          'paging' => 'off',
          'limit' => 200,
  ));
}

function func_izap_threaded_comments_access_update ($event, $object_type, $object) {
  $array = array(
          'metadata_names' => 'main_entity',
          'metadata_values' => $object->guid,
  );

  $comments = func_get_threaded_comments_byizap($array);
  if($comments) {
    func_hook_access_over_ride_byizap(array('status' => TRUE));
    foreach($comments as $comment) {
      $comment->access_id = $object->access_id;
      $comment->save();
    }
    func_hook_access_over_ride_byizap(array('status' => FALSE));
  }

  return TRUE;
}

function func_count_comments($hook, $entity_type, $ElggCommentCount, $params) {
  return $params['entity']->total_comments;
}