<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
        'default_sortby' => 'ORDER BY ratinguser',

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'criteria1,criteria2,criteria3,ratinguser,product',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('marketplace') . 'Resources/Public/Icons/tx_marketplace_domain_model_rating.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, criteria1, criteria2, criteria3, ratinguser, product,country,position,ratingtext,crdate,legals',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, criteria1, criteria2, criteria3, ratinguser, product,country,position,ratingtext,crdate,legals, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_marketplace_domain_model_currency',
				'foreign_table_where' => 'AND tx_marketplace_domain_model_currency.pid=###CURRENT_PID### AND tx_marketplace_domain_model_currency.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
    'crdate' => array(
      'exclude' => 1,
      'l10n_mode' => 'mergeIfNotBlank',
      'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.crdate',
      'config' => array(
        'type' => 'input',
        'readOnly' =>1,
        'size' => 13,
        'max' => 20,
        'eval' => 'datetime',
        'checkbox' => 0,
        'default' => 0,
        'range' => array(
          'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
        ),
      ),
    ),
		'criteria1' => array(
			'exclude' => 0,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.criteria1',
      'config' => Array (
        'type' => 'radio',
        'items' => array(
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.1',
            1
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.2',
            2
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.3',
            3
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.4',
            4
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.5',
            5
          ),
        ),
      ),
		),
		'criteria2' => array(
			'exclude' => 0,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.criteria2',
      'config' => Array (
        'type' => 'radio',
        'items' => array(
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.1',
            1
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.2',
            2
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.3',
            3
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.4',
            4
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.5',
            5
          ),
        ),
      ),
		),
		'criteria3' => array(
			'exclude' => 0,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.criteria3',
      'config' => Array (
        'type' => 'radio',
        'items' => array(
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.1',
            1
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.2',
            2
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.3',
            3
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.4',
            4
          ),
          array(
            'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.star.5',
            5
          ),
        ),
      ),
		),
		'ratinguser' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_rating.ratinguser',
			'config' => Array (
			    'type' => 'select',
			    'foreign_table' => 'fe_users',
			    'items' => array(
			        array('--none--', 0),
			    ),
			)
		),
		'product' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating.product',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_marketplace_domain_model_product',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
    'country' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating.country',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'position' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating.position',
      'config' => array(
        'type' => 'input',
        'size' => 30,
        'eval' => 'trim'
      ),
    ),
    'ratingtext' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating.ratingtext',
      'config' => array(
          'type' => 'text',
          #'renderType' => 't3editor',
          #'format' => 'html',
          'cols' => 30,
          'rows' => 5,
      ),
    ),
    'legals' => array(
      'exclude' => 1,
      'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_rating.legals',
      'config' => array(
        'type' => 'check',
        'eval' => 'required'
      ),
    ),
	),
);
