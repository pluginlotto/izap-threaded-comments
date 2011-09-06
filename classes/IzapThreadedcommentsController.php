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


class IzapThreadedcommentsController extends IzapController {
  public function  __construct($page) {
    parent::__construct($page);
  }

  function actionRss() {
    $main_entity = get_entity($this->url_vars[2]);
    $limit = 100;
    // set the options
    $options['type'] = 'object';
    $options['subtype'] = 'IzapThreadedComments';
    $options['metadata_names'] = 'main_entity';
    $options['metadata_values'] = $this->url_vars[2];
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
    $this->page_elements['title']= elgg_echo('rss_page_title') . ': ' . $main_entity->title;
    $this->page_elements['content'] = $entities;
    $this->drawPage();
  }
  function actionloadchild(){
 
  ECHO elgg_view('output/threaded_comments',array('entity' => get_entity($this->url_vars[2])));
  }
}