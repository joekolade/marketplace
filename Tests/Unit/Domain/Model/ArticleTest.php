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
 * Test case for class \JS\Marketplace\Domain\Model\Article.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class ArticleTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Article
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Article();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat()
	{
		$this->assertSame(
			0.0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice()
	{
		$this->subject->setPrice(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'price',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getDealerReturnsInitialValueForDealer()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getDealer()
		);
	}

	/**
	 * @test
	 */
	public function setDealerForDealerSetsDealer()
	{
		$dealerFixture = new \JS\Marketplace\Domain\Model\Dealer();
		$this->subject->setDealer($dealerFixture);

		$this->assertAttributeEquals(
			$dealerFixture,
			'dealer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProductReturnsInitialValueForProduct()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getProduct()
		);
	}

	/**
	 * @test
	 */
	public function setProductForProductSetsProduct()
	{
		$productFixture = new \JS\Marketplace\Domain\Model\Product();
		$this->subject->setProduct($productFixture);

		$this->assertAttributeEquals(
			$productFixture,
			'product',
			$this->subject
		);
	}
}
