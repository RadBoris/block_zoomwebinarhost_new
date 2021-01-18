<?php

defined('MOODLE_INTERNAL') || die();

class block_zoomwebinarhost extends block_base
{
    public function init()
    {
        $this->title = get_string('zoomwebinarhost', 'block_zoomwebinarhost');
    }

    public function get_content()
    {
        if ($this->content !== null) {
            return $this->content;
        }

        global $COURSE;
        global $DB;

        $context = context_course::instance($COURSE->id);


        if (!has_capability('block/zoomwebinarhost:managepages', $context)) {
            return '';
        }

        $url = new moodle_url('/blocks/zoomwebinarhost/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));

        $this->content         =  new stdClass;
        $this->content->text   =

             sprintf('<h5 style="text-align: center;display: flex;align-items: inherit;"><a id="block_zoomwebinar" href="%s" style="color: #1b466e;display: flex;height: 20px;align-items: center;background-color: white;"> <i class="fa fa-2x fa fa-film" aria-hidden="true" style="
                    margin-right: 10px;
                "></i>Manage Webinar Hosts</a></h5>', $url);


        return $this->content;
    }

    public function instance_allow_multiple()
    {
        return true;
    }
}
