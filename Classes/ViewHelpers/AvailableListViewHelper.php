<?php

namespace JS\Marketplace\ViewHelpers;

use \JS\Marketplace\Domain\Model\Product;

// use \JS\Marketplace\Domain\Model\Article;

class AvailableListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{


    /**
     * @param Product $product
     *
     * @return string the pricerange in HTML structure
     */
    public function render($product = null)
    {

        $output = '';

        if (!$product) {
            return 'No articles given';
        }

        $continents = array();
        
        foreach ($product->getArticles() as $article) {
            if($article->getDealer()) {

                $c = $article->getDealer()->getCountry()->getContinent()->getName();
                $country = $article->getDealer()->getCountry()->getName();
                if (count($continents[$c])) {
                    if (!in_array($country, $continents[$c]['countries'])) {
                        $continents[$c]['countries'][] = $country;
                    }
                } else {
                    $continents[$c] = array(
                        'name' => $c,
                        'countries' => array($country)
                    );
                }
            }
            else {
                // no Dealer set
            }
        }

        $this->templateVariableContainer->add('continents', $continents);

        $output .= $this->renderChildren();

        $this->templateVariableContainer->remove('continents');

        // $output .= parent::render();

        return $output;
    }


    #Want more:
    #https://docs.typo3.org/typo3cms/ExtbaseFluidBook/8-Fluid/8-developing-a-custom-viewhelper.html
}
