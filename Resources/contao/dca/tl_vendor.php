<?php
$GLOBALS['TL_DCA']['tl_vendor'] = [
    'config' => [
        'dataContainer' => 'Table',
        'ctable' => ['tl_parts'],
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
            'fields' => ['name'],
            'flag' => 1,
            'panelLayout' => 'search,limit'
        ],
        'label' => [
            'fields' => ['name'],
            'format' => '%s',
        ],
        'operations' => [
            'edit' => [
                'href' => 'table=tl_parts',
                'icon' => 'edit.svg',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
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
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['name'],
            'search' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'street' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['street'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'postal' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['postal'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'clr w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'city' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['city'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'country' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['country'],
            'inputType' => 'select',
            'options' => \Contao\System::getCountries(),
            'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true],
            'sql' => ['type' => 'string', 'length' => 2, 'default' => '']
        ],
    ],
    'palettes' => [
        'default' => '{vendor_legend},name;{address_legend},street,postal,city,country'
    ],
];
?>
