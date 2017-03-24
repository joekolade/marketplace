<?php
namespace JS\Marketplace\ViewHelpers;

use \JS\Marketplace\Domain\Model\Product;
// use \JS\Marketplace\Domain\Model\Article;

class AvailableListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


  /**
   * @param Product $product
   *
   * @return string the pricerange in HTML structure
   */
  public function render($product = NULL) {

    $output = '';

    if(!$product){
      return 'No articles given';
    }

    $countries = array();

    foreach ($product->getArticles() as $article) {
      $c = $article->getDealer()->getCountry()->getContinent()->getName();
      $countries[$c] = array(
        'continent' => $c,
        'country' => $article->getDealer()->getCountry()->getName()
      );
    }

    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($countries, '$countries');

    $this->templateVariableContainer->add('countries', $countries);

    $output .= $this->renderChildren();

    $this->templateVariableContainer->remove('countries');

    $output .= parent::render();

    return $output;
  }


    #Want more:
    #https://docs.typo3.org/typo3cms/ExtbaseFluidBook/8-Fluid/8-developing-a-custom-viewhelper.html
}
