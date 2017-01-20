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
 * Test case for class \JS\Marketplace\Domain\Model\Product.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class ProductTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Product
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Product();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForFileReference()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getImages()
		);
	}

	/**
	 * @test
	 */
	public function setImagesForFileReferenceSetsImages()
	{
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImages($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'images',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductgroupReturnsInitialValueForProductgroup()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getProductgroup()
		);
	}

	/**
	 * @test
	 */
	public function setProductgroupForProductgroupSetsProductgroup()
	{
		$productgroupFixture = new \JS\Marketplace\Domain\Model\Productgroup();
		$this->subject->setProductgroup($productgroupFixture);

		$this->assertAttributeEquals(
			$productgroupFixture,
			'productgroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductsubgroupReturnsInitialValueForProductsubgroup()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getProductsubgroup()
		);
	}

	/**
	 * @test
	 */
	public function setProductsubgroupForProductsubgroupSetsProductsubgroup()
	{
		$productsubgroupFixture = new \JS\Marketplace\Domain\Model\Productsubgroup();
		$this->subject->setProductsubgroup($productsubgroupFixture);

		$this->assertAttributeEquals(
			$productsubgroupFixture,
			'productsubgroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getArticlesReturnsInitialValueForArticle()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getArticles()
		);
	}

	/**
	 * @test
	 */
	public function setArticlesForObjectStorageContainingArticleSetsArticles()
	{
		$article = new \JS\Marketplace\Domain\Model\Article();
		$objectStorageHoldingExactlyOneArticles = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneArticles->attach($article);
		$this->subject->setArticles($objectStorageHoldingExactlyOneArticles);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneArticles,
			'articles',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addArticleToObjectStorageHoldingArticles()
	{
		$article = new \JS\Marketplace\Domain\Model\Article();
		$articlesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$articlesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($article));
		$this->inject($this->subject, 'articles', $articlesObjectStorageMock);

		$this->subject->addArticle($article);
	}

	/**
	 * @test
	 */
	public function removeArticleFromObjectStorageHoldingArticles()
	{
		$article = new \JS\Marketplace\Domain\Model\Article();
		$articlesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$articlesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($article));
		$this->inject($this->subject, 'articles', $articlesObjectStorageMock);

		$this->subject->removeArticle($article);

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
