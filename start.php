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
if (elgg_is_active_plugin(GLOBAL_IZAP_ELGG_BRIDGE))
elgg_register_event_handler('init', 'system','func_izap_threaded_comment_init');

function func_izap_threaded_comment_init() {

  izap_plugin_init(GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN);
  elgg_register_plugin_hook_handler('comments', 'object', 'func_replace_comments');
  elgg_register_plugin_hook_handler('comments:count', 'object', 'func_count_comments');
  elgg_register_plugin_hook_handler('register', 'menu:river', 'izap_river_menu_setup');
//  elgg_register_event_handler('update', 'object', 'func_izap_threaded_comments_access_update');
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
/**
 * Add the threaded-comments to river actions menu
 */
function izap_river_menu_setup($hook, $type, $return, $params){
  	if (elgg_is_logged_in()) {
		$item = $params['item'];
		$object = $item->getObjectEntity();
		// comments and non-objects cannot be commented on or liked
		if (!elgg_in_context('widgets') && $item->annotation_id == 0) {
			// comments
			if ($object->canComment()) {
				$options = array(
					'name' => 'comment',
					'href' => '#form_threaded_comment_'.$object->guid,
					'text' => elgg_view_icon('speech-bubble'),
					'title' => elgg_echo('comment:this'),
					'rel' => 'toggle',
					'priority' => 50,
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}

	return $return;
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
      $comment->access_id = ACCESS_PUBLIC;
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
