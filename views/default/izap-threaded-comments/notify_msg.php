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


$comment = $vars['entity'];
$main_entity = get_entity($comment->main_entity);
?>

  <?php echo elggb_echo('new_comment');?>
  at <a href="<?php echo $comment->getURL();?>" >
    <?php echo $main_entity->title?>
  </a>
  <p>
    &quot;
    <?php echo $comment->description;?>
    &quot;
  </p>
