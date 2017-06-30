<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => true,

        'requestUpdate' => 'category',

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,teaser,description,contentright,contentleft,images,productgroup,productsubgroup,articles,producer,ratings,proposinguser,category, options',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('marketplace') . 'Resources/Public/Icons/tx_marketplace_domain_model_product.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, teaser, description, contentright, contentleft, images, productgroup, productsubgroup, producer, proposinguser, articles, ratings, category, options',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, productgroup, productsubgroup, producer, proposinguser, articles, ratings, --div--;Content, teaser, description, contentleft, contentright, images, --div--;Relations, category, options, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
                'default' => 0,
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
                'foreign_table' => 'tx_marketplace_domain_model_product',
                'foreign_table_where' => 'AND tx_marketplace_domain_model_product.pid=###CURRENT_PID### AND tx_marketplace_domain_model_product.sys_language_uid IN (-1,0)',
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

        'title' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'teaser' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.teaser',
            'config' => array(
                'type' => 'text',
                #'renderType' => 't3editor',
                #'format' => 'html',
                'cols' => 30,
                'rows' => 5,
            ),
        ),
        'description' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext[]',
        ),
        'contentleft' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.contentleft',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext[]',
        ),
        'contentright' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.contentright',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ),
            'defaultExtras' => 'richtext[]',
        ),
        'images' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.images',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'images',
                array(
                    'appearance' => array(
                        'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                    ),
                    'foreign_types' => array(
                        '0' => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
                            'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
                        )
                    ),
                    'maxitems' => 1
                ),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ),
        'productgroup' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.productgroup',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_marketplace_domain_model_productgroup',
                'foreign_table_where' => 'AND 1=1 ORDER BY name ASC',
                'minitems' => 0,
                'maxitems' => 1,
                'eval' => 'required'
            ),
        ),
        'productsubgroup' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.productsubgroup',
            'config' => array(
                'type' => 'select',
                'items' => Array(
                    Array("-- none --", 0),
                ),
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_marketplace_domain_model_productsubgroup',
                'foreign_table_where' => 'AND 1=1 ORDER BY name ASC',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'articles' => array(
            'exclude' => 1,
            'expandSingle' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.articles',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_marketplace_domain_model_article',
                'foreign_field' => 'product',
                #'foreign_label' => 'dealer',
                'foreign_sortby' => 'sorting',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),

        ),
        'producer' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.producer',
            'config' => array(
                'type' => 'select',
                'items' => Array(
                    Array("-- none --", 0),
                ),
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_marketplace_domain_model_producer',
                'foreign_table_where' => 'AND 1=1 ORDER BY name ASC',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'ratings' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.ratings',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_marketplace_domain_model_rating',
                'foreign_field' => 'product',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),

        ),
        'proposinguser' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xml:tx_marketplace_domain_model_product.proposinguser',
            'config' => Array(
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'items' => array(
                    array('-- none --', 0),
                ),
            )
        ),
        'averagerating' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.averagerating',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'Double2With4DecimalsFormat'
            )
        ),


        'category' => [
            'exclude' => false,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.category',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_marketplace_domain_model_category',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'options' => [
            'exclude' => true,
            'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_product.options',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_marketplace_domain_model_option',
                'MM' => 'tx_marketplace_product_option_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 1,
                'enableMultiSelectFilterTextfield' => true,
                'itemsProcFunc' => 'JS\\Marketplace\\UserFunc\\TcaProcFunc->productOptions'
            ],
        ],


        // 'articles' => array(
        // 	'config' => array(
        // 		'type' => 'passthrough',
        // 	),
        // ),
        // 'productgroup' => array(
        // 	'config' => array(
        // 		'type' => 'passthrough',
        // 	),
        // ),
        // 'productsubgroup' => array(
        // 	'config' => array(
        // 		'type' => 'passthrough',
        // 	),
        // ),
        // 'producer' => array(
        // 	'config' => array(
        // 		'type' => 'passthrough',
        // 	),
        // ),
        // 'ratings' => array(
        // 	'config' => array(
        // 		'type' => 'passthrough',
        // 	),
        // ),
    ),
);
