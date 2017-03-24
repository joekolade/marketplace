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

    $continents = array();

    foreach ($product->getArticles() as $article) {
      $c = $article->getDealer()->getCountry()->getContinent()->getName();
      if(count($continents[$c])) {
        $continents[$c]['countries'][] = $article->getDealer()->getCountry()->getName();
      }
      else {
        $continents[$c] = array(
          'name' => $c,
          'countries' => array($article->getDealer()->getCountry()->getName())
        );
      }
    }

    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($continents, '$continents');

    $this->templateVariableContainer->add('continents', $continents);

    $output .= $this->renderChildren();

    $this->templateVariableContainer->remove('continents');

    // $output .= parent::render();

    return $output;
  }


    #Want more:
    #https://docs.typo3.org/typo3cms/ExtbaseFluidBook/8-Fluid/8-developing-a-custom-viewhelper.html
}
