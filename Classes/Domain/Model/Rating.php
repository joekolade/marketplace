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
 * Ratings
 */
class Rating extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * hidden 
     * 
     * @var boolean 
     */
    protected $hidden = TRUE;
    /**
     * crdate 
     * 
     * @var int
     */
    protected $crdate;

    /**
     * Criteria 1
     *
     * @var int
     * @validate NumberRange(minimum = 1, maximum = 5)
     */
    protected $criteria1 = 0;

    /**
     * Criteria 2
     *
     * @var int
     * @validate NumberRange(minimum = 1, maximum = 5)
     */
    protected $criteria2;

    /**
     * Criteria 3
     *
     * @var int
     * @validate NumberRange(minimum = 1, maximum = 5)
     */
    protected $criteria3;
    
    /**
     * ratinguser
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $ratinguser = null;
    
    /**
     * product
     *
     * @var \JS\Marketplace\Domain\Model\Product
     */
    protected $product = null;

    /**
     * country
     *
     * @var string
     * @validate NotEmpty
     */
    protected $country = '';

    /**
     * position
     *
     * @var string
     * @validate NotEmpty
     */
    protected $position = '';
    
    /**
     * ratingtext
     *
     * @var string
     */
    protected $ratingtext = '';
    
    /**
     * legals 
     * 
     * @var boolean 
     * @validate Boolean(is=true)
     */
    protected $legals = FALSE;

    /** 
     * Returns hidden 
     * 
     * @return boolean $hidden 
     */
    public function getHidden() {
        return $this->hidden;
    }


    /**
     * Sets hidden 
     * 
     * @param boolean $hidden 
     * @return void 
     */
    public function setHidden($hidden) {    
        $this->hidden = $hidden;
    }


    /** 
     * Returns the boolean state of hidden 
     * 
     * @return boolean 
     */
    public function isHidden() {    
        return $this->getHidden();
    }

    /** 
     * Returns crdate 
     * 
     * @return int $crdate 
     */
    public function getCrdate() {
        return $this->crdate;
    }

    /**
     * Gets the Criteria 1.
     *
     * @return integer
     */
    public function getCriteria1()
    {
        return $this->criteria1;
    }

    /**
     * Sets the Criteria 1.
     *
     * @param integer $criteria1 the criteria1
     * @return void
     */
    public function setCriteria1($criteria1)
    {
        $this->criteria1 = $criteria1;
    }

    /**
     * Gets the Criteria 2.
     *
     * @return integer
     */
    public function getCriteria2()
    {
        return $this->criteria2;
    }

    /**
     * Sets the Criteria 2.
     *
     * @param integer $criteria2 the criteria2
     * @return void
     */
    public function setCriteria2($criteria2)
    {
        $this->criteria2 = $criteria2;
    }

    /**
     * Gets the Criteria 3.
     *
     * @return integer
     */
    public function getCriteria3()
    {
        return $this->criteria3;
    }

    /**
     * Sets the Criteria 3.
     *
     * @param integer $criteria3 the criteria3
     * @return void
     */
    public function setCriteria3($criteria3)
    {
        $this->criteria3 = $criteria3;
    }

    /**
     * Gets the ratinguser.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getRatinguser()
    {
        return $this->ratinguser;
    }

    /**
     * Sets the ratinguser.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @return void
     */
    public function setRatinguser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $ratinguser)
    {
        $this->ratinguser = $ratinguser;
    }

    /**
     * Gets the product.
     *
     * @return \JS\Marketplace\Domain\Model\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Sets the product.
     *
     * @param \JS\Marketplace\Domain\Model\Product $product the product
     * @return void
     */
    public function setProduct(\JS\Marketplace\Domain\Model\Product $product)
    {
        $this->product = $product;
    }
    
    /**
     * Returns the country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Sets the country
     *
     * @param string $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    
    /**
     * Returns the position
     *
     * @return string $position
     */
    public function getPosition()
    {
        return $this->position;
    }
    
    /**
     * Sets the position
     *
     * @param string $position
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
    
    /**
     * Returns the ratingtext
     *
     * @return string $ratingtext
     */
    public function getRatingtext()
    {
        return $this->ratingtext;
    }
    
    /**
     * Sets the ratingtext
     *
     * @param string $ratingtext
     * @return void
     */
    public function setRatingtext($ratingtext)
    {
        $this->ratingtext = $ratingtext;
    }

    /** 
     * Returns legals 
     * 
     * @return boolean $legals 
     */
    public function getLegals() {
        return $this->legals;
    }

    /**
     * Sets legals 
     * 
     * @param boolean $legals 
     * @return void 
     */
    public function setLegals($legals) {    
        $this->legals = $legals;
    }

    public function getAverageRating(){
        return ($this->getCriteria1() + $this->getCriteria2() + $this->getCriteria3())/3;
    }
}
