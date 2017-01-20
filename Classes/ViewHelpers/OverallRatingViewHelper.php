<?php
namespace JS\Marketplace\ViewHelpers;

class OverallRatingViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

  /**
  * Beschreibung der Methode
  * @param mixed $rating
  * @param string $class
  * @return string the stars in HTML structure
  */
  public function render($rating = 0, $class = 'rating')
  {

    $output = '';

    if(!$rating){
      return 'No rating given!';
    }
    if($class != 'rating'){
      $class = 'rating '.$class;
    }

    $rating = round($rating);
    $output .= '<fieldset class="'.$class.'">';
    for($i = 5; $i > 0; $i--) {
      $output .= $this->_buildInput($i, $i == $rating);
    }
    $output .= '</fieldset>';
    /*
    <fieldset class="rating">
        <legend>Please rate:</legend>
        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
    </fieldset>
      
     */
    
    return $output;
  }

  private function _buildInput($idx = 1, $checked = FALSE)
  {
    $input = '<input id="star'.$idx.'" type="radio" name="rating" value="'.$idx.'"';
    if($checked){
      $input .= ' checked';
    }
    $input .= ' /><label for="star'.$idx.'">'.$idx.'</label>';
    return $input;
  }
}
