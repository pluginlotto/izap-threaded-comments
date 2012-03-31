<?php
/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * @version {version} $Revision: {revision}
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

//add river to the comments

$options = array(
    'metadata_names' => 'parent_guid',
    'metadata_values' => $vars['entity']->guid,
    'type' => 'object',
    'subtype' => 'IzapThreadedComments',
    'order_by' => 'e.time_created desc',
    'count' => TRUE,
    'limit' => 3,
);
$count = elgg_get_entities_from_metadata($options);
if ($count) {
  $options['count'] = FALSE;
  $entities = elgg_get_entities_from_metadata($options);
}
if ($entities):
  krsort($entities);
?>
  <span class="elgg-river-comments-tab"><?php echo elgg_echo('comments'); ?></span>
<?php endif; ?>
  <div id="threaded_comments">
  <?php
  echo elgg_view('page/components/list', array(
      'items' => $entities,
      'offset' => 0,
      'limit' => 999,
      'full_view' => TRUE,
      'list_type_toggle' => FALSE,
      'pagination' => FALSE,
      'list_class' => ' elgg-annotation-list elgg-river-comments ',
      'river_thread' => TRUE
  ));
  ?>
</div>