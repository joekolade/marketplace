<?php
namespace JS\Marketplace\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Joe Schäfer <joe@schaefer-webentwicklung.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * The repository for Articles
 */
class ArticleRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'comparablePrice' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        'currency.exchangerate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * dealerRepository
     *
     * @var \JS\Marketplace\Domain\Repository\DealerRepository
     * @inject
     */
    protected $dealerRepository = NULL;

    /**
     * productRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository = NULL;

    /**
     * Filtering articles
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @return [type]         [description]
     */
    public function findByFilter(\JS\Marketplace\Domain\Model\Filter $filter)
    {
      $query = $this->createQuery();
      // Constraints initialisieren
      $constraints = array();
      $filterActive = false;

      // 
      // Filter by country
      // -------------------------------------------
      // 
      if(count($filter->getCountry())){
        $filterActive = true;
        
        // Get possible dealers
        $dealer = array();
        foreach ($filter->getCountry() as $c) {
          $d = $this->dealerRepository->findByCountry($c);
          if(count($d)) {
            foreach ($d as $key => $value) {
              array_push($dealer, $value);
            }
          }
        }
        // Filter by dealers
        if($dealer) {
          $constraints[] = $query->in('dealer', $dealer);
        }
      }

      if(count($constraints)){
        $query->matching($query->logicalAnd($constraints));
      }
      else if ($filterActive){
        // Filter active but no constraints
        return;
      }
      return $query->execute();
    }

}
