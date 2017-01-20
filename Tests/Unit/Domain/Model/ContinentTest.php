<?php

namespace JS\Marketplace\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Joe Schäfer <joe@schaefer-webentwicklung.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \JS\Marketplace\Domain\Model\Continent.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class ContinentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Continent
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Continent();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName()
	{
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCountriesReturnsInitialValueForCountry()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCountries()
		);
	}

	/**
	 * @test
	 */
	public function setCountriesForObjectStorageContainingCountrySetsCountries()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$objectStorageHoldingExactlyOneCountries = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCountries->attach($country);
		$this->subject->setCountries($objectStorageHoldingExactlyOneCountries);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCountries,
			'countries',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCountryToObjectStorageHoldingCountries()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$countriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$countriesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($country));
		$this->inject($this->subject, 'countries', $countriesObjectStorageMock);

		$this->subject->addCountry($country);
	}

	/**
	 * @test
	 */
	public function removeCountryFromObjectStorageHoldingCountries()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$countriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$countriesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($country));
		$this->inject($this->subject, 'countries', $countriesObjectStorageMock);

		$this->subject->removeCountry($country);

	}
}
