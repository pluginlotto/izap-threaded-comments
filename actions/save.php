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

gatekeeper();
global $CONFIG;
$error = FALSE;

$validated = $CONFIG->post_byizap->form_validated;
// check if from is validated
if($validated) {
  $entity = new IzapThreadedComments($CONFIG->post_byizap->attributes['guid'], array('post'=>&$CONFIG->post_byizap));
  if($entity->save()) {
    $entity = new IzapThreadedComments($entity->guid);

    // send notification
    if($entity->owner_guid != get_loggedin_userid()) {
      $main_entity = get_entity($entity->main_entity);
      $subject = sprintf(elggb_echo('threaded_comment_notify_subject'), $main_entity->title);
      $message = func_izap_bridge_view('home/notify_msg', array('plugin' => GLOBAL_THREADED_COMMENTS_PLUGIN, 'entity' => $entity));
      notify_user($main_entity->owner_guid, $CONFIG->site->guid, $subject, $message);
    }
    // notification end

    $html_output = elgg_view_entity($entity);
  }else {
    $error = TRUE;
  }
}else {
  $error = TRUE;
}

if($error) {
  $html_output = '<div id="fade_out_comment_text">';
  $html_output .= '
    <div class="threaded_comments_error">
      '.elggb_echo('threaded_comments_error').'
    </div>
    ';
  $html_output .= '<div>';
  $html_output .= '
  <script type="text/javascript">
  $("#fade_out_comment_text").fadeOut(4000, function(){
    $("#fade_out_comment_text").remove();
  });
  </script>
  <div>';
}
echo $html_output;
exit;