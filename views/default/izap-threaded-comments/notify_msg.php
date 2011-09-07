<?php
/***************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2011. iZAP                  *
 * All rights reserved                             *
 ***************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/forum/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */



$comment = $vars['entity'];
$main_entity = get_entity($comment->main_entity);
?>

  <?php echo elgg_echo('izap-threaded-comment:new_comment');?>
  at <?php echo $main_entity->title?>
   &quot;
    <?php echo $comment->getDescription();?>
    &quot;
  <?php echo elgg_echo('izap-threaded-comment:clickhere');echo $comment->getURL();?>"