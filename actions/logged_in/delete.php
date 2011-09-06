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
$guid  = get_input('guid');
$izapThreadedComments = get_entity($guid);
$id ="#threaded_comment_".$guid;
$html_output = '<div id="fade_out_comment_text">';
if($izapThreadedComments instanceof IzapThreadedComments && $izapThreadedComments->canEdit() && $izapThreadedComments->delete()) {
  $html_output .= '
    <div class="threaded_comments_success">
    '.elgg_echo('threaded_comments_deleted').'
    </div>
    ';
}else{
  $html_output = '
    <div class="threaded_comments_error">
    '.elgg_echo('threaded_comments_delete_error').'
    </div>
    ';
}
$html_output .= '
  <script type="text/javascript">
  $("#fade_out_comment_text").fadeOut(1000, function(){
    $("#fade_out_comment_text").remove();
    $("'.$id.'").parents().css("border","none");
      $("'.$id.'").remove();
    });
    
  </script>
  <div>';
echo $html_output;
exit;