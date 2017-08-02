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
 * AbstractController
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository = NULL;

    /**
     * articleRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ArticleRepository
     * @inject
     */
    protected $articleRepository = NULL;

    /**
     * productgroupRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ProductgroupRepository
     * @inject
     */
    protected $productgroupRepository = NULL;

    /**
     * productsubgroupRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ProductsubgroupRepository
     * @inject
     */
    protected $productsubgroupRepository = NULL;

    /**
     * countryRepository
     *
     * @var \JS\Marketplace\Domain\Repository\CountryRepository
     * @inject
     */
    protected $countryRepository = NULL;

    /**
     * ratingRepository
     *
     * @var \JS\Marketplace\Domain\Repository\RatingRepository
     * @inject
     */
    protected $ratingRepository = NULL;


    /**
     * producerRepository
     *
     * @var \JS\Marketplace\Domain\Repository\ProducerRepository
     * @inject
     */
    protected $producerRepository = NULL;

    /**
     * userRepository
     *
     * @var \JS\Marketplace\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = NULL;

    /**
     * feUserGroupRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository
     * @inject
     */
    protected $feUserGroupRepository = NULL;

    /**
     * categoryRepository
     *
     * @var \JS\Marketplace\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository = NULL;

    /**
     * filtergroupRepository
     *
     * @var \JS\Marketplace\Domain\Repository\FiltergroupRepository
     * @inject
     */
    protected $filtergroupRepository = NULL;

    /**
     * filtersubgroupRepository
     *
     * @var \JS\Marketplace\Domain\Repository\FiltersubgroupRepository
     * @inject
     */
    protected $filtersubgroupRepository = NULL;

    /**
     * optionRepository
     *
     * @var \JS\Marketplace\Domain\Repository\OptionRepository
     * @inject
     */
    protected $optionRepository = NULL;



    /**
     * This method should be called in the corresponding initialize*Action,
     * and it will rebuild the registered validators for this argument.
     *
     * It will also respect the @validate annotation on the action method name.
     *
     * THIS METHOD WILL NOT CHECK A @dontvalidate ANNOTATION. Thus, it should NOT be used
     * for displaying a form, but instead be used for SAVING data.
     *
     * @param string $argumentName The name of the argument where the partial validator should be registered for.
     */
    protected function registerPartialValidatorForArgument($argumentName, $modelName) {
        if ($this->request->hasArgument($argumentName)) {

            // Build up the validator for all submitted data.
            $rawRequestDataForArgument = $this->arguments->getArgument($argumentName);
            $argument = $this->arguments[$argumentName];
            /** @var \TYPO3\CMS\Extbase\Validation\ValidatorResolver */
            $validatorResolver = $this->objectManager->get('TYPO3\CMS\Extbase\Validation\ValidatorResolver');
            $newValidator = $validatorResolver->getBaseValidatorConjunction('\\JS\\Marketplace\\Domain\\Model\\'.$modelName);

            /** @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator */
            $conjunctionValidator = $this->arguments->getArgument($argumentName)->getValidator();

            // Alle alten Validatoren entfernen
            foreach ($conjunctionValidator->getValidators() as $validator) {
                $conjunctionValidator->removeValidator($validator);
            }

            // Validatoren des Models AnmeldungWmt hinzufuegen
            $conjunctionValidator->addValidator($newValidator);
        }
    }

    /**
    * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
    * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
    * @param string $subject subject of the email
    * @param string $templateName template name (UpperCamelCase)
    * @param array $variables variables to be passed to the Fluid view
    * @return boolean TRUE on success, otherwise false
    */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
        $templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);

        $emailBody = $emailView->render();

        // Catch receipient in dev mode
        if($this->settings['dev']['emailCatcher']){
            $recipient = array($this->settings['dev']['emailCatcher'] => '(DEV Catcher) ' . $recipient[0]);
            $subject = '(DEV email-catcher) ' . $subject;
        }

        /** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
        $message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
        ->setFrom($sender)
        ->setSubject($subject);

      // Plain text email
        $message->setBody($emailBody, 'text/plain');

      // HTML email
      // $message->setBody($emailBody, 'text/html');

        $message->send();
        return $message->isSent();
    }

    /**
     * logs in an user
     *
     * @param string $uname
     * @param string $pwd
     * @param boolean $passthrough
     *
     * @return boolean
     */
    protected function loginUser($uname, $pwd = '', $passthrough = FALSE)
    {


        $success = FALSE;
        $loginData = array(
            'uname' => $uname,
            'uident_text' => $pwd,
            'status' => 'login'
            );


        $frontEndUser = $GLOBALS['TSFE']->fe_user;
        $frontEndUser->checkPid = FALSE;


        $authenticationData = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
        $userData = $frontEndUser->fetchUserRecord($authenticationData['db_user'], $uname);
        $frontEndUser->user = $userData;

        $saltedPassword = '';
        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('saltedpasswords')) {
            if (\TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility::isUsageEnabled('FE')) {
                $objSalt = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance(NULL);
               // if (is_object($objSalt)) {
               //    $saltedPassword = $objSalt->getHashedPassword($pwd);
               // }
            }
            if (is_object($objSalt)) {
                $success = $objSalt->checkPassword($pwd, $frontEndUser->user['password']);
            }
        }

        // Is a passthrough?
        if($passthrough){
            $success = $pwd == $frontEndUser->user['password'];
            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($pwd.' == '.$frontEndUser->user['password'], 'Passthrough');
        }

        // Create session
        if($success) {
            $frontEndUser->createUserSession($userData);
            // Using hack: https://forge.typo3.org/issues/62194
            $reflection = new \ReflectionClass($frontEndUser);
            $setSessionCookieMethod = $reflection->getMethod('setSessionCookie');
            $setSessionCookieMethod->setAccessible(TRUE);
            $setSessionCookieMethod->invoke($frontEndUser);
            $frontEndUser->user = $frontEndUser->fetchUserSession();
        }

        return $success;
    }

    protected function sendMessage($title, $body, $severity = 'error')
    {
        $storeInSession = TRUE;

        switch($severity){
            case 'error':
            $severity = \JS\Marketplace\Messaging\FlashMessage::ERROR;
            break;
            case 'warning':
            $severity = \JS\Marketplace\Messaging\FlashMessage::WARNING;
            break;
            case 'notice':
            $severity = \JS\Marketplace\Messaging\FlashMessage::NOTICE;
            break;
            case 'info':
            $severity = \JS\Marketplace\Messaging\FlashMessage::INFO;
            break;
            // case 'ok':
            default:
            $severity = \JS\Marketplace\Messaging\FlashMessage::OK;
            break;
        }

        $this->controllerContext->getFlashMessageQueue()->enqueue(
            $this->objectManager->get(
                'JS\\Marketplace\\Messaging\\FlashMessage',
                $body,
                $title,
                $severity,
                $storeInSession
                )
            );
    }

    /**
     * Deactivate errorFlashMessage
     *
     * @return bool|string
     */
    public function getErrorFlashMessage()
    {
        return FALSE;
    }

    /**
     * [sanitize description]
     *
     * @param string $string
     * @return string
     */
    protected function sanitize($string)
    {
        return htmlentities ( trim ( strip_tags( $string ) ) , ENT_NOQUOTES );
    }

    /**
     * build paginator
     *
     * @param int $actualPage [description]
     * @param int $totalPages [description]
     * @return array
     */
    protected function buildPagination($actualPage, $totalPages)
    {

        //Anzahl der Seiten die im Paginator angezeigt werden sollen:
        $pageLinks = $this->settings['pagination']['pageLinks'] ? intval( $this->settings['pagination']['pageLinks'] ) : 3;

        $lower = intval( floor( $pageLinks/2 ) );
        $upper = intval( ceil( $pageLinks/2 ) );

        $i = 1;

        // case 1
        // Es können alle Seiten dierekt in der Paginierung angezeigt werden
        // Paginierung: 1 | 2 | 3 | 4 | 5 | 6 | 7
        if($totalPages <= $pageLinks) {
            while ($i <= $totalPages) {
                $pagination[$i]['value'] = $i;
                if ($i == $actualPage) {
                    $pagination[$i]['class'] = 'active';
                }
                $i++;
            }
            return $pagination;
        }

        // case 2
        // Die aktuelle Seite ist kleiner 4, die Paginierung beginnt mit 1
        // Paginierung: 1 | 2 | 3 | 4 | 5 | 6 | 7 | >>
        if($actualPage < $upper) {
            while ($i <= $pageLinks) {
                $pagination[$i]['value'] = $i;
                if ($i == $actualPage) {
                    $pagination[$i]['class'] = 'active';
                }
                $i++;
            }
                // link to last page
            $pagination[$i]['value'] = $totalPages;
            if($i != $totalPages) $pagination[$i]['class'] = 'last';

            return $pagination;
        }

        // case 3
        // Die aktuelle Seite liegt irgendwo in der Mitte
        // Paginierung: << | 5 | 6 | 7 | 8 | 9 | 10 | 11 | >>
        if($actualPage >= $upper && $actualPage < $totalPages - $lower) {
            //beginn der Paginierung berechnen:
            $i = $actualPage - $lower + 1;

            // link to first page
            $pagination[0]['value'] = 1;
            if($i != 2) $pagination[0]['class'] = 'first';

            while ($i < $actualPage - $lower + $pageLinks) {
                $pagination[$i]['value'] = $i;
                if ($i == $actualPage) {
                    $pagination[$i]['class'] = 'active';
                }
                $i++;
            }

            // link to last page
            $pagination[$i]['value'] = $totalPages;
            if($i != $totalPages) $pagination[$i]['class'] = 'last';

            return $pagination;
        }

        // case 4
        // Die aktuelle Seite liegt unter den letzten 3
        // Paginierung: << | 15 | 16 | 17 | 18 | 19 | 20 | 21 |
        if($actualPage >= $totalPages - $lower) {
            //beginn der Paginierung berechnen:
            $i = $totalPages - $pageLinks + 1;

            // link to first page
            $pagination[0]['value'] = 1;
            if($i != 2) $pagination[0]['class'] = 'first';

            while ($i <= $totalPages) {
                $pagination[$i]['value'] = $i;
                if ($i == $actualPage) {
                    $pagination[$i]['class'] = 'active';
                }
                $i++;
            }
            return $pagination;
        }
    }

}
