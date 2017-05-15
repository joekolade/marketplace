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
 * Article
 */
class Article extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * price
     *
     * @var float
     * @validate NotEmpty
     */
    protected $price = 0.0;

    /**
     * currency
     *
     * @var \JS\Marketplace\Domain\Model\Currency
     */
    protected $currency = '';
    
    /**
     * dealer
     *
     * @var \JS\Marketplace\Domain\Model\Dealer
     */
    protected $dealer = null;
    
    /**
     * product
     *
     * @var \JS\Marketplace\Domain\Model\Product
     * @lazy
     */
    protected $product = null;
    
    /**
     * Returns the price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Sets the price
     *
     * @param float $price
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    /**
     * Returns the comparablePrice
     *
     * @return float $comparablePrice
     */
    public function getComparablePrice()
    {
        return $this->price * $this->getCurrency()->getExchangerate();
    }
    
    /**
     * Returns the currency
     *
     * @return \JS\Marketplace\Domain\Model\Currency $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    
    /**
     * Sets the currency
     *
     * @param \JS\Marketplace\Domain\Model\Currency $currency
     * @return void
     */
    public function setCurrency(\JS\Marketplace\Domain\Model\Currency $currency)
    {
        $this->currency = $currency;
    }
    
    /**
     * Returns the dealer
     *
     * @return \JS\Marketplace\Domain\Model\Dealer $dealer
     */
    public function getDealer()
    {
        return $this->dealer;
    }
    
    /**
     * Sets the dealer
     *
     * @param \JS\Marketplace\Domain\Model\Dealer $dealer
     * @return void
     */
    public function setDealer(\JS\Marketplace\Domain\Model\Dealer $dealer)
    {
        $this->dealer = $dealer;
    }
    
    /**
     * Returns the product
     *
     * @return \JS\Marketplace\Domain\Model\Product $product
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /**
     * Sets the product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @return void
     */
    public function setProduct(\JS\Marketplace\Domain\Model\Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * Returns the country
     *
     * @return \JS\Marketplace\Domain\Model\Country $country
     */
    public function getCountry()
    {
        return $this->dealer->getCountry();
    }

}
