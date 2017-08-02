<?php
namespace JS\Marketplace\Controller;


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

    public function migrationAction()
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('Migration start');

        $migrationHelper = new MigrationHelper();

        // Clear data
        $this->clearData($this->productRepository->findAll());

    }

    /*
     * Clear before migrated data
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Product> $products
     */
    public function clearData($products)
    {
        foreach ($products as $product){
            $product->setCategory(NULL);
            $product->setOptions(new ObjectStorage());

            $this->productRepository->update($product);

            return;
        }
    }

}