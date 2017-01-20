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
 * Countries
 */
class Country extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';
    
    /**
     * dealers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Dealer>
     * @lazy
     */
    protected $dealers = null;
    
    /**
     * continent
     *
     * @var \JS\Marketplace\Domain\Model\Continent
     * @lazy
     */
    protected $continent = null;
    
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
        $this->dealers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Adds a Dealer
     *
     * @param \JS\Marketplace\Domain\Model\Dealer $dealer
     * @return void
     */
    public function addDealer(\JS\Marketplace\Domain\Model\Dealer $dealer)
    {
        $this->dealers->attach($dealer);
    }
    
    /**
     * Removes a Dealer
     *
     * @param \JS\Marketplace\Domain\Model\Dealer $dealerToRemove The Dealer to be removed
     * @return void
     */
    public function removeDealer(\JS\Marketplace\Domain\Model\Dealer $dealerToRemove)
    {
        $this->dealers->detach($dealerToRemove);
    }
    
    /**
     * Returns the dealers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Dealer> $dealers
     */
    public function getDealers()
    {
        return $this->dealers;
    }
    
    /**
     * Sets the dealers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Dealer> $dealers
     * @return void
     */
    public function setDealers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dealers)
    {
        $this->dealers = $dealers;
    }
    
    /**
     * Returns the continent
     *
     * @return \JS\Marketplace\Domain\Model\Continent $continent
     */
    public function getContinent()
    {
        return $this->continent;
    }
    
    /**
     * Sets the continent
     *
     * @param \JS\Marketplace\Domain\Model\Continent $continent
     * @return void
     */
    public function setContinent(\JS\Marketplace\Domain\Model\Continent $continent)
    {
        $this->continent = $continent;
    }

}
