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

global $CONFIG;
return array(
        'plugin'=>array(
                'name'=>GLOBAL_THREADED_COMMENTS_PLUGIN,
                'version' => '1.0',
                'url_title' => GLOBAL_THREADED_COMMENTS_PAGEHANDLER,
                'title'=>"Threaded comments for the elgg, replacement of the current comment system",
                'objects'=>array(
                        'IzapThreadedComments' => array(
                                'class' => 'IzapThreadedComments',
                                'type' => 'object',
                        ),
                ),

                'hooks'=>array(
                        'comments' => array(
                                'object' => array(
                                        'func_replace_comments'
                                ),
                        ),
                        'comments:count' => array(
                                'object' => array(
                                        'func_count_comments'
                                ),
                        ),
                ),

                'actions'=>array(
                        'threaded_comments/save' => array('file' => 'save.php', 'public' => FALSE),
                        'threaded_comments/delete' => array('file' => 'delete.php', 'public' => FALSE),
                ),

                'action_to_plugin_name' => array(
                        'threaded_comments' => GLOBAL_THREADED_COMMENTS_PLUGIN,
                ),

                'events'=>array(
                        'update' => array(
                                'object' => array(
                                        'func_izap_threaded_comments_access_update'
                                ),
                        ),

                        'delete' => array(
                                'object' => array(
                                        'func_delete_comments_event'
                                ),
                        ),

                ),

                'custom'=>array(
                        'minimum_comment_post_time' => 5,

                ),
        ),

        'includes'=>array(
                dirname(__FILE__) . '/functions' => array('functions_core.php', 'function_hooks.php'),
                dirname(__FILE__) . '/classes' => array('IzapThreadedComments.php'),
        ),

        'path'=>array(
                'www'=>array(
                        'page' => $CONFIG->wwwroot . 'pg/'.GLOBAL_THREADED_COMMENTS_PAGEHANDLER.'/',
                        'images' => $CONFIG->wwwroot . 'mod/'.GLOBAL_THREADED_COMMENTS_PLUGIN.'/_graphics/',
                        'action' => $CONFIG->wwwroot . 'action/threaded_comments/',
                ),
                'dir'=>array(
                        'plugin'=>dirname(dirname(__FILE__))."/",
                        'actions'=>$CONFIG->pluginspath.GLOBAL_THREADED_COMMENTS_PLUGIN."/actions/",
                        'class'=>dirname(__FILE__)."/classes/",
                        'functions'=>dirname(__FILE__)."/functions/",
                        'views'=>array(
                                'home'=>"izap-threaded-comments/",
                                'forms'=>"izap-threaded-comments/forms/",
                                'river'=>"river/izap-threaded-comments/",
                        ),
                        'images'=>dirname(dirname(__FILE__)) . '/_graphics/',
                ),
        ),
);