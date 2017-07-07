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
 * Option
 */
class Option extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * value
     *
     * @var string
     */
    protected $value = '';

    /**
     * filtergroup
     *
     * @var \JS\Marketplace\Domain\Model\Filtergroup
     */
    protected $filtergroup = null;

    /**
     * filtersubgroup
     *
     * @var \JS\Marketplace\Domain\Model\Filtersubgroup
     */
    protected $filtersubgroup = null;

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
     * Returns the value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the filtergroup
     *
     * @return \JS\Marketplace\Domain\Model\Filtergroup filtergroup
     */
    public function getFiltergroup()
    {
        return $this->filtergroup;
    }

    /**
     * Sets the filtergroup
     *
     * @param \JS\Marketplace\Domain\Model\Filtergroup $filtergroup
     * @return void
     */
    public function setFiltergroup(\JS\Marketplace\Domain\Model\Filtergroup $filtergroup)
    {
        $this->filtergroup = $filtergroup;
    }

    /**
     * Returns the filtersubgroup
     *
     * @return \JS\Marketplace\Domain\Model\Filtersubgroup filtersubgroup
     */
    public function getFiltersubgroup()
    {
        return $this->filtersubgroup;
    }

    /**
     * Sets the filtersubgroup
     *
     * @param \JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroup
     * @return void
     */
    public function setFiltersubgroup(\JS\Marketplace\Domain\Model\Filtersubgroup $filtersubgroup)
    {
        $this->filtersubgroup = $filtersubgroup;
    }
}
