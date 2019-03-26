<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Block displaying information about current logged-in user.
 *
 * This block can be used as anti cheating measure, you
 * can easily check the logged-in user matches the person
 * operating the computer.
 *
 * @package    block_reporting
 * @copyright  2019 Youssef
 * @author     Youssef Elhanafi <yelhanafi@ac2i.ma>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Displays the current user's profile information.
 *
 * @copyright  2010 Remote-Learner.net
 * @author     Olav Jordan <olav.jordan@remote-learner.ca>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_reporting extends block_base {
    /**
     * block initializations
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_reporting');
    }

    public function get_content() {
        /* if ($this->content !== null) {
          return $this->content;
        }
     
        $this->content         =  new stdClass;

        if (! empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }
        else {
            $this->content->text = 'This is a default value';
        }

        // $this->content->text   = 'The content of our Reporting block!';
        $this->content->footer = '<h3>Footer</h3>';
     
        return $this->content; */
        global $COURSE;
        global $USER;

        $text = 'courseid: '.$COURSE->id.'<br>';
        $text .= 'fullname: '.$COURSE->fullname.'<br><br>';

        $text .= 'userid: '.$USER->id.'<br>';
        $text .= 'user\'s name: '.$USER->firstname.' '.$USER->lastname.'<br><br>';

        $url_site = new moodle_url('/blocks/reporting/view.php',array('blockid' => $this->instance->id,'courseid' => $COURSE->id,'global' => 'site'));
        $url_user = new moodle_url('/blocks/reporting/view.php',array('blockid' => $this->instance->id,'courseid' => $COURSE->id,'global' => 'user'));
        $url_course = new moodle_url('/blocks/reporting/view.php',array('blockid' => $this->instance->id,'courseid' => $COURSE->id,'global' => 'course'));
        $url_page = new moodle_url('/blocks/reporting/view.php',array('blockid' => $this->instance->id,'courseid' => $COURSE->id,'global' => 'page'));

        $footer = html_writer::link($url_site, get_string('linkname', 'block_reporting').':SITE');
        $footer .='<br><br>'.html_writer::link($url_course, get_string('linkname', 'block_reporting').':CRSE');
        $footer .='<br><br>'.html_writer::link($url_user, get_string('linkname', 'block_reporting').':USER');
        $footer .='<br><br>'.html_writer::link($url_page, get_string('linkname', 'block_reporting').':PAGE'); 
        
        $this->content->text = $text;
        $this->content->footer = $footer;

        return $this->content;

    } 

    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_reporting');            
            } else {
                $this->title = $this->config->title;
            }   
        }
    }

    public function instance_allow_multiple() {
        // Are you going to allow multiple instances of each block?
        // If yes, then it is assumed that the block WILL USE per-instance configuration
        return TRUE;
    }

    function has_config(){
        return true;
    }

    public function html_attributes() {
        $attributes = parent::html_attributes(); // Get default values
        if(get_config('reporting','Set_Background') == 1)
        {
            $attributes['class'] .= ' block_'. $this->name(); // Append our class to class attribute
        }
        return $attributes;
    }

}
