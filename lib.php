<?php
defined('MOODLE_INTERNAL') || die();

function gruenesfeld_add_instance($data, $mform = null) {
    global $DB;
    $data->timecreated = time();
    $data->timemodified = time();
    $data->id = $DB->insert_record('gruenesfeld', $data);

    return $data->id;
}

function gruenesfeld_update_instance($data, $mform = null) {
    global $DB;
    $data->timemodified = time();
    $data->id = $data->instance;
    return $DB->update_record('gruenesfeld', $data);
}

function gruenesfeld_delete_instance($id) {
    global $DB;
    if (!$DB->record_exists('gruenesfeld', ['id'=>$id])) {
        return false;
    }
    $DB->delete_records('gruenesfeld', ['id'=>$id]);
    return true;
}
function gruenesfeld_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO: return true;
        default: return null;
    }
}

function mod_gruenesfeld_is_editing($courseid) {
    global $USER, $PAGE;
    $context = context_course::instance($courseid);
    return has_capability('moodle/course:update', $context, $USER->id) && $PAGE->user_is_editing();
}