<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'JS.' . $_EXTKEY,
	'Articlesearch',
	array(
		'Product' => 'list, show',
		'Article' => 'contact, sendlead',
		
	),
	// non-cacheable actions
	array(
		'Product' => 'list',
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

// Register TCA Eval
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['Double2With4DecimalsFormat'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('marketplace', 'Classes/Formevals/Double2With4DecimalsFormat.php');

// cHash
$GLOBALS['TYPO3CONF_VARS']['FE']['cacheHash']['cHashExcludedParameters'] .= ',tx_marketplace_articlesearch[lead],tx_marketplace_articlesearch[filter],tx_marketplace_ratingsearch[lead],tx_marketplace_ratingsearch[filter]';
