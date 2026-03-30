<?php
require('../../config.php');

$id = required_param('id', PARAM_INT);

$course = $DB->get_record('course', ['id'=>$id], '*', MUST_EXIST);

require_course_login($course);

redirect(new moodle_url('/course/view.php', ['id'=>$course->id]));

//Test mit GitHub
