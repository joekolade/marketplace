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
 * Test case for class \JS\Marketplace\Domain\Model\Productsubgroup.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class ProductsubgroupTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Productsubgroup
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Productsubgroup();
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
	public function getImageReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage()
	{
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductsReturnsInitialValueForProduct()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getProducts()
		);
	}

	/**
	 * @test
	 */
	public function setProductsForObjectStorageContainingProductSetsProducts()
	{
		$product = new \JS\Marketplace\Domain\Model\Product();
		$objectStorageHoldingExactlyOneProducts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneProducts->attach($product);
		$this->subject->setProducts($objectStorageHoldingExactlyOneProducts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneProducts,
			'products',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addProductToObjectStorageHoldingProducts()
	{
		$product = new \JS\Marketplace\Domain\Model\Product();
		$productsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$productsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($product));
		$this->inject($this->subject, 'products', $productsObjectStorageMock);

		$this->subject->addProduct($product);
	}

	/**
	 * @test
	 */
	public function removeProductFromObjectStorageHoldingProducts()
	{
		$product = new \JS\Marketplace\Domain\Model\Product();
		$productsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$productsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($product));
		$this->inject($this->subject, 'products', $productsObjectStorageMock);

		$this->subject->removeProduct($product);

	}
}
