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
     * selects
     *
     * @var \JS\Marketplace\Domain\Model\Select
     */
    protected $select = null;

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
     * Returns the select
     *
     * @return \JS\Marketplace\Domain\Model\Select $select
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Sets the select
     *
     * @param \JS\Marketplace\Domain\Model\Select $select
     * @return void
     */
    public function setSelect(\JS\Marketplace\Domain\Model\Select $select)
    {
        $this->select = $select;
    }
}
