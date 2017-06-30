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
        $selects = $this->_getCategory($config['row']['category'][0])->getSelects();
        
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($selects);

        $itemList = [];
        $rows = $this->_getSelectsByPid(188);
        foreach ($rows as $row) {
            $itemList[] = [$row->getOutput() . ': ' . $row->getTitle(), $row->getUid()];
        }
        $config['items'] = $itemList;
        return $config;
    }


    private function _getCategory($id = 0)
    {
        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $categoryRepository = $objectManager->get('JS\\Marketplace\\Domain\\Repository\\CategoryRepository');
        $category = $categoryRepository->findByUid($id);

        return $category;
    }
}
