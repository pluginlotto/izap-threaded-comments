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
$owner = get_user($vars['entity']->owner_guid); 
$reply_url = func_set_href_byizap(array(
  'plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN,
  'page' => 'load_reply_form',
  'vars' => array(
    $vars['entity']->guid, get_entity($vars['entity']->main_entity)->guid
  ),
));
?>
<div class="threadedComment" id="threaded_comment_<?php echo $vars['entity']->guid ;?>">
  <div class="comment-info-byizap" id="threaded_comment_description_<?php echo $vars['entity']->guid ;?>">
      <?php echo $vars['entity']->description; ?>
       - <a href="<?php echo $owner->getURL(); ?>"><?php echo $owner->name; ?></a> <?php echo friendly_time($vars['entity']->time_created); ?>
        <a href="#reply" id="threaded_comment_reply_<?php echo $vars['entity']->guid ;?>"><?php echo elggb_echo('reply');?></a>
        | <a href="<?php echo $vars['entity']->getUrl();?>"><?php echo elggb_echo('link');?></a>
        <?php
        if ($vars['entity']->canEdit()) :
          ?>
         |
        <a href="
          <?php echo elgg_add_action_tokens_to_url(func_get_actions_path_byizap(array('plugin'=>GLOBAL_THREADED_COMMENTS_PLUGIN)) . "delete?guid={$vars['entity']->guid}")?>"
          id="delete_<?php echo $vars['entity']->guid;?>"
          >
          <?php echo elgg_echo('delete');?>
        </a>
          <?php
        endif; ?>
        <div style="float: right"><?php echo elgg_view('profile/icon', array('size' => 'tiny', 'entity' => $owner));?></div>
  </div>

  <div class="clearfloat"></div>
  <div id="threaded_comment_form_<?php echo $vars['entity']->guid;?>"></div>
  <div id="threaded_comment_form_reply_<?php echo $vars['entity']->guid;?>"></div>
  <?php
  $child = $vars['entity']->countChild();
  echo ($child) ? elgg_view('output/threaded_comments', array('entity'=>$vars['entity'], 'paging' => 'off') ) : "";
  ?>
</div>
<script type="text/javascript">
  $('#threaded_comment_reply_<?php echo $vars['entity']->guid ;?>').live('click', function(){
    $('#threaded_comment_form_<?php echo $vars['entity']->guid ;?>').load(
    '<?php echo $reply_url;?>'
  );
  });
  
  $('#delete_<?php echo $vars['entity']->guid;?>').click(function() {
    if(confirm('<?php echo addslashes(elgg_echo('question:areyousure')); ?>')) {
      $('#threaded_comment_<?php echo $vars['entity']->guid ;?>').load(this.href);
    }

    return false;
  });
  
  $(document).ready(function() {
  var url = window.location.href;
  var comment_id = url.split("#")[1];
  
  if(comment_id == 'comment_<?php echo $vars['entity']->guid?>') {
    $('#threaded_comment_description_<?php echo $vars['entity']->guid ;?>').effect("highlight", {color: "#FFC351"}, 5000);
  }
  });
</script>