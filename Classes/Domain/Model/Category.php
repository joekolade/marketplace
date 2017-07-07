<?php
namespace JS\Marketplace\Domain\Model;

/***
 *
 * This file is part of the "Marketplace" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Joe Schäfer
 *
 ***/

/**
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * filtergroups
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtergroup>
     * @cascade remove
     */
    protected $filtergroups = null;

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
        $this->filtergroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Select
     *
     * @param \JS\Marketplace\Domain\Model\Filtergroup $filtergroup
     * @return void
     */
    public function addFiltergroup(\JS\Marketplace\Domain\Model\Filtergroup $filtergroup)
    {
        $this->filtergroups->attach($filtergroup);
    }

    /**
     * Removes a Select
     *
     * @param \JS\Marketplace\Domain\Model\Filtergroup $filtergroupToRemove The Filtergroup to be removed
     * @return void
     */
    public function removeFiltergroup(\JS\Marketplace\Domain\Model\Filtergroup $filtergroupToRemove)
    {
        $this->filtergroups->detach($filtergroupToRemove);
    }

    /**
     * Returns the filtergroups
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtergroup> filtergroups
     */
    public function getFiltergroups()
    {
        return $this->filtergroups;
    }

    /**
     * Sets the filtergroups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtergroup> $filtergroups
     * @return void
     */
    public function setFiltergroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $filtergroups)
    {
        $this->filtergroups = $filtergroups;
    }
}
