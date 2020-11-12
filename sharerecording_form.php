<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');
require_once($CFG->dirroot . '/mod/congrea/locallib.php');

class mod_congrea_sharerecording_form extends moodleform {

    /**
     * Defines forms elements
     */
    public function definition() {
        global $CFG;
        $mform = $this->_form;
        $id = $this->_customdata['id'];
        $psession = $this->_customdata['psession'];
        $share = $this->_customdata['share'];
        $recname = $this->_customdata['recname'];
        $mform->addElement('hidden', 'id', $id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'psession', $psession);
        $mform->setType('psession', PARAM_INT);
        $mform->addElement('hidden', 'share', $share);
        $mform->setType('share', PARAM_INT);
        $mform->addElement('hidden', 'recname', $recname);
        $mform->setType('recname', PARAM_INT);
        $courses = get_courses();
        $courseoptions[] = 'All';
        foreach($courses as $keys => $course) {
           $courseoptions[$keys] = $course->fullname;
        }
        $mform->addElement('select', 'shareid', get_string('courselist', 'congrea'), $courseoptions);
        $mform->$courseoptions;
        $mform->addHelpButton('shareid', 'courselist', 'congrea');
        //$mform->addElement('static', 'description', get_string('sharerecordingfile', 'mod_congrea', $recname));
        $buttonarray=array();
        $buttonarray[] = $mform->createElement('submit', 'submitbutton', get_string('share', 'congrea'));
        $buttonarray[] = $mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', ' ', false);
    }
       /**
     * Validate this form.
     * @param array $data submitted data
     * @param array $files not used
     * @return array errors
     */
    function validation($data, $files) {
        $errors = parent::validation($data, $files);
        if (empty($data['shareid'])) {
            $errors['shareid'] = get_string('sharerecording', 'congrea');
        }
        return $errors;;
    }
}