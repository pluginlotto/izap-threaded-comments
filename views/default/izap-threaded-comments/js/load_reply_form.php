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

global $CONFIG;

$guid = get_input('guid');
$main = get_input('main');
$entity = new IzapThreadedComments($guid);
$main_entity = get_entity($main);

?>
<div id="reply_form_<?php echo $guid?>" class="izap_r_class">
  <?php
  echo elgg_view('forms/comments/add', array(
  'plugin' => GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN,
  'parent_guid'=>$entity->guid,
  'main_entity_guid' => $main_entity->guid,
  'access_id' => $main_entity->access_id,
  'resultId'=>"threaded_comment_form_reply_{$entity->guid}",
  'div_placement' => 'append',
  'close_button' => TRUE,
  )
  );
  ?>
</div>