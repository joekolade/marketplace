<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'JS.' . $_EXTKEY,
            'Articlesearch',
            'Article Search / Product list'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'JS.' . $_EXTKEY,
            'Ratingsearch',
            'Rating Search / Product list'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'JS.' . $_EXTKEY,
            'Registeruser',
            'Register user'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'JS.' . $_EXTKEY,
            'Categorylist',
            'List by category'
        );


        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($extensionName);

        $pluginName = strtolower('Articlesearch');
        $pluginSignature = $extensionName . '_' . $pluginName;
        $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
            'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/' . $pluginName . '_settings.xml');

        $pluginName = strtolower('Ratingsearch');
        $pluginSignature = $extensionName . '_' . $pluginName;
        $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
            'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/' . $pluginName . '_settings.xml');

        $pluginName = strtolower('Registeruser');
        $pluginSignature = $extensionName . '_' . $pluginName;
        $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

        $pluginName = strtolower('Categorylist');
        $pluginSignature = $extensionName . '_' . $pluginName;
        $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive';
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
            'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/' . $pluginName . '_settings.xml');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript',
            'Marketplace');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_product',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_product.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_product');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_productgroup',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_productgroup.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_productgroup');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_productsubgroup',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_productsubgroup.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_productsubgroup');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_dealer',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_dealer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_dealer');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_country',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_country.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_country');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_article',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_article.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_article');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_producer',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_producer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_producer');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_continent',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_continent.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_continent');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_filter',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_filter.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_filter');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_lead',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_lead.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_lead');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_currency',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_currency.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_currency');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_rating',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_rating.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_rating');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_category',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_category.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_category');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_select',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_select.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_select');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_marketplace_domain_model_option',
            'EXT:marketplace/Resources/Private/Language/locallang_csh_tx_marketplace_domain_model_option.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_marketplace_domain_model_option');
    },
    $_EXTKEY
);