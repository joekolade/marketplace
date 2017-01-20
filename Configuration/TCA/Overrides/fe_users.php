<?php
if (!defined('TYPO3_MODE')) {
        die ('Access denied.');
}

// 
// Extend fe_users
// 
// \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('fe_users');
$addColumnArray = array( 
    'legals' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.legals',
        'config' => array(
            'type' => 'check',
            'default' => 0
        ),
    ),
    'hash' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.hash',
        'config' => array(
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ),
    ),
    'confirmpassword' => array(
        'exclude' => 0,
        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.confirmpassword',
        'config' => array(
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ),
    ),
    'gender' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.gender',
        'config' => array(
            'type' => 'radio',
            'items' => array(
                Array('LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.gender.male', '1'),
                Array('LLL:EXT:marketplace/Resources/Private/Language/locallang_db.xlf:tx_marketplace_domain_model_user.gender.female', '2')
            ),
        )
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'fe_users',
        $addColumnArray
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'fe_users',
        'legals, gender, hash'
);
