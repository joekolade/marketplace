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
 * The repository for Ratings
 */
class RatingRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
//        'user' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        'tstamp' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * find all ratings (really)
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
     * find all ratings  by user to activate them when a user finishes registration
     * @param \JS\Marketplace\Domain\Model\User $ratinguser
     *
     * @return [type]
     */
    public function findHiddenByUser($ratinguser)
    {
      $query = $this->createQuery();

      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      $query->getQuerySettings()->setIgnoreEnableFields(TRUE);

      $query->matching($query->equals('ratinguser', $ratinguser));

      return $query->execute();
    }

    /**
     * Find the last given Rating
     *
     * @param  \JS\Marketplace\Domain\Model\Product $product
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     *
     * @return \JS\Marketplace\Domain\Model\Rating
     */
    public function findLastByProductAndUser($product, $user)
    {
      $query = $this->createQuery();

      $query->matching($query->logicalAnd(
        $query->equals('ratinguser', $user),
        $query->equals('product', $product)
      ));

      // Sort by crdate
      $query->setOrderings(array(
        'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
      ));

      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      return $query->execute()->getFirst();

    }

}
