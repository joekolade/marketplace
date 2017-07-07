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
 * Dealer
 */
class Dealer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';
    
    /**
     * email
     *
     * @var string
     * @validate NotEmpty
     */
    protected $email = '';
    
    /**
     * address
     *
     * @var string
     */
    protected $address = '';
    
    /**
     * Country in which the dealer is
     *
     * @var \JS\Marketplace\Domain\Model\Country
     */
    protected $country = null;
    
    /**
     * fob
     *
     * @var string
     */
    protected $fob = '';
    
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
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns the address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Sets the address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    /**
     * Returns the country
     *
     * @return \JS\Marketplace\Domain\Model\Country country
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Sets the country
     *
     * @param \JS\Marketplace\Domain\Model\Country $country
     * @return void
     */
    public function setCountry(\JS\Marketplace\Domain\Model\Country $country)
    {
        $this->country = $country;
    }
    
    /**
     * Returns the fob
     *
     * @return string $fob
     */
    public function getFob()
    {
        return $this->fob;
    }
    
    /**
     * Sets the fob
     *
     * @param string $fob
     * @return void
     */
    public function setFob($fob)
    {
        $this->fob = $fob;
    }
    
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
        
    }

}
