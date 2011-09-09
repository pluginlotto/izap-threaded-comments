<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2011. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

$unique_id = uniqid();
if($vars['div_placement'] == '') {
  $append_prepend = 'prepend';
}else {
  $append_prepend = $vars['div_placement'];
}
$hidden = $vars['reply']== true?'':'class="hidden"';

?>
<div id="form_threaded_comment_<?php echo $vars['parent_guid'] ?>" <?php echo $hidden?>>
<form action="<?php echo IzapBase::getFormAction('save', GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN)?>" method="post" id="form_threaded_comment_<?php echo $unique_id;?>" style="height:40px">
  <?php
  echo elgg_view('input/hidden', array('name'=>"attributes[_parent_guid]", 'value'=>$vars['parent_guid']) );
  echo elgg_view('input/hidden', array('name'=>"attributes[_main_entity]", 'value'=>$vars['main_entity_guid']) );
  echo elgg_view('input/hidden', array('name'=>"attributes[_access_id]", 'value'=>$vars['access_id']) );
  echo elgg_view('input/hidden',array('name' => "attributes[river]",'value' => 'true'));
  ?>
  <fieldset>
    <input type="text" name="attributes[_description]" id="form_threaded_comment_<?php echo $unique_id;?>_textarea" style="height: 40px;"/>

  <?php
   $posting_icon = '<div id="form_posting"><img src="'.$vars['url'].'mod/'.GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN.'/_graphics/ajax-loader.gif"></div>';
    echo elgg_view('input/submit',array(
  'name'=>'submit',
  'value'=>'Submit'
  ));
  ?>
  <?php
  if($vars['close_button']):
    
    ?>
    <a href="#" onclick="$('#reply_form_<?php echo $vars['parent_guid']?>').remove(); return false;"><?php echo elgg_echo('close');?></a>
    
    <?php endif;?>
</fieldset>
  <script type="text/javascript">
    $("#form_threaded_comment_<?php echo $unique_id;?>").submit(function(){
      $('#<?php echo $vars['resultId'] ?>').<?php echo $append_prepend?>('<?php echo $posting_icon?>');
      
        elgg.action(this.action, {
        data: $(this).serialize(),

        success: function(data){
          $('#form_threaded_comment_<?php echo $unique_id;?>_textarea').val('');
          $('#reply_form_<?php echo $vars['parent_guid']?>').remove();
          $('#<?php echo $vars['resultId'] ?>').<?php echo $append_prepend?>(data.output);
          $('#form_posting').remove();
        }
      });
      return false;
    });
  </script>

</form>
  </div>