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
?>
<form action="<?php echo func_get_actions_path_byizap(array('plugin'=>GLOBAL_THREADED_COMMENTS_PLUGIN)) . "save";?>" method="post" id="form_threaded_comment_<?php echo $vars['parent_guid'];?>">
  <?php
  echo elgg_view('input/securitytoken');
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_parent_guid]", 'value'=>$vars['parent_guid']) );
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_main_entity]", 'value'=>$vars['main_entity_guid']) );
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_access_id]", 'value'=>$vars['access_id']) );
  ?>

  <p>
    <label for="name" ><?php echo elggb_echo('comment');?></label><br />
    <textarea name="attributes[_description]" cols="50" rows="3" id="form_threaded_comment_<?php echo $vars['parent_guid'];?>_textarea"></textarea>
  </p>

  <p>
    <?php echo elgg_view('input/ajax_submit',
    array(
    'internalname'=>'submit',
    'value'=>elgg_echo('submit'),
    'formId'=>"form_threaded_comment_{$vars['parent_guid']}",
    'resultId'=>"{$vars['resultId']}",
    'div_placement' => $vars['div_placement'],
    'method'=>"POST",
    'value'=>elgg_echo('save'),
    'remove_form' => $vars['close_button'],
    )
    ); 
    if($vars['close_button']):
    ?>
    <a href="#" onclick="$('#reply_form_<?php echo $vars['parent_guid']?>').remove(); return false;"><?php echo elggb_echo('close');?></a>
    <?php endif;?>
  </p>
</form>