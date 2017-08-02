<?php
namespace JS\Marketplace\Domain\Repository;

    /***
     *
     * This file is part of the "Marketplace" Extension for TYPO3 CMS.
     *
     * For the full copyright and license information, please read the
     * LICENSE.txt file that was distributed with this source code.
     *
     *  (c) 2017 Joe Schäfer
     *
     ***/

    /**
     * The repository for Filtergroups
     */
class FiltergroupRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    // Example for repository wide settings
    public function initializeObject() {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

        // don't add the pid constraint
        $querySettings->setRespectStoragePage(FALSE);

        // set the storagePids to respect
        #$querySettings->setStoragePageIds(array(1, 26, 989));

        // don't add fields from enablecolumns constraint
        // this function is deprecated!
        #$querySettings->setRespectEnableFields(FALSE);

        // define the enablecolumn fields to be ignored
        // if nothing else is given, all enableFields are ignored
        #$querySettings->setIgnoreEnableFields(TRUE);
        // define single fields to be ignored
        #$querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));

        // add deleted rows to the result
        #$querySettings->setIncludeDeleted(TRUE);

        // don't add sys_language_uid constraint
        #$querySettings->setRespectSysLanguage(FALSE);

        $this->setDefaultQuerySettings($querySettings);
    }

    public function findByPid($pid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        // set the storagePids to respect

        if($pid > 0) {
            $query->getQuerySettings()->setStoragePageIds(array($pid));
        }

        return $query->execute();
    }
}
