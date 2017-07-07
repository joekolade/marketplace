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

        // Todo: get selects of selects in TCA

        if($config['row']['category'][0] != NULL) {
            $selects = $this->_getCategory($config['row']['category'][0])->getSelects()->toArray();

            foreach ($selects as $select) {
                if($select->getSelects()){
                    $selects = array_merge($selects, $select->getSelects());
                }
            }

            $itemList = [];
            foreach ($selects as $select) {

                foreach ($select->getOptions() as $option) {
                    $itemList[] = [$select->getOutput() . ': ' . $option->getTitle(), $option->getUid()];
                }

            }
            if(count($itemList))
                $config['items'] = $itemList;
        }

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
