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
 * Currencies
 */
class Currency extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';

    /**
     * short
     *
     * @var string
     * @validate NotEmpty
     */
    protected $short = '';
    
    /**
     * exchangerate
     *
     * @var float
     * @validate NotEmpty
     */
    protected $exchangerate = 1;
    
    /**
     * articles
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Article>
     * @lazy
     */
    protected $articles = null;
    
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
     * Returns the short
     *
     * @return string $short
     */
    public function getShort()
    {
        return $this->short;
    }
    
    /**
     * Sets the short
     *
     * @param string $short
     * @return void
     */
    public function setShort($short)
    {
        $this->short = $short;
    }
    
    /**
     * Returns the exchangerate
     *
     * @return string $exchangerate
     */
    public function getExchangerate()
    {
        return $this->exchangerate;
    }
    
    /**
     * Sets the exchangerate
     *
     * @param string $exchangerate
     * @return void
     */
    public function setExchangerate($exchangerate)
    {
        $this->exchangerate = $exchangerate;
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

}
