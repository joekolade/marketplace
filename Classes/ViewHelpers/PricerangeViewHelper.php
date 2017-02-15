<?php
namespace JS\Marketplace\ViewHelpers;

class PricerangeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

  /**
  * Beschreibung der Methode
  * @param mixed $articles
  * @return string the pricerange in HTML structure
  */
  public function render($articles = NULL) {

    $output = '';

    if(!$articles){
      return 'No articles given';
    }

    $low = 10000000;
    $lowCurrency = $low;
    $high = 0;
    $highCurrency = $high;

    foreach ($articles as $key => $value) {
      if($value->getComparableprice() < $low){
        $low = $value->getComparableprice();
        if($value->getCurrency()->getUid()) {
          $lowCurrency = $value->getCurrency()->getShort();
          $lowInUSD = $value->getCurrency()->getExchangerate() * $value->getPrice();
        }
        else {
         $lowCurrency = false;
        }
      }
      if($value->getComparableprice() > $high){
        $high = $value->getComparableprice();
        if($value->getCurrency()->getUid()) {
          $highCurrency = $value->getCurrency()->getShort();
          $highInUSD = $value->getCurrency()->getExchangerate() * $value->getPrice();
        }
        else {
         $highCurrency = false;
        }
      }
    }

    if($low && $high){
      $this->templateVariableContainer->add('low', $low);
      $this->templateVariableContainer->add('high', $high);
      $this->templateVariableContainer->add('lowCurrency', $lowCurrency);
      $this->templateVariableContainer->add('highCurrency', $highCurrency);
      $this->templateVariableContainer->add('lowInUSD', money_format('%i', $lowInUSD));
      $this->templateVariableContainer->add('highInUSD', money_format('%i', $highInUSD));
      $output .= $this->renderChildren();
      $this->templateVariableContainer->remove('low');
      $this->templateVariableContainer->remove('high');
      $this->templateVariableContainer->remove('lowCurrency', $lowCurrency);
      $this->templateVariableContainer->remove('highCurrency', $highCurrency);
    }

    // $output .= parent::render();
    return $output;
  }


    #Want more:
    #https://docs.typo3.org/typo3cms/ExtbaseFluidBook/8-Fluid/8-developing-a-custom-viewhelper.html
}
?>
