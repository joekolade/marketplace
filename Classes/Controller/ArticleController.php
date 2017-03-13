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
 * ArticleController
 */
class ArticleController extends \JS\Marketplace\Controller\AbstractController
{
    public function initializeListAction(){
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->arguments->getArgument('productgroupFilter'));
    }


    /**
     * action list
     *
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @ignorevalidation $filter
     * @return void
     */
    public function listAction(\JS\Marketplace\Domain\Model\Filter $filter = NULL)
    {
        if(!$filter) {
            $filter = new \JS\Marketplace\Domain\Model\Filter();
            $articles = $this->articleRepository->findAll();
        }
        else {
            $articles = $this->articleRepository->findByFilter($filter);
            // $articles = $this->articleRepository->findAll();
        }

        $this->view->assignMultiple([
            // The filtered articles
            'articles' => $articles,
            // all Productgroups & Productsubgroups
            'productgroups' => $this->productgroupRepository->findAll(),
            'productsubgroups' => $this->productsubgroupRepository->findAll(),
            'countries' => $this->countryRepository->findAll(),
            // Filter
            'filter' => $filter,
        ]);
    }

    /**
     * action show
     *
     * @param \JS\Marketplace\Domain\Model\Article $article
     * @return void
     */
    public function showAction(\JS\Marketplace\Domain\Model\Article $article)
    {
        $this->view->assign('article', $article);
    }

    /**
     * contact dealer of an article
     *
     * @param \JS\Marketplace\Domain\Model\Article $article
     * @return void
     */
    public function contactAction(\JS\Marketplace\Domain\Model\Article $article)
    {
        $lead = new \JS\Marketplace\Domain\Model\Lead();
        $lead->setArticle($article);
        $this->view->assign('lead', $lead);
        $this->view->assign('view','lead');
    }

    /**
     * send off lead
     *
     * @param \JS\Marketplace\Domain\Model\Lead $lead
     * @ignorevalidation $lead
     * @return void
     */
    public function sendleadAction(\JS\Marketplace\Domain\Model\Lead $lead)
    {
        // Send Template Emails
        $emailSettings = $this->settings['email'];

        $dealer = $lead->getArticle()->getDealer();

        // make $lead safe
        $lead->setMessage(htmlspecialchars($lead->getMessage()));
        $lead->setName(htmlspecialchars($lead->getName()));
        $lead->setFirstname(htmlspecialchars($lead->getFirstname()));

        # E-Mail to Sendea.biz
        $recipients = array($emailSettings['receiver'] => $emailSettings['receiverName']);
        $sender = array($emailSettings['sender'] => $emailSettings['senderName']);
        $subject = '[To Sendea] '. $emailSettings['subjectReceiver'] . ' ' . $lead->getArticle()->getProduct()->getTitle() . ' to ' . $dealer->getName() .', ' . $dealer->getCountry()->getName();
        $templateName = 'Receiver';
        $arguments = array('lead' => $lead);

        if(!$this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments)){
            $error = true;
        }

        # E-Mail to Dealer
        $recipients = array($dealer->getEmail() => $dealer->getName());
        $sender = array($lead->getEmail() => $lead->getName());
        $subject = '[To Dealer] '. $emailSettings['subjectDealer'] . ' ' . $lead->getArticle()->getProduct()->getTitle();
        $templateName = 'Dealer';
        $arguments = array('lead' => $lead);

        return $this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments);

        if(!$this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments)){
            $error = true;
        }

        # Visual Feedback to customer
        if($error){
            $messageBody = 'Please try again!';
            $messageTitle = 'An error occured!';
            $severity = 'error';
        }
        else {
            $messageBody = 'Your message was delivered to ' . $lead->getArticle()->getDealer()->getName() . '!';
            $messageTitle = 'Thank you, ' . $lead->getName();
            $severity = 'ok';
        }

        $this->sendMessage($messageTitle, $messageBody, $severity);

        $this->redirect('show', 'Product', NULL, array('product' => $lead->getArticle()->getProduct()));
    }
}
