<?php

$services = array(
      'zoomwebinarhostpluginservice' => array(
          'functions' => array('block_zoomwebinarhost_create_webinar_host', 'block_zoomwebinarhost_delete_webinar_host'),
          'requiredcapability' => '',                //if set, the web service user need this capability to access
                                                     //any function of this service. For example: 'some/capability:specified'
          'restrictedusers' =>0,                      //if enabled, the Moodle administrator must link some user to this service
                                                      //into the administration
          'enabled'=>1,                               //if enabled, the service can be reachable on a default installation
          'shortname'=>'zoomwebservice' //the short name used to refer to this service from elsewhere including when fetching a token
       )
  );

$functions = array(
    'block_zoomwebinarhost_create_webinar_host' => array(
        'classname' => 'block_zoomwebinarhost_external',
        'methodname' => 'create_webinar_host',
        'classpath' => 'blocks/zoomwebinarhost/classes/externallib.php',
        'description' => 'Create webinar host',
        'type' => 'write',
        'ajax' => true,
        'loginrequired' => true,
    ),
    'block_zoomwebinarhost_delete_webinar_host' => array(
        'classname' => 'block_zoomwebinarhost_external',
        'methodname' => 'delete_webinar_host',
        'classpath' => 'blocks/zoomwebinarhost/classes/externallib.php',
        'description' => 'Delete webinar host',
        'type' => 'write',
        'ajax' => true,
        'loginrequired' => true,
     )
  );
