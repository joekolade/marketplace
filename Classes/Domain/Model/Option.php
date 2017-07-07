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
    protected $optionselect = null;

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
     * Returns the optionselect
     *
     * @return \JS\Marketplace\Domain\Model\Select $optionselect
     */
    public function getOptionselect()
    {
        return $this->optionselect;
    }

    /**
     * Sets the optionselect
     *
     * @param \JS\Marketplace\Domain\Model\Select $optionselect
     * @return void
     */
    public function setOptionselect(\JS\Marketplace\Domain\Model\Select $optionselect)
    {
        $this->optionselect = $optionselect;
    }
}
