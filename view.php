<?php
 
require_once('../../config.php');
require_once('webinar_host_form.php');
 
global $DB;
global $OUTPUT;

$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);

if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_zoomwebinarhost', $courseid);
}

require_login($course);

require_capability('block/zoomwebinarhost:viewpages', context_course::instance($courseid));

$site = get_site();

$PAGE->set_url('/blocks/zoomwebinarhost/view.php', array('id' => $blockid, 'courseid' => $courseid));

$heading = $site->fullname . ' :: ' . $course->shortname;

$PAGE->set_heading($heading);

$contextid = context_course::instance($courseid)->id;

$PAGE->requires->js_call_amd('block_zoomwebinarhost/zoomwebinarhost', 'init', array($courseid, $contextid)); 

$hosts = $DB->get_records('block_zoomwebinarhost', array('courseid'=> $courseid));

$to_form = array('email' => $hosts);

$webinar_form = new webinar_host_form(null, $to_form);

echo $OUTPUT->header();
 
$webinar_form->display();

echo $OUTPUT->footer();

?>
