<?php
$GLOBALS['TL_DCA']['tl_parts'] = [
    'config' => [
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'ptable' => 'tl_vendor',
        'sql' => [
            'keys' => [
                'id' => 'primary'
            ],
        ],
        'onload_callback' => [
            function (\Contao\DataContainer $dc) {
                $db = \Contao\Database::getInstance();
                $pid = \Contao\Input::get('pid');
                $result = $db->prepare('SELECT `name` FROM `tl_vendor` WHERE `id` = ?')
                             ->execute([$pid]);
                $prefix = strtoupper(substr($result->name, 0, 2));
                $GLOBALS['TL_DCA']['tl_parts']['fields']['number']['default'] = $prefix;
            },
        ] 
    ],
    'list' => [
        'sorting' => [
            'mode' => 4,
            'fields' => ['name'],
            'headerFields' => ['name'],
            'panelLayout' => 'search,limit',
            'child_record_callback' => function (array $row) {
                return '<div class="tl_content_left">'.$row['name'].' ['.$row['number'].']</div>';
            },
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
        'pid' => [
            'foreignKey' => 'tl_vendor.name',
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
            'relation' => ['type'=>'belongsTo', 'load'=>'lazy']
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['name'],
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'number' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['number'],
            'search' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'description' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['description'],
            'inputType' => 'textarea',
            'eval' => ['tl_class' => 'clr', 'rte' => 'tinyMCE', 'mandatory' => true],
            'sql' => ['type' => 'text', 'notnull' => false]
        ],
        'singleSRC' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['singleSRC'],
            'inputType' => 'fileTree',
            'eval' => [
                'tl_class' => 'clr',
                'mandatory' => true, 
                'fieldType' => 'radio', 
                'filesOnly' => true, 
                'extensions' => \Contao\Config::get('validImageTypes'), 
                'mandatory' => true,
            ],
            'sql' => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true]
        ],
    ],
    'palettes' => [
        'default' => '{parts_legend},name,number,description,singleSRC'
    ],
];
?>
