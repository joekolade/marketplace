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
 * Select
 */
class Filtergroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * type
     *
     * @var int
     */
    protected $type = 0;

    /**
     * output
     *
     * @var string
     */
    protected $output = '';

    /**
     * options
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Option>
     * @cascade remove
     */
    protected $options = null;

    /**
     * filtersubgroups
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtersubgroup>
     * @cascade remove
     */
    protected $filtersubgroups = null;

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
        $this->options = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->filtersubgroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the type
     *
     * @return int $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param int $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
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

    /**
     * Returns the output
     *
     * @return string $output
     */
    public function getOutput()
    {
        return $this->output ? $this->output : $this->title;
    }

    /**
     * Sets the output
     *
     * @param string $output
     * @return void
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * Adds a Selectgroup
     *
     * @param \JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroup
     * @return void
     */
    public function addFiltersubgroup(\JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroup)
    {
        $this->filtersubgroups->attach($filtersubgroup);
    }

    /**
     * Removes a Selectgroup
     *
     * @param \JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroupToRemove The Filtersubgroup to be removed
     * @return void
     */
    public function removeFiltersubgroup(\JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroupToRemove)
    {
        $this->filtersubgroups->detach($filtersubgroupToRemove);
    }

    /**
     * Returns the filtersubgroups
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtersubgroup> filtersubgroups
     */
    public function getFiltersubgroups()
    {
        return $this->filtersubgroups;
    }

    /**
     * Sets the filtersubgroups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JS\Marketplace\Domain\Model\Filtersubgroup> $filtersubgroups
     * @return void
     */
    public function setFiltersubgroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $filtersubgroups)
    {
        $this->filtersubgroups = $filtersubgroups;
    }
}
