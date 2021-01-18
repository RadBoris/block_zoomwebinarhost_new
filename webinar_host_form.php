<?php

require_once("{$CFG->libdir}/formslib.php");

class webinar_host_form extends moodleform
{
    public function definition()
    {
        global $CFG;

        $attributes='font-size="20"';

        $hosts = $this->_customdata['email'];

        $newh = [];

        foreach ($hosts as $k=>$v) {
            array_push($newh, $v->email);
        }

        $mform =& $this->_form;

	    $mform->addElement('header', 'configheader', get_string('blocksettingstext', 'block_zoomwebinarhost'));	
	
        if ($newh) {
            $mform->addElement('static', 'defaulttexthost', get_string('defaultheadertext', 'block_zoomwebinarhost'), '', $attributes);

            $i = 0;
            foreach ($newh as $host) {
                $i++;
                $mform->addElement('static', sprintf('host_%s', $i), '', $host);
                $mform->addElement('button', sprintf('delete_%s', $i), 'REMOVE');
            }
        } else {
            $mform->addElement('static', 'defaulttextnohost', get_string('nowebinarhostselected', 'block_zoomwebinarhost'), '', $attributes);
        }

        $mform->addElement('text', 'email');
        $mform->setType('email', PARAM_NOTAGS);
        $mform->addElement('button', 'add', 'ADD');
        $mform->setDefault('email', 'Please enter an email');
    }
}
