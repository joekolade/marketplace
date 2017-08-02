<?php
namespace JS\Marketplace\Controller;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use JS\Marketplace\Utility\MigrationHelper;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Joe Schäfer <joe@schaefer-webentwicklung.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * MigrationController
 */
class MigrationController extends \JS\Marketplace\Controller\AbstractController
{
    public function initializeAction()
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TSFE']->beUserLogin);

        ($GLOBALS['TSFE']->beUserLogin) || die('Access denied. Please log in!');

        parent::initializeAction();

    }

    public function migrationAction()
    {

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Migration start');

        $migrationHelper = new MigrationHelper();

        $products = $this->productRepository->findAll();

        // Clear data
        $productsCleared = $this->clearData($products);

        $categoriesSelected = 0;
        $optionsSelected = 0;


        foreach ($products as $product) {

            //
            // Set Categories by Productgroups

            $pcMap = $migrationHelper->getProductGroupsToCategories();
            $soMap = $migrationHelper->getProductSubGroupsToOptions();

            /**
             * @var \JS\Marketplace\Domain\Model\Product $product
             */
            $cat = $pcMap[$product->getProductgroup()->getUid()];

            if(!empty($cat)){
                $product->setCategory($this->categoryRepository->findByUid($cat));


                $categoriesSelected++;
            }

            //
            // Set Options by Subgroup
            if(!empty($product->getProductsubgroup())){
                $opt = $soMap[$product->getProductsubgroup()->getUid()];

                if(!empty($opt)) {
                    $product->addOption($this->optionRepository->findByUid($opt));
                    $optionsSelected++;
                }
            }

            if($product->_isDirty()){
                $this->productRepository->update($product);
            }

        }

        $message = $categoriesSelected.' Categories and ' . $optionsSelected  . ' Options have been set to products';
        
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($message, 'Migration Finished!');

    }

    /*
     * Clear before migrated data
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Product> $products
     *
     * @return integer
     */
    public function clearData($products)
    {
        $i = 0;
        foreach ($products as $product){
            $product->setCategory(NULL);
            $product->setOptions(new ObjectStorage());

            $this->productRepository->update($product);
            $i++;
        }

        return $i;
    }

}