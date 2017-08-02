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
            $filtergroups = $this->_getCategory($config['row']['category'][0])->getFiltergroups()->toArray();
            
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($config['row']);

            $itemList = [];
            foreach ($filtergroups as $filtergroup) {

                foreach ($filtergroup->getOptions() as $option) {
                    $subgroup = $option->getFiltersubgroup() ? ' - '.$option->getFiltersubgroup()->getTitle() : '';
                    $itemList[] = [$filtergroup->getOutput() . $subgroup . ': ' . $option->getTitle(), $option->getUid()];
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
