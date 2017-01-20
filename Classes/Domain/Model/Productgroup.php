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
 * Productgroup
 */
class Productgroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';
    
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
     * productsubgroups
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup>
     * @cascade remove
     * @lazy
     */
    protected $productsubgroups = null;
    
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
        $this->productsubgroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Adds a Productsubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup
     * @return void
     */
    public function addProductsubgroup(\JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup)
    {
        $this->productsubgroups->attach($productsubgroup);
    }
    
    /**
     * Removes a Productsubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroupToRemove The Productsubgroup to be removed
     * @return void
     */
    public function removeProductsubgroup(\JS\Marketplace\Domain\Model\Productsubgroup $productsubgroupToRemove)
    {
        $this->productsubgroups->detach($productsubgroupToRemove);
    }
    
    /**
     * Returns the productsubgroups
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup> $productsubgroups
     */
    public function getProductsubgroups()
    {
        return $this->productsubgroups;
    }
    
    /**
     * Sets the productsubgroups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup> $productsubgroups
     * @return void
     */
    public function setProductsubgroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $productsubgroups)
    {
        $this->productsubgroups = $productsubgroups;
    }
    
    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
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

}
