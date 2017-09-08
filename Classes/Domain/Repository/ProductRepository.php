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
 * The repository for Products
 */
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
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
     * articleRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ArticleRepository
     * @inject
     */
    protected $articleRepository = NULL;

    /**
     * findAll
     *
     * @param boolean $needsArticles
     * @return [type]
     */
    public function findAll($needsArticles = FALSE)
    {
      $query = $this->createQuery();
      if($needsArticles){
        $query->matching(
          $query->greaterThanOrEqual('articles', 1)
        );
      }

      return $query->execute();
    }

    /**
     * Filtering articles
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @param boolean $needsArticles
     * @param int $offset
     * @param int $limit
     * @return [type]         [description]
     */
    public function findByFilter(
      \JS\Marketplace\Domain\Model\Filter $filter,
      $needsArticles = FALSE,
      $offset = NULL,
      $limit = NULL
    )
    {
      $query = $this->createQuery();

      // Constraints initialisieren
      $constraints = array();
      $filterActive = false;

      // Does the products need articles?
      if($needsArticles){
        $constraints[] = $query->greaterThanOrEqual('articles', 1);
      }


      //
      // get Articles/Products by filter
      // Phrase, Country, Dealer, Continent, Tradebloc
      //
      if(count($filter->getCountry())){
        $filterActive = true;

        $filteredArticles = $this->articleRepository->findByFilter($filter);

        if(count($filteredArticles)){
          $constraints[] = $query->in('uid', $filteredArticles);
        }
      }


      //
      // Filter by productgroup
      // -------------------------------------------
      //
      if(count($filter->getProductgroup())){
        $filterActive = true;

        //
        // Filter only by productsubgroup
        // if productsubgroup is set
        // -------------------------------------------
        //
        if(count($filter->getProductsubgroup())){

          $constraints[] = $query->in('productsubgroup', $filter->getProductsubgroup());
        }
        //
        // Else filter only by productgroup
        // -------------------------------------------
        //
        else if( count($filter->getProductgroup()->getProductsubgroups()) ){
          $constraints[] = $query->in('productsubgroup', $filter->getProductgroup()->getProductsubgroups());
        }
        else {
          $constraints[] = $query->equals('productgroup', $filter->getProductgroup());
        }
      }


      //
      // Filter by producer
      // -------------------------------------------
      //
      if(count($filter->getProducer())){
        $filterActive = true;
        $constraints[] = $query->in('producer', $filter->getProducer());
      }


      //
      // Filter by searchphrase
      // -------------------------------------------
      //
      if ($filter->getSearchphrase() != '') {
          $columns = 'title,teaser,description,producer.name';

          foreach (explode(',', $columns) as $key => $col) {
              foreach (explode(' ', $filter->getSearchphrase()) as $text) {
                  $c[] = $query->like($col, '%' . $text . '%');
              }
              $t[] = $query->logicalOr($query->logicalOr($c));
          }
          $constraints[] = $query->logicalOr($t);
      }



      //
      // Sort by filter
      // -------------------------------------------
      //
      switch($filter->getSortby()) {
        case 0:
          // Sort by article count
            $query->setOrderings(array(
                'articles' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
            ));
          break;
        case 1:
          // titel desc
          $query->setOrderings(array(
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
          ));
          break;
        case 2:
          // Overall rating
          $query->setOrderings(array(
            'averagerating' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
          ));
          break;
        case 3:
          // Ratings count -- sorting in Controller, since no corresponding field is available
          $query->setOrderings(array(
            // 'ratings' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
          ));
          break;
        case 4:
          // Producer title
          $query->setOrderings(array(
            'producer.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
          ));
          break;
        case 5:
          // Producer title (Z-A)
          $query->setOrderings(array(
            'producer.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
          ));
          break;
        case 6:
            // Sort by price (asc)
            // handled in controller
            break;
        case 7:
            // Sort by price (desc)
            // handled in controller
            break;
        default:
          break;
        #
        # Sorting
        # 0: no sorting (alphabetical)
        # 1: rating
        # 2: alphabet
      }

      //
      // Use given constraints
      // -------------------------------------------
      //
      if(count($constraints)){
        $query->matching($query->logicalAnd($constraints));
      }
      // else if ($filterActive){
      //   // Filter active but no constraints
      //   return;
      // }
      if($offset) $query->setOffset($offset);
      if($limit) $query->setLimit($limit);
      return $query->execute();
    }

    /**
     * Count filtered articles
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @param boolean $needsArticles
     * @return int
     */
    public function countByFilter(
      \JS\Marketplace\Domain\Model\Filter $filter,
      $needsArticles = FALSE
    )
   {
     return $this->findByFilter($filter, $needsArticles)->count();
   }

    /**
     * find all products (really)
     * @param \integer $uid
     *
     * @return [type]
     */
    public function findHiddenByUid($uid)
    {
      $query = $this->createQuery();

      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      $query->getQuerySettings()->setIgnoreEnableFields(TRUE);

      $query->matching($query->equals('uid', $uid));

      return $query->execute()->getFirst();
    }

    /**
     * find the proposed product by a user to send it to the admin crew when a user finishes registration
     * @param \JS\Marketplace\Domain\Model\User $ratinguser
     *
     * @return [type]
     */
    public function findHiddenByUser($ratinguser)
    {
      $query = $this->createQuery();

      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      $query->getQuerySettings()->setIgnoreEnableFields(TRUE);

      $query->matching($query->equals('proposinguser', $ratinguser));

      return $query->execute();
    }

    /**
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @param \JS\Marketplace\Domain\Model\Category $category
     * @param int $offset
     * @param int $limit
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByOptions(
        $filter,
        $category,
        $offset= 0,
        $limit = 0
    )
    {
        $query = $this->createQuery();

        // Constraints initialisieren
        $constraints = array();

        //
        // get Products by filter
        // Phrase, Country, Dealer, Continent, Tradebloc
        //
        if(count($filter->getOptions())){

            $optMatch = [];
            foreach ($filter->getOptions() as $option){
                $optMatch[] = $query->contains('options', $option);
            }

            $constraints[] = $query->logicalOr($optMatch);

        }

        //
        // Category
        //
        if(count($category)){
            $constraints[] = $query->equals('category', $category);
        }

        //
        // Country
        //
        if(count($filter->getCountry())){
            $filterActive = true;

            $filteredArticles = $this->articleRepository->findByFilter($filter);
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($filteredArticles, 'filteredArticles');
            if(count($filteredArticles)){
                $optMatch = [];
                foreach ($filter->getExtras() as $option) {
                    $optMatch[] = $query->equals('uid', $option->getProduct()->getUid());
                }
                \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($opts);
                $constraints[] = $query->logicalOr($opts);
            }
        }

        //
        // Filter by producer
        // -------------------------------------------
        //
        if(count($filter->getProducer())){
            $filterActive = true;
            $constraints[] = $query->in('producer', $filter->getProducer());
        }


        //
        // Filter by searchphrase
        // -------------------------------------------
        //
        if ($filter->getSearchphrase() != '') {
            $columns = 'title,teaser,description,producer.name';

            foreach (explode(',', $columns) as $key => $col) {
                foreach (explode(' ', $filter->getSearchphrase()) as $text) {
                    $c[] = $query->like($col, '%' . $text . '%');
                }
                $t[] = $query->logicalOr($query->logicalOr($c));
            }
            $constraints[] = $query->logicalOr($t);
        }



        //
        // Sort by
        // -------------------------------------------
        //
        switch($filter->getSortby()) {
            case 0:
                // Sort by article count
                $query->setOrderings(array(
                    'articles' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 1:
                // titel desc
                $query->setOrderings(array(
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 2:
                // Overall rating
                $query->setOrderings(array(
                    'averagerating' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 3:
                // Ratings count -- sorting in Controller, since no corresponding field is available
                $query->setOrderings(array(
                    // 'ratings' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 4:
                // Producer title
                $query->setOrderings(array(
                    'producer.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 5:
                // Producer title (Z-A)
                $query->setOrderings(array(
                    'producer.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                    'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                    'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
                ));
                break;
            case 6:
                // Sort by price (asc)
                // handled in controller
                break;
            case 7:
                // Sort by price (desc)
                // handled in controller
                break;
            default:
                break;
            #
            # Sorting
            # 0: no sorting (alphabetical)
            # 1: rating
            # 2: alphabet
        }

        //
        // Use given constraints
        // -------------------------------------------
        //
        if(count($constraints)){
            $query->matching($query->logicalAnd($constraints));
        }

        if($offset) $query->setOffset($offset);
        if($limit) $query->setLimit($limit);

        $result = $query->execute();

        return $result;

    }

    public function findRecentWithLimit($limit = 0)
    {
        $query = $this->createQuery();

        $query->setLimit($limit);

        return $query->execute();
    }
}
