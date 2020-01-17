<?php
$GLOBALS['TL_DCA']['tl_attendees_exams'] = [
    'config' => [
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['exam_id'],
            'flag' => 1,
            'panelLayout' => 'search,filter;limit,sort'
        ],
        'label' => [
            'fields' => ['attendee_id:tl_member.firstname', 'attendee_id:tl_member.lastname', 'exam_id:tl_exams.title'],
            'format' => '%s',
            'showColumns' => true,
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg'
            ],
        ],
    ],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
        'attendee_id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_attendees_exams']['attendee_id'],
            'inputType' => 'select',
	    //Optionen aus Funktion getAttendee() holen
            'options_callback' => ['tl_attendees_exams', 'getAttendee'],
            'eval' => ['mandatory' => true, 'includeBlankOption' => true],
            'sql' => ['type' => 'integer', 'default' => 0]
        ],
        'exam_id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_attendees_exams']['exam_id'],
            'inputType' => 'select',
	    //Optionen aus Funktion getExam() holen
            'options_callback' => ['tl_attendees_exams', 'getExam'],
            'eval' => ['mandatory' => true, 'includeBlankOption' => true],
            'sql' => ['type' => 'integer', 'default' => 0]
        ],
	'status' => [
	    'label' => &$GLOBALS['TL_LANG']['tl_attendees_exams']['status'],
	    'inputType' => 'select',
	    'options' => ['in_progress', 'confirmed'],
	    'reference' => &$GLOBALS['TL_LANG']['tl_attendees_exams'],
            'eval' => ['mandatory' => true, 'includeBlankOption' => true],
            'sql' => ['type' => 'string', 'length' => '16', 'default' => 0]
	],
    ],
    'palettes' => [
        'default' => '{exam_legend},attendee_id,exam_id,status'
    ],
];

class tl_attendees_exams extends Backend
{

    // Alle Infos für Select-Box "Teilnehmer" sammeln
    public function getAttendee()
    {
        $array = array();
        $this->import('Database');
        $result = Database::getInstance()->prepare("SELECT id, firstname, lastname FROM tl_member WHERE usertype='Student'")->query();
        while ($result->next()) {
            $nameset = $result->lastname;
            $nameset .= ', ';
            $nameset .= $result->firstname;
            $array[$result->id] = $nameset;
        }
        return $array;
    }

    // Alle Infos für Select-Box "Klausur" sammeln
    public function getExam()
    {
        $array = array();
        $this->import('Database');
        $result = Database::getInstance()->prepare("SELECT id, title, date, department, begin FROM tl_exams")->query();
        while ($result->next()) {
            $nameset = $result->title;
            $nameset .= ' (';
	    //Verkürzte Schreibweise für die Fachbereiche
	    $nameset .= str_ireplace("-", "", str_ireplace(" ", "", substr($GLOBALS['TL_LANG']['tl_attendees_exams'][$result->department],0,5)));
	    $nameset .= ', ';
            $nameset .= date("d.m.Y", $result->date);
            $nameset .= ' um ';
            $nameset .= date("H:i", $result->begin);
            $nameset .= ' Uhr';
            $nameset .= ')';
            $array[$result->id] = $nameset;
        }
        return $array;
    }

}
?>
