<?php

namespace JS\Marketplace\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Fabian Auer <auer@curo-design.de>, curo design GmbH
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
 * @package markeplace
 */


class UserRepository extends \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository {

  /**
   * defaultOrderings
   *
   * @var array
   */
  protected $defaultOrderings = array(
    'username' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
  );

    /**
     * defaultOrderings
     *
     * @var array
     */
    protected $defaultOrderings = array(
      'username' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
    );

    /**
     * @param string $user
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    public function findHiddenUser($user)
    {
      $query = $this->createQuery();
      $query->matching(
           $query->logicalAnd(
               $query->equals('uid', $user),
               $query->equals('deleted', 0)
           )
        );
        $query->getQuerySettings()->setIgnoreEnableFields(TRUE);

        #$query->setOrderings(array("crdate" => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING));
        $query->setLimit(1);
      # return  $query->matching($query->equals('uid',$user))->setLimit(1)->execute();
        $result = $query->execute();
        #if ($result instanceof Tx_Extbase_Persistence_QueryResultInterface) {
        if ($result instanceof \TYPO3\CMS\Extbase\Persistence\QueryResultInterface) {

            return $result->getFirst();

        }
    }

    /**
     * @param string $hash
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    public function findHiddenByHash($hash){

      $query = $this->createQuery();
      $query->matching(
        $query->equals('hash', $hash)
      );

      $query->getQuerySettings()->setRespectStoragePage(FALSE); //result of all pids
      $query->getQuerySettings()->setIgnoreEnableFields(TRUE); // add hidden entries to repository
      $query->getQuerySettings()->setIncludeDeleted(FALSE); // DELETED nicht mit reinnehmen

      $result = $query->execute();
      //return 0;
      return $result->getFirst();
    }

    /**
     * @param string $mail
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    public function countHiddenByEmail($mail){

      $query = $this->createQuery();
      $query->matching(
        $query->equals('email', $mail)
      );

      $query->getQuerySettings()->setRespectStoragePage(FALSE); //result of all pids
      $query->getQuerySettings()->setIgnoreEnableFields(TRUE); //add hidden entries to repository
      $query->getQuerySettings()->setIncludeDeleted(FALSE); // DELETED nicht mit reinnehmen

      $result = $query->execute()->count();
      //return 0;
      return $result;
    }

}
?>
