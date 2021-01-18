<?php

require_once("$CFG->libdir/externallib.php");

class block_zoomwebinarhost_external extends external_api
{

    /**
     * Returns parameters
     * @return external_description
     */

    public static function create_webinar_host_parameters()
    {
        return new external_function_parameters(
            array(
                'courseid' => new external_value(PARAM_INT, 'The course id for the host'),
                'email' => new external_value(PARAM_EMAIL, 'The host email')
                )
        );
    }

    /**
     * Returns return value description
     * @return external_description
     */

    public static function create_webinar_host_returns()
    {
        return new external_single_structure(
            array(
                    'name' => new external_value(PARAM_RAW, 'Host name'),
                    'email' => new external_value(PARAM_EMAIL, 'Host email')
                )
        );
    }

    /**
     * Returns host object
     * @return external_description
     */

    public static function create_webinar_host($courseid, $email)
    {
        global $DB;
        $dataobject = new  stdClass();
        $dataobject->courseid = $courseid;
        $dataobject->email = trim($email);

        if (!$DB->record_exists('user', array(email => $email))) {
            $message = get_string('userdoesnotexist', 'block_zoomwebinarhost');
            throw new moodle_exception('userdoesnotexist', 'block_zoomwebinarhost', '', $message, $message);
        }

        if ($DB->record_exists('block_zoomwebinarhost', array('courseid' =>  $courseid, 'email' => $email))) {
            $message = get_string('useralreadyexists', 'block_zoomwebinarhost');
            throw new moodle_exception('useralreadyexists', 'block_zoomwebinarhost', '', $message, $message);
        } else {
            $DB->insert_record('block_zoomwebinarhost', $dataobject);
        }
    
        return ['name' => '', 'email' => '' ];
    }

    /**
     * Returns params of method result value
     * @return external_description
     */


    public static function delete_webinar_host_parameters()
    {
        return new external_function_parameters(
            array(
                'courseid' => new external_value(PARAM_INT, 'The course id for the host'),
                'email' => new external_value(PARAM_EMAIL, 'The host email')
                )
        );
    }

    /**
     * Returns description of method result value
     * @return external_description
     */

    public static function delete_webinar_host_returns()
    {
        return new external_value(PARAM_BOOL, 'True if user has been successfully deleted');
    }

    /**
     * Returns method result value
     * @return external_description
     */

    public static function delete_webinar_host($courseid, $email)
    {     
        global $DB;
        $data = ['courseid' => $courseid, 'email' => $email];

        if ($DB->delete_records('block_zoomwebinarhost', $data)) {
            return true;
        }

        return false;
    }
}
