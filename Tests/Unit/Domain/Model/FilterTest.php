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
 * Test case for class \JS\Marketplace\Domain\Model\Filter.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class FilterTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Filter
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Filter();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForCountry()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForObjectStorageContainingCountrySetsCountry()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$objectStorageHoldingExactlyOneCountry = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCountry->attach($country);
		$this->subject->setCountry($objectStorageHoldingExactlyOneCountry);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCountry,
			'country',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCountryToObjectStorageHoldingCountry()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$countryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$countryObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($country));
		$this->inject($this->subject, 'country', $countryObjectStorageMock);

		$this->subject->addCountry($country);
	}

	/**
	 * @test
	 */
	public function removeCountryFromObjectStorageHoldingCountry()
	{
		$country = new \JS\Marketplace\Domain\Model\Country();
		$countryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$countryObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($country));
		$this->inject($this->subject, 'country', $countryObjectStorageMock);

		$this->subject->removeCountry($country);

	}

	/**
	 * @test
	 */
	public function getProductgroupReturnsInitialValueForProductgroup()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProductgroup()
		);
	}

	/**
	 * @test
	 */
	public function setProductgroupForObjectStorageContainingProductgroupSetsProductgroup()
	{
		$productgroup = new \JS\Marketplace\Domain\Model\Productgroup();
		$objectStorageHoldingExactlyOneProductgroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProductgroup->attach($productgroup);
		$this->subject->setProductgroup($objectStorageHoldingExactlyOneProductgroup);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProductgroup,
			'productgroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addProductgroupToObjectStorageHoldingProductgroup()
	{
		$productgroup = new \JS\Marketplace\Domain\Model\Productgroup();
		$productgroupObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$productgroupObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($productgroup));
		$this->inject($this->subject, 'productgroup', $productgroupObjectStorageMock);

		$this->subject->addProductgroup($productgroup);
	}

	/**
	 * @test
	 */
	public function removeProductgroupFromObjectStorageHoldingProductgroup()
	{
		$productgroup = new \JS\Marketplace\Domain\Model\Productgroup();
		$productgroupObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$productgroupObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($productgroup));
		$this->inject($this->subject, 'productgroup', $productgroupObjectStorageMock);

		$this->subject->removeProductgroup($productgroup);

	}

	/**
	 * @test
	 */
	public function getProductsubgroupReturnsInitialValueForProductsubgroup()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProductsubgroup()
		);
	}

	/**
	 * @test
	 */
	public function setProductsubgroupForObjectStorageContainingProductsubgroupSetsProductsubgroup()
	{
		$productsubgroup = new \JS\Marketplace\Domain\Model\Productsubgroup();
		$objectStorageHoldingExactlyOneProductsubgroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProductsubgroup->attach($productsubgroup);
		$this->subject->setProductsubgroup($objectStorageHoldingExactlyOneProductsubgroup);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProductsubgroup,
			'productsubgroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addProductsubgroupToObjectStorageHoldingProductsubgroup()
	{
		$productsubgroup = new \JS\Marketplace\Domain\Model\Productsubgroup();
		$productsubgroupObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$productsubgroupObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($productsubgroup));
		$this->inject($this->subject, 'productsubgroup', $productsubgroupObjectStorageMock);

		$this->subject->addProductsubgroup($productsubgroup);
	}

	/**
	 * @test
	 */
	public function removeProductsubgroupFromObjectStorageHoldingProductsubgroup()
	{
		$productsubgroup = new \JS\Marketplace\Domain\Model\Productsubgroup();
		$productsubgroupObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$productsubgroupObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($productsubgroup));
		$this->inject($this->subject, 'productsubgroup', $productsubgroupObjectStorageMock);

		$this->subject->removeProductsubgroup($productsubgroup);

	}

	/**
	 * @test
	 */
	public function getProducerReturnsInitialValueForProducer()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getProducer()
		);
	}

	/**
	 * @test
	 */
	public function setProducerForProducerSetsProducer()
	{
		$producerFixture = new \JS\Marketplace\Domain\Model\Producer();
		$this->subject->setProducer($producerFixture);

		$this->assertAttributeEquals(
			$producerFixture,
			'producer',
			$this->subject
		);
	}
}
