<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_reporting'),
            get_string('descconfig', 'block_reporting')
        ));
 
$settings->add(new admin_setting_configcheckbox(
            'reporting/Set_Background',
            get_string('labelsetbackground', 'block_reporting'),
            get_string('descsetbackground', 'block_reporting'),
            '0'
        ));