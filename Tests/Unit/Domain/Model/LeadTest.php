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
 * Test case for class \JS\Marketplace\Domain\Model\Lead.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class LeadTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \JS\Marketplace\Domain\Model\Lead
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \JS\Marketplace\Domain\Model\Lead();
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
	public function getEmailReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail()
	{
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMessageReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getMessage()
		);
	}

	/**
	 * @test
	 */
	public function setMessageForStringSetsMessage()
	{
		$this->subject->setMessage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'message',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getArticleReturnsInitialValueForArticle()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getArticle()
		);
	}

	/**
	 * @test
	 */
	public function setArticleForArticleSetsArticle()
	{
		$articleFixture = new \JS\Marketplace\Domain\Model\Article();
		$this->subject->setArticle($articleFixture);

		$this->assertAttributeEquals(
			$articleFixture,
			'article',
			$this->subject
		);
	}
}
