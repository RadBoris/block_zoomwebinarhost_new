<?php

$capabilities = array(

    'block/zoomwebinarhost:viewpages' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
		'guest' => CAP_PREVENT,
		'student' => CAP_PREVENT,
		'teacher' => CAP_PREVENT,
		'editingteacher' => CAP_PREVENT,
		'coursecreator' => CAP_ALLOW,
		'manager' => CAP_ALLOW
        ),
	
    ),

    'block/zoomwebinarhost:managepages' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
        'student' => CAP_PREVENT,
		'editingteacher' => CAP_PREVENT,
		'coursecreator' => CAP_ALLOW,
        'manager' => CAP_ALLOW
        ),
    ),

    'block/zoomwebinarhost:myaddinstance' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
            'user' => CAP_PREVENT
        ),

    ),

    'block/zoomwebinarhost:addinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
            'user' => CAP_PREVENT
        ),
    ),
);

