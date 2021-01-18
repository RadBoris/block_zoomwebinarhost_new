<?php
require_once('webinar_host_form.php');

function block_zoomwebinarhost_output_fragment_formreload($args)
{
    global $CFG;
    global $DB;

    $email = clean_param($args['email'], PARAM_EMAIL);
    $courseid = clean_param($args['courseid'], PARAM_INT);

    $result = $DB->get_records('block_zoomwebinarhost', array('courseid' => $courseid));
    $to_form = array('email' => $result);

    $webinar_form = new webinar_host_form(null, $to_form);

    ob_start();
    $o = $webinar_form->display();
    $o .= ob_get_contents();
    ob_end_clean();

    return $o;
}
