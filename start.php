<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */


define('GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN','izap-threaded-comments');
define('GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE','IzapThreadedComments');
define('GLOBAL_IZAP_THREADED_COMMENTS_PAGEHANDLER','threadedcomments');

elgg_register_event_handler('init', 'system','func_izap_threaded_comment_init');

function func_izap_threaded_comment_init() {

  izap_plugin_init(GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN);
  register_plugin_hook('comments', 'object', 'func_replace_comments');
  register_plugin_hook('comments:count', 'object', 'func_count_comments');
  elgg_register_event_handler('update', 'object', 'func_izap_threaded_comments_access_update');
  elgg_register_event_handler('delete', 'object', 'func_delete_comments_event');
  elgg_register_page_handler(GLOBAL_IZAP_THREADED_COMMENTS_PAGEHANDLER, GLOBAL_IZAP_PAGEHANDLER);
  
 }

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
    IzapBase::getAllAccess();
    foreach($comments as $comment) {
      $comment->access_id = $object->access_id;
      $comment->save();
    }
    IzapBase::removeAccess();
  }

  return TRUE;
}

function func_count_comments($hook, $entity_type, $ElggCommentCount, $params) {
  return $params['entity']->total_comments;
}

function func_delete_comments_event($event, $object_type, $object) {
  if(!$object->guid || $event != 'delete') {
    return TRUE;
  }

  $array = array(
          'metadata_names' => 'main_entity',
          'metadata_values' => $object->guid,
  );

  $comments = func_get_threaded_comments_byizap($array);
  if($comments) {
    foreach($comments as $comment) {
      $comment->delete(TRUE);
    }
  }
  IzapBase::removeAccess();
  return TRUE;
}

function func_get_threaded_comments_byizap ($provided) {
  $default = array(
          'type' => 'object',
          'subtype' => GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE,
          'limit' => 99999,
  );

  $working_array = array_merge($default, $provided);

  return elgg_get_entities_from_metadata($working_array);
}

function func_update_subtype(){
   if(get_subtype_id('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE)) {
    update_subtype('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE, GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE);
  }else{
    add_subtype('object', GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE, GLOBAL_IZAP_THREADED_COMMENTS_SUBTYPE);
  }
}