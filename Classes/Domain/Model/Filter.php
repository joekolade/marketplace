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
 * Filter
 */
class Filter extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{

    /**
     * searchphrase
     *
     * @var string
     */
    protected $searchphrase = '';

    /**
     * country
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Country>
     * @lazy
     */
    protected $country = null;
    
    /**
     * productgroup
     *
     * @var \JS\Marketplace\Domain\Model\Productgroup
     * @lazy
     */
    protected $productgroup = null;
    
    /**
     * productsubgroup
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup>
     * @lazy
     */
    protected $productsubgroup = null;
    
    /**
     * producer
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Producer>
     * @lazy
     */
    protected $producer = null;

    /**
     * sortby
     *
     * @var int
     */
    protected $sortby = 0;

    /**
     * options
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Option>
     * @cascade remove
     */
    protected $options = null;
    
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
        $this->country = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->productsubgroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->producer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->options = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the searchphrase
     *
     * @return string $searchphrase
     */
    public function getSearchphrase()
    {
        return $this->searchphrase;
    }
    
    /**
     * Sets the searchphrase
     *
     * @param string $searchphrase
     * @return void
     */
    public function setSearchphrase($searchphrase)
    {
        $this->searchphrase = $searchphrase;
    }
    
    /**
     * Adds a Country
     *
     * @param \JS\Marketplace\Domain\Model\Country $country
     * @return void
     */
    public function addCountry(\JS\Marketplace\Domain\Model\Country $country)
    {
        $this->country->attach($country);
    }
    
    /**
     * Removes a Country
     *
     * @param \JS\Marketplace\Domain\Model\Country $countryToRemove The Country to be removed
     * @return void
     */
    public function removeCountry(\JS\Marketplace\Domain\Model\Country $countryToRemove)
    {
        $this->country->detach($countryToRemove);
    }
    
    /**
     * Returns the country
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Country> $country
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Sets the country
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Country> $country
     * @return void
     */
    public function setCountry(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $country)
    {
        $this->country = $country;
    }
    
    /**
     * Returns the productgroup
     *
     * @return \JS\Marketplace\Domain\Model\Productgroup $productgroup
     */
    public function getProductgroup()
    {
        return $this->productgroup;
    }
    
    /**
     * Sets the productgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productgroup $productgroup
     * @return void
     */
    public function setProductgroup(\JS\Marketplace\Domain\Model\Productgroup $productgroup = NULL)
    {
        if(!$productgroup) {
            $this->productgroup = NULL;
            $this->productsubgroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        else {
            $this->productgroup = $productgroup;
        }   
    }
    
    /**
     * Adds a Productsubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup
     * @return void
     */
    public function addProductsubgroup(\JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup)
    {
        $this->productsubgroup->attach($productsubgroup);
    }
    
    /**
     * Removes a Productsubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroupToRemove The Productsubgroup to be removed
     * @return void
     */
    public function removeProductsubgroup(\JS\Marketplace\Domain\Model\Productsubgroup $productsubgroupToRemove)
    {
        $this->productsubgroup->detach($productsubgroupToRemove);
    }
    
    /**
     * Returns the productsubgroup
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup> $productsubgroup
     */
    public function getProductsubgroup()
    {
        return $this->productsubgroup;
    }
    
    /**
     * Sets the productsubgroup
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Productsubgroup> $productsubgroup
     * @return void
     */
    public function setProductsubgroup(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $productsubgroup = NULL)
    {
        $this->productsubgroup = $productsubgroup;
    }
    
    /**
     * Adds a Producer
     *
     * @param \JS\Marketplace\Domain\Model\Producer $producer
     * @return void
     */
    public function addProducer(\JS\Marketplace\Domain\Model\Producer $producer)
    {
        $this->producer->attach($producer);
    }
    
    /**
     * Removes a Producer
     *
     * @param \JS\Marketplace\Domain\Model\Producer $producerToRemove The Producer to be removed
     * @return void
     */
    public function removeProducer(\JS\Marketplace\Domain\Model\Producer $producerToRemove)
    {
        $this->producer->detach($producerToRemove);
    }
    
    /**
     * Returns the producer
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Producer> $producer
     */
    public function getProducer()
    {
        return $this->producer;
    }
    
    /**
     * Sets the producer
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Producer> $producer
     * @return void
     */
    public function setProducer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $producer = NULL)
    {
        $this->producer = $producer;
    }

    /**
     * Gets the sortby.
     *
     * @return integer
     */
    public function getSortby()
    {
        return $this->sortby;
    }

    /**
     * Sets the sortby.
     *
     * @param integer $sortby the sortby
     * @return void
     */
    public function setSortby($sortby)
    {
        $this->sortby = $sortby;
    }

    /**
     * Adds a Option
     *
     * @param \JS\Marketplace\Domain\Model\Option $option
     * @return void
     */
    public function addOption(\JS\Marketplace\Domain\Model\Option $option)
    {
        $this->options->attach($option);
    }

    /**
     * Removes a Option
     *
     * @param \JS\Marketplace\Domain\Model\Option $optionToRemove The Option to be removed
     * @return void
     */
    public function removeOption(\JS\Marketplace\Domain\Model\Option $optionToRemove)
    {
        $this->options->detach($optionToRemove);
    }

    /**
     * Returns the options
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Option> $options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Option> $options
     * @return void
     */
    public function setOptions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $options)
    {
        $this->options = $options;
    }

}
