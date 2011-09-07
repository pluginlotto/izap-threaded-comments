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
gatekeeper();
global $CONFIG;
$error = FALSE;

// check if from is validated
if(!IzapBase::hasFormError()) {

  $posted_arr=IzapBase::getPostedAttributes();
  $main_entity = get_entity($posted_arr['main_entity']);
  $entity = new IzapThreadedComments($posted_arr['guid']);
  $entity->setAttributes();
  $entity->access_id =ACCESS_PUBLIC;
  
  
  if($entity->save()) {
    $entity = new IzapThreadedComments($entity->guid);

    // save user who commented on this entity, with it
    IzapBase::updateMetadata(array(
            'entity' => $main_entity,
            'metadata' => array(
                    'commented_users' => array_unique(
                    array_merge(
                    (array) $main_entity->commented_users,
                    (array) $entity->owner_guid
                    )
                    ),

                    'commented_emails' => array_unique(
                    array_merge(
                    (array) $main_entity->commented_emails,
                    (array) $entity->getOwnerEntity()->email
                    )
                    ),
            ),
    ));
    // end user saving

    // send notification


    if(is_array($main_entity->commented_emails) && sizeof($main_entity->commented_emails)) {
      $email_ids = $main_entity->commented_emails;
      foreach($email_ids as $email) {
        $send_array['subject'] = sprintf(elgg_echo('threaded_comment_notify_subject'), $main_entity->title);
        $send_array['to'] = $email;
        $send_array['from_username'] = $CONFIG->site->name;
        $send_array['from'] = $CONFIG->site->email;
        $send_array['msg'] = elgg_view(GLOBAL_IZAP_THREADED_COMMENTS_PLUGIN. '/notify_msg', array('entity' => $entity));
        IzapBase::sendMail($send_array);
      }
    }
    // notification end
    $html_output = elgg_view_entity($entity);
    }
  else {
    $error = TRUE;
  }
}else {
  $error = TRUE;
}

if($error) {
  register_error(elgg_Echo('izap-threaded-comments:form_not_validated'));
}
echo $html_output;