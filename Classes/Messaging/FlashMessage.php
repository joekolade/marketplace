<?php
namespace JS\Marketplace\Messaging;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class FlashMessage extends \TYPO3\CMS\Core\Messaging\FlashMessage {
  protected $classes = array(
    self::NOTICE => 'notice alert alert-info alert-dismissible',
    self::INFO => 'info alert alert-info alert-dismissible',
    self::OK => 'ok alert alert-success alert-dismissible',
    self::WARNING => 'warning alert alert-warning alert-dismissible',
    self::ERROR => 'error alert alert-danger alert-dismissible'
  );

  /**
   * Renders the flash message.
   *
   * @return string The flash message as HTML.
   * @deprecated since TYPO3 CMS 7, will be removed in TYPO3 CMS 8
   */
  public function render()
  {
      GeneralUtility::logDeprecatedFunction();
      $title = '';
      if (!empty($this->title)) {
          $title = '<h4 class="alert-title">' . $this->title . '</h4>';
      }
      $message = '
    <div class="' . $this->getClass() . '">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      ' . $title . '
      <div>' . $this->message . '</div>
    </div>';
      return $message;
  }
}
