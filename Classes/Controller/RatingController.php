<?php
namespace JS\Marketplace\Controller;

use JS\Marketplace\Domain\Model\Filter;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Joe Schäfer <joe@schaefer-webentwicklung.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * RatingController
 */
class RatingController extends \JS\Marketplace\Controller\AbstractController
{
    
    public function initializeAction(){
    }

    /**
     * action reportRating
     *
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     * @return void
     */
    public function reportRatingAction($rating)
    {
      $this->view->assignMultiple([
          'rating' => $rating,
          'user_email' => '',
      ]);
    }


    /**
     * action sendReport
     *
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     * @param string $reason
     * @validate $reason \string
     * @param string $message
     * 
     * @return void
     */
    public function sendReportAction($rating, string $reason)
    {
      \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($rating);
      \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($reason);
      \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($message);
    }
}
