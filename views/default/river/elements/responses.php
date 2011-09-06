<?php

/* * *************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2011. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/forum/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */
$item = $vars['item'];
$object = $item->getObjectEntity();

?>
<div  id="threaded-comment-<?php echo $object->getGUID()?>" class="hidden">
<?php
if (!elgg_in_context('widgets')) {
  echo elgg_view('input/threaded_comments_river', array(
      'entity' => $object,
      'paging' => 'off',
      'limit' => 200
          )
  );
}
?>
</div>
<script type="text/javascript">

</script>