<?php
namespace JS\Marketplace\Domain\Model;

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
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';
    
    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;
    
    /**
     * products
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Product>
     * @lazy
     */
    protected $products = null;

    /**
     * selects
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Select>
     * @cascade remove
     */
    protected $selects = null;
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->products = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->parentcategory = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->selects = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a Product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @return void
     */
    public function addProduct(\JS\Marketplace\Domain\Model\Product $product)
    {
        $this->products->attach($product);
    }
    
    /**
     * Removes a Product
     *
     * @param \JS\Marketplace\Domain\Model\Product $productToRemove The Product to be removed
     * @return void
     */
    public function removeProduct(\JS\Marketplace\Domain\Model\Product $productToRemove)
    {
        $this->products->detach($productToRemove);
    }
    
    /**
     * Returns the products
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Product> $products
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    /**
     * Sets the products
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Product> $products
     * @return void
     */
    public function setProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $products)
    {
        $this->products = $products;
    }
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Adds a Select
     *
     * @param \JS\Marketplace\Domain\Model\Select $select
     * @return void
     */
    public function addSelect(\JS\Marketplace\Domain\Model\Select $select)
    {
        $this->selects->attach($select);
    }

    /**
     * Removes a Select
     *
     * @param \JS\Marketplace\Domain\Model\Select $selectToRemove The Select to be removed
     * @return void
     */
    public function removeSelect(\JS\Marketplace\Domain\Model\Select $selectToRemove)
    {
        $this->selects->detach($selectToRemove);
    }

    /**
     * Returns the selects
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Select> $selects
     */
    public function getSelects()
    {
        return $this->selects;
    }

    /**
     * Sets the selects
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Select> $selects
     * @return void
     */
    public function setSelects(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $selects)
    {
        $this->selects = $selects;
    }

}
