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

?>
<a name="comment_<?php echo $vars['entity']->guid?>"></a>
<?php
$owner = get_user($vars['entity']->owner_guid);
$reply_url = IzapBase::setHref(array(
  'page_owner' => FALSE,
  'context' => 'ajax',
  'vars' => array('view', GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN, 'js', 'load_reply_form'),
)) . '?guid=' . $vars['entity']->guid . '&main=' . $vars['entity']->main_entity;
?>
<div class="threadedComment" id="threaded_comment_<?php echo $vars['entity']->guid ;?>">
  <div class="comment-info-byizap" id="threaded_comment_description_<?php echo $vars['entity']->guid ;?>">
      <?php echo $vars['entity']->getDescription(); ?>
       <a href="<?php echo $owner->getURL(); ?>"><?php echo $owner->name; ?></a> <?php echo elgg_view_friendly_time($vars['entity']->time_created); ?>
       <?php if(elgg_is_logged_in()) :?>
        <a href="#reply" id="threaded_comment_reply_<?php echo $vars['entity']->guid ;?>"><?php echo elgg_echo('reply');?></a>
        |
       <?php endif;?>
        <a href="<?php echo $vars['entity']->getUrl();?>"><?php echo elgg_echo('link');?></a>
        <?php
        if ($vars['entity']->canEdit()) :
          ?>
         |
        <a href="
          <?php echo elgg_add_action_tokens_to_url(IzapBase::getformaction('delete',GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN)."?guid={$vars['entity']->guid}");?>"
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
    $('.izap_r_class').remove();
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