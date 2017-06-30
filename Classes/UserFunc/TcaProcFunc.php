<?php
namespace JS\Marketplace\UserFunc;

class TcaProcFunc extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * selectRepository
     *
     * @var \JS\Marketplace\Domain\Repository\SelectRepository
     * @inject
     */
    protected $selectRepository = NULL;

    /**
     * @param array $config
     * @return array
     */
    public function productOptions($config)
    {
        $itemList = [];
        $rows = $this->_getSelectsByPid(188);
        foreach ($rows as $row) {
            $itemList[] = ['Label of the item', $row['title']];
        }
        $config['items'] = $itemList;
        return $config;
    }


    private function _getSelectsByPid($pid = 0)
    {
        return $this->selectRepository->findAll();
    }
}
