<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'title,type,output,options,filtersubgroups',
        'iconfile' => 'EXT:marketplace/Resources/Public/Icons/tx_marketplace_domain_model_filtergroup.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, type, output, options, filtersubgroups',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, type, output, options, filtersubgroups, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_marketplace_domain_model_filtergroup',
                'foreign_table_where' => 'AND tx_marketplace_domain_model_filtergroup.pid=###CURRENT_PID### AND tx_marketplace_domain_model_filtergroup.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
		'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
		'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'title' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup.title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	    ],
	    'type' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup.type',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'items' => [
			        ['-- Label --', 0],
			    ],
			    'size' => 1,
			    'maxitems' => 1,
			    'eval' => ''
			],
	    ],
	    'output' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup.output',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'options' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup.options',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => 'tx_marketplace_domain_model_option',
			    'foreign_field' => 'filtergroup',
			    'foreign_sortby' => 'sorting',
			    'maxitems' => 9999,
			    'appearance' => [
			        'collapseAll' => 1,
                    'expandSingle' => 1,
			        'levelLinksPosition' => 'top',
			        'showSynchronizationLink' => 1,
			        'showPossibleLocalizationRecords' => 1,
			        'useSortable' => 1,
			        'showAllLocalizationLink' => 1
			    ],
			],
	    ],
	    'filtersubgroups' => [
	        'exclude' => false,
	        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_filtergroup.filtersubgroups',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => 'tx_marketplace_domain_model_filtersubgroup',
			    'foreign_field' => 'filtergroup',
			    'foreign_sortby' => 'sorting',
			    'maxitems' => 9999,
			    'appearance' => [
			        'collapseAll' => 1,
                    'expandSingle' => 1,
			        'levelLinksPosition' => 'top',
			        'showSynchronizationLink' => 1,
			        'showPossibleLocalizationRecords' => 1,
			        'useSortable' => 1,
			        'showAllLocalizationLink' => 1
			    ],
			],
	    ],
    ],
];
