<?php

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_gruenesfeld_mod_form extends moodleform_mod {

    function definition() {

        $mform = $this->_form;

        $mform->addElement('text', 'name', 'Activity Name');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required');

        // Textfeld für die Aktivität
        $mform->addElement('header', 'textheader', get_string('text_settings', 'mod_gruenesfeld'));
        $mform->addElement('textarea', 'description_text', get_string('description_text', 'mod_gruenesfeld'), array('rows' => 5, 'cols' => 50));
        $mform->setType('description_text', PARAM_TEXT);


        $this->standard_intro_elements();

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}