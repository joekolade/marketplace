<?php
namespace JS\Marketplace\UserFunc;

class TcaProcFunc
{

    /**
     * @param array $config
     * @return array
     */
    public function productOptions($config)
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($config['row']['category']);
        $itemList = [];
        $rows = $this->_getSelectsByPid(188);
        foreach ($rows as $row) {
            $itemList[] = [$row->getOutput() . ': ' . $row->getTitle(), $row->getUid()];
        }
        $config['items'] = $itemList;
        return $config;
    }


    private function _getSelectsByPid($pid = 0)
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $selectRepository = $objectManager->get('JS\\Marketplace\\Domain\\Repository\\SelectRepository');
        $items = $selectRepository->findByPid($pid);
        
        return $items;
    }
}
