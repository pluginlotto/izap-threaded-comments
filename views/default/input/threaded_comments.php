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

<script src="<?php echo func_get_www_path_byizap(array('plugin'=>GLOBAL_BRIDGE_PLUGIN,'type'=>"vendors"));?>/jquery.form.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="<?php echo func_get_www_path_byizap(array('plugin' => GLOBAL_BRIDGE_PLUGIN, 'type' => 'vendors'));?>jquery-ui/js/jquery-ui-1.7.3.custom-highlight.min.js"></script>
<div class="clearfloat"></div>
<?php
$main_entity_guid = ($vars['main_entity']->guid>0) ? $vars['main_entity']->guid : $vars['entity']->guid;
$rss_url = func_set_href_byizap(array(
  'plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN,
  'page' => 'rss',
  'vars' => array($main_entity_guid),
));
?>
<div class="contentWrapper">
  <div align="right">
    <a href="<?php echo $rss_url?>" title="<?php echo elgg_view('comments_rss')?>">
      <img src="<?php echo func_get_www_path_byizap(array('plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN, 'type' => 'images'));?>rss_comments.png" alt="<?php echo elgg_view('comments_rss')?>"/>
    </a>
  </div>
  <?php
  echo $vars['isForm']?"":elgg_view('output/threaded_comments', array('entity'=>$vars['entity']) );
  ?>
  <?php
  if(isloggedin()) {
    $minimum_post_time = func_get_custom_value_byizap(array('plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN, 'var' => 'minimum_comment_post_time'));
    echo '<b><em>' . sprintf(elggb_echo('minimum_time'), $minimum_post_time) . ' Sec.</em></b>';
    echo func_izap_bridge_view('forms/comment', array(
    'plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN,
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