<?php


require_once('../../config.php');

defined('MOODLE_INTERNAL') || die();

//Check for all required variables.
$courseid = required_param('courseid',PARAM_INT);
$blockid = required_param('blockid',PARAM_INT);
$global = required_param('global',PARAM_TEXT);

//Set the page heading and layout
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('base');

//Breadcrumb
$settingsnode = $PAGE->settingsnav->add(get_string('pluginname', 'block_reporting'));
$editurl = new moodle_url('/blocks/reporting/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('pluginname', 'block_reporting'), $editurl);
$editnode->make_active();

//print $OUTPUT->header();

print $OUTPUT->header();
 switch ($global)
{
    case 'course':
        print 'COURSE:';
        print_object($COURSE);
        break;
    case 'site':
        print 'SITE:';
        print_object($SITE);
        break;
    case 'user':
        print 'USER:';
        print_object($USER);
        break;
    case 'page':
        print 'PAGE:';
        print_object($PAGE);
        break;

} 

/* echo $courseid;
echo '<br>';
echo $blockid;
echo '<br>';
echo $global; */

print $OUTPUT->footer();