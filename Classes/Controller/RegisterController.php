<?php
namespace JS\Marketplace\Controller;

use \JS\Marketplace\Domain\Model\Filter;

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
 * RegisterController
 */
class RegisterController extends \JS\Marketplace\Controller\AbstractController
{
    /**
     * showRegisterFormAction
     * 
     * @param \JS\Marketplace\Domain\Model\User $user
     * @return void
     */
    public function showRegisterFormAction($user = NULL)
    {
        if($this->request->hasArgument('rating')){
            $rating = $this->ratingRepository->findHiddenByUid($this->request->getArgument('rating'));
        }
        if($this->request->hasArgument('product')){
            $product = $this->productRepository->findHiddenByUid($this->request->getArgument('product'));
        }

        if(!$user){
            $user = new \JS\Marketplace\Domain\Model\User();
        }

        $this->view->assignMultiple(array(
            'user' => $user,
            'rating' => $rating,
            'product' => $product,
        ));
    }


    public function initializeRegisterUserAction() {
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->request->getArgument('user'));
        // $this->registerPartialValidatorForArgument('user','UserRegister');
    }

    /**
     * registerUserAction
     * 
     * @param \JS\Marketplace\Domain\Model\User $user
     * @validate $user \JS\Marketplace\Validation\Validator\PasswordValidator
     * @return void
     */
    public function registerUserAction($user = NULL)
    {

        $hash = sha1($user->getLastName().$user->getEmail().date('U'));

        $user->setPassword($this->encryptPassword($user->getPassword()));
        $user->setName($user->getFirstName() . ' ' . $user->getLastName());
        $user->setHash($hash);
        $user->addUserGroup($this->feUserGroupRepository->findByUid($this->settings['register']['pendingFeGroup']));

        // $user->setHidden('TRUE');
        $this->userRepository->add($user);

        # if there is a new rating add the user to them
        $rating = $this->ratingRepository->findHiddenByUid($this->request->getArgument('rating'));
        if($rating){
            $rating->setRatinguser($user);
            $this->ratingRepository->update($rating);
        }

        # if there are is a new product add the user to them
        $product = $this->productRepository->findHiddenByUid($this->request->getArgument('product'));
        if($product){
            $product->setProposinguser($user);
            $this->productRepository->update($product);
        }

        // Send Template Emails
        $emailSettings = $this->settings['registerEmail'];

        # E-Mail to user
        $recipients = array($user->getEmail() => $user->getName());
        $sender = array($emailSettings['sender'] => $emailSettings['senderName']);

        $subject = $emailSettings['subjectReceiver'];
        $templateName = 'Register';
        $arguments = array('user' => $user, $settings => $this->settings);

        if(!$this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments)){
            $error = true;
        }

        // $this->redirect('show', 'Product', NULL, array('product' => $lead->getArticle()->getProduct()));

        $this->view->assign('user', $user);

    }
    
    /**
     * Called by confirmation link in email while registering an user
     *
     * @param string $hash
     * @return void
     */
    public function confirmUserAction($hash = NULL)
    {
        // Prepare success dialog so far
        $messageTitle = 'Success, ';
        $messageBody = 'Your account was approved and you have been logged in!';
        $severity = 'ok';


        if(!$hash){
            $error = TRUE;
        }
        else {
            // a Register user
            $user = $this->userRepository->findHiddenByHash($hash);
            
            if(!$user){
                $error = TRUE;
            }
            else {
                
                $messageTitle .= $user->getName();
                $user->setHash(0);
                // $user->setPid($this->settings['']);
                
                // Set Groups            
                $pendingGroup = $this->feUserGroupRepository->findByUid($this->settings['register']['pendingFeGroup']);
                $activeGroup = $this->feUserGroupRepository->findByUid($this->settings['register']['registeredFeGroup']);
                $user->removeUserGroup($pendingGroup);
                $user->addUserGroup($activeGroup);
                
                // Enable user
                $user->setDisable(0);
                
                // Update user data
                $this->userRepository->update($user);
                $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
                $persistenceManager->persistAll();

                // Login user
                if(!$this->loginUser($user->getUsername(), $user->getPassword(), TRUE)){
                    die('There was a problem with your credentials. You could not be logged in.');
                }

                // Activate Ratings
                $ratings = $this->ratingRepository->findHiddenByUser($user);
                if($ratings){
                    foreach ($ratings as $rating) {
                        $rating->setHidden(FALSE);
                        $this->ratingRepository->update($rating);

                        // Inform user about publisheb rating
                        $messageBody .= '<br>';
                        $messageBody .= '<br>';
                        $messageBody .= 'Your Rating has been published.';
                        
                        $this->view->assign('product', $rating->getProduct());
                    }
                }
                
                // Send product suggestions if there are any
                $product = $this->productRepository->findHiddenByUser($user)->getFirst();

                if($product){
                    
                    $this->sendMessage($messageTitle, $messageBody, $severity);

                    $this->redirect(
                        'proposeProduct',
                        'Product',
                        NULL,
                        array(
                            'product' => $product,
                            // 'rating' => $ratings,
                            // $arguments = NULL,
                        ),
                        $pageUid = $this->settings['ratingList']['pid']
                    );
                    
                    $this->view->assign('product', $product);

                }
            }
        } 
        # Visual Feedback to customer
        if($error){
            $messageBody = 'Please retry or contact us!';
            $messageTitle = 'An error occured!';
            $severity = 'error';
        }

        $this->sendMessage($messageTitle, $messageBody, $severity);
        
        // 
        // TODO: Forward je nach Aktion vor der Registrierung
        // 
        $this->view->assignMultiple(array(
            'user' => $user,
            'error' => $error,
        ));
    }

    /**
     * Encrypt the password
     *
     * @param string $password
     * @return string
     *
     * (c) 2011 Sebastian Fischer <typo3@evoweb.de>
     * SfRegister
     */
    public function encryptPassword($password) {
        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('saltedpasswords') && \TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility::isUsageEnabled('FE')) {
        
            $saltObject = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance(NULL);
            if (is_object($saltObject)) {
                $password = $saltObject->getHashedPassword($password);
            }
        } elseif ($this->settings['encryptPassword'] === 'md5') {
            $password = md5($password);
        } elseif ($this->settings['encryptPassword'] === 'sha1') {
            $password = sha1($password);
        }

        return $password;
    }

}
