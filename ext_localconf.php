<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.' . $_EXTKEY,
            'Articlesearch',
            array(
                'Product' => 'list, show, showProductRatings, ratinglist, rateProduct, sendRating, login, loginForm, showProposeProductForm, proposeProduct, adminProduct',
                'Article' => 'contact, sendlead',

            ),
            // non-cacheable actions
            array(
                'Product' => 'list, show, showProductRatings, ratinglist, rateProduct, sendRating, login, loginForm, showProposeProductForm, proposeProduct, adminProduct',
                'Article' => 'sendlead',

            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.' . $_EXTKEY,
            'Ratingsearch',
            array(
                'Product' => 'showProductRatings,ratinglist,rateProduct,sendRating,login,loginForm,showProposeProductForm,proposeProduct,adminProduct',
                'Rating' => 'reportRating, sendReport',

            ),
            // non-cacheable actions
            array(
                'Product' => 'showProductRatings,ratinglist,rateProduct,sendRating,login,loginForm,showProposeProductForm,proposeProduct,adminProduct',
                'Rating' => 'reportRating, sendReport',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.' . $_EXTKEY,
            'Registeruser',
            array(
                'Register' => 'showRegisterForm,registerUser,confirmUser',
            ),
            // non-cacheable actions
            array(
                'Register' => 'showRegisterForm,registerUser,confirmUser',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.' . $_EXTKEY,
            'Categorylist',
            array(
                // Later w/ "showProductRatings"
                'Product' => 'catList, list, show, showProductRatings, ratinglist, rateProduct, sendRating, login, loginForm, showProposeProductForm, proposeProduct, adminProduct',
                'Article' => 'contact, sendlead',
                'Migration' => 'migration',
            ),
            // non-cacheable actions
            array(
                'Product' => 'catList, list, show, showProductRatings, ratinglist, rateProduct, sendRating, login, loginForm, showProposeProductForm, proposeProduct, adminProduct',
                'Article' => 'sendlead',
                'Migration' => 'migration',
            )
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'JS.' . $_EXTKEY,
            'Recentlist',
            array(
                // Later w/ "showProductRatings"
                'Product' => 'list, listrecent, show, showProductRatings',
            ),
            // non-cacheable actions
            array(
                'Product' => '',
            )
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					projectlist {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/user_plugin_categorylist.svg
						title = LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_plugin_categorylist
						description = LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_plugin_categorylist.description
						tt_content_defValues {
							CType = list
							list_type = marketplace_categorylist
						}
					}
					recentlist {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/user_plugin_recentlist.svg
						title = LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_plugin_recentlist
						description = LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_plugin_recentlist.description
						tt_content_defValues {
							CType = list
							list_type = marketplace_recentlist
						}
					}
				}
				show = *
			}
	   }'
        );

// Register TCA Eval
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['Double2With4DecimalsFormat'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('marketplace',
    'Classes/Formevals/Double2With4DecimalsFormat.php');

// cHash
$GLOBALS['TYPO3CONF_VARS']['FE']['cacheHash']['cHashExcludedParameters'] .= ',tx_marketplace_articlesearch[lead],tx_marketplace_ratingsearch[lead],tx_marketplace_ratingsearch[filter]';

// Caching framework
if (!is_array($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY] = array();
}
// Hier ist der entscheidende Punkt! Es ist der Cache von Variablen gesetzt!
if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['frontend'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['frontend'] = 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend';
}
//if( !isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['backend'] ) ) {
//    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\DatabaseBackend';
//}
// Wie lange soll der Cache haltbar sein? (1 Stunde)
if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['options'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['options'] = array('defaultLifetime' => 3600);
}
if (!isset($GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['groups'])) {
    $GLOBALS['TYPO3_CONF_VARS'] ['SYS']['caching']['cacheConfigurations'][$_EXTKEY]['groups'] = array('pages');
}

// Add page.ts

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:marketplace/Configuration/TSconfig/page.ts">'
);
