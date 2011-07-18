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

if($vars['div_placement'] == '') {
  $append_prepend = 'prepend';
}else {
  $append_prepend = $vars['div_placement'];
}?>
<form action="<?php echo IzapBase::getFormAction('save', GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN)?>" method="post" id="form_threaded_comment_<?php echo $vars['parent_guid'];?>">
  <?php
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_parent_guid]", 'value'=>$vars['parent_guid']) );
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_main_entity]", 'value'=>$vars['main_entity_guid']) );
  echo elgg_view('input/hidden', array('internalname'=>"attributes[_access_id]", 'value'=>$vars['access_id']) );
  ?>

  <p>
    <textarea name="attributes[_description]" id="form_threaded_comment_<?php echo $vars['parent_guid'];?>_textarea" style="height: 50px;"></textarea>
  </p>
  <?php
   $posting_icon = '<div id="form_posting"><img src="'.$vars['url'].'mod/'.GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN.'/_graphics/ajax-loader.gif"></div>';
    //echo $vars['url'].'mod/'.GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN.'/_graphics/ajax-loader.gif';
  echo elgg_view('input/submit',array(
  'internalname'=>'submit',
  'value'=>'Submit'
  ));
  if($vars['close_button']):
    ?>
    <a href="#" onclick="$('#reply_form_<?php echo $vars['parent_guid']?>').remove(); return false;"><?php echo elgg_echo('close');?></a>
    <?php endif;?>

  <script type="text/javascript">
    $("#form_threaded_comment_<?php echo $vars['parent_guid'];?>").submit(function(){
       $('#<?php echo $vars['resultId'] ?>').<?php echo $append_prepend?>('<?php echo $posting_icon?>');
      elgg.action(this.action, {
        data: $(this).serialize(),
        success: function(data){
           
          $('#form_threaded_comment_<?php echo $vars['parent_guid'];?>_textarea').val('');
          $('#form_posting').remove();
          $('#reply_form_<?php echo $vars['parent_guid']?>').remove();
          $('#<?php echo $vars['resultId'] ?>').<?php echo $append_prepend?>(data.output);
          $('#form_posting').remove();
        }
      });
      return false;
    });
  </script>

</form>
