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


$performed_by = get_entity($vars['item']->subject_guid); // $statement->getSubject();
$object = get_entity($vars['item']->object_guid);
$main_entity = get_entity($object->main_entity);

$string = "<a href=\"{$performed_by->getURL()}\">{$performed_by->name}</a>";
$contents = strip_tags($object->description); //strip tags from the contents to stop large images etc blowing out the river view
$string .= ' '.elgg_echo('izap-threaded-comments:has_commented_on').' ';
$string .= "<a href=\"" . $object->getUrl() . "\">" . $object->title . "</a>";
$string .= "<div class=\"river_content_display\">";

if(strlen($contents) > 200) {
  $string .= substr($contents, 0, 200) . " ...";
}else {
  $string .= $contents;
}
$string .= "</div>";

echo $string;