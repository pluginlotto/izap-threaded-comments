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
?>

<div class="clearfloat"></div>
<?php
$main_entity_guid = ($vars['main_entity']->guid>0) ? $vars['main_entity']->guid : $vars['entity']->guid;
$rss_url = IzapBase::setHref(array(
  'context'=>GLOBAL_IZAP_THREADED_COMMENTS_PAGEHANDLER,
  'action'=>'rss',
)).$main_entity_guid;


?>
<div class="elgg-list" id="threadedcomments">
  <div align="right">
    <a
      href="<?php echo $rss_url?>"
      title="<?php echo elgg_echo('comments_rss')?>"><img
        src="<?php echo $vars['url'],'mod/'.GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN.'/_graphics/rss_comments.png';?>"
          alt="<?php echo elgg_echo('comments_rss')?>"/></a>
   
  </div>
  <?php
  echo $vars['isForm'] ? "" : elgg_view('output/threaded_comments', array('entity'=>$vars['entity']) );
  ?>
  <?php
  if(isloggedin()) {
    echo elgg_view(GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN . '/forms/comment', array(
    'plugin' => GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN,
    'parent_guid'=> $vars['entity']->guid,
    'access_id' => $vars['entity']->access_id,
    'main_entity_guid' => $main_entity_guid,
    'postArray'=>$vars['postArray'],
    'resultId'=>"threaded_comments",
    'div_placement' => 'append',
    )
    );
  }
  ?>
</div>