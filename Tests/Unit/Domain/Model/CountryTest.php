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
 * Test case for class \JS\Marketplace\Domain\Model\Country.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class CountryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Country
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Country();
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
	public function getDealersReturnsInitialValueForDealer()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDealers()
		);
	}

	/**
	 * @test
	 */
	public function setDealersForObjectStorageContainingDealerSetsDealers()
	{
		$dealer = new \JS\Marketplace\Domain\Model\Dealer();
		$objectStorageHoldingExactlyOneDealers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDealers->attach($dealer);
		$this->subject->setDealers($objectStorageHoldingExactlyOneDealers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDealers,
			'dealers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDealerToObjectStorageHoldingDealers()
	{
		$dealer = new \JS\Marketplace\Domain\Model\Dealer();
		$dealersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$dealersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($dealer));
		$this->inject($this->subject, 'dealers', $dealersObjectStorageMock);

		$this->subject->addDealer($dealer);
	}

	/**
	 * @test
	 */
	public function removeDealerFromObjectStorageHoldingDealers()
	{
		$dealer = new \JS\Marketplace\Domain\Model\Dealer();
		$dealersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$dealersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($dealer));
		$this->inject($this->subject, 'dealers', $dealersObjectStorageMock);

		$this->subject->removeDealer($dealer);

	}

	/**
	 * @test
	 */
	public function getContinentReturnsInitialValueForContinent()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getContinent()
		);
	}

	/**
	 * @test
	 */
	public function setContinentForContinentSetsContinent()
	{
		$continentFixture = new \JS\Marketplace\Domain\Model\Continent();
		$this->subject->setContinent($continentFixture);

		$this->assertAttributeEquals(
			$continentFixture,
			'continent',
			$this->subject
		);
	}
}
