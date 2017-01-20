<?php
namespace JS\Marketplace\Tests\Unit\Controller;
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
 * Test case for class JS\Marketplace\Controller\ArticleController.
 *
 * @author Joe Schäfer <joe@schaefer-webentwicklung.de>
 */
class ArticleControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \JS\Marketplace\Controller\ArticleController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('JS\\Marketplace\\Controller\\ArticleController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllArticlesFromRepositoryAndAssignsThemToView()
	{

		$allArticles = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$articleRepository = $this->getMock('JS\\Marketplace\\Domain\\Repository\\ArticleRepository', array('findAll'), array(), '', FALSE);
		$articleRepository->expects($this->once())->method('findAll')->will($this->returnValue($allArticles));
		$this->inject($this->subject, 'articleRepository', $articleRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('articles', $allArticles);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenArticleToView()
	{
		$article = new \JS\Marketplace\Domain\Model\Article();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('article', $article);

		$this->subject->showAction($article);
	}
}
