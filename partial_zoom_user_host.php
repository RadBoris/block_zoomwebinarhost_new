<?php

//partial function to evaluate whether user is host; for PHP>=7.4 
function partial_zoomwebinarhost (callable $func, ...$args): callable
{
    return function () use ($func, $args) {
        return call_user_func_array($func, array_merge($args, func_get_args()));
    };
}

function check($arg1, $arg2)
{
    return ($arg1 || $arg2);
}

function getEmails($courseid, $useremail)
{
    
    global $DB;

    $aoahosts = $DB->get_records('block_zoomwebinarhost', array('courseid' => $courseid, 'email' => $useremail), '', 'email');
    $aoahostemail = array_values($aoahosts);

    $hosts = [];

    foreach ($aoahostemail as $email) {
        array_push($hosts, $email->email);
    }

    return in_array($useremail, $hosts);
}

