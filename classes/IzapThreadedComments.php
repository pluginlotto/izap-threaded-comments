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

class IzapThreadedComments extends IzapObject {

  protected function initialise_attributes() {
    parent::initializeAttributes();
  }

  public function __construct($guid = null) {
    parent::__construct($guid);
  }

  public function getAttributesArray() {
    return array(
            'description'=>array(),
            'parent_guid' => array(),
            'up_vote' => array(),
            'down_vote' => array(),
            'flaged' => array(),
            'main_entity' => array(),
    );
  }

  public function save() {
    $main_entity = get_entity($this->_post->attributes['main_entity']);
    $this->title = $main_entity->title;
    $this->access_id = $main_entity->access_id;
    if(parent::save(true,array('river' =>false))) {
      IzapBase::getAllAccess();
      $main_entity->total_comments = (int) $main_entity->total_comments + 1;
      IzapBase::removeAccess();
      return TRUE;
    }

    return FALSE;
  }

  public function delete($force = FALSE) {
    // get main entity
    $main_entity = get_entity($this->main_entity);
    // check the child
    if($this->countChild()) {
      $children = get_child_recursive($this->guid);
    }
    // if child, then delete them as well
    if(is_array($children) && sizeof($children)) {
      IzapBase::getAllAccess();
      foreach($children as $child) {
        // decrease the count
        $main_entity->total_comments = (int) $main_entity->total_comments - 1;
        delete_entity($child->guid, TRUE);
      }
      IzapBase::removeAccess();
    }
    
    // decrease the count
    IzapBase::getAllAccess();
    $main_entity->total_comments = (int) $main_entity->total_comments - 1;
    IzapBase::removeAccess();

    if($force) {
      IzapBase::getAllAccess();
    }
    return delete_entity($this->guid, TRUE);
  }

  public function updateTitle() {
    $parent_entity = get_entity($this->container_guid);
    $subtype = get_class($this);

    if($parent_entity instanceof $subtype) {
      $title = $parent_entity->title;
    }else {
      $title = $parent_entity->guid;
    }

    return $this->title = $title . '_' . $this->guid;
  }

  public function countChild($in_array = array()) {
    $options = array(
            'type' => 'object',
            'subtype' => get_class($this),
            'count' => TRUE,
            'metadata_names'			=>	"parent_guid",
            'metadata_values'			=>	$this->guid,
    );

    $working_array = array_merge($options, $in_array);
    return elgg_get_entities_from_metadata($working_array);
  }

  public function getUrl() {
    $main_entity = get_entity($this->main_entity);
    if($main_entity) {
      return $url = $main_entity->getUrl() . '#comment_' . $this->guid;
    }

    return parent::getUrl();
  }

}

function get_child_recursive($parent_guid) {
  $options = array(
          'type' => 'object',
          'subtype' => 'IzapThreadedComments',
          'metadata_names'			=>	"parent_guid",
          'metadata_values'			=>	$parent_guid,
  );

  $return_array = array();
  $entity_array = elgg_get_entities_from_metadata($options);
  if($entity_array) {
    foreach($entity_array as $entity) {
      $return_array[] = $entity;
      if($entity->countChild()) {
        $return_array = array_merge($return_array, get_child_recursive($entity->guid));
      }
    }
  }

  return $return_array;
}