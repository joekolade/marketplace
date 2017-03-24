<?php
namespace JS\Marketplace\ViewHelpers;

use \JS\Marketplace\Domain\Model\Article;

class AvailableListViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


  /**
   * @param mixed $articles
   * @return string the pricerange in HTML structure
   */
  public function render($articles = NULL) {

    $output = '';

    if(!$articles){
      return 'No articles given';
    }

    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($articles);


    // if($low && $high){
    //   $this->templateVariableContainer->add('low', $low);
    //   $this->templateVariableContainer->add('high', $high);
    //   $this->templateVariableContainer->add('lowCurrency', $lowCurrency);
    //   $this->templateVariableContainer->add('highCurrency', $highCurrency);
    //   $this->templateVariableContainer->add('lowInUSD', money_format('%i', $lowInUSD));
    //   $this->templateVariableContainer->add('highInUSD', money_format('%i', $highInUSD));
    //   $output .= $this->renderChildren();
    //   $this->templateVariableContainer->remove('low');
    //   $this->templateVariableContainer->remove('high');
    //   $this->templateVariableContainer->remove('lowCurrency', $lowCurrency);
    //   $this->templateVariableContainer->remove('highCurrency', $highCurrency);
    // }

    // $output .= parent::render();
    return $output;
  }


    #Want more:
    #https://docs.typo3.org/typo3cms/ExtbaseFluidBook/8-Fluid/8-developing-a-custom-viewhelper.html
}
?>
