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

// get the query params
$qry = func_get_query_params_byizap();
$main_entity = get_entity($qry[1]);
$limit = 100;
// set the options
$options['type'] = 'object';
$options['subtype'] = 'IzapThreadedComments';
$options['metadata_names'] = 'main_entity';
$options['metadata_values'] = $qry[1];
$options['limit'] = $limit;
$options['order_by'] =	'e.time_created DESC';

$comments = elgg_get_entities_from_metadata($options);
foreach($comments as $comment) {
  $comment->title = '';
  $entities[] = $comment;
}
// send rss view to the elgg
elgg_set_viewtype('rss');
$entities = elgg_view_entity_list($entities, count($entities), 0, $limit, FALSE, FALSE, FALSE);
$title = elgg_echo('rss_page_title') . ': ' . $main_entity->title;
$body = elgg_view_layout('left_column_sidebar', '', $entities);
page_draw($title, $body);