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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * hidden
     *
     * @var boolean
     */
    protected $hidden = TRUE;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * teaser
     *
     * @var string
     */
    protected $teaser = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * contentright
     *
     * @var string
     */
    protected $contentright = '';

    /**
     * contentleft
     *
     * @var string
     */
    protected $contentleft = '';

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $images = null;

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
     * @var \JS\Marketplace\Domain\Model\Productsubgroup
     * @lazy
     */
    protected $productsubgroup = null;

    /**
     * articles
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Article>
     * @cascade remove
     */
    protected $articles = null;

    /**
     * producer
     *
     * @var \JS\Marketplace\Domain\Model\Producer
     */
    protected $producer = null;

    /**
     * ratings
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Rating>
     * @cascade remove
     * @lazy
     */
    protected $ratings = null;

    /**
     * proposinguser
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @lazy
     */
    protected $proposinguser = null;

    /**
     * averagerating
     *
     * @var float
     */
    protected $averagerating = 0;

    /**
     * category
     *
     * @var \JS\Marketplace\Domain\Model\Category
     */
    protected $category = null;

    /**
     * options
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Option>
     */
    protected $options = null;

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
        $this->productgroup = $productgroup;
    }

    /**
     * Returns the productsubgroup
     *
     * @return \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup
     */
    public function getProductsubgroup()
    {
        return $this->productsubgroup;
    }

    /**
     * Sets the productsubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup
     * @return void
     */
    public function setProductsubgroup(\JS\Marketplace\Domain\Model\Productsubgroup $productsubgroup)
    {
        $this->productsubgroup = $productsubgroup;
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
     * Returns the teaser
     *
     * @return string $teaser
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * Sets the teaser
     *
     * @param string $teaser
     * @return void
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the contentright
     *
     * @return string $contentright
     */
    public function getContentright()
    {
        return $this->contentright;
    }

    /**
     * Sets the contentright
     *
     * @param string $contentright
     * @return void
     */
    public function setContentright($contentright)
    {
        $this->contentright = $contentright;
    }

    /**
     * Returns the contentleft
     *
     * @return string $contentleft
     */
    public function getContentleft()
    {
        return $this->contentleft;
    }

    /**
     * Sets the contentleft
     *
     * @param string $contentleft
     * @return void
     */
    public function setContentleft($contentleft)
    {
        $this->contentleft = $contentleft;
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images)
    {
        $this->images = $images;
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
        $this->articles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->ratings = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->options = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Article
     *
     * @param \JS\Marketplace\Domain\Model\Article $article
     * @return void
     */
    public function addArticle(\JS\Marketplace\Domain\Model\Article $article)
    {
        $this->articles->attach($article);
    }

    /**
     * Removes a Article
     *
     * @param \JS\Marketplace\Domain\Model\Article $articleToRemove The Article to be removed
     * @return void
     */
    public function removeArticle(\JS\Marketplace\Domain\Model\Article $articleToRemove)
    {
        $this->articles->detach($articleToRemove);
    }

    /**
     * Returns the articles
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Article> $articles
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Sets the articles
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Article> $articles
     * @return void
     */
    public function setArticles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Returns the producer
     *
     * @return \JS\Marketplace\Domain\Model\Producer $producer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Sets the producer
     *
     * @param \JS\Marketplace\Domain\Model\Producer $producer
     * @return void
     */
    public function setProducer(\JS\Marketplace\Domain\Model\Producer $producer = NULL)
    {
        $this->producer = $producer;
    }


    /**
     * Gets the ratings.
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Rating>
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Sets the ratings.
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Rating> $ratings the ratings
     * @return void
     */
    protected function setRatings(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * Gets the proposinguser.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getProposinguser()
    {
        return $this->proposinguser;
    }

    /**
     * Sets the proposinguser.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @return void
     */
    public function setProposinguser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $proposinguser)
    {
        $this->proposinguser = $proposinguser;
    }

    public function getOverallRating()
    {
        if(!count($this->ratings)){
            return false;
        }
        $oa = 0;

        $this->ratings->rewind();
        for($i=0;$i<count($this->ratings);$i++){
            $rating =  $this->ratings->current();
            $oa += $rating->getCriteria1() + $rating->getCriteria2() + $rating->getCriteria3();
            $this->ratings->next();
        }

        return ($oa / (count($this->ratings) * 3));
    }

    /**
     * Returns the averagerating
     *
     * @return string $averagerating
     */
    public function getAveragerating()
    {
        return $this->averagerating;
    }

    /**
     * Sets the averagerating
     *
     * @param string $averagerating
     * @return void
     */
    public function setAveragerating($averagerating)
    {
        $this->averagerating = $averagerating;
    }

    public function getAvailablein(){
        return array('Egypt');
    }


    /**
     * Returns the category
     *
     * @return \JS\Marketplace\Domain\Model\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the category
     *
     * @param \JS\Marketplace\Domain\Model\Category|NULL $category
     * @return void
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
