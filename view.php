<?php
require('../../config.php');
require_once('lib.php'); // Stelle sicher, dass die lib.php eingebunden wird

$id = required_param('id', PARAM_INT);
$cm = get_coursemodule_from_id('gruenesfeld', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$gruenesfeld = $DB->get_record('gruenesfeld', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);
$PAGE->set_url('/mod/gruenesfeld/view.php', ['id' => $cm->id]);
$PAGE->set_title("Grünes Feld");
$PAGE->set_heading($course->fullname);

// Überprüfe, ob der Nutzer im Bearbeitungsmodus ist
$isediting = mod_gruenesfeld_is_editing($course->id);
$fieldcolor = $isediting ? '#4CAF50' : '#f44336'; // Grün für Bearbeitungsmodus, Rot für normalen Modus

echo $OUTPUT->header();

// Farbiges Feld anzeigen
echo '<div style="background:' . $fieldcolor . '; color:white; padding:40px; font-size:24px; border-radius:10px; text-align:center;">
    Grünes Feld Activity 🌿
    <p>' . ($isediting ? 'Bearbeitungsmodus aktiv' : 'Bearbeitungsmodus inaktiv') . '</p>
</div>';

// Textfeld anzeigen, wenn es einen Inhalt hat und NICHT im Bearbeitungsmodus ist
if (!$isediting && !empty($gruenesfeld->description_text)) {
    echo '<div style="margin: 20px 0; padding: 15px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; font-size: 1em; line-height: 1.5;">
        ' . format_text($gruenesfeld->description_text, FORMAT_HTML) . '
    </div>';
}

echo $OUTPUT->footer();
?>